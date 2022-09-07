<?php

    class TemplateEngine implements Jsonable{
        private string $arraySeparator;

        public function __construct(string $arraySeparator) {
            $this->arraySeparator = $arraySeparator;
        }

        public function getArraySeparator() : string{
            return $this->arraySeparator;
        }

        public function setArraySeparator(string $arraySeparator) : TemplateEngine{
            $this->arraySeparator = $arraySeparator;
            return $this;
        }

        public function toJson(): string {
            return json_encode([
                "arraySeparator" => $this->arraySeparator
            ]);
        }

        public function fromJson(string $json): Jsonable {
            $json = json_decode($json, true);
            $this->arraySeparator = $json["arraySeparator"];
            return $this;
        }
    }

?>