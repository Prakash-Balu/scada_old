<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Form</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"></link>
<script src="https://code.jquery.com/jquery-1.12.4.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
</script>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
	.error_msg{
		color:red;
	}
</style>
</head>
<body>
</head>
<body>
<div class="login-form">
    <form action="<?= base_url().'login/loginprocess'; ?>" method="post" data-toggle="validator" role="form" autocomplete="off">
        <h2 class="text-center">Log in</h2>       
		<?php
				if(!empty($message)){
			?>
				<script>
					setTimeout(function() {
						$("#error_msg").hide();
					}, 2000);
			</script>
				<span id="error_msg" class="error_msg" > <?php echo $message; ?></span>
		<?php }?>
        <div class="form-group">
            <input type="text" class="form-control" maxlength="15" placeholder="Username" name="username" data-error="Please enter name field."  required>
    		<div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" maxlength="15" placeholder="Password" name="password" data-error="Please enter password field." required>
			<div class="help-block with-errors"></div>
		</div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        </form>
  </div>
</body>
</html>   


