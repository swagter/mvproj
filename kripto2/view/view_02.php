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

	    $podatki = $this->_model->getDnevnikiByID($id);
	
	    $podatki=$podatki[0]; 
		print_r($podatki);
	
	    $html='';
	   
        $html = '<div style="width:35%"><form action="?action=uredi" method="get">
		         <fieldset>
				   <legend>Urejanje podatkov</legend>
		           <input type="text" name="id" hidden="hidden" value="' . $podatki['ID'] .'"/>
				   <input type="text" name="accessCount"      value="' . $podatki['accessCount'] . '"/>  <br />
				   <input type="text" name="lastAccess"  value="' . $podatki['lastAccess'] .'"/> <br />
				   
				   <input type="submit" name="action" value="spremeni"/>
				  </fieldset> 
				 </form></div>';
      
		

		
		

        return $html;

    }

}



