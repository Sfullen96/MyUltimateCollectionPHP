<?php if( $this->session->flashdata('error') ) { ?>
<div class="alert alert-danger">
	Incorrect email address or password, please try again.
</div>
<?php } ?>
<form action="/login/loginUser" method="POST" role="form">
	<legend> Login </legend>

	<div class="form-group">
		<!-- <label for="email"> Email Address </label> -->
		<input type="text" class="form-control" name="email" id="email" placeholder="Email Address" required="required">
	</div>

	<div class="form-group">
		<!-- <label for="password"> Password </label> -->
		<input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password" required="required">
	</div>

	<button type="submit" class="btn btn-primary margin-bottom"> Login </button>
	<a href="/register" class="btn btn-primary pull-right"> Register Now </a>
</form>
