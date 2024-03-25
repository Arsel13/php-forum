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
    <!-- Navbar -->
    <?php include "partials/_header.php"; ?>

    <!-- Signup Alerts -->
    <?php
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <strong>Success!</strong> Your iCode account has been successfully created.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Username already in use"
    ) {
        echo '<div class="alert alert-secondary alert-dismissible fade show mb-0" role="alert">
        <strong>Username already in use!</strong> You are requested to choose some other username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Passwords do not match"
    ) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>Passwords do not match!</strong> It seems like you didn\'t confirm the same password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Do not use special characters"
    ) {
        echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Error!</strong> Kindly don\'t use special characters in username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <strong>Success!</strong> You are successfully logged in to iCode.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"  && $_GET['error']
        && $_GET['error'] == "Invalid password"
    ) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>Invalid Credentials!</strong> It seems like you have put invalid password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"  && $_GET['error']
        && $_GET['error'] == "User does not exist"
    ) {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <strong>Invalid Credentials!</strong> It seems like you have put invalid username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Do not use special characters"
    ) {
        echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Error!</strong> Kindly don\'t use special characters in username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['catsuccess']) && $_GET['catsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Category already exists"
    ) {
        echo '<div class="alert alert-error alert-dismissible fade show mb-0" role="alert">
        <strong>Error!</strong> The Category name already exists.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['catsuccess']) && $_GET['catsuccess'] == "true"
    ) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <strong>Success!</strong> Category added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }

    if (
        isset($_GET['catsuccess']) && $_GET['catsuccess'] == "false" && $_GET['error']
        && $_GET['error'] == "Do not use special characters"
    ) {
        echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Error!</strong> Kindly don\'t use special characters in username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header('Refresh: 1; url=index.php');
    }
    ?>

    <!-- Carousel starts here -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/bg-1.jpg" class="d-block w-100 img-fluid">
            </div>
            <div class="carousel-item">
                <img src="images/bg-2.jpg" class="d-block w-100 img-fluid">
            </div>
            <div class="carousel-item">
                <img src="images/bg-3.jpg" class="d-block w-100 img-fluid">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Carousel ends here -->

    <!-- Categories Section Starts here -->
    <div class="container my-5 w-75 m-auto">
        <div class="row">
            <?php
            include "partials/db_connection.php";

            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['category_id'];
                $cat_name = $row['category_name'];
                $cat_desc = $row['category_description'];
                echo '
                    <div class="col-md-4 pt-4">
                        <div class="card">
                            <img src="https://source.unsplash.com/500x500/?' . $cat_name . ',coding " class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="threads.php?catid=' . $cat_id . '" class="text-decoration-none text-primary">'
                    . $cat_name . '
                                    </a>
                                </h5>
                                <p class="card-text">' . substr($cat_desc, 0, 70) . '...</p>
                                <a href="threads.php?catid=' . $cat_id . '" class="btn btn-success">View Threads</a>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
    <!-- Categories Section Ends here -->

    <?php
    // Footer 
    include "partials/_footer.php";

    // Modals
    include "partials/_login_modal.php";
    include "partials/_signup_modal.php";
    include "partials/_categories_modal.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>