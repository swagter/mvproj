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
	    
		
		$podatki = $this->_model->getAll();
		
		//print_r($podatki);die;
		
		if ($podatki==null || count($podatki)==0 ) { $html="ni podatkov o {$this->_model->getUserTable()}."; return $html; } // !!!!
		
		$html.= '<table class="table">';
		$html.= '<tr>';
		foreach ($podatki[0] as $key=>$zapis){
			$html.= '<th>';
		      $html.= $key;
			$html.= '</th>';
		}
		$html.='</tr>';
		foreach ($podatki as $zapis){
			
			$html.= '<tr>'; if (isset($zapis['ID']))$id=$zapis['ID'];
			   foreach($zapis as $podatek){
				   $html.= '<td>';
				      $html.= $podatek;
				   $html.= '</td>';
			   }
			   //$html.='<td><span class="glyphicons glyphicons-edit"></span><a href="?action=uredi&id='.$id.'"><span class="glyphicon glyphicon-pencil"></span></a> <a href="?action=odstrani&id='.$id.'"><span class="glyphicon glyphicon-remove"></span></a> <a href="?action=vnesi"><span class="glyphicons glyphicon-plus"></span></a> </td>';
			$html.= '</tr>';
		}
		$html.= '</table>';
        

        return $html;

    }

}


