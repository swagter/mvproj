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
	    
		
		$pod = $this->_model->getAll();
		$podatki = json_decode($pod,true);
		
		
		if ($podatki==null || count($podatki)==0 ) { $html="ni podatkov o {$this->_model->getUserTable()}."; return $html; } 
		
		$html.= '<table id="table" class="table"><thead>';
		$html.= '<tr>';
		foreach ($podatki[0] as $key=>$zapis){
			$html.= '<th>';
		      $html.= $key;
			$html.= '</th>';
		}
		$html.='</tr></thead>';

		$html.= '</table>';
        
        
		
		$html.='<script>$(document).ready(function(){ var myRecords = '.$pod.'; $("#table").dynatable({dataset: {records: ';
		$html.='myRecords}});});</script>';
		
        return $html;

    }

}


