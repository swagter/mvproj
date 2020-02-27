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
}



abstract class Model {
   protected $_db;

   public function __construct(Database $db) {
       $this->_db = $db;
   }   
   
}


class KriptoExchange extends Model {

   private $usersTableName='kripto';
   

   public function getUserTable(){
	   return $this->$usersTableName;
   }
   
   
   public function getAll(){
	   
	   
	   //$sql = "SELECT * FROM " . $this->usersTableName . " ";   
	   //$sql = "SELECT l.ID,u.ime,u.priimek,l.lastAccess,l.accessCount FROM " . $this->usersTableName . " l, users u where l.user_id=u.ID";
	   //echo $sql; die();
	   //return $this->_db->ExecuteRawSQL($sql);
	   
	   
	   
	   $query = http_build_query(
			array(
				//'reqType' => 'data',
				//'newSnapshotName' => 'example',
				//'currentSnapshotName' => '1',
				//'configId' => '2',
				//'ttData' => '4',
				//'feData' => '5',
				'convert' => 'EUR'
		)
	);

	if (strlen($query)>1) $query = '?'.$query;  // doda ? na začetek spiska parametrov, če ti obstatajo


	// če imaš API key, ga dodaš v header ; vsak string gre v lastno vrstico ...
	// pazi, če imaš http ne https, potem je ključ http !
	// včasih : Content-Type: application/json - je pa to za response header, spodnje lepo dela
	$options = array('https' =>
						array(
							'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded'  //.'\r\napi_key_id: key_value\r\n'
						)
	);

	$a = file_get_contents('https://api.coinmarketcap.com/v1/ticker/' . $query, false, stream_context_create($options));

	//echo $a;
	  
    return json_decode($a, true)	;  
	   
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

