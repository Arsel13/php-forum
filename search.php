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
    
    <!-- Search Results -->
    <div class="container w-50 mx-auto my-3">
        <h1 class="text-center">Search results for <em>"<?php echo $_GET['search'] ?>"</em></h1>
        <h1 class="mt-5">Threads</h1>
        <?php
        include "partials/db_connection.php";
        $noResult = true;
        $noResult2 = true;
        $query = $_GET['search'];

        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_description`) AGAINST ('$query');";
        $result = mysqli_query($conn, $sql);
        $counter = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $counter++;
            $noResult = false;
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_description'];
            $url = "threadlist.php?threadid=$thread_id";
            
            echo '<div>
                    <h3>
                        <a href="'. $url .'" class="text-primary">'. $counter .'. '. $thread_title .'</a>
                    </h3>
                    <p class="ms-4">'. $thread_desc .'</p>
                </div>';
        }
        if ($noResult) {
            echo '<div class="bg-light py-5 px-3">
                    <div class="display-6">No Results Found</div>
                    <ul class="">
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                    </ul>
                </div>';
        }
        echo '<hr class="mt-5">';

        echo '<h1 class="mt-5">Comments</h1>';
        $sql2 = "SELECT * FROM `comments` WHERE MATCH (`comment_content`) AGAINST ('$query');";
        $result2 = mysqli_query($conn, $sql2);
        $counter2 = 0;
        while ($row = mysqli_fetch_assoc($result2)) {
            $counter2++;
            $noResult2 = false;
            $comment = $row['comment_content'];
            $cthread_id = $row['thread_id'];
            $uri = "threadlist.php?threadid=$cthread_id";
            echo '<div>
                    <h4>
                        <a href="'. $uri .'" class="text-dark text-decoration-none">'. $counter2 .'. "'. $comment .'"</a>
                    </h4>
                </div>';
        }
        if ($noResult2) {
            echo '<div class="bg-light py-5 px-3">
                    <div class="display-6">No Results Found</div>
                    <ul class="">
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                    </ul>
                </div>';
        }
        ?>

    </div>

    <?php
    // Modals
    include "partials/_login_modal.php";
    include "partials/_signup_modal.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>