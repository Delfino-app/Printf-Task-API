<?php

namespace App\Api\Controller\Helpers;

class delfinoapp{
	

	public static function output_header( $status = true, $message = null, $dados = array()){

	    header('Content-Type: application/json; charset=utf-8',http_response_code($status));
	    
	    echo json_encode(
	        array(
	            'status' => $status,
	            'message' => $message,
	            'dados'   => $dados
	        )
	    );
	    # por ser a ultima funcao, podemos matar o processo aqui.
	    exit;
	}
	public static function output_header_post( $status = true, $message = null, $dados = array()){

	    header('Content-Type: application/json; charset=utf-8');
	    
	    echo json_encode(
	        array(
	            'status' => $status,
	            'message' => $message,
	            'dados'   => $dados
	        )
	    );
	    # por ser a ultima funcao, podemos matar o processo aqui.
	    exit;
	}
	public static function returnMessageEdit($info, $dados = array()){

		if ($info =="Feito") {
			
			delfinoapp::output_header(200,"Dado(s) editado(s) com sucesso!",$dados);
		}
		else{

			//Error
			delfinoapp::output_header(400,"Erro ao editar dado(s).");
		}
	}
	
	public static function reduceLyrics($tring,$tamanho){
		
		#Reduzir tamanho das strings -> Pegar as primeiras letras de uma string
				
		$newString = substr($tring,0,$tamanho);

		if(strlen($tring) > $tamanho){

			$newString .= "...";
		}
		
		return $newString;
	}
	
	public static function dataFormat($data){
		
		$newData = date('d/m/Y', strtotime($data));
				
		$newData .= "  ".date('H:i', strtotime($data));
		
		return $newData;
	}
	public static function dataOnlyFormat($data){
		
		$newData = date('d/m/Y', strtotime($data));
		
		return $newData;
	}
	public static function numberFormat($dado){

		$numero = number_format($dado, 0,',',' ');

		return $numero;
	}
	public static function criarteNewDataTime($dataDefault){

		$dataPedido = $dataDefault;

		$dataPrepare = explode(" ",$dataPedido);

		//Only data ano, m, d
		$indexData = $dataPrepare[0];
		//Only time h, m,s
		$indexTime = $dataPrepare[1];

		$indexDataExplode = explode("-", $indexData);

		$indexDataDia = end($indexDataExplode);
		$indexDataDia += 1;

		//Nova Data + 1 dia acrescentado
		$indexDataExplode[2] = $indexDataDia;

		$createData = date_create("".$indexDataExplode[0]."-".$indexDataExplode[1]."-".$indexDataExplode[2]);

		$hora = 23; //Hora
		$mint = 59; //Minuto

		date_time_set($createData,$hora,$mint);

		$novaData = date_format($createData,"Y-m-d H:i:s");

		return $novaData;

	}
	public static function encriptarSenha($senha){

		$newSenha = crypt($senha, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		return $newSenha;
	}

	public static function teste(){

		//Expressões Regulares

		$expressaoNome='/^[A-Za-z]+$/';
		$expressaoTelefone = '/^[0-9]+$/';
		$expressaoEmail='/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]+$/';
		$expressaoSenha='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}+$/';
	}

	public static function getRegex($regex){


		//Expreções regulares

		if ($regex == "telefone" || "numero") {
			
			return '/^[0-9]+$/';
		}
		elseif ($regex == "senha") {
			
			return '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}+$/';
		}
	}

	public static function uploadImg($file,$from){

		$arquivo=$file;
		
		$nomeFile = '';

		#Atribuir diretorio
		$dominio = BASE;

	 	$diretorio='img/uploads/'.$from.'/';
		
		
		$permitir_tipos  = array(

			'image/jpg', 
			'image/png',
			'image/jpeg'
		);

		#Pegar a extenção do arquivo
		$tipos_file = $arquivo['type'];

		if (in_array($tipos_file,$permitir_tipos)) {

			#Atribuir um novo nome ao aqruivo
			$explode = explode("/", $tipos_file);
			$extencao = end($explode);

			$novo_nome=md5(time()).'.'.$extencao;

			#Diretorio do arquivo
			$destino=$diretorio;

			#Mover o arquivo para o diretorio
	 		try{

	 			$move_files = move_uploaded_file($arquivo["tmp_name"], $destino.$novo_nome);
	 		}
	 		catch(Exception $e){

	 			delfinoapp::output_header_post("400",$e->getMessage(), $dados = array());

	 			exit;
	 		}

	 		if($move_files){
				
				$nome = $diretorio.$novo_nome;

				$nomeFile = $nome;
			}
		}

	 	return $nomeFile;
	}
}