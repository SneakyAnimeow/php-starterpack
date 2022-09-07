<?php

    class Router implements Jsonable{
        private bool $errorPrinting;

        public function __construct(bool $errorPrinting) {
            $this->errorPrinting = $errorPrinting;
        }

        public function getErrorPrinting() : bool{
            return $this->errorPrinting;
        }

        public function setErrorPrinting(bool $errorPrinting) : Router{
            $this->errorPrinting = $errorPrinting;
            return $this;
        }

        public function toJson(): string {
            return json_encode([
                "errorPrinting" => $this->errorPrinting
            ]);
        }

        public function fromJson(string $json): Jsonable {
            $json = json_decode($json, true);
            $this->errorPrinting = $json["errorPrinting"];
            return $this;
        }
    }

?>