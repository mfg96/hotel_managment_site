<?php
session_start();
require_once'login.php';



$email=$_SESSION['email'];
$con = new mysqli($hn,$un,$pw,$db);
if($con->connect_error)
    die($con->connect_error);
// unauthorized -> redirect to login
if(!isset($_SESSION['email'])){
header('Location: login_users.php');
}
?>


<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="..\js\check_all.js"></script>
</head>


<body>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Your Bookings</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <p>First Name : <?= $_SESSION['f_name'] ?> </p> 
    <p>Last Name : <?= $_SESSION['l_name'] ?> </p>
    <p>Email : <?= $_SESSION['email'] ?> </p>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php // sqltest.php

echo <<<_END
<head>
<link rel="stylesheet" type="text/css" href="../css/table.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../js/check_all.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

_END;
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) )
  {
    foreach($_POST['chk'] as $item) {

         $query  = "DELETE FROM rooms WHERE email='$item'";
         $result = $conn->query($query);
  if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";

    }


  }

  if (isset($_POST['utype'])   &&
      isset($_POST['email'])    &&
      isset($_POST['fname']) &&
      isset($_POST['lname']) &&
      isset($_POST['psd']))
  {
    $utype   = get_post($conn, 'utype');
    $email    = get_post($conn, 'email');
    $fname = get_post($conn, 'fname');
    $lname     = get_post($conn, 'lname');
    $psd     = get_post($conn, 'psd');
  
    $query    = "INSERT INTO users VALUES" .
      "('$utype', '$email', '$fname', '$lname','$psd')";
    $result   = $conn->query($query);

  if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }



  $query  = "SELECT * FROM users INNER JOIN rooms ON users.email = rooms.email WHERE users.email = '" . $email . "';" ;
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
echo <<<_END
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<form action="guest_page.php" method="post">
<br>
  <input name="delete" type="submit" value="DELETE RECORD">
<br>
<table style="width:100%">
<thead>
  <tr>
    <th>Type</th>
    <th>Email</th>
    <th>First Name</th>
<th>Booked Room</th>
<th><input type="checkbox" id="selectAll" onclick="check_all()"></th>
  </tr>
</thead>

_END;
 

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo <<<_END
  <pre>
<tr>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[5]</td>
<td><input type="checkbox"  name="chk[]" value="$row[1]"></td>
</tr>
  </pre>
 
_END;

  }
  echo <<<_END
</table> </form>
_END;
  $result->close();
  $conn->close();
 
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?></div>



 
</div>

</body>
 <a href="index.html" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</html>