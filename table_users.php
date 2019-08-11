<?php // sqltest.php

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

         $query  = "DELETE FROM users WHERE email='$item'";
         $result = $conn->query($query);
  if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";

    }


  }

  if (isset($_POST['utype'])   &&
      isset($_POST['email'])    &&
      isset($_POST['fname']) &&
      isset($_POST['lname']))
  {
    $author   = get_post($conn, 'utype');
    $title    = get_post($conn, 'email');
    $category = get_post($conn, 'fname');
    $year     = get_post($conn, 'lname');
  
    $query    = "INSERT INTO users VALUES" .
      "('$utype', '$email', '$fname', '$lname')";
    $result   = $conn->query($query);

  if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="table_users.php" method="post"><pre>
    Type <input type="text" name="utype">
     Email <input type="text" name="email">
  First Name <input type="text" name="fname">
      Last Name <input type="text" name="lname">
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  $query  = "SELECT * FROM users";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
echo <<<_END

 <form action="sqltest.php" method="post">
  <input name="delete" type="submit" value="DELETE RECORD">

<table style="width:100%">
<thead>
  <tr>
    <th>Type</th>
    <th>Email</th>
    <th>First Name</th>
<th>Last Name</th>
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
<td>$row[3]</td>
<td><input type="checkbox"  name="chk[]" value="$row[4]"></td>
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
?>