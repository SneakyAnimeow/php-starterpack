<?php

    class SQLQueryable{
        private mysqli $connection;

        public function setConnection(mysqli $connection) : SQLQueryable{
            $this->connection = $connection;
            return $this;
        }

        public function execute(string $query) : array|bool {
            $result = $this->connection->query($query);
            if ($result->num_rows > 0) {
                $results = [];
                while($row = $result->fetch_assoc()) {
                    $results[] = $row;
                };
                return $results;
            } else {
                return false;
            }
        }
    }

?>