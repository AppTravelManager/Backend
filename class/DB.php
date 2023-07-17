<?php

    class DB
    {
        protected $pdo;

        /**
         * @param $pdo
         */
        public function __construct()
        {
            try {
                $this->pdo = new PDO('mysql:host=localhost;dbname=my_travelmanagerhost',"root","");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo("Can't open the database." . $e->getMessage());
            }
        }

        /**
         * @return mixed
         */
        public function getPdo()
        {
            return $this->pdo;
        }

        /**
         * @param mixed $pdo
         */
        public function setPdo($pdo)
        {
            $this->pdo = $pdo;
        }

        public function alreadyExists($table,$field,$value)
        {
            try{
                $sql = "SELECT * FROM `".$table."` WHERE `".$field."` = :value ";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':value',$value);
                $stmt->execute();

                if($stmt->rowCount() > 0)
                    return true;
                else
                    return false;
            }catch(PDOException $e){
                echo "Errore --> " . $e->getMessage();
            }

        }


        /**
         * @param $fields
         * @param $table
         * @param $join
         * @param $conditions
         * @param $booleans
         * @param $orderBy
         * @return false|PDOStatement
         */
        public function select($fields,$table,$join,$conditions = [],$booleans = [],$orderBy='')
        {
            $sql = "SELECT ";
            if($fields == '*')
                $sql .= "* FROM `" . $table ."`";
            else
            {
                foreach($fields as $f)
                {
                    $sql .= "`".$f."`, ";
                }
                $sql = substr($sql,0,-1);
                $sql = rtrim($sql, ',');
                $sql .= " FROM `" . $table ."`";
            }

            $sql .= $join;

            if(count($conditions) > 0)
            {
                $sql .= " WHERE ";
                $z = 0;
                foreach ($conditions as $col => $val) {
                    if($val != "NULL")
                        $sql .= " `".$col."` = '".$val."' ";
                    else
                        $sql .= " `".$col."` IS NULL";

                    if(count($booleans) > 0 && $z < count($conditions)-1 )
                    {
                        $sql .= $booleans[$z]." ";
                    }
                    $z++;
                }
            }

            if($orderBy != '')
                $sql .= " ORDER BY `".$orderBy['columns']."` ".$orderBy['option'];

            $stmt = $this->pdo->prepare($sql);
            return $stmt;

        }

        public function update($modifiche,$table,$conditions = [],$booleans = [])
        {
            $sql = "UPDATE " . $table ." SET ";

            foreach($modifiche as $campo => $valore)
            {
                $sql .= "`".$campo."` = :" . $campo. ", ";
            }

            $sql = substr($sql,0,-1);
            $sql = rtrim($sql, ',');
            if(count($conditions) > 0)
            {
                $sql .= " WHERE ";
                $z = 0;
                foreach ($conditions as $col => $val) {
                    if($val != "NULL")
                        $sql .= " `".$col."` = '".$val."' ";
                    else
                        $sql .= " `".$col."` IS NULL";

                    if(count($booleans) > 0 && $z < count($conditions)-1 )
                    {
                        $sql .= $booleans[$z]." ";
                    }
                    $z++;
                }
            }

            $stmt = $this->pdo->prepare($sql);

            foreach($modifiche as $campo => $valore)
                $stmt->bindValue(':'.$campo,$valore);

            return $stmt;
        }

        public function emptyField($table, $column, $where) {
            $stmt = $this->update(array($column => ''), $table, $where);
            $stmt->execute();
        }

        public function insert($daInserire,$table)
        {
            $sql = "INSERT INTO " . $table ." SET ";

            foreach($daInserire as $campo => $valore)
            {
                $sql .= "`".$campo."` = :" . $campo. ", ";
            }

            $sql = substr($sql,0,-1);
            $sql = rtrim($sql, ',');

            $stmt = $this->pdo->prepare($sql);

            foreach($daInserire as $campo => $valore)
                $stmt->bindValue(':'.$campo,$valore);

            return $stmt;
        }

        public function delete($table,$conditions = [],$booleans = [])
        {
            $sql = "DELETE FROM " . $table;

            if(count($conditions) > 0)
            {
                $sql .= " WHERE ";
                $z = 0;
                foreach ($conditions as $col => $val) {
                    if($val != "NULL")
                        $sql .= " `".$col."` = '".$val."' ";
                    else
                        $sql .= " `".$col."` IS NULL";

                    if(count($booleans) > 0 && $z < count($conditions)-1 )
                    {
                        $sql .= $booleans[$z]." ";
                    }
                    $z++;
                }
            }

            $stmt = $this->pdo->prepare($sql);

            return $stmt;
        }


    }

?>