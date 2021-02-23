<?php

namespace App\Api\Model;

use PDO;

class UserModel extends Model{

    private $name;
    private $email;
    private $description;
    private $img;
    private $password;

    private $entidadeD = "user";

    public function __construct()
    {
        $this->setEntidade($this->entidadeD);
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

        $stmt = $this->conectar()->prepare("INSERT INTO {$this->entidadeD} (name,email,description,img,password) VALUES(:name,:email,:description,:img,:password)");

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

    public function edit($id){

        $stmt = $this->conectar()->prepare("UPDATE {$this->entidadeD} SET name =:name, email =:email, description =:description, img =:img, password =:password WHERE id =:id");

        $stmt->BindParam(":id",$id,PDO::PARAM_INT);
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

    public function find($id){

        return $this->get($id);
    }

    public function all(){

        return $this->getAll();
    }

    public function delete($id){

        return $this->distroy($id);
    }
}