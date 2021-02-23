<?php

namespace App\Api\Controller;

use App\Api\Model\UserModel as User;
use App\Api\Controller\Helpers\delfinoapp;

class UserController{


    public function index($data = []){

        if(isset($data["id"])){

            $id = $data["id"];

            $get = (new User())->find($id);

            if(!empty($get)){

                array_splice($get,5,1);

                return delfinoapp::output_header(200,"User",$get);
            }
            else{

                return delfinoapp::output_header(404,"User Not Found");
            }
        }
        else{

            //Show All

            $get = (new User())->all();

            if(!empty($get)){

                $data = [];

                foreach($get as $user){

                    array_splice($user,5,1);

                    array_push($data,$user);
                }

                return delfinoapp::output_header(200,"Users",$data);
            }
            else{

                return delfinoapp::output_header(200,"Users",[]);

            }
        }
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

            return delfinoapp::output_header(200,"An Error to Create");

        }
    }

    public function edit($data){

        if((isset($data["id"])) && ($data["id"] > 0)){

            $id  = $data["id"];

            $get = (new User())->find($id);

            if(!empty($get)){

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
        
                if($storage->edit($id)){

                    $get = (new User())->find($id);

                    array_splice($get,5,1);
        
                    return delfinoapp::output_header(200,"User Info Edited",$get);
                }
                else{
        
                    return delfinoapp::output_header(200,"An Error to Edit User Info");
        
                }
            }
            else{

                return delfinoapp::output_header(404,"User Not found");

            }
        }
        else{

            return delfinoapp::output_header(400,"Parameter Id not set Our Invalid");
        }
    }

    public function delete($data){

        if((isset($data["id"])) && ($data["id"] > 0)){

            $id = $data["id"];

            $get = (new User())->find($id);

            if(!empty($get)){

                if((new User())->delete($id)){

                    return delfinoapp::output_header(200,"User Deleted");
                }
                else{

                    return delfinoapp::output_header(200,"Error to delete User");
                }
            }
            else{

                return delfinoapp::output_header(404,"User not found");                
            }
        }
        else{

            return delfinoapp::output_header(400,"Parameter Id not set Our Invalid");
        }
    }
}