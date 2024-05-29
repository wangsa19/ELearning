<?php
session_start();
$uploadDir = 'file/';
if (isset($_POST['upload'])) {
  $user_id = $_SESSION['user_id'];
  $fileName = $_FILES['userfile']['name'];
  $tmpName = $_FILES['userfile']['tmp_name'];
  $fileType = $_FILES['userfile']['type'];
  $filePath = $uploadDir . $fileName;
  $result = move_uploaded_file($tmpName, $filePath);
  include 'config.php';
  include 'opendb.php';
  $fileName = addslashes($fileName);
  $filePath = addslashes($filePath);
  $query = "INSERT INTO upload_tugas (user_id, filename, type, path, nilai) VALUES ('$user_id', '$fileName', '$fileType', '$filePath', 0)";
  mysqli_query($conn, $query);
  include 'closedb.php';
  if ($result) {
    $_SESSION['success'] = 'Berhasil menambah data';
    header("Location: ud_page.php");
    exit;
  } else {
    echo "Gagal Upload";
  }
} else {
  header("Location: ud_page.php");
}
