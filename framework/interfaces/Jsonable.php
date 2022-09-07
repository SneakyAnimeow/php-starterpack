<?php

    interface Jsonable{
        public function toJson() : string;

        public function fromJson(string $json) : Jsonable;
    }

?>