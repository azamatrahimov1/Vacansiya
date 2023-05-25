<?php
if (isset($_POST['signup'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $encryptedpass = md5($password);

  include 'db.php';


  // Проверка, существует ли email уже в базе данных
  $checkQuery = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
  $checkResult = $connection->query($checkQuery);
  $checkRow = $checkResult->fetch_assoc();


  if ($checkRow['count'] == 0) {
    // доавления информаций в базу данных
    $query = "INSERT INTO users(email,
    username,
    password,
    role) VALUES ('$email',
    '$username',
    '$encryptedpass',
    'client')";
  if ($connection->query($query) === TRUE) {
      echo "<div class='center-align'>
      <h5 class='black-text'>Добро пожаловать Пожалуйста войдите в систему!</h5><br><br>
      </div>";}
      header('signin.html')
  } elseif ($checkRow['count'] > 0) {
    echo "<div class='center-align'>
    <h5 class='red-text'>Пользователь с такой почтой уже существует, используйте другую почту для регистрации! </h5><br><br>
    </div>";
  } else {
    echo "<h5 class='red-text'>Error: " . $query . "</h5>" . $connection->error;
  }



  

  $connection->close();


}




?>