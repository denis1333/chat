<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
	<div id="app">
		<div class="col-1">
			<div class="all-chats">
				<p v-for="chat in all_chats" @click="click"> {{chat.name}} </p>
			</div>
			<div class="user-in-chat">
				<p v-for="val in user_in_chat"> {{val.nick}} </p>
			</div>
		</div>
		<div class="col-2">
			<div class="chat-window">
					<div class="message-output">
						<p v-for="val in chat_messages"> {{val.text}} </p>
					</div>
				<div class="wrapper">
					<div class="message-input">
						<input type="textarea"/>
						<div class="submit-btn">Отправить</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
