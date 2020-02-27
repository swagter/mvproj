<?php

/**

sestavimo model in dostop do podatkovne baze  (združimo vsebini model_02 in model_04)


   modelu User dodamo metodi:

     getAll/0            - vrne vse zapise v tabeli user
     getUserByPriimek/1  - vrne vse zapise v tabeli user, kjer je priimek enak zahtevanemu 

   preskus:
      - vse stlačimo v eno samo datoteko
	  
	  - izvedmo povezavo s podatkovno bazo
	  - kreiramo Database objekt
	  - kreiramo model User s povezavo na Database objekt
	  
	  - preverimo vsebnost Database objekta v modelu User
	  - izvedemo povpraševanje iz model User s klicem ene izmed njegovih metoda
	  
  od tu naprej:

     pozabimo, da obstaja objekt/razred Database:
       - vse operacije na modelu Uporabnik/User izvajamo zgolj na modelu User, nikoli več direktno na Database
       - trenutno razpoložljivi metodi sta zgolj:
                    * getAll/0
                    * getUserByPriimek
       - če rabimo še kaj pri manipulaciji z uporabnikom, vedno dodamo ustrezno metodo v definicijo razreda User					
	 

*/

class Database {
   protected $_conn;

   public function __construct($connection) {
       $this->_conn = $connection;
   }

   //nerabljena
   public function ExecuteObject($sql, $data) {
       // stuff:    izvedi query vrni RS
	   return $sql;
   }
   
   // dodana
   public function executeRawSQL($sql) {
       	   
	   $rs=$this->_conn->query($sql);	

       if (!is_object($rs)) return $rs;
	   
	   return $this->tableFromResult($rs);

   }
   
   //dodana - recimo, da rezultat vedno interpretiramo kot asociativno tabelo
   //         pustimo javno, mogoče je bomo kot tako  še kje rabili; v realnosti pa je to privatna metoda
   public function tableFromResult($rs){
	   $retVal=[]; 
	   	   
	   while(  ( $v=$rs->fetch_assoc() ) !=null  )
	     $retVal[]=$v;
	 
	   return $retVal;
	}

}


abstract class Model {
   protected $_db;

   public function __construct(Database $db) {
       $this->_db = $db;
   }   
   
}


class User extends Model {

   private $usersTableName='users';
   

   public function splosnaMetoda($sql,$data) {
     
       $sql = "SELECT Username FROM " . $this->usersTableName . " WHERE ...";
       return $this->_db->ExecuteObject($sql, $data);
   }
   
   //dodana
   public function getAll(){
	   $sql = "SELECT * FROM " . $this->usersTableName . " ";   
	   return $this->_db->ExecuteRawSQL($sql);
   }
      
   //dodana
   public function getUserByPriimek($username){
	   $sql = "SELECT * FROM " . $this->usersTableName . " WHERE priimek='{$username}'";
	   return $this->_db->ExecuteRawSQL($sql);
   }
  
   public function getUserByID($id){
	   $sql = "SELECT * FROM " . $this->usersTableName . " WHERE id='{$id}'";
	   return $this->_db->ExecuteRawSQL($sql);
   }
   
   public function removeUserByID($id){
	   $sql = "delete FROM " . $this->usersTableName . " WHERE id='{$id}'";
	   return $this->_db->ExecuteRawSQL($sql);
   }
   
   public function updateUser($data){
	   $sql = "update " . $this->usersTableName . " set priimek='{$data['priimek']}', ime='{$data['ime']}' WHERE id='{$data['id']}'";
	   return $this->_db->ExecuteRawSQL($sql);
   }
   
   public function addUser($data){
	   $sql = "update " . $this->usersTableName . " set priimek='{$data['priimek']}', ime='{$data['ime']}' WHERE id='{$data['id']}'";
	   $sql = "insert into ". $this->usersTableName . " values ('','{$data['priimek']}','{$data['ime']}')";
	  // echo $sql;die();
	   return $this->_db->ExecuteRawSQL($sql);
   }
  
}

//
//    -------------------------- testi :
//

/*
$conn = new mysqli('localhost','root','','test');
$db = new Database($conn);
$user = new User($db);

$rezultat = $user->getAll();

echo '<pre>';
print_r($user);    //manj podatkov

print_r($rezultat);
echo '<br />parcialni rezultati:<br/>';
    print_r($user->getUserByPriimek('Novak'));
echo '<p />';
    print_r($user->getUserByPriimek('Dren'));
echo '</pre>';
*/

