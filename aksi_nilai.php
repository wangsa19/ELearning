<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'dosen') {
  header("Location: login.php");
  exit;
}

include 'config.php';
include 'opendb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $mahasiswa_id = $_POST['mahasiswa_id'];
  $nilai = $_POST['nilai'];
  $dosen_id = $_SESSION['user_id'];

  $sql = "UPDATE upload_tugas SET nilai = '$nilai' WHERE id = '$mahasiswa_id'";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    header("Location: nilai_page.php");
  } else {
    echo "Gagal Beri Nilai";
  }
}
