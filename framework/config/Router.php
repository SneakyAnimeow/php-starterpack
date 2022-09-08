<?php

    class Router implements Jsonable{
        private bool $errorPrinting;
        private bool $experimentalAPISupport;

        public function __construct(bool $errorPrinting, bool $experimentalAPISupport){
            $this->errorPrinting = $errorPrinting;
            $this->experimentalAPISupport = $experimentalAPISupport;
        }

        public function getErrorPrinting() : bool{
            return $this->errorPrinting;
        }

        public function setErrorPrinting(bool $errorPrinting) : Router{
            $this->errorPrinting = $errorPrinting;
            return $this;
        }

        public function getExperimentalAPISupport() : bool{
            return $this->experimentalAPISupport;
        }

        public function setExperimentalAPISupport(bool $experimentalAPISupport) : Router{
            $this->experimentalAPISupport = $experimentalAPISupport;
            return $this;
        }

        public function toJson(): string {
            return json_encode([
                "errorPrinting" => $this->errorPrinting,
                "experimentalAPISupport" => $this->experimentalAPISupport
            ]);
        }

        public function fromJson(string $json): Jsonable {
            $json = json_decode($json);
            $this->errorPrinting = $json->errorPrinting;
            $this->experimentalAPISupport = $json->experimentalAPISupport;
            return $this;
        }
    }

?>