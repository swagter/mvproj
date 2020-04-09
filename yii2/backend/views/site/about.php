<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

echo \Yii::$app->user->identity->username;
echo '<pre>';

print_r($_COOKIE);
echo '</pre>';



$this->title = 'about';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Kaj ti</h1>


    <code><?= __FILE__ ?></code>
</div>
