<?php
include ("header.php");
?>
<?php
session_start();
require_once ("config.php");
if (isset($_POST['submit'])) {
  echo '<pre>';
  $path = 'uploads/';
  $extention = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
  $file_name = $_POST['firstName'] . '_' . date('YmdHms') . '.' . $extention;
  $profile = (file_exists($_FILES['profile']['tmp_name'])) ? $file_name : 'null';

  $insert_data = [
    'fname' => $_POST['firstName'],
    'lname' => $_POST['lastName'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'contact' => $_POST['contact'],
    'profile' => $profile,
    'gender' => $_POST['gender'],
    'address' => $_POST['address'],
    'state' => $_POST['state'],
    'hobbies' => implode(',', $_POST['hobby']),
  ];
  // print_r($insert_data); # to check about inserted info
  $cols = implode(',', array_keys($insert_data));
  $vals = implode("','", array_values($insert_data));
  $sql = "INSERT INTO users ($cols) VALUES ('$vals')";
  // echo $sql;
  $insert = $conn->query($sql);
  if ($insert) {
    if (!is_null($profile)) {
      move_uploaded_file($_FILES['profile']['tmp_name'], $path . $file_name);
    }

    echo '<div class="alert alert-primary" role="alert">
    Data Inserted succesfully!
  </div>';

    header('Refresh: 3; URL=login.php');
  } else {
    echo '<div class="alert alert-primary" role="alert">
  Something went wrong!
  </div>';

    header('Refresh: 3; URL=registration.php');

  }


}
?>

<div class="container">
  <h2>Registration Form</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name"
            required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name='email' id="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
          <label for="contact">Contact</label>
          <input type="text" class="form-control" name='contact' id="contact" placeholder="Enter Contact" required>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required>
        </div>
        <div class="form-group">
          <label for="profile">Profile</label>
          <input type="file" class="form-control-file" name="profile" id="profile">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"
            required>
        </div>
        <div class="form-group">
          <label>Gender</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male">
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female">
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="state">State</label>
          <select class="form-control" name="state" id="state">
            <option value="" disabled selected>Select State</option>
            <option value="1">Uttarakhand</option>
            <option value="2">Delhi</option>
            <option value="3">Gujrat</option>
            <!-- Add more states here -->
          </select>
        </div>
        <div class="form-group">
          <label>Hobbies</label>
          <div>
            <div class="form-check">
              <input class="form-check-input" name="hobby[]" type="checkbox" value="travelling" id="hobby1">
              <label class="form-check-label" for="hobby1">Travelling</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="hobby[]" type="checkbox" value="music" id="hobby2">
              <label class="form-check-label" for="hobby2">Music</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="hobby[]" type="checkbox" value="coding" id="hobby3">
              <label class="form-check-label" for="hobby3">Coding</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" name="submit" value="Register" class="btn btn-primary">
  </form>
  <br><br>
  <a style="color:blue; border: 1px solid blue ;padding:7px 15px" href="/learning/crud_php/login.php">LogIn</a>
</div>

<?php
include ("footer.php");
?>