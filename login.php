<?php
include ("header.php");
?>
<?php
session_start();
require_once ("config.php");
if (isset($_POST['login'])) {

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM users WHERE email = '$email' AND  password = '$password'";
  $exec = $conn->query($sql);
  if ($exec->num_rows > 0) {
    $_SESSION['user_data'] = $exec->fetch_object();
    // echo '<pre>';
    // print_r($_SESSION['user_data'] );
    echo ("<div class='alert alert-success' role='alert' > Welcome" . ' ' . $_SESSION['user_data']->fname . ' ' . $_SESSION['user_data']->lname . "</div>");
    header('Refresh: 1; URL=index.php');
    exit();
  } else {
    echo ("<div class='alert alert-danger' role='alert' '>Email or Password is invalid</div>");
 
  }
}
?>


<div class="container">
  <h2>Login</h2>
  <form method="post">
    <div class="form-group">
      <label for="email">Email address</label>
      <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <input type="submit" name="login" id="login" class="btn btn-primary" value="Submit">
  </form>
  <br><br>
  <a style="color:blue; border: 1px solid blue ;padding:7px 15px"
    href="/learning/crud_php/registration.php">Registration</a>
</div>
<?php
include ("footer.php");
?>