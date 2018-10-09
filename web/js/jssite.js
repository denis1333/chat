Vue.component('modal', {
  template: '#modal-template'
})

var app = new Vue({
  el: '#app',
  data: {
    all_chats: null,
	user_in_chat: null,
	chat_messages: null,
	all_user_chats: null,
	site_url : "localhost",
	showModal: false,
	modalType: false,
	nick: "Undefined user",
	token: null,
  },
  methods:{
	  get_all_users_in_chat: function(event){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://' + this.site_url + '/site/get-all-users-chats?chatName='+ event.target.outerText, false);
		xhr.send();
		console.log(xhr.responseText);
		this.user_in_chat = $.parseJSON(xhr.responseText);
	  },
	  get_all_message: function(event){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://' + this.site_url + '/site/get-all-message?chatName='+ event.target.outerText, false);
		xhr.send();
		console.log(xhr.responseText);
		this.chat_messages = $.parseJSON(xhr.responseText);
	  },
	  get_all_message_chatName: function(chanName){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://' + this.site_url + '/site/get-all-message?chatName='+ chanName, false);
		xhr.send();
		console.log(xhr.responseText);
		this.chat_messages = $.parseJSON(xhr.responseText);
	  },
	  click: function(event){
		  this.get_all_users_in_chat(event);
		  this.get_all_message(event);
	  },
	  get_all_chats: function(){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://' + this.site_url + '/site/get-all-chats', false);
		xhr.send();
		this.all_chats = $.parseJSON(xhr.responseText);
	  },
	  registration: function(){
		var xhr = new XMLHttpRequest();
		var nick = $("input[name='nick']").val();
		var mail = $("input[name='mail']").val();
		var pass = $("input[name='pass']").val();
		xhr.open('GET', 'http://' + this.site_url + '/site/registration?nick=' + nick + "&mail=" + mail + "&pass=" + pass, false);
		xhr.send();
		console.log($.parseJSON(xhr.responseText));
	  },
	  authorization: function(){
		var xhr = new XMLHttpRequest();
		var mail = $("input[name='mail']").val();
		var pass = $("input[name='pass']").val();
		xhr.open('GET', 'http://' + this.site_url + '/site/autorization?mail='+ mail +"&pass=" + pass, false);
		xhr.send();
		this.nick = $.parseJSON(xhr.responseText).name;
		this.token = $.parseJSON(xhr.responseText).token;
		localStorage.setItem("token", this.token);
		localStorage.setItem("nick", this.nick);
		console.log( "token = " + localStorage.getItem("token"));
	  },
	  makeMessage: function(){
		var xhr = new XMLHttpRequest();
		var messageText = $(".message-input input").val();
		$(".message-input input").val("");
		var token = this.token;
		if(token == null){
			alert("you are not logged in");
		}
		var chatName = $(".active").text().replace(" ", "");
		if(chatName == null){
			alert("select chat please");
		}
		xhr.open('GET', 'http://' + this.site_url + '/site/add-message?token='+ token +"&text=" + messageText + "&chatName="+ chatName, false);
		xhr.send();
		this.get_all_message_chatName(chatName);
	  }
  }
})

app.get_all_chats();

$(document).ready(function(){
	$('.all-chats p').click(function(){
		elem = $(this);
		$('.active').removeClass('active');
		elem.addClass('active');
	});

	app.token = localStorage.getItem("token");
	app.nick = localStorage.getItem("nick")
});
