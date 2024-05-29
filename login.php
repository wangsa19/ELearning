<?php
session_start();
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'config.php';
  include 'opendb.php';
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (isset($sql)) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['level'] = $row['level'];
      $_SESSION['nama'] = $row['nama'];
      header('Location: index.php');
      exit();
    } else {
      $errorMessage = 'Incorrect Email or Password';
    }
  } else {
    $errorMessage = 'User not found with that email';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-gradient-to-tr from-blue-500 to-pink-500 font-inter">
  <div class="container mx-auto px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">
    <div class="flex flex-col items-center justify-center h-screen w-full">
      <div class="w-full sm:w-[400px] h-[350px] bg-white rounded-2xl shadow-2xl">
        <div class="flex flex-col justify-center items-center">
          <h2 class="text-center font-semibold text-3xl w-full mt-12 mb-3">Login</h2>
          <form action="" method="post" class="w-full px-8 mb-3">
            <?php if ($errorMessage != '') { ?>
              <div class="w-full bg-red-100 px-4 py-2 rounded-lg text-red-600 font-medium mb-3 
              flex justify-end items-center relative" id="error-alert">
                <span class="me-auto">
                  <?php echo $errorMessage ?>
                </span>
                <button type="button" class="focus:ring focus:ring-red-200 absolute cursor-pointer
                 rounded-sm py-1 px-2 right-1" id="closeAlert">
                  <i class="ri-close-large-line "></i>
                </button>
              </div>
            <?php } else { ?>
              <div class="mb-6"></div>
            <?php } ?>
            <div class="mb-3">
              <input type="email" name="email" class="px-4 py-[10px] border border-slate-200 bg-white
               rounded-lg shadow-md w-full" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="px-4 py-[10px] border border-slate-200
               bg-white rounded-lg shadow-md w-full" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="w-full px-4 py-[10px] bg-blue-600 text-white 
            rounded-lg shadow-sm hover:bg-blue-700 focus:ring focus:ring-blue-200">
              <span class="inline-block">Login</span>
            </button>

          </form>
          <p class="font-medium text-base">Don't have an account?
            <span class="text-blue-700 hover:underline">
              <a href="register.php">Register</a>
            </span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // start: login
    const closeBtn = document.querySelector("#closeAlert");
    const alertError = document.querySelector("#error-alert")
    if (closeBtn) {
      closeBtn.addEventListener("click", function() {
        alertError.classList.add("hidden")
      })
    }
    // end: login
  </script>

</body>

</html>