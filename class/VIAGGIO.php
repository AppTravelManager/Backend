<?php

    class VIAGGIO extends DB
    {
        private $viaggioId;
        private $table;

        /**
         * @param $viaggioId
         * @param $table
         */
        public function __construct($viaggioId, $table)
        {
            parent::__construct();
            $this->viaggioId = $viaggioId;
            $this->table = $table;
        }

        /**
         * @return mixed
         */
        public function getViaggioId()
        {
            return $this->viaggioId;
        }

        /**
         * @param mixed $viaggioId
         */
        public function setViaggioId($viaggioId)
        {
            $this->viaggioId = $viaggioId;
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

        /**
         * @param $uid
         * @return array
         */
        public function getUserViaggi($uid){

            $viaggi = array();
            $join = "INNER JOIN utenti_viaggi ON ksViaggio = viaggi.idViaggio";

            $stmt = $this->select('*',$this->table,$join,array('ksUtente' => $uid));
            $stmt->execute();

            while($row = $stmt->fetch())
                $viaggi[] = $row;

            return $viaggi;
        }

        /**
         * @param $dati
         * @return int
         */
        public function addViaggio($dati){

            $stmt = $this->insert($dati, $this->table);
            $stmt->execute();

            return $stmt->rowCount();
        }

        public function addUserToViaggio($dati){

            $stmt = $this->insert($dati, $this->table);
            $stmt->execute();

            return $stmt->rowCount();
        }

    }

?>