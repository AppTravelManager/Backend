<?php

    class USER extends DB
    {
        private $uid;
        private $table;

        /**
         * @param $uid
         * @param $table
         */
        public function __construct($uid, $table)
        {
            $this->uid = $uid;
            $this->table = $table;
        }

        /**
         * @return mixed
         */
        public function getUid()
        {
            return $this->uid;
        }

        /**
         * @param mixed $uid
         */
        public function setUid($uid)
        {
            $this->uid = $uid;
        }

        /**
         * @return mixed
         */
        public function getTable()
        {
            return $this->table;
        }

        /**
         * @param mixed $table
         */
        public function setTable($table)
        {
            $this->table = $table;
        }

        public function login($email, $pwd){
            $stmt = $this->select('*',$this->table,array('email' => $email, 'pwd' => $pwd), array('and'));
            $stmt->execute();

            if($stmt->rowCount()) {
                while($row = $stmt->fetch())
                    return $row['idUtente'];
            }else
                return 0;
        }

        public function generateRandomString($length) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        /**
         * @param $dati
         * @return false|int|string
         * Immagine in base64
         */
        public function registra($dati)
        {
            if($this->alreadyExists($this->table,'email',$dati['email']))
                return -1;

            $dati['pwd'] = md5($dati['pwd']);
            $stmt = $this->insert($dati, $this->table);
            $stmt->execute();

            if($stmt->rowCount() > 0)
                return $this->pdo->lastInsertId();
            else
                return 0;

        }


    }

?>