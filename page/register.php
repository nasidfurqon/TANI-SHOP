<?php
if (isset($_POST['submit'])) {
    $conn = connect();
    // Ambil password dari $_POST, simpan ke variabel $password...
    $password = $_POST['password'];
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Lakukan koneksi database seperti biasa...
    // Buat query seperti biasa...
    // Simpan
    $stmt = $conn->prepare("INSERT INTO user (Name, Email, Password) VALUES(?, ?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['email'], $hashed_password]);
}
?>
<h3 class="m-5 title">Register</h3>
<form action="/index.php?page=register" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 m-5">
    <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="form-group">    
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Daftar" name="submit" class="btn btn-success">
</form>