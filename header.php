<?php
    require "includes/config_session.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log Sign Users</title>
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    </head>


    <body>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Username</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="includes/edit.inc.php" method="post">
                        <input type="hidden" name="idEdit" id="idEdit">
                        <div class="form-group mb-3">
                            <label for="usernameEdit" class="form-label">Edit Username</label>
                            <input type="text" class="form-control" id="usernameEdit" name="usernameEdit">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Username</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Users Site</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                        if(!isset($_SESSION['user_username'])){
                            echo '<li class="nav-item">
                                <a class="nav-link" href="signup.php">Signup</a>
                            </li>';
                            echo'<li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>';

                        }else{
                            echo'<li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>';
                        }
                    ?>
                    
                </ul>
                </div>
            </div>
        </nav>

        <?php
            if (isset($_GET['signup']) && $_GET['signup']==='success'){
                echo '<div class="alert alert-success text-center" role="alert">
                        Signed in successfully
                    </div>';
            }else if (isset($_SESSION["error_signup"])){ 
                $errors = $_SESSION["error_signup"];
                echo '<div class="alert alert-danger text-center" role="alert">';
                foreach($errors as $error){
                    echo '<p class="form-error">'. $error . '</p>';
                }
                echo '</div>';
                unset($_SESSION['error_signup']);
            }else if (isset($_GET['login']) && $_GET['login']==='success'){
                echo '<div class="alert alert-success text-center" role="alert">
                        Logged in successfully
                    </div>';
            }else if (isset($_SESSION["errors_login"])){ 
                $errors = $_SESSION["errors_login"];
                echo '<div class="alert alert-danger text-center" role="alert">';
                foreach($errors as $error){
                    echo '<p class="form-error">'. $error . '</p>';
                }
                echo '</div>';
                unset($_SESSION['errors_login']);
            }else if (isset($_GET['logout']) && $_GET['logout']==='success'){
                echo '<div class="alert alert-success text-center" role="alert">
                        Logged out successfully
                    </div>';
            }else if (isset($_GET['update']) && $_GET['update']==='success'){
                echo '<div class="alert alert-success text-center" role="alert">
                        user updated successfully
                    </div>';
            }
            else if (isset($_GET['delete']) && $_GET['delete']==='success'){
                echo '<div class="alert alert-danger text-center" role="alert">
                        user Deleted successfully
                    </div>';
            }
        ?>