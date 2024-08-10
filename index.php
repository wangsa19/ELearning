<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include 'config.php';
include 'opendb.php';
$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];
$nama = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Final Project WPW</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="src/output.css">
</head>

<body>
  <!-- start: Sidebar -->
  <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
      <img src="https://upload.wikimedia.org/wikipedia/id/4/44/Logo_PENS.png" alt="" class="w-10 h-10 
      rounded object-cover" />
      <span class="text-lg font-bold text-white ml-3">ELearning</span>
    </a>
    <ul class="mt-4">
      <li class="mb-1 group active">
        <a href="index.php" class="flex items-center py-2 px-4 text-gray-300 rounded-xl hover:bg-gray-950 
        hover:text-gray-100 group-[.active]:bg-gray-800 group-[.active]:text-white 
        group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
          <i class="ri-home-2-line mr-3 text-lg"></i>
          <span class="text-sm">Dashboard</span>
        </a>
      </li>
      <?php if ($level == 'mahasiswa') : ?>
        <li class="mb-1 group">
          <a href="ud_page.php" class="flex items-center py-2 px-4 text-gray-300 rounded-xl hover:bg-gray-950 
          hover:text-gray-100 group-[.active]:bg-gray-800 group-[.active]:text-white 
          group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
            <i class="ri-file-line mr-3 text-lg"></i>
            <span class="text-sm">Upload and Download</span>
          </a>
        </li>
      <?php elseif ($level == 'dosen') : ?>
        <li class="mb-1 group">
          <a href="nilai_page.php" class="flex items-center py-2 px-4 text-gray-300 rounded-xl hover:bg-gray-950 
            hover:text-gray-100 group-[.active]:bg-gray-800 group-[.active]:text-white 
            group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
            <i class="ri-file-line mr-3 text-lg"></i>
            <span class="text-sm">Nilai</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if (isset($user_id)) : ?>
        <li class="mb-1 group">
          <a href="logout.php" class="flex items-center py-2 px-4 text-gray-300 rounded-xl hover:bg-gray-950 
          hover:text-gray-100 group-[.active]:bg-gray-800 group-[.active]:text-white 
          group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
            <i class="ri-logout-box-line mr-3 text-lg"></i>
            <span class="text-sm">Logout</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
  <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
  <!-- end: Sidebar -->

  <!-- start: Main -->
  <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
    <div class="py-2 px-4 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
      <button type="button" class="text-lg text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
      </button>
      <ul class="flex items-center text-sm ml-4">
        <li class="mr-2">
          <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
        </li>
        <li class="font-mediumtext-gray-600">/</li>
      </ul>
      <ul class="ml-auto flex items-center">
        <li class="dropdown ml-3">
          <button type="button" class="dropdown-toggle text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
            <i class="ri-user-line text-lg px-2 py-2"></i>
          </button>
          <ul class="dropdown-menu z-30 hidden py-1.5 rounded-xl bg-white border border-gray-100 w-full max-w-[140px]">
            <li>
              <form action="logout.php" method="post" class="w-full text-gray-600 hover:text-blue-500 hover:bg-gray-50">
                <button type="submit" name="logout" class="flex items-center text-[13px] py-1.5 px-4 ">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="p-6">
      <div class="grid grid-cols-1 gap-3 mb-6">
        <div class=" bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
          <div class="flex flex-wrap">
            <div class="w-full mb-4">
              <div class="text-2xl font-medium mb-1">Selamat Datang
                <span class="font-semibold">
                  <?php if (isset($_SESSION['user_id'])) { ?>
                    <?php echo $nama; ?>
                  <?php } ?>
                </span>, di Halaman
                <?php if ($level == 'mahasiswa') : ?>
                  Mahasiswa
                <?php elseif ($level == 'dosen') : ?>
                  Dosen
                <?php endif ?>
              </div>
            </div>
            <?php if ($level == 'mahasiswa') : ?>
              <div class="w-full flex items-center justify-start">
                <a href="ud_page.php" class="bg-sky-600 px-5 py-2 rounded-lg text-white">Upload Download Page</a>
              </div>
            <?php elseif ($level == 'dosen') : ?>
              <div class="w-full flex items-center justify-start">
                <a href="nilai_page.php" class="bg-sky-600 px-5 py-2 rounded-lg text-white">Nilai Page</a>
              </div>
            <?php endif ?>
          </div>
        </div>
        <?php
        $mhs_upload_tugas = mysqli_query($conn, "SELECT COUNT(*) AS count_ut FROM users u JOIN upload_tugas ut ON u.id = ut.user_id WHERE level = 'mahasiswa'");
        $r_mhs_upload_tugas = mysqli_fetch_assoc($mhs_upload_tugas);
        $count = $r_mhs_upload_tugas['count_ut'];
        $q_count_mhs = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE level = 'mahasiswa'");
        $count_mhs = mysqli_fetch_assoc($q_count_mhs);
        $total_mhs = $count_mhs['total'];
        $result = $count / $total_mhs * 100;
        ?>
        <div class="card bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
          <div class="flex gap-3 justify-start items-center mb-6">
            <div class="flex items-center flex-wrap">
              <div class="text-2xl font-semibold mb-1 w-full"><?= $count ?></div>
              <div class="text-sm font-medium text-gray-400 ml-2">Banyak Mahasiswa Upload Document</div>
            </div>
            <div class="flex items-center flex-wrap">
              <div class="text-2xl font-semibold mb-1 w-full"><?= $total_mhs ?></div>
              <div class="text-sm font-medium text-gray-400 ml-2">Total Seluruh Mahasiswa</div>
            </div>
            <div class="dropdown ml-auto">
              <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600">
                <i class="ri-more-fill"></i>
              </button>
              <ul class="dropdown-menu z-30 hidden py-1.5 rounded-xl bg-white border border-gray-100 w-full max-w-[140px]">
                <li>
                  <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                </li>
                <li>
                  <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Setting</a>
                </li>
                <li>
                  <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-full bg-gray-100 rounded-full h-4">
              <div class="h-full bg-blue-500 rounded-full p-1 w-[<?= $result ?>%]">
                <div class="w-2 h-2 rounded-full bg-white ml-auto"></div>
              </div>
            </div>
            <span class="text-sm font-medium text-gray-600 ml-4"><?= $result ?>%</span>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- </div> -->
  </main>
  <!-- end: Main -->

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="src/script.js"></script>
</body>

</html>