<?php

namespace App\Api\Controller;

use App\Api\Model\UserModel as User;
use App\Api\Controller\Helpers\delfinoapp;

class UserController{


    public function index(){


    }

    public function storage(){

        $name = $_POST["user_name"];
        $email = $_POST["user_email"];
        $description = $_POST["user_description"];
        $img = "";
        $password = delfinoapp::encriptarSenha($_POST["user_password"]);

        $storage = new User();

        $storage->setName($name);
        $storage->setEmail($email);
        $storage->setDescription($description);
        $storage->setImg($img);
        $storage->setPassword($password);

        if($storage->save()){

            return delfinoapp::output_header(201,"User created");
        }
        else{

            return delfinoapp::output_header(200,"An Error Ocuured");

        }
    }

    public function edit(){


    }

    public function delete(){


    }
}