<?php

class UserDetailView1 {

    private $_model;                               //<-- model

	
    public function __construct(Model $model) {

        $this->_model = $model;

    }

    
    public function output() {

	//    $podatki = $this->_model->getUserByID($id);
	
	//    $podatki=$podatki[0]; 
	//	  print_r($podatki);
	
	    $html='';
	   
        $html = '<div style="width:35%"><form action="?action=uredi" method="get">
		         <fieldset>
				   <legend>Urejanje podatkov</legend>
		           <input type="text" name="id" hidden="hidden" value=""/>
				   <input type="text" name="ime"      value=""/>  <br />
				   <input type="text" name="priimek"  value=""/> <br />
				   
				   <input type="submit" name="action" value="dodaj"/>
				  </fieldset> 
				 </form></div>';
      
		

		
        return $html;

    }

}
