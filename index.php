<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
include_once "koneksi.php";
session_start();  
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  unset($_SESSION['UserId']);
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh</title>
  <link rel="stylesheet" href="style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/index.php">Taniku</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Tomat" aria-label="City">
        </div>
        <button class="btn btn-outline-success" type="submit">Search</button>
        <div class="left-nav">
          <?php if (isset($_SESSION['UserId'])) : ?>
            <a href="/index.php?page=keranjang" style="text-decoration: none;">
              <img src="image/keranjang.png" alt="keranjang">
            </a>
            <a href="/index.php?action=logout" type="button" class="btn btn-outline-success">Keluar</a>
          <?php else : ?>
            <a href="/index.php" type="button" class="btn btn-outline-success">Masuk</abs>
              <a href="/index.php?page=register" type="button" class="btn btn-outline-success m-2">Daftar</a>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
  <!-- end of navbar -->
  <?php
  switch ($page) {
    case 'detail':
      include "page/detail.php";
      break;
    case 'tambah':
      include "page/tambah.php";
      break;
    case 'edit':
      include "page/edit.php";
      break;
    case 'keranjang':
      include "page/keranjang.php";
      break;
    case 'register':
      include "page/register.php";
      break;
    case 'login':
      include "page/login.php";
      break;
    case 'home':
      include "page/home.php";
      break;
    default:
      if (isset($_SESSION['UserId'])) {
        include "page/home.php";
      } else {
        include "page/login.php";
      }
      break;
  }
  ?>
  <!-- end of home display -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
