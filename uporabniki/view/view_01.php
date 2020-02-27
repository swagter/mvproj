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
class UserView {

    private $_model;                               //<-- model

	
    public function __construct(Model $model) {

        $this->_model = $model;

    }

    
    public function output() {

	    $html='';
	    /**
        $html = '<form action="?action=convert" method="post">
		           <input name="currency" type="hidden" value="' . $this->currency .'"/>
				   <label>' . $this->currency .':</label>
				   <input name="amount" type="text" value="' . $this->model->getAll() . '"/>   <!-- <-- iz modela -->
				   <input type="submit" value="Convert"/>
				 </form>';
        */
		
		$podatki = $this->_model->getAll();
		
		
		$html.= '<table class="table">';
		foreach ($podatki as $zapis){
			
			$html.= '<tr>'; $id=$zapis['ID'];
			   foreach($zapis as $podatek){
				   $html.= '<td>';
				      $html.= $podatek;
				   $html.= '</td>';
			   }
			   $html.='<td><span class="glyphicons glyphicons-edit"></span><a href="?action=uredi&id='.$id.'"><span class="glyphicon glyphicon-pencil"></span></a> <a href="?action=odstrani&id='.$id.'"><span class="glyphicon glyphicon-remove"></span></a> <a href="?action=vnesi"><span class="glyphicons glyphicon-plus"></span></a> </td>';
			$html.= '</tr>';
		}
		$html.= '</table>';
        

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

