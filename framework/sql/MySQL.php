<?php

class MySQL implements SQL, Jsonable{
    private string $host;
    private string $user;
    private string $password;
    private string $database;

    public function __construct($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function getHost(): string {
        return $this->host;
    }

    public function getUser(): string {
        return $this->user;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getDatabase(): string {
        return $this->database;
    }

    public function setHost(string $host): SQL {
        $this->host = $host;
        return $this;
    }

    public function setUser(string $user): SQL{
        $this->user = $user;
        return $this;
    }

    public function setPassword(string $password): SQL{
        $this->password = $password;
        return $this;
    }

    public function setDatabase(string $database): SQL {
        $this->database = $database;
        return $this;
    }

    public function toJson(): string {
        return json_encode([
            "host" => $this->host,
            "user" => $this->user,
            "password" => $this->password,
            "database" => $this->database
        ]);
    }

    public function fromJson(string $json): MySQL {
        $json = json_decode($json, true);
        $this->host = $json["host"];
        $this->user = $json["user"];
        $this->password = $json["password"];
        $this->database = $json["database"];
        return $this;
    }
}

?>