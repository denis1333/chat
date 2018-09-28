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

});
