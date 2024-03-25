<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']  == true) {
  $loggedin = true;
  $loggedin_user = $_SESSION['username'];
  $user_role = $_SESSION['user_role'];
} 
else {
  $loggedin = false;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iCode</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <?php
        if ($loggedin) {
          echo '<li class="nav-item">
                  <a class="nav-link" href="profile.php">Edit Profile</a>
                </li>';
        }
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" 
          aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <?php
              include "db_connection.php";
              $sql = "SELECT `category_name`, `category_id` FROM `categories`";
              $result = mysqli_query($conn, $sql);
              $count = 0;

              while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                echo '<a class="dropdown-item" href="threads.php?catid=' . $row['category_id'] . '">' . $count . ') 
                ' . $row['category_name'] . '</a>';
              }
              ?>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>
      </ul>
      <form class="d-flex" action="search.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <div class="d-flex ms-lg-2 ms-sm-0 mt-2 mt-lg-0 gap-1">
        <?php
        if (!$loggedin) {
          echo '<button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" 
                 data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" 
                 data-bs-target="#signupModal">Signup</button>';
        } elseif ($loggedin) {
          $img_sql = "SELECT * FROM `profiles` WHERE `user_name` = '$loggedin_user'";
          $img_result = mysqli_query($conn, $img_sql);
          $img_row = mysqli_fetch_assoc($img_result);
          echo '<h6 class="text-white my-auto">Welcome <b><i>' . $_SESSION['username'] . '</i></b></h6>';
          if ($img_row > 0) {
            echo '<img src="uploads/'. $img_row["image_url"] .'" width="50px" class="rounded-circle img-fluid" 
            style="object-fit: cover; border: 1px solid white;">';
          }
          if ($user_role === "admin") {
            echo  '<button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" 
                   data-bs-target="#categoriesModal">Add Category</button>';
          }
          echo '<form action="partials/_logout.php">
                  <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>';
        }
        ?>
      </div>
    </div>
  </div>
</nav>