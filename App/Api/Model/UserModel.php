<?php

namespace App\Api\Model;

use PDO;

class UserModel extends Model{

    private $name;
    private $email;
    private $description;
    private $img;
    private $password;

    const Entidade = "user";

    public function __construct()
    {
        $this->setEntidade(self::Entidade);
    }

    public function getName(){

        return $this->name;

    }

    public function setName($name){

        $this->name = $name;
    }

    public function getEmail(){

        return $this->email;

    }

    public function setEmail($email){

        $this->email = $email;
    }

    public function getDescription(){

        return $this->description;

    }

    public function setDescription($description){

        $this->description = $description;
    }

    public function getImg(){

        return $this->img;

    }

    public function setImg($img){

        $this->img = $img;
    }

    public function getPassword(){

        return $this->password;

    }

    public function setPassword($password){

        $this->password = $password;
    }

    public function save(){

        $stmt = $this->conectar()->prepare("INSERT INTO user (name,email,description,img,password) VALUES(:name,:email,:description,:img,:password)");

        $stmt->BindParam(":name",$this->name,PDO::PARAM_STR);
        $stmt->BindParam(":email",$this->email,PDO::PARAM_STR);
        $stmt->BindParam(":description",$this->description,PDO::PARAM_STR);
        $stmt->BindParam(":img",$this->img,PDO::PARAM_STR);
        $stmt->BindParam(":password",$this->password,PDO::PARAM_STR);

		#execute()
	    if ($stmt->execute()) {
	    	
            return true;
        } 
        else{

            return false;
        } 
    }
}