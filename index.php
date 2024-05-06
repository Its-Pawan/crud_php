<?php
include ("header.php");
?>
  <div class="container">
    <h2>Dashboard</h2>
    <div class="row">
      <div class="col"><strong>Fname</strong></div>
      <div class="col"><strong>Lname</strong></div>
      <div class="col"><strong>Email</strong></div>
      <div class="col"><strong>Password</strong></div>
      <div class="col"><strong>Contact</strong></div>
      <div class="col"><strong>Gender</strong></div>
      <div class="col"><strong>Address</strong></div>
      <div class="col"><strong>Status</strong></div>
      <div class="col"><strong>Profile</strong></div>
      <div class="col"><strong>Action</strong></div>
    </div>
    <!-- Sample data rows -->
    <div class="row">
      <div class="col">John</div>
      <div class="col">Doe</div>
      <div class="col">john@example.com</div>
      <div class="col">********</div>
      <div class="col">1234567890</div>
      <div class="col">Male</div>
      <div class="col">123 Street, City</div>
      <div class="col">Active</div>
      <div class="col"><img src="https://www.w3schools.com/images/colorpicker2000.png" alt="Profile Picture" width="50"></div>
      <div class="col">
        <button type="button" class="btn btn-primary">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
    <!-- Add more rows with data here -->
  </div>
  <?php
  include ("footer.php");
  ?>
