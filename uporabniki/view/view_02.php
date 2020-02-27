<?php

/** dodamo dostop do modela  .. glej opombe 


    definiramo pogled na podatke
	vloga tega dela je zgolj vizualizacija podatkov, ki jih  dobi iz modela User
	torej mora imeti dostop do modela:
	
	   poenostavimo:
	       ta view bo služil zgolj za tabelarično predstavitev VSEH podatkov tabele user; tabeli dodamo še orodje briši;
		   torej bo predstavitev dejansko forma z eno samo akcijo 'briši zapis'
		   
		  razred vsebuje 2 metodi:
              - konstruktor omogoča zgolj povezovanje pogleda/view z modelom
              - metoda output bo vizualizirala našo tabelo			  


*/
class UserDetailView {

    private $_model;                               //<-- model

	
    public function __construct(Model $model) {

        $this->_model = $model;

    }

    
    public function output($id) {

	    $podatki = $this->_model->getUserByID($id);
	
	    $podatki=$podatki[0]; 
		print_r($podatki);
	
	    $html='';
	   
        $html = '<div style="width:35%"><form action="?action=uredi" method="get">
		         <fieldset>
				   <legend>Urejanje podatkov</legend>
		           <input type="text" name="id" hidden="hidden" value="' . $podatki['ID'] .'"/>
				   <input type="text" name="ime"      value="' . $podatki['ime'] . '"/>  <br />
				   <input type="text" name="priimek"  value="' . $podatki['priimek'] .'"/> <br />
				   
				   <input type="submit" name="action" value="spremeni"/>
				  </fieldset> 
				 </form></div>';
      
		

		
		/*
		$html.= '<table border="1">';
		foreach ($podatki as $zapis){
			
			$html.= '<tr>'; $id=$zapis['ID'];
			   foreach($zapis as $podatek){
				   $html.= '<td>';
				      $html.= $podatek;
				   $html.= '</td>';
			   }
			   $html.='<td><a href="?action=uredi&id='.$id.'">Uredi</a> <a href="?action=odstrani&id='.$id.'">Odstrani</a></td>';
			$html.= '</tr>';
		}
		$html.= '</table>';
        */

        return $html;

    }

}

/*
require_once('model_05.php');

//--------------------- dry test
$conn = new mysqli('localhost','root','','test');
$db = new Database($conn);
$user = new User($db);

$view = new UserView($user);
echo $view->output();
*/

