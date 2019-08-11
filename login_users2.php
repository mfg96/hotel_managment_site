<?php
session_start();
require_once'login.php';
$connect=new mysqli($hn,$un,$pw,$db);


$rooms=$_GET['value'];



//echo $rooms;


if($connect->connect_error)
  die($connect->connect_error);




if( isset($_POST['email']) &&
    isset($_POST['password']))
{
    
    $email    = get_post($connect, 'email');
    $password     = get_post($connect, 'password');
    //$rooms= $_POST['rooms']

  
  $query  = "SELECT *FROM users WHERE email = '" .  $email . "' AND `psd` = '" . $password . "'" ;
  $result = $connect->query($query);

 
  
  
  $row = $result->fetch_array(MYSQLI_NUM);

  if($row != null && sizeof($row) > 0) {
    $email_exist = "true";
    $_SESSION['email']=$email; 
    $_SESSION['f_name']=$row[2];
    $_SESSION['l_name']=$row[3]; 
    $_SESSION['value']=$rooms;


    if($row[0] == "admin") {
      header('Location: admin_page.php');
      $email_exits="false";
    } 
    else {
     
      if($rooms){
      $query2 = "insert into rooms(booked_room, email)values('".$rooms."','".$email."')";
      $result2 = $connect->query($query2);}


      header('Location: guest_page.php');
      $email_exits="false";
    }
  } else {
    echo "User not found.";
  }

  die();

}

/*
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



<form action="login_users.php?" method="post">

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

*/


$result->close();
$connect->close();
function get_post($connect, $var)  {
   return $connect->real_escape_string($_POST[$var]); }



?>