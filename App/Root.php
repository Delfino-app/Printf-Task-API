<?php

namespace App;

class Root{


    public function index(){

        $data = ["Project-Title" => "Printf-Task","Project-Type" => "BackEnd","Project-Discription" => "APi do Sitema Integrado de Gestão de Projectos","Project-Author" => ["Name" => "Delfino Torres","Type" => "Php FullStack Developer","GitHub" => "delfino-app"]];

        exit(json_encode($data));
    }
}