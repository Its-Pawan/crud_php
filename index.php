<?php
include ("header.php");
session_start();
require_once ("config.php");
$sql = "select * from users";
$exec = $conn->query($sql);
while ($data = $exec->fetch_object()) {
  $users[] = $data;
}
$states = [
  '1' => 'Uttarakhand',
  '2' => 'Delhi',
  '3' => 'Gujrat',
];
// echo "<pre>";
// print_r($users);
if (isset($_POST['logout'])) {
  $_SESSION = [];
  session_destroy();
  echo ("<div class='alert alert-success' role='alert' > Thanks for coming</div>");
  header('Refresh: 1; URL=login.php');
  exit;
}
?>
?>
<div class="container-fluid">

  <?php
  if (isset($_SESSION['user_data'])) {
    $i = 1;
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><strong>#</strong></th>
          <th><strong>Fname</strong></th>
          <th><strong>Lname</strong></th>
          <th><strong>Email</strong></th>
          <th><strong>Password</strong></th>
          <th><strong>Contact</strong></th>
          <th><strong>Gender</strong></th>
          <th><strong>Hobbies</strong></th>
          <th><strong>Address</strong></th>
          <th><strong>State</strong></th>
          <th><strong>Profile</strong></th>
          <th><strong>Action</strong></th>
        </tr>
      </thead>
      <?php

      foreach ($users as $user) {
        // echo "<pre>";
        // print_r($user);
        ?>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $user->fname; ?></td>
          <td><?php echo $user->lname; ?></td>
          <td><?php echo $user->email; ?></td>
          <td><?php echo $user->password; ?></td>
          <td><?php echo $user->contact; ?></td>
          <td><?php echo $user->gender; ?></td>
          <td><?php echo $user->hobbies; ?></td>
          <td><?php echo $user->address; ?></td>
          <td><?php echo isset($states[$user->state]) ? $states[$user->state] : null; ?></td>
          <td><img src="<?php echo 'uploads/' . $user->profile; ?>" alt="Profile Picture" width="50">
          </td>
          <td>
            <button type="button" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </td>
        </tr>
        <?php
        $i++;
      }
      ?>
      </tbody>
    </table>

    <form method="post">
      <button class="btn btn-danger" type="submit" name="logout">Logout</button>
    </form>
    <?php
  } else {
    echo "
        <div class='alert alert-danger' role='alert'>Please login or Register to view all data</div>
        ";
    echo "<a href='/learning/crud_php/registration.php'>Click to Register </a>";
    echo "<a href='/learning/crud_php/login.php'>Click to LogIn </a>";
  }
  ?>

</div>
<?php
include ("footer.php");
?>