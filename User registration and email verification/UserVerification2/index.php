<?php require_once 'controllers/authController.php'; 

if(!isset($_SESSION['id'])){
    header('location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 indexx text-white">
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php echo $_SESSION['message']?>
                </div>

                <h3 class="text-white">Welcome, <?php echo $_SESSION['username']?></h3>

                <a href="index.php?logout=1" class="logout text-danger">Logout</a>

            </div>
        </div>
    </div>
</body>
</html>