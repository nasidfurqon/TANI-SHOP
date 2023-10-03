<?php
// ... proses pengambilan data user data ...
if (isset($_POST["submit"])){
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = ?");
    $stmt->execute([$_POST['email']]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();
    if ($user) {
        // Verifikasi password: (parameter 1 dari input, ke-2 dari database)
        if (password_verify($_POST['password'], $user['Password'])) {
            // Mulai sesi baru, simpan ke $_SESSION['user_id'];
            $_SESSION['UserId'] = $user['id'];
            header('Location: /index.php?page=home');
        } else {
            // Password salah, silakan cek email dan password
            echo "maaf username atau password tidak valid";
        }  
    } else {
        echo "maaf username atau password tidak valid";
    }
}
?>
<h3 class="m-5 title">Login</h3>
<form action="/index.php?page=login" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 m-5">
    <div class="form-group">    
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Masuk" name="submit" class="btn btn-success">
</form>