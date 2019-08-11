<?php
require_once'login.php';
$connect=new mysqli($hn,$un,$pw,$db);

if($connect->connect_error)die($connect->connect_error);


if( isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['users']) &&
    isset($_POST['email']) &&
    isset($_POST['password']))
    {
    $firstname   = get_post($connect, 'firstname');
    $lastname   = get_post($connect, 'lastname');
    $email    = get_post($connect, 'email');
    $password     = get_post($connect, 'password');


    $users = get_post($connect,'users');

$query  = "SELECT * FROM users";
 $result = $connect->query($query);
 if (!$result) die ("Database access failed: " . $connect->error);

 $rows = $result->num_rows;

 $email_exist ="false";

 for ($j = 0 ; $j < $rows ; ++$j)
 {
   $result->data_seek($j);
   $row = $result->fetch_array(MYSQLI_NUM);
   if($row[3]==$email){
  $email_exist="true"; }
}

if($email_exist=="false"){

    $query = "insert into users(fname,lname,utype,email,psd)values('$firstname','$lastname','$users','$email','$password')";
    $result = $connect->query($query);


    if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
else if(result)
echo "Insertion Successful";}
else{
echo "Enter a different email !! This email has been registered !!";


$email_exits="false";
}

}

echo <<<_END

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<center>
<h1><a href="index.html"><b style="color: orange" >The River</b></a></h1>
<form action="signup.php" method="post">

<label>First name: </label><input type="text" name="firstname" id="firstname" /><br />
<label>Last name: </label><input type="text" name="lastname" id="lastname" /><br />
<label>User Type: </label><select name="users">
    <option value="guest">guest</option>
    <option value="admin">admin</option>
    </select><br />
<label>E-mail: </label><input type="text" name="email" id="email" required/><br />
<label>Password: </label><input type="text" name="password" id="password" required/><br />
<!--<input value="Submit" type="submit" />-->
<button class="btn btn-primary" type="submit">Sign Up</button>

</form>
Old users <a href="login_users.php"> click <a> here.
</center>
_END;




$result->close();
$connect->close();
function get_post($connect, $var)  {
   return $connect->real_escape_string($_POST[$var]); }



?>