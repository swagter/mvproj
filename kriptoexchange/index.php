<!--
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

gliphicons:  https://getbootstrap.com/docs/3.3/components/   

glyphicon glyphicon-plus
glyphicon glyphicon-pencil
glyphicon glyphicon-remove

<span class="glyphicons glyphicon-plus"></span>
 -->

<?php

include_once ('../html_header.php');         // vključi vse css, javascripte, .... potrebno, ker home-page stran ne vsebuje kontrolerja !

// requive access to MVC   - loader
//require_once('model/User.php');
//require_once('view/UserView.php');
//require_once('controllers/controller.php');
require_once('model/Model_05.php');
require_once('control/controller.php');
require_once('view/view_01.php'); require_once('view/view_02.php');

/*
  testna koda 5
*/


//---------------- rabimo model, kontroler,view

$conn = new mysqli('localhost','root','','test');
$db = new Database($conn);
//$user = new User($db);
//$controller = new Controller($user);
$log = new KriptoExchange($db);
$controller = new Controller($log);

//print_r($controller);

$controller->index($_GET); 

