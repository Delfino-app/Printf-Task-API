<?php

namespace App\Api\Model;

use PDO;

require_once __DIR__.'/../../Config/Config.php';


class Model{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;

    private $entidade;

    public function __construct()
    {

    }

    public function getEntidade(){

        return $this->entidade;
    }

    public function setEntidade($entidade){

        $this->entidade = $entidade;
    }

    public function conectar(){

        $this->db_name = DB_NAME;
        $this->db_user = DB_USER;
        $this->db_pass = DB_PASS;
        $this->db_host = DB_HOST;

        try{

            $link = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}",$this->db_user,$this->db_pass);
            
			return $link;
            
            $link->setAttribute(PDO::ATT_ERRMODE,PDO::ERRMODE_EXCEPTION);
		    
		}
		catch(PDOException $e){

			return $e->getMessage();
		}
    }


    public function get($id){

        $stmt = $this->conectar()->prepare("SELECT * FROM {$this->entidade} WHERE id =:id");

        $stmt->BindParam(":id",$id,PDO::PARAM_INT);

		#execute()
	    $stmt->execute();
	    	
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(){

        $stmt = $this->conectar()->prepare("SELECT * FROM {$this->entidade} ORDER BY id DESC");

		#execute()
	    $stmt->execute();
	    	
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function distroy($id){

        $stmt = $this->conectar()->prepare("DELETE FROM {$this->entidade} WHERE id =:id");

        $stmt->BindParam(":id",$id,PDO::PARAM_INT);

        if($stmt->execute()){

            return true;
        }
        else{

            return false;
        }
    }
}