<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
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
        <div class='dashboard-app'>

            <div class='dashboard-content'>
                <div class="container container-fluid card " style="margin-left: 88px;">
                    <div style="position: sticky; top: 0; z-index: 1000;">
                        <h3 class=" mt-4 text-center ">Manage Expenses</h3>
                    </div>
                    <hr>
                    <div class=" row justify-content-center" style="background-color: white;padding-top:4em">
                        <div style="padding-top:2em">
                            <img src="expenseMangerExpenses.gif" width="500px" height="500px" alt="">
                        </div>


                        <div class=" col-md-6">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sr.</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Expense Category</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>

                                <?php $count=1; while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $row['expensedate']; ?></td>
                                    <td><?php echo 'Rs.'.$row['expense']; ?></td>
                                    <td><?php echo $row['expensecategory']; ?></td>
                                    <td class="text-center">
                                        <a href="add_expense.php?edit=<?php echo $row['expense_id']; ?>"
                                            class="btn btn-primary btn-sm" style="border-radius:0%;">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="add_expense.php?delete=<?php echo $row['expense_id']; ?>"
                                            class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a>
                                    </td>
                                </tr>
                                <?php $count++; } ?>
                            </table>
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
</body>

</html>