<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$errors = array();
$success = "";

if(isset($_POST['submit'])){
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $mothersName = $_POST["mothersName"];
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $dateOfBirth = $_POST["dateOfBirth"];
    $courseToLearn = $_POST["courseToLearn"];
    $email = $_POST["email"];

    // Empty field validation
    if(empty($firstName) || empty($lastName) || empty($mothersName) || empty($address) || empty($dateOfBirth) || empty($courseToLearn) || empty($email)) {
        array_push($errors, 'All fields are required');
    }

    // Validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, 'Email not valid');
    }

    if (empty($errors)) {
        // Form submission was successful, you can process the data here
        $success = "Registration successful!";
    } else {
        require_once("db.php");

        $sql = "INSERT INTO users (firstName, lastName, mothersName, address, dateOfBirth, courseToLearn, email) VALUES(?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if ($preparestmt) {
            mysqli_stmt_bind_param($stmt, 'sssssss', $firstName, $lastName, $mothersName, $address, $dateOfBirth, $courseToLearn, $email);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
<section class="h-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="img4.webp" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-Yellow">
                <h3 class="mb-5 text-uppercase">DavTevh Studio Registration Form</h3>
                <form method="post" action="register.php">
                  <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error) : ?>
                            <?php echo $error; ?><br>
                        <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($success)) : ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                  <?php endif; ?>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" name="firstName" placeholder="First name" id="form3Example1m" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1m"></label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" name="lastName" placeholder="Last name" id="form3Example1n" class="form-control form-control-lg" />
                        <label class="form-label" for = "form3Example1n"></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" name="mothersName" placeholder="Mother's name" id="form3Example1m1" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1m1"></label>
                      </div>
                    </div>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="address" placeholder="Address" id="form3Example8" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example8"></label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="dateOfBirth" placeholder="Date of Birth" id="form3Example9" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example9"></label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="courseToLearn" placeholder="Course to Learn" id="form3Example99" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example99"></label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="email" placeholder="Email ID" id="form3Example97" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example97"></label>
                  </div>
                  <div class="d-flex justify-content-end pt-3">
                    <button type="reset" class="btn btn-light btn-lg">Reset all</button>
                    <button type="submit" name="submit" class="btn btn-warning btn-lg ms-2">Submit form</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
