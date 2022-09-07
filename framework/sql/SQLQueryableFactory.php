<?php

    class SQLQueryableFactory{
        public static function create(SQL $sql) : SQLQueryable{
            $queryable = new SQLQueryable();
            $queryable->setConnection(new mysqli($sql->getHost(), $sql->getUser(), $sql->getPassword(), $sql->getDatabase()));

            return $queryable;
        }

        public static function createFromJson(string $json) : SQLQueryable{
            $sql = new MySQL("", "", "", "");
            $sql->fromJson($json);
            return self::create($sql);
        }

        public static function createDefault() : SQLQueryable{
            $config = Config::getInstance();
            $sql = new MySQL(
                $config->getMySQL()->getHost(),
                $config->getMySQL()->getUser(),
                $config->getMySQL()->getPassword(),
                $config->getMySQL()->getDatabase()
            );
            return self::create($sql);
        }
    }

?>