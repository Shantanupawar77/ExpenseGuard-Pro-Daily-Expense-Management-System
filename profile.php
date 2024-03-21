<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

if (isset($_POST['save'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];

    $sql = "UPDATE users SET firstname = '$fname', lastname='$lname' WHERE user_id='$userid'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: profile.php');
}

if (isset($_POST['but_upload'])) {

    $name = $_FILES['file']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record
        $query = "UPDATE users SET profile_path = '$name' WHERE user_id='$userid'";
        mysqli_query($con, $query);

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);

        header("Refresh: 0");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseGuard Pro</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/feather.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css_new/indexcss.css">
    <style>
    * {
        margin: 0;
    }

    .dashboard {
        margin-top: 0;
    }

    .dashboard-app .navbar {
        background-color: #365486;
    }


    .dashboard-nav-list a {
        color: #0F1035;
    }

    .dashboard-content {
        background-color: #DCF2F1;
    }

    .dashboard-content {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
    </style>
</head>

<body>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5>
                    <?php echo $username ?>
                </h5>
                <p>
                    <?php echo $useremail ?></p>
            </div>


            <nav class="dashboard-nav-list"><a href="index.php" class="dashboard-nav-item"><i class="fas fa-home"></i>
                    Dashboard </a><a href="add_expense.php" class="dashboard-nav-item "><i
                        class="fas fa-tachometer-alt"></i>
                    Add Expenses
                </a><a href="manage_expense.php" class="dashboard-nav-item"><i class="fas fa-file-upload"></i> Manage
                    Expenses </a>
                <a href="profile.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Profile </a>
                <a href="getReport.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Export </a>
                <div class="nav-item-divider"></div>
                <a href="change_password.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Change Password
                </a>
                <a href="logout.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="mt-4 text-center">Update Profile</h3>
                    <hr>
                    <form class="form" method="post" action="" enctype='multipart/form-data'>
                        <div class="text-center mt-3">
                            <img src="<?php echo $userprofile; ?>"
                                class="text-center img img-fluid rounded-circle avatar" width="120"
                                alt="Profile Picture">
                        </div>
                        <div class="input-group col-md mb-3 mt-3">
                            <div class="custom-file">
                                <input type="file" name='file' class="custom-file-input" id="profilepic"
                                    aria-describedby="profilepicinput">
                                <label class="custom-file-label" for="profilepic">Change Photo</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" name='but_upload'
                                    id="profilepicinput">Upload Picture</button>
                            </div>
                        </div>


                    </form>



                    <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <div class="col-md">
                                        <label for="first_name">
                                            First name
                                        </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                            placeholder="First Name" value="<?php echo $firstname; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">

                                    <div class="col-md">
                                        <label for="last_name">
                                            Last name
                                        </label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            value="<?php echo $lastname; ?>" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="<?php echo $useremail; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md">
                                <br>
                                <button class="btn btn-block btn-md btn-primary"
                                    style="border-radius:0%; background:#0F1035" name="save" type="submit">Save
                                    Changes</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <script>
    feather.replace()
    </script>
    <script type="text/javascript">
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });
    </script>
</body>

</html>