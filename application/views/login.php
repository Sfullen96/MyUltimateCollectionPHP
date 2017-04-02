<div class="well">
	<form action="/login/loginUser" method="POST" role="form">
		<legend> Login </legend>
	
		<div class="form-group">
			<label for="email"> Email Address </label>
			<input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
		</div>
	
		<div class="form-group">
			<label for="password"> Password </label>
			<input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password">
		</div>
	
		<button type="submit" class="btn btn-primary"> Login </button>
	</form>
</div>