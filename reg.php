<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reg Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class='container'>
    <?php
    if(isset($_POST['submit'])){
        $Fullname = $_POST['Fullname'];
        $Email = $_POST['Email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Empty field validation
        $errors = array();
        if(empty($Fullname) OR empty($Email) OR empty($password) OR empty($confirmpassword)) {
            array_push($errors, 'All fields are required');
        }

        // Validate email
        if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, 'Email not valid');
        }

        // Password validation
        if(strlen($password) < 8) {
            array_push($errors, 'Password should be at least 8 characters long');
        }

        if($password != $confirmpassword) {
            array_push($errors, 'Passwords do not match');
        }

        if (count($errors) > 0) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            echo '</div>'; // Close the error div
        }
        else{
            require_once("db.php");
        
            $sql = "INSERT INTO users (Fullname, Email, password) VALUES(?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt,$sql);
            if ($preparestmt) {
              mysqli_stmt_bind_param($stmt,'sss', $Fullname, $Email, $passwordHash );
              mysqli_stmt_execute($stmt);
              echo"<div class='alert alert-success'>You are registered Succcessfully.</div>";
            }else{
              die("something went wrong");
            }
          }
    }
    ?>

    <form action="reg.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"></label>
            <input type="text" class="form-control" name="Fullname" placeholder="Fullname" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"></label>
            <input type="email" class="form-control" name="Email" placeholder="Email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"></label>
            <input type="password" class="form-control" name="password" placeholder="Password" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"></label>
            <input type="password" name= "confirmpassword" placeholder="confirm Password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>
</html>
