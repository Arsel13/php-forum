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

    <div class="container bg-light py-5 px-3 my-5 w-50 m-auto">
        <?php
        include "partials/db_connection.php";

        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` where thread_id=$id";
        $result = mysqli_query($conn, $sql);
        foreach ($row = mysqli_fetch_assoc($result) as $result) {
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_description'];
            $thread_user_id = $row['thread_user_id'];

            $sql3 = "SELECT user_name FROM `icode_users` WHERE user_id='$thread_user_id' ";
            $result3 = mysqli_query($conn, $sql3);
            $row2 = mysqli_fetch_assoc($result3);
        }
        ?>
        <div class="h1"><?php echo $thread_title ?></div>
        <p class="my-2">
            <?php echo $thread_desc; ?>
        </p>
        <hr>
        <p class="my-2">
            No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive”
            posts, links or images. Do not cross post questions. Do not PM users asking for help. Remain respectful of
            other members at all times.
        </p>
        <p>Posted by: <b><?php echo $row2['user_name']; ?></b></p>
    </div>

    <?php
    $showAlert = false;
    $my_uri = $_SERVER['REQUEST_URI'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];
        $cur_user = $_SESSION['username'];

        $fil_comment = filter_var($comment, FILTER_SANITIZE_STRING);

        $query = "INSERT INTO `comments` (`thread_id`, `comment_content`, `comment_by`, `comment_time`) 
        VALUES ('$id', '$fil_comment', '$cur_user', current_timestamp())";
        $c_result = mysqli_query($conn, $query);
        $showAlert = true;
        if ($c_result) {
            echo '<div class="alert alert-success alert-dismissible fade show container w-50 m-auto" role="alert">
                    <strong>Success!</strong> Your comment has been posted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            header('Refresh: 2; url=' . $my_uri . '');
        } else {
            echo "Your comment couldn't be posted";
        }
    }
    ?>

    <!-- Form -->
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION["loggedin"] == true) {
        echo '<div class="container w-50 m-auto mt-3">
                <form method="post" action="' . $_SERVER["REQUEST_URI"] . '">
                    <h1>Type your comment</h1>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Elaborate Your Concern</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
    } else {
        echo "<div class='container w-50 m-auto mt-3 p-3 bg-light'>
                You are not logged in at the moment. Kindly login in to post comments. If you don't have an iCode account, 
                then signup.
            </div>";
    }

    ?>

    <div class="container my-5 w-50 m-auto">
        <h2 class="mb-3">Discussions</h2>
        <?php
        include "partials/db_connection.php";

        $sql2 = "SELECT * FROM `comments` where thread_id=$id";
        $result2 = mysqli_query($conn, $sql2);
        $noComment = true;
        while ($row = mysqli_fetch_assoc($result2)) {
            $noComment = false;
            $comment_id = $row['comment_id'];
            $comment_content = $row['comment_content'];
            $comment_by = $row['comment_by'];
            $comment_time = $row['comment_time'];

            $sql4 = "SELECT * FROM `profiles` WHERE `user_name` = '$comment_by'";
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);

            if ($row4 > 0) {
                $user_image = $row4['image_url'];
                echo '        
                <div class="d-flex my-2">
                    <div>
                        <img src="uploads/' . $user_image . '" alt="" width="70px" class="img-fluid" 
                        style="height: 60px; object-fit: cover;">
                    </div>
                    <div class="ms-2">
                        <h6>
                            <b>' . $comment_by . '</b> at ' . $comment_time . '
                        </h6>
                        <p>
                            ' . $comment_content . '
                        </p>
                    </div>
                </div>';
            } 
            else {
                echo '        
                <div class="d-flex my-2">
                    <div>
                        <img src="images/user.jfif" alt="" width="70px" class="img-fluid">
                    </div>
                    <div class="ms-2">
                        <h6>
                            <b>' . $comment_by . '</b> at ' . $comment_time . '
                        </h6>
                        <p>
                            ' . $comment_content . '
                        </p>
                    </div>
                </div>';
            }
        }

        if ($noComment) {
            echo '<div class="bg-light py-5 px-3">
                <div class="display-6">No Results Found</div>
                <p class="px-1">Be the first person to comment</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>