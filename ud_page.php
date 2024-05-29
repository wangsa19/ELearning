<?php
session_start();
$successMSG = '';
$user_id = $_SESSION['user_id'];
$level = $_SESSION['level'];
$nama = $_SESSION['nama'];
$mhs = $user_id && $level == 'mahasiswa';
if (!isset($mhs)) {
  header('Location: login.php');
  exit;
}
if (isset($_SESSION['success'])) {
  $successMSG = $_SESSION['success'];
}
include 'config.php';
include 'opendb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Document</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="src/output.css" />
</head>

<body class="font-inter">
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
      <li class="mb-1 group">
        <a href="ud_page.php" class="flex items-center py-2 px-4 text-gray-300 rounded-xl hover:bg-gray-950 
        hover:text-gray-100 group-[.active]:bg-gray-800 group-[.active]:text-white 
        group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
          <i class="ri-user-line mr-3 text-lg"></i>
          <span class="text-sm">Upload Document</span>
        </a>
      </li>
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
    <!-- start: navbar -->
    <div class="py-2 px-4 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
      <button type="button" class="text-lg text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
      </button>
      <ul class="flex items-center text-sm ml-4">
        <li class="mr-2">
          <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
        </li>
        <li class="font-medium text-gray-600">/</li>
        <li class="font-medium text-gray-600">Upload Document</li>
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
    <!-- end: navbar -->
    <div class="p-6">
      <div class="grid grid-cols-1 gap-3 mb-6">
        <div class="w-full h-screen">
          <div class="flex items-center">
            <h2 class="font-semibold text-3xl">Upload Document</h2>
          </div>
          <div class="flex justify-center">
            <form action="upload.php" method="post" enctype="multipart/form-data" name="uploadform" class="w-full sm:w-[450px]">
              <div class="p-4 w-full bg-white flex flex-wrap mt-8 rounded-2xl shadow-lg shadow-black/5">
                <div class="w-full mt-0 flex justify-start items-center">
                  <input type="hidden" name="user_id" id="user_id" class="w-full" value="<?= $user_id ?>">
                  <input type="file" name="userfile" id="userfile" class="w-full hidden">
                  <label for="userfile" class="px-4 py-2 rounded-lg border border-slate-900 cursor-pointer mr-2 flex-none text-center">
                    Choose File
                  </label>
                  <span class="font-extralight text-sm sm:text-base text-slate-700 overflow-hidden truncate" id="custom-text">No file chosen, yet.</span>
                  <span class="min-w-[40px] min-h-[40px] bg-slate-100 hover:bg-slate-200 focus:ring focus:ring-slate-800 rounded-full flex 
                  justify-center items-center cursor-pointer ml-auto invisible" id="close-file">
                    <i class="ri-close-large-line"></i>
                  </span>
                </div>

                <button type="submit" name="upload" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white mt-4 w-full shadow-lg">Upload</button>
              </div>
            </form>
          </div>
          <div class="flex flex-wrap w-full mt-8">
            <h3 class="font-medium text-base">Nama: <?= $nama; ?></h3>
            <div class="relative w-full overflow-x-auto rounded-lg flex flex-wrap items-center mt-4">
              <table class="w-full text-sm text-left rtl:text-right rounded-xl text-gray-500">
                <thead class="text-xs text-gray-900 uppercase bg-gray-300">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Name File
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Tipe
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Nilai
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Download
                    </th>
                  </tr>
                </thead>
                <tbody class="text-xs bg-white shadow-2xl shadow-red/5">
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM upload_tugas WHERE user_id = '$user_id'");
                  $no = 1;
                  while ($data = mysqli_fetch_array($query)) :
                  ?>
                    <tr>
                      <td class="px-6 py-4"><?= $no++ ?></td>
                      <td class="px-6 py-4"><?= $data['filename'] ?></td>
                      <td class="px-6 py-4"><?= $data['type'] ?></td>
                      <td class="px-6 py-4"><?= $data['nilai'] ?></td>
                      <td class="px-6 py-4">
                        <a href="<?php echo $data["path"]; ?>" class="font-medium px-3 py-2 bg-sky-200 text-sky-600 rounded-full">Download</a>
                      </td>
                    </tr>
                  <?php endwhile ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- end: Main -->

  <script>
    const inputFile = document.getElementById('userfile');
    const customText = document.getElementById('custom-text');
    const closeFile = document.getElementById('close-file');

    inputFile.addEventListener("change", function() {
      if (inputFile.files.length > 0) {
        closeFile.classList.toggle('invisible');
        customText.textContent = inputFile.files[0].name;
        console.log("Selected file: " + inputFile.files[0].name);
      } else {
        customText.textContent = "No file chosen, yet.";
      }
    });
    closeFile.addEventListener("click", function() {
      customText.textContent = "No file chosen, yet.";
      closeFile.classList.toggle('invisible');
    });
  </script>

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="src/script.js"></script>
</body>

</html>