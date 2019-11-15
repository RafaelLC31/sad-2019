<?php
namespace FATOS;
require_once('FatoVenda.php');
require_once('../dim/Data.php');
require_once('../dim/Sumario.php');

use dimensoes\Data;
use dimensoes\Sumario;
use FATOS\FatoVenda;

class CargaFatosVenda{

    private function conectarBanco($banco){
        if(!defined('DS')){
           define('DS', DIRECTORY_SEPARATOR);
        }
        if(!defined('BASE_DIR')){
           define('BASE_DIR', dirname(__FILE__).DS);
        }
        require(BASE_DIR.'config.php');
        try{
           $conn = new \MySQLi($dbhost, $user, $password, $banco);
           return $conn;
        }catch(mysqli_sql_exception $e){
           throw new \Exception($e);
           die;
        }
     }
}


?>