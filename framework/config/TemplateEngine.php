<?php

    class TemplateEngine implements Jsonable{
        private string $arraySeparator;
        private bool $experimentalJavaScriptSupport;

        public function __construct(string $arraySeparator, bool $experimentalJavaScriptSupport) {
            $this->arraySeparator = $arraySeparator;
            $this->experimentalJavaScriptSupport = $experimentalJavaScriptSupport;
        }

        public function getArraySeparator() : string{
            return $this->arraySeparator;
        }

        public function setArraySeparator(string $arraySeparator) : TemplateEngine{
            $this->arraySeparator = $arraySeparator;
            return $this;
        }

        public function getExperimentalJavaScriptSupport() : bool{
            return $this->experimentalJavaScriptSupport;
        }

        public function setExperimentalJavaScriptSupport(bool $experimentalJavaScriptSupport) : TemplateEngine{
            $this->experimentalJavaScriptSupport = $experimentalJavaScriptSupport;
            return $this;
        }

        public function toJson(): string {
            return json_encode([
                "arraySeparator" => $this->arraySeparator,
                "experimentalJavaScriptSupport" => $this->experimentalJavaScriptSupport
            ]);
        }

        public function fromJson(string $json): Jsonable {
            $json = json_decode($json);
            $this->arraySeparator = $json->arraySeparator;
            $this->experimentalJavaScriptSupport = $json->experimentalJavaScriptSupport;
            return $this;
        }
    }

?>