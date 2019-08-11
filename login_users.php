<?php

$val=$_GET['value'];
echo $value;
echo <<<_END

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="login_style.css">




</head>

<center>
<h1><a href="index.html"><b style="color: orange" >The River</b></a></h1>



<form action="login_users2.php?value=$val" method="post">

<div class="form-group">
<label>E-mail: </label><input type="text" name="email" id="email" required/><br />
</div>

<div class="form-group">
<label>Password: </label><input type="password" name="password" id="password" required /><br />

<!--<input value="Log In" type="submit" />-->
<button class="btn btn-primary" type="submit">Log In</button>
</div>

</form>
New user <a href="signup.php">SignUp</a> here.
</center>


</html>
_END;


?>