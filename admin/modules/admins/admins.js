$.admins = {
	login : function(){
		var username = $('input#username').val();
		var password = $('input#password').val();
		$('#login_result').html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
		$.ajax({
			url: 'process.php?dispatch=admins.login',
			data: {'username':username, 'password':password},
			method: 'POST',
			success: function(e){
				$('#login_result').html(e);	
			}
		});
	}
}