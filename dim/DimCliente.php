<?php
namespace dimensoes;
mysqli_report(MYSQLI_REPORT_STRICT);
require_once('Cliente.php');
use dimensoes\Cliente;
class DimCliente{
  public function carregarDimCliente($banco){
      $dataAtual = date('Y-m-d');
      try{
          $connDimensao = $this->concetarBanco('dm_comercial');
          $connComercial = $this->concetarBanco('bd_comercial');
      }catch(\Exception $e){
          die($e->getMessage());
      }
      // verifica se tem dados nas dimensões
      $sqlDim = $connDimensao->prepare('select SK_cliente, cpf, nome, sexo, idade, rua, bairro, cidade, uf
                                          from dim_cliente');
      $sqlDim->execute();
      $result=$sqlDim->get_result();
      if($result->num_rows === 0){
           $sqlComercial = $connComercial->prepare("select * from cliente");//cria variável com comando SQL
           $sqlComercial->execute(); // Executa o comando SQL
           $resultComercial = $sqlComercial->get_result(); // Atribui a variável o resultado da consulta
           if($resultComercial->num_rows !== 0){ // testa se a consulta retornou dados
               while($linhaCliente = $resultComercial->fetch_assoc()){ // Atribui a variável cada linha até o último
                   $cliente = new Cliente();
                   $cliente->setCliente($linhaCliente['cpf'],$linhaCliente['nome'],$linhaCliente['sexo'],$linhaCliente['idade'],$linhaCliente['rua'],$linhaCliente['bairro'],$linhaCliente['cidade'],$linhaCliente['uf']);
 
                   $sqlInsertDim = $connDimensao->prepare("insert into dim_cliente
                                                         (cpf,nome,sexo,idade,rua,bairro,cidade,uf,data_ini)
                                                         values
                                                         (?,?,?,?,?,?,?,?,?)");
                   $sqlInsertDim->bind_param("sssisssss", $cliente->cpf,$cliente->nome,$cliente->sexo,$cliente->idade,$cliente->rua,$cliente->bairro,$cliente->cidade,$cliente->uf,$dataAtual);
                   $sqlInsertDim->execute();
               }
               $sqlComercial->close();
               $sqlDim->close();
               $sqlInsertDim->close();
               $connComercial->close();
               $connDimensao->close();
           }
      }else{
    
      }
  }
  private function conectarBanco($banco){
      if(!define('DS')){  
       define('DS', DIRECTORY_SEPARATOR);
       }
      if(!define('BASE_DIR')){
       define('BASE_DIR', dirname(__FILE__).DS);
       }
      require_once(BASE_DIR.'config.php');
 
      try{
          $conn = new \MySQLi($db_host, $user, $password, $banco);
          return $conn;
      }catch(myslqi_sql_exception $e){
          throw new \Exception($e);
          die;
      }
  }
}
?>
 
 
 

