<?php

    interface SQL {
        public function __construct($host, $user, $password, $database);

        public function getHost() : string;
        public function getUser() : string;
        public function getPassword() : string;
        public function getDatabase() : string;

        public function setHost(string $host) : SQL;
        public function setUser(string $user) : SQL;
        public function setPassword(string $password) : SQL;
        public function setDatabase(string $database) : SQL;
    }

?>