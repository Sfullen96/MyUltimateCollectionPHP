<?php 
	
	if(isset($errors)) {
		echo '<div class="alert alert-danger">';
			echo '<ul>';
				echo $errors;
			echo '</ul>';
		echo '</div>';
	}

?>
<form action="/register/registerAccount" method="POST" role="form" id="registerForm">
	<h3 class="margin-bottom"> Register an Account </h3>

	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				<input type="text" class="form-control" id="" name="fname" placeholder="First Name" value="<?= (isset($fname)?$fname:''); ?>" required >
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				<input type="text" class="form-control" id="" name="lname" placeholder="Last Name" value="<?= (isset($lname)?$lname:''); ?>" required >
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="username" placeholder="Username" value="<?= (isset($username)?$username:''); ?>" required >
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="" name="email" placeholder="Email Address" value="<?= (isset($email)?$email:''); ?>" required >
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				<input type="password" class="form-control" id="" name="password" placeholder="Password" required >
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				<input type="password" class="form-control" id="" name="password_confirm" placeholder="Confirm Password" required >
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary"> Register Now </button>
</form>