<?php
include ("header.php");
?>
<?php
session_start();
require_once ("config.php");

if(isset($_GET['user'])){
  $uid =mysqli_real_escape_string($conn, $_GET['user']);
$select_user = "SELECT * FROM users WHERE id = $uid";
$select_exec = $conn-> query($select_user);
$user_data= $select_exec-> fetch_object();
// echo "<pre>";
// print_r($user_data  );
// exit();   
}
else{
  header('Location:index.php');
}


if (isset($_POST['update'])) {
  echo '<pre>';
  $path = 'uploads/';
  $extention = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
  $file_name = $_POST['firstName'] . '_' . date('YmdHms') . '.' . $extention;
  $profile = (file_exists($_FILES['profile']['tmp_name'])) ? $file_name :  $user_data->profile ;

  $update_data = [
    'fname' => mysqli_real_escape_string($conn,$_POST['firstName']),
    'lname' => mysqli_real_escape_string($conn,$_POST['lastName']),
    'email' => mysqli_real_escape_string($conn,$_POST['email']),
    'password' => mysqli_real_escape_string($conn,$_POST['password']),
    'contact' => mysqli_real_escape_string($conn,$_POST['contact']),
    'profile' => mysqli_real_escape_string($conn,$profile),
    'gender' => mysqli_real_escape_string($conn,$_POST['gender']),
    'address' => mysqli_real_escape_string($conn,$_POST['address']),
    'state' => mysqli_real_escape_string($conn,$_POST['state']),
    'hobbies' => mysqli_real_escape_string($conn,implode(',', $_POST['hobby'])),
  ];
  // print_r($insert_data); # to check about inserted info
 
$sql = "UPDATE  users SET ";
foreach($update_data as $key=>$value){
  $sql .="$key = '$value',";
}
$sql = rtrim($sql,',');
$sql .= " WHERE id =".$uid;
// echo $sql;
$exec = $conn->query($sql); 


  if ($exec) {
    if (!is_null($profile)) {
      move_uploaded_file($_FILES['profile']['tmp_name'], $path . $file_name);
    }

    echo '<div class="alert alert-primary" role="alert">
    Data Updated succesfully!
  </div>';

    header('Refresh: 3; URL=index.php');
  } else {
    echo '<div class="alert alert-primary" role="alert">
  Something went wrong!
  </div>';

    header('Refresh: 3; URL=index.php');

  }


}
?>

<div class="container">
  <h2>Update Profile</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name"
            required value="<?php echo $user_data-> fname;?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name='email' id="email" placeholder="Enter Email" required value="<?php echo $user_data-> email;?>">
        </div>
        <div class="form-group">
          <label for="contact">Contact</label>
          <input type="text" class="form-control" name='contact' id="contact" placeholder="Enter Contact" required value="<?php echo $user_data-> contact;?>">
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required value="<?php echo $user_data-> address;?>">
        </div>
        <div class="form-group">
          <label for="profile">Profile</label> 
          <img src="uploads/<?php echo $user_data->profile?>" width="80"  alt="">
          <input type="file" value="<?php echo $user_data->profile?>" src="uploads/<?php echo $user_data->profile?>" class="form-control-file" name="profile" id="profile" value="<?php echo $user_data-> profile;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php echo $user_data-> lname;?>" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password"
            required value="<?php echo $user_data-> password;?>">
        </div>
        <div class="form-group">
          <label>Gender</label>
          <div> 
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male"
              <?php if($user_data-> gender =='Male'){echo 'checked';}?>
              >
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input"
              type="radio" name="gender" id="female" value="female" 
              <?php if($user_data-> gender =='Female'){echo 'checked';} ?>
              >
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="state">State</label>
          <select class="form-control" name="state" id="state">
            <option value="" disabled >Select State</option>
            <option value="1" <?php if($user_data-> state =='1'){echo 'selected';}?> >Uttarakhand</option>
            <option value="2" <?php if($user_data-> state =='2'){echo 'selected';}?>>Delhi</option>
            <option value="3" <?php if($user_data-> state =='3'){echo 'selected';}?>>Gujrat</option>
            <!-- Add more states here -->
          </select>
        </div>
        <div class="form-group">
          <label>Hobbies</label>
          <?php $hobbies_arr =  explode(',', $user_data -> hobbies); ?>
          <div class="d-flex">
            <div class="form-check ml-2">
              <input class="form-check-input" name="hobby[]" <?php if(in_array('travelling', $hobbies_arr)){echo 'checked';}?> type="checkbox" value="travelling" id="hobby1">
              <label class="form-check-label" for="hobby1">Travelling</label>
            </div>
            <div class="form-check ml-2">
              <input class="form-check-input" name="hobby[]" type="checkbox" <?php if(in_array('music', $hobbies_arr)){echo 'checked';}?> value="music" id="hobby2">
              <label class="form-check-label" for="hobby2">Music</label>
            </div>
            <div class="form-check ml-2">
              <input class="form-check-input" name="hobby[]" type="checkbox" <?php if(in_array('coding', $hobbies_arr)){echo 'checked';}?> value="coding" id="hobby3">
              <label class="form-check-label" for="hobby3">Coding</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" name="update" value="Update" class="btn btn-primary">
  </form>
  <br><br>
  <?php
  if (isset($_SESSION['user_data'])) {
    echo '<a style="color:blue; border: 1px solid blue ;padding:7px 15px" href="/learning/crud_php/index.php">Index</a>
    ';
    echo '<a style="color:blue; border: 1px solid blue ;padding:7px 15px" href="/learning/crud_php/logout.php">LogIn</a>
    ';
  }
  ?>
</div>

<?php
include ("footer.php");
?>