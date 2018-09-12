<?php
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\User;
use Yii;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
	
}