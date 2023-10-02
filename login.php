<?php
    include_once 'database.php';
    session_start();
    $message="";
    if(count($_POST)>0) {
        $result = mysqli_query($conn,"SELECT * FROM admin WHERE Username='" . $_POST["Username"] . "' and Password = '". $_POST["Password"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['user_id'];
        $_SESSION["name"] = $row['Username'];
        } else {
        echo '<script>alert("Invalid Username Or Password")</script>';
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Wish Portal | All Students</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
<div class="container mt-5">
    <div class="content">
        <div class="row">
        <div class="col-3">
            </div>
                <div class="col-6  mt-4 text-center">
                <div class="header text-center">
                    <h1>Birthday Wish Portal</h1>
                </div>
                <div class="login-form">
                    <form method="post">
                        <div class="form-group mt-3">
                            <input type="text" id="Username" name="Username" class="form-control" placeholder="Username" required="required">
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" id="Password" name="Password" class="form-control" placeholder="Password" required="required">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Log in</button>
                        </div>     
                    </form>
                </div>
                </div>
        <div class="col-3">
        </div>
        </div>
    </div> 
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>