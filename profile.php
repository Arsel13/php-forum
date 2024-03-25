<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Welcome to iCode - Coding Forum</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'partials/db_connection.php';

        $userName = $_SESSION['username'];
        $fisrtName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bio = $_POST['bio'];

        $id_sql = "SELECT * FROM `icode_users` WHERE `user_name` = '$userName'";
        $id_result = mysqli_query($conn, $id_sql);
        $id_row = mysqli_fetch_assoc($id_result);

        $user_id = $id_row['user_id'];

        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        echo '<div class="d-none">';
        echo "<pre>";
        var_dump($_FILES['my_image']);
        echo "</pre>";
        echo '</div>';

        $dup_sql = "SELECT * from `profiles` where `user_name` = '$userName'";
        $dup_result = mysqli_query($conn, $dup_sql);
        if ($dup_result) {
            $num_rows = mysqli_num_rows($dup_result);
            if ($num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show container w-50 m-auto" role="alert">
                    <strong>Error!</strong> You cannot have more than 2 profiles. You can update your existing profile by clicking 
                    update button.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                header('Refresh: 2, url= profile.php');
            } else {
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {

                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;


                        $sql = "INSERT INTO `profiles` (`user_id`, `user_name`, `first_name`, `last_name`, `date`, `gender`, 
                                `image_url`, `about`, `edited_at`) VALUES ('$user_id', '$userName', '$fisrtName', '$lastName', '$dob', 
                                '$gender', '$new_img_name', '$bio', CURRENT_TIMESTAMP())";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo '<div class="alert alert-success alert-dismissible fade show container w-50 m-auto" role="alert">
                    <strong>Success!</strong> Your profile has been updated.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                            move_uploaded_file($tmp_name, $img_upload_path);
                            header('Refresh: 2, url= profile.php');
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show container w-50 m-auto" role="alert">
                                <strong>Error!</strong> Kindly do not use special characters.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            header('Refresh: 2, url= profile.php');
                        }
                    } else {
                        echo '<div class="alert alert-warning alert-dismissible fade show container w-50 m-auto" role="alert">
                            <strong>Error!</strong> You cannot upload image files of this type. Only jpg, jpeg & png are allowed.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        header('Refresh: 2, url= profile.php');
                    }
                } else {
                    echo "unknown error occurred!";
                }
            }
        }
    }

    ?>

    <!-- Form starts here -->
    <div class="container w-50 mx-auto my-5">
        <h1 class="text-center my-4">Edit Profile</h1>
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Your First Name" required>
                <label for="firstName">First Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Your Last Name" required>
                <label for="lastName">Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dob" name="dob" required>
                <label for="dob" class="form-label">DOB</label>
            </div>
            <div class="form-floating mb-3 w-50">
                <select class="form-select" id="gender" name="gender" aria-label="Floating label select example" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <label for="gender">Gender</label>
            </div>
            <div class="mb-3 w-50">
                <label for="my_image" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" id="my_image" name="my_image" required>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="bio" name="bio" style="height: 100px">
                </textarea>
                <label for="bio">About Yourself</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Form ends here -->

    <?php
    // Footer 
    include "partials/_footer.php";
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>