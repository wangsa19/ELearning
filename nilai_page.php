<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'dosen') {
  header("Location: login.php");
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
  <title>Nilai Page - Dosen</title>
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
        <li class="font-medium text-gray-600">Nilai Page</li>
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
    <div class="p-6 relative">
      <div class="text-2xl font-medium mb-4">Nilai Page</div>
      <div class="mb-6">
        <button class="tab_btn active-tab">Belum dinilai</button>
        <button class="tab_btn">Sudah dinilai</button>
      </div>
      <div class="content active relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 mb-6">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM users u INNER JOIN upload_tugas ut ON u.id = ut.user_id WHERE u.level = 'mahasiswa' AND ut.nilai = 0");
        if ($query && mysqli_num_rows($query) > 0) :
          $no = 1;
          while ($data = mysqli_fetch_array($query)) :
            $no++;
        ?>
            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
              <div class="flex justify-between mb-6">
                <div class="overflow-hidden h-[60px]">
                  <div class="text-xl font-semibold mb-1"><?= $data['nama']; ?></div>
                  <div class="text-sm font-medium text-gray-400">Mahasiswa</div>
                </div>
              </div>
              <div class="w-full mb-4">
                <div class="flex flex-wrap items-center justify-start">
                  <p class="font-medium text-base">File: </p>
                  <a href="<?= $data['path'] ?>" class="ml-auto cursor-pointer font-medium bg-blue-200 text-blue-500 flex justify-center items-center rounded-full px-4 py-1 hover:underline">Download</a>
                </div>
              </div>
              <div class="w-full">
                <input type="checkbox" id="nilai-modal<?= $no; ?>" class="peer fixed appearance-auto opacity-0">
                <label for="nilai-modal<?= $no; ?>" class="ml-auto cursor-pointer font-medium text-white bg-blue-600 flex justify-center items-center rounded-lg px-5 py-2">Beri Nilai</label>
                <label for="nilai-modal<?= $no; ?>" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain 
                bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                  <label class="bg-gray-100 rounded-2xl shadow-md w-[92%] sm:w-1/2 md:w-2/3 lg:w-[400px] flex overflow-hidden overscroll-contain">
                    <div class="flex flex-col p-4 *:text-sm w-full">
                      <div class="mb-3 flex justify-end items-center sticky">
                        <h2 class="font-semibold text-2xl text-black">Form Beri Nilai</h2>
                        <label for="nilai-modal<?= $no; ?>" class="ms-auto bg-white rounded-full min-w-[40px] h-[40px] flex justify-center items-center cursor-pointer group-checked:visible">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                          </svg>
                        </label>
                      </div>
                      <form action="aksi_nilai.php" method="post">
                        <label for="nilai" class="font-semibold">Nilai</label>
                        <div class="mt-3 mb-3">
                          <input type="hidden" name="mahasiswa_id" value="<?= $data['id'] ?>">
                          <input type="number" name="nilai" id="nilai" class="rounded-lg shadow-xl bg-white w-full focus:border-none px-4 py-4" placeholder="Masukkan Nilai" required>
                        </div>
                        <div class="flex justify-end">
                          <button type="submit" class="text-sm w-full px-10 py-[10px] rounded-lg bg-blue-500 hover:bg-sky-600 focus:ring-2 focus:ring-gray-300 text-white mt-3" name="addData">Submit</button>
                        </div>
                        <div class="mb-3 rounded-lg shadow-xl p-1 w-full">
                        </div>
                      </form>
                      <div class="mb-0 rounded-lg shadow-xl p-1 w-full">
                      </div>
                    </div>
                  </label>
                </label>
              </div>
            </div>
          <?php endwhile ?>
        <?php else : ?>
          <div class="absolute top-0 w-full bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-center items-center">
              <div>
                <div class="text-xl font-semibold mb-1">Data Kosong</div>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>
      <div class="content relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 mb-6">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM users u INNER JOIN upload_tugas ut ON u.id = ut.user_id WHERE u.level = 'mahasiswa' AND ut.nilai > 0");
        $no = 1;
        if ($query && mysqli_num_rows($query) > 0) :
          while ($data = mysqli_fetch_array($query)) :
            $no++;
        ?>
            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
              <div class="flex justify-between mb-6">
                <div class="overflow-hidden h-[60px]">
                  <div class="text-xl font-semibold mb-1 truncate"><?= $data['nama']; ?></div>
                  <div class="text-sm font-medium text-gray-400">Mahasiswa</div>
                </div>
              </div>
              <div class="w-full mb-4">
                <div class="flex flex-wrap items-center justify-start">
                  <p class="font-medium text-base">File: </p>
                  <a href="<?= $data['path'] ?>" class="ml-auto cursor-pointer font-medium bg-blue-200 text-blue-500 flex justify-center items-center rounded-full px-4 py-1 hover:underline">Download</a>
                </div>
              </div>
              <div class="w-full mb-4">
                <div class="flex flex-wrap items-center justify-start">
                  <p class="font-medium text-base">Nilai: </p>
                  <p class="ml-auto"><?= $data['nilai'] ?></p>
                </div>
              </div>
              <div class="w-full">
                <input type="checkbox" id="snilai-modal<?= $no; ?>" class="peer fixed appearance-auto opacity-0">
                <label for="snilai-modal<?= $no; ?>" class="ml-auto cursor-pointer font-medium text-white bg-blue-600 flex justify-center items-center rounded-lg px-5 py-2">Update Nilai</label>
                <label for="snilai-modal<?= $no; ?>" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain 
                bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                  <label class="bg-gray-100 rounded-2xl shadow-md w-[92%] sm:w-1/2 md:w-2/3 lg:w-[400px] flex overflow-hidden overscroll-contain">
                    <div class="flex flex-col p-4 *:text-sm w-full">
                      <div class="mb-3 flex justify-end items-center sticky">
                        <h2 class="font-semibold text-2xl text-black">Form Update Nilai</h2>
                        <label for="snilai-modal<?= $no; ?>" class="ms-auto bg-white rounded-full min-w-[40px] h-[40px] flex justify-center items-center cursor-pointer group-checked:visible">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                          </svg>
                        </label>
                      </div>
                      <form action="aksi_nilai.php" method="post">
                        <label for="nilai" class="font-semibold">Nilai</label>
                        <div class="mt-3 mb-3">
                          <input type="hidden" name="mahasiswa_id" value="<?= $data['id'] ?>">
                          <input type="number" name="nilai" id="nilai" class="rounded-lg shadow-xl bg-white w-full focus:border-none px-4 py-4" placeholder="Masukkan Nilai" required>
                        </div>
                        <div class="flex justify-end">
                          <button type="submit" class="text-sm w-full px-10 py-[10px] rounded-lg bg-blue-500 hover:bg-sky-600 focus:ring-2 focus:ring-gray-300 text-white mt-3" name="addData">Submit</button>
                        </div>
                        <div class="mb-3 rounded-lg shadow-xl p-1 w-full">
                        </div>
                      </form>
                      <div class="mb-0 rounded-lg shadow-xl p-1 w-full">
                      </div>
                    </div>
                  </label>
                </label>
              </div>
            </div>
          <?php endwhile ?>
        <?php else : ?>
          <div class="absolute top-0 w-full bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-center items-center">
              <div>
                <div class="text-xl font-semibold mb-1">Data Kosong</div>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>
    </div>
  </main>
  <!-- end: Main -->

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="src/script.js"></script>
  <script>
    const tabs = document.querySelectorAll('.tab_btn');
    const all_content = document.querySelectorAll('.content');

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => {
        tabs.forEach(tab => {
          tab.classList.remove('active-tab');
        })
        tab.classList.add('active-tab');

        all_content.forEach(content => {
          content.classList.remove('active');
        });
        all_content[index].classList.add('active');
      })
    })
  </script>
</body>

</html>