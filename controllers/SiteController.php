<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	 public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionSay()
    {
		$query = User::find();
		$response = $query->all();
        return $this->render('say', ['response' => $response]);
    }
	
	public function actionRegistration($nick, $mail, $pass)
    {
		$result = Yii::$app->db->createCommand()->insert('user', ['nick'=>$nick, 'mail'=>$mail, 'pass'=>$pass])->execute();
        return $result;
    }
	
	public function actionAutorization($mail, $pass)
	{
		$params = [':mail' => $mail, ':pass' => $pass];
		$response = Yii::$app->db->createCommand('SELECT * FROM user WHERE mail = :mail AND pass = :pass');
		$result = $response->bindValues($params)->queryOne();
		if($result!=false)
		{
			$time = time();
			$token = bin2hex(openssl_random_pseudo_bytes(16));
			Yii::$app->db->createCommand()->update('user', ['time' => $time, 'token' => $token], ['mail'=>$mail,])->execute();
			return $token;
		}
		return false;
	}
	
	public function actionLogout($token)
	{
		Yii::$app->db->createCommand()->update('user', ['token' => 0, 'time' => 0], ['token' => $token,])->execute();
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		return ['status code' => 200];
	}
	
	public function actionCreateChat($token, $chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':token' => $token, ':name' => $chatName];
		$response = Yii::$app->db->createCommand('INSERT INTO chat (name, creator) VALUES (:name, (SELECT id FROM user WHERE token = :token))');
		$result = $response->bindValues($params)->execute();
		return ['status code' => 200];
	}
	
	public function actionDeleteChat($token, $chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':token' => $token, ':name' => $chatName];
		$response = Yii::$app->db->createCommand('DELETE FROM chat WHERE name= :name AND creator =(SELECT id FROM user WHERE token = :token)');
		$result = $response->bindValues($params)->execute();
		return ['status code' => 200];
	}
	
	public function actionEnterChat($token, $chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':token' => $token, ':name' => $chatName];
		$response = Yii::$app->db->createCommand(
		'INSERT INTO user_in_chat (chat, user) 
		VALUES ((SELECT id FROM chat WHERE name = :name), (SELECT id FROM user WHERE token = :token))'
		);
		$result = $response->bindValues($params)->execute();
		return ['status code' => 200];
	}
	
	public function actionExitChat($token, $chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':token' => $token, ':name' => $chatName];
		$response = Yii::$app->db->createCommand(
		'DELETE FROM user_in_chat WHERE chat = (SELECT id FROM chat WHERE name = :name) AND user = (SELECT id FROM user WHERE token = :token)'
		);
		$result = $response->bindValues($params)->execute();
		return ['status code' => 200];
	}
	
	public function actionAddMessage($text, $token, $chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':text' => $text,':token' => $token, ':name' => $chatName];
		$response = Yii::$app->db->createCommand(
		'INSERT INTO message (text, user, chat) VALUES (:text, (SELECT id FROM user WHERE token = :token), (SELECT id FROM chat WHERE name = :name))'
		);
		$result = $response->bindValues($params)->execute();
		return ['status code' => 200];
	}
	
	public function actionGetAllMessage($chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':name' => $chatName];
		$response = Yii::$app->db->createCommand(
		'SELECT text FROM message WHERE chat = (SELECT id FROM chat WHERE name = :name)'
		);
		$result = $response->bindValues($params)->queryAll();
		return $result;
	}
	
	public function actionGetAllChats()
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$response = Yii::$app->db->createCommand(
		'SELECT name FROM chat'
		);
		$result = $response->queryAll();
		return $result;
	}
	
	public function actionGetAllUsersChats($chatName)
	{
		Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
		$params = [':name' => $chatName];
		$response = Yii::$app->db->createCommand(
		'SELECT nick FROM user WHERE id = (SELECT user FROM user_in_chat WHERE chat = (SELECT id FROM chat WHERE name = :name))'
		);
		$result = $response->bindValues($params)->queryAll();
		return $result;
	}
}
