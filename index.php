

  
<?php

    include_once ('html_header.php');  //<!-- se vključuje ZGOLJ in SAMO na tem mestu -->


     if (strpos($_SERVER['HTTP_USER_AGENT'],'JavaFX')!=null)   //JavaFX user agent je preusmerjen na dnevniki
	     header('location:/mvc_php_4d_f02/dnevniki');

     

    if ($_SERVER['SCRIPT_NAME'] == '/mvc_php_4d_f02/index.php') {

           print_r( $_SERVER  );
		   
	 	   echo '<br><br>';
		   echo '<p>   v meniju je alineja <b>dnevniki</b> vendar ta ni dosegljiva preko brskalnika, temveč zgolj preko JavaFX webview odjemalca !    </p>';
		   echo '<p>vse vsebina bo šla tlele</p>';
		   
	}	   
  
