<?php



$meni = ['Domov'=>'','Uporabniki'=>'','Dnevniki'=>'','Kriptoexchange'=>'','Kripto2'=>'','O_programu'=>''];

/** iz trenutne skripte ugotovi, katero alinejo menija je potrebno označiti z class="active"
    pot do Domov ne sme iti v podmapo Domov !
*/
function echoMeni($meni){
	$none=0;
	//print_r($meni);
	foreach ($meni as $k=>$p)
	   if (strpos(dirname($_SERVER['SCRIPT_NAME']),$k) > 0){
		   $none=1;
		   $meni[$k]='active'; break;
	   }
	if ($none==0) $meni['Domov']='active';
	//print_r($meni);                              -- narobe
	foreach($meni as $k=>$el){
	   echo '<li class="'.$el.'"';
	   echo '><a href="/mvc_php_4d_f02/'; 
	      if($k != 'Domov') 
		  //if($none != 0) 	  
			   echo $k; 
	   echo '">'.$k.'</a></li>';
	}

}

echo '
<html lang="en">
<head>
  <title>Moj Pejđ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  <script type="text/javascript" src="https://s3.amazonaws.com/dynatable-docs-assets/js/jquery.dynatable.js"></script>    
  <link rel="stylesheet" type="text/css" href="https://s3.amazonaws.com/dynatable-docs-assets/css/jquery.dynatable.css">
  
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Moj page</a>
    </div>
    <ul class="nav navbar-nav">';
      	   
	      echoMeni($meni);
		 
  echo '		  
    </ul>
  </div>
</nav>
  
<div class="container">
 '; 
 
 echo '<div>';
//echo $_SERVER['SCRIPT_NAME']; echo '</div>';
//echo dirname($_SERVER['SCRIPT_NAME']);