<?php require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="login.php" method="post" class="form-design login-design">
                <h3 class="text-center">Login</h3>
                    
                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-warning" role="alert">
                     <?php foreach($errors as $error): ?>
                     <li><?php echo $error; ?></li>
                     <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username;   ?>" placeholder="Enter your name or email">
                    </div>
                
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>

                    <div class="form-group">
                    <button type="submit" name="loginbutton" class="btn btn-primary btn-block mt-4">Log In</button>
                    </div>
                    <p class="text-center text-white">Not yet a member? <a href="signup.php">Sign Up</a></p>  
                </form>
            </div>
        </div>
    </div>
</body>
</html>