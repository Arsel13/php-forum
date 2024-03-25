<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Welcome to iCode - Coding Forum</title>
</head>

<body>
    <!-- Navbar -->
    <?php include "partials/_header.php"; ?>

    <div class="container bg-light py-5 px-3 my-5 w-50 m-auto">
        <?php
        include "partials/db_connection.php";

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` where category_id=$id";
        $result = mysqli_query($conn, $sql);
        foreach ($row = mysqli_fetch_assoc($result) as $result) {
            $cat_name = $row['category_name'];
            $cat_desc = $row['category_description'];
        }
        ?>
        <div class="h1">Welcome to <?php echo $cat_name; ?> Forums</div>
        <p class="my-2">
            <?php echo $cat_desc; ?>
        </p>
        <hr>
        <p class="my-2">
            No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive”
            posts, links or images. Do not cross post questions. Do not PM users asking for help. Remain respectful of
            other members at all times.
        </p>
    </div>

    <?php 
    $showAlert = false;
    $url = $_SERVER['REQUEST_URI'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $th_title = $_POST['thread_title'];
        $th_desc = $_POST['thread_desc'];
        $user = $_SESSION['username'];

        $fil_th_title = filter_var($th_title, FILTER_SANITIZE_STRING);
        $fil_th_desc = filter_var($th_desc, FILTER_SANITIZE_STRING);

        $sql4 = "SELECT * FROM `icode_users` WHERE user_name='$user' ";
        $result4 = mysqli_query($conn, $sql4);
        $row3 = mysqli_fetch_assoc($result4);

        $user_id = $row3['user_id'];

        $query = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `thread_time`)
                 VALUES ('$fil_th_title', '$fil_th_desc', '$id', '$user_id', CURRENT_TIMESTAMP())";
        $q_result = mysqli_query($conn, $query);
        $showAlert = true;
        if ($q_result) {
            echo '<div class="alert alert-success alert-dismissible fade show container w-50 m-auto" role="alert">
                    <strong>Success!</strong> Your concern has been posted, kindly wait for others to comment.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            header('Refresh: 2; url=' . $url . '');
        }
        else {
            echo "Your thread couldn't be posted";
        }
    }
    ?>

    <!-- Form -->
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '    <div class="container w-50 m-auto mt-3">
                    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                        <h1>Start a Discussion</h1>
                        <div class="mb-3 mt-3">
                            <label for="thread_title" class="form-label">Problem Title</label>
                            <input type="text" class="form-control" id="thread_title" name="thread_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="thread_desc" class="form-label">Elaborate Your Concern</label>
                            <textarea class="form-control" id="thread_desc" name="thread_desc" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>';
    } else {
        echo 
        "<div class='container w-50 m-auto mt-3 p-3 bg-light'>
            You are not logged in at the moment. Kindly login to start a discussion. If you don't have an iCode account, then signup.
        </div>";
    }
    
    ?>

    <div class="container my-5 w-50 m-auto">
        <h2 class="mb-3">Browse Questions</h2>
        <?php
        include "partials/db_connection.php";

        $sql2 = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result2 = mysqli_query($conn, $sql2);
        $noThread = true;
        while ($row = mysqli_fetch_assoc($result2)) {
            $noThread = false;
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_description'];
            $thread_time = $row['thread_time'];
            $thread_user_id = $row['thread_user_id'];

            $sql3 = "SELECT user_name FROM `icode_users` WHERE user_id='$thread_user_id' ";
            $result3 = mysqli_query($conn, $sql3);
            $row2 = mysqli_fetch_assoc($result3);

            $sql5 = "SELECT * FROM `profiles` WHERE `user_id` = '$thread_user_id'";
            $result5 = mysqli_query($conn, $sql5);
            $row5 = mysqli_fetch_assoc($result5); 
            
            if ($row5 > 0) {
                $user_img = $row5['image_url'];
                
                echo '        
                <div class="d-flex my-2">
                    <div>
                        <img src="uploads/'. $user_img .'" alt="" width="90" class="img-fluid rounded img-thumbnail" 
                        style="height: 80px; object-fit: cover;">
                    </div>
                    <div class="ms-2">
                        <h6 class="text-secondary">
                            <b>'. $row2['user_name'] .'</b> at '. $thread_time .'
                        </h6>
                        <h6>
                            <a href="threadlist.php?threadid=' . $thread_id . '" class="text-primary text-decoration-none">
                                ' . $thread_title . '
                            </a>
                        </h6>
                        <p>
                            ' . $thread_desc . '
                        </p>
                    </div>
                </div>';
            }
            else {
                echo '        
                <div class="d-flex my-2">
                    <div>
                        <img src="images/user.jfif" alt="" width="90px" class="img-fluid">
                    </div>
                    <div class="ms-2">
                        <h6 class="text-secondary">
                            <b>'. $row2['user_name'] .'</b> at '. $thread_time .'
                        </h6>
                        <h6>
                            <a href="threadlist.php?threadid=' . $thread_id . '" class="text-primary text-decoration-none">
                                ' . $thread_title . '
                            </a>
                        </h6>
                        <p>
                            ' . $thread_desc . '
                        </p>
                    </div>
                </div>';
            }
        }
        if ($noThread) {
            echo '<div class="bg-light py-5 px-3">
                    <div class="display-6">No Threads Found</div>
                    <p class="px-1">Be the first person to ask a question</p>
                </div>';
        }


        ?>
    </div>

    <?php
    // Footer 
    include "partials/_footer.php";

    // Modals
    include "partials/_login_modal.php";
    include "partials/_signup_modal.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>