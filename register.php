<?php
session_start();
include 'config.php';
include 'opendb.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  $sql = "INSERT INTO users (nama, email, password, level) VALUES ('$nama', '$email', '$password', '$level')";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    header("Location: login.php");
  } else {
    $errorMessage = 'Failed to register try again';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-gradient-to-tr from-blue-500 to-pink-500 font-inter">
  <div class="container mx-auto px-4 sm:px-8 md:px-12 lg:px-16 xl:px-20">
    <div class="flex flex-col items-center justify-center h-screen w-full">
      <div class="w-full sm:w-[400px] h-[470px] bg-white rounded-2xl shadow-2xl">
        <div class="flex flex-col justify-center items-center">
          <h2 class="text-center font-semibold text-3xl w-full mt-12 mb-3">Register</h2>
          <form action="" method="post" class="w-full px-8 mb-3 relative">
            <?php if ($errorMessage != '') { ?>
              <div class="w-full bg-red-100 px-4 py-2 rounded-lg text-red-600 font-medium mb-3 
              flex justify-end items-center relative" id="error-alert">
                <span class="me-auto">
                  <!-- <?php echo $errorMessage ?> -->
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
              <input type="text" name="nama" class="px-4 py-[10px] border border-slate-200 bg-white
               rounded-lg shadow-md w-full" placeholder="Nama" required>
            </div>
            <div class="mb-3">
              <input type="text" name="email" class="px-4 py-[10px] border border-slate-200 bg-white
               rounded-lg shadow-md w-full" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="px-4 py-[10px] border border-slate-200
               bg-white rounded-lg shadow-md w-full" placeholder="Password" required>
            </div>
            <div class="mb-3">
              <select name="level" id="level" class="px-4 py-[10px] border border-slate-200 bg-white 
              rounded-md shadow-md w-full text-slate-400 appearance-none">
                <option value="">Role</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
              </select>
              <svg class="absolute top-[215px] right-11 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 
                0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
              </svg>
            </div>
            <button type="submit" name="register" class="w-full px-4 py-[10px] bg-blue-600 text-white 
            rounded-lg shadow-sm hover:bg-blue-700 focus:ring focus:ring-blue-200">
              <span class="inline-block">Register</span>
            </button>

          </form>
          <p class="font-medium text-base">Don't have an account?
            <span class="text-blue-700 hover:underline">
              <a href="login.php">Login</a>
            </span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // start: Register
    const closeBtn = document.querySelector("#closeAlert");
    const alertError = document.querySelector("#error-alert")
    if (closeBtn) {
      closeBtn.addEventListener("click", function() {
        alertError.classList.add("hidden")
      })
    }
    // end: Register
  </script>

</body>

</html>