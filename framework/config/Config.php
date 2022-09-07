<?php

    class Config implements Jsonable{
        private static Config $instance;

        private MySQL $mysql;
        private TemplateEngine $templateEngine;
        private Router $router;

        private function __construct(MySQL $mysql, TemplateEngine $templateEngine, Router $router) {
            $this->mysql = $mysql;
            $this->templateEngine = $templateEngine;
            $this->router = $router;
        }

        public static function init(string $json) : Config{
            $config = json_decode($json);
            self::$instance = new Config(
                new MySQL(
                    $config->mysql->host,
                    $config->mysql->user,
                    $config->mysql->password,
                    $config->mysql->database
                ),
                new TemplateEngine(
                    $config->templateEngine->arraySeparator
                ),
                new Router(
                    $config->router->errorPrinting
                )
            );
            return self::$instance;
        }

        public static function getInstance() : Config{
            return self::$instance;
        }

        public function getMySQL() : MySQL{
            return $this->mysql;
        }

        public function getTemplateEngine() : TemplateEngine{
            return $this->templateEngine;
        }

        public function getRouter() : Router{
            return $this->router;
        }

        public function toJson(): string {
            return json_encode([
                "mysql" => $this->mysql->toJson(),
                "templateEngine" => $this->templateEngine->toJson(),
                "router" => $this->router->toJson()
            ]);
        }

        public function fromJson(string $json): Jsonable {
            $json = json_decode($json, true);
            $this->mysql = new MySQL(
                $json["mysql"]["host"],
                $json["mysql"]["user"],
                $json["mysql"]["password"],
                $json["mysql"]["database"]
            );
            $this->templateEngine = new TemplateEngine(
                $json["templateEngine"]["arraySeparator"]
            );
            $this->router = new Router(
                $json["router"]["errorPrinting"]
            );
            return $this;
        }
    }

?>