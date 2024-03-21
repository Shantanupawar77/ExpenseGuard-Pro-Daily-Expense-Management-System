<?php 
require 'config.php'; 
?>
<?php
include("session.php");
require 'data.php';
$update = false;
$del = false;
$expenseamount = "";
$expensedate = date("Y-m-d");
$expensecategory = "Entertainment";
if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $expenses = "INSERT INTO expenses (user_id, expense,expensedate,expensecategory) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory')";
    $result = mysqli_query($con, $expenses) or die("Something Went Wrong!");
    header('location: add_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE expenses SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE expenses SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "DELETE FROM expenses WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>
<?php
 
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
    body {
        margin: 0;
    }

    .dashboard {
        margin-top: 0;
    }

    .dashboard-app .navbar {
        background-color: #23d2ae;
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
    </style>


</head>

<body>
    <?php
    require 'data.php';
  ?>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5>
                    <?php 
                echo $username 
                ?>

                </h5>
                <p>
                    <?php 
                echo $useremail
                 ?>

                </p>

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

        <div class='dashboard-app'>
            <nav class="navbar navbar-expand-lg navbar-light  ">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <a class="dropdown-item" href="profile.php">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h3 class="mt-4 text-center">Add Your Daily Expenses</h3>
                            <hr>
                        </div>
                        <div class='container '>
                            <div class="row">
                                <div style="padding:15px 15px">
                                    <img src="exenseManagerPhoto.gif" width="400px" alt="" style="padding:15px 15px">
                                </div>

                                <div class="col-md" style="margin:0 auto;">
                                    <form action="" method="POST">
                                        <div class="form-group row">
                                            <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter
                                                    Amount($)</b></label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control col-sm-12"
                                                    value="<?php echo $expenseamount; ?>" id="expenseamount"
                                                    name="expenseamount" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control col-sm-12"
                                                    value="<?php echo $expensedate; ?>" name="expensedate"
                                                    id="expensedate" required>
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-6 pt-0"><b>Category</b>
                                                </legend>
                                                <div class="col-md">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory4"
                                                            value="Medicine"
                                                            <?php echo ($expensecategory == 'Medicine') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory4">
                                                            Medicine
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory3" value="Food"
                                                            <?php echo ($expensecategory == 'Food') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory3">
                                                            Food
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory2"
                                                            value="Bills & Recharges"
                                                            <?php echo ($expensecategory == 'Bills & Recharges') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory2">
                                                            Bills and Recharges
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory1"
                                                            value="Entertainment"
                                                            <?php echo ($expensecategory == 'Entertainment') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory1">
                                                            Entertainment
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory7"
                                                            value="Clothings"
                                                            <?php echo ($expensecategory == 'Clothings') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory7">
                                                            Clothings
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory6" value="Rent"
                                                            <?php echo ($expensecategory == 'Rent') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory6">
                                                            Rent
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory8"
                                                            value="Household Items"
                                                            <?php echo ($expensecategory == 'Household Items') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory8">
                                                            Household Items
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="expensecategory" id="expensecategory5" value="Others"
                                                            <?php echo ($expensecategory == 'Others') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="expensecategory5">
                                                            Others
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-12 text-right">
                                                <?php if ($update == true) : ?>
                                                <button class="btn btn-lg btn-block btn-warning"
                                                    style="border-radius: 0%;" type="submit"
                                                    name="update">Update</button>
                                                <?php elseif ($del == true) : ?>
                                                <button class="btn btn-lg btn-block btn-danger"
                                                    style="border-radius: 0%;" type="submit"
                                                    name="delete">Delete</button>
                                                <?php else : ?>
                                                <button type="submit" name="add"
                                                    class="btn btn-lg btn-block btn-primary"
                                                    style="border-radius: 0%; background:#0F1035">Add Expense
                                                </button>



                                                <hr>
                                                <?php endif ?>
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
    feather.replace();
    </script>

    <script>
    const mobileScreen = window.matchMedia("(max-width: 990px )");
    $(document).ready(function() {
        $(".dashboard-nav-dropdown-toggle").click(function() {
            $(this).closest(".dashboard-nav-dropdown")
                .toggleClass("show")
                .find(".dashboard-nav-dropdown")
                .removeClass("show");
            $(this).parent()
                .siblings()
                .removeClass("show");
        });
        $(".menu-toggle").click(function() {
            if (mobileScreen.matches) {
                $(".dashboard-nav").toggleClass("mobile-show");
            } else {
                $(".dashboard").toggleClass("dashboard-compact");
            }
        });
    });
    </script>
</body>

</html>