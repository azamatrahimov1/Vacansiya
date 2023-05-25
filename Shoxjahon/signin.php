<?php
session_start();

if (isset($_POST['signin'])) {


  $email = $_POST['email'];
  $password=md5($_POST['password']);
  include 'db.php';
  $email=mysqli_real_escape_string($connection, $email);
  $query = "SELECT * FROM users WHERE email='{$email}' and password = '{$password}'";
  $select_user_query = mysqli_query($connection, $query);


  if (!$select_user_query) {
    DIE("QUERY FAILED". mysqli_error($connection));
  }
  $row = mysqli_fetch_array($select_user_query);

  $user_id = $row['id'];
  $user_email = $row['email'];
  $user_password = $row['password'];
  $username= $row['username'];
  $user_role = $row['role'];


  if ($email !== $user_email && $password !== $user_password) {
    echo "<div class='center-align meh'>
      <h5 class='red-text'>Введенные вами данные неправильны!</h5>
      </div>";
  }



  else{
    if($user_role == 'admin'){

      $_SESSION['id'] = $user_id;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $user_email;
      $_SESSION['role'] = 'admin';
      $_SESSION['logged_in']= 'True';
      echo "<meta http-equiv='refresh' content='0;url=./admin/index.php' />";
    }

    else {
      $_SESSION['id'] = $user_id;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $user_email;
      $_SESSION['logged_in']= 'True';
      echo '<meta http-equiv="refresh" content="0;url=../index.php">';
    }
}
}

?>
