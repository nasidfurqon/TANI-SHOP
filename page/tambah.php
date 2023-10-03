<?php
if (isset($_POST['submit'])) {
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO product (Name, Description, Price, Stock) VALUES(?, ?, ?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['deskripsi'], $_POST['harga'],$_POST['stok']]);

    $id = $conn->lastInsertId();
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $filename = "image/$id.$ext";
    move_uploaded_file($_FILES['gambar']['tmp_name'], $filename);
    $stmt = $conn->prepare("UPDATE product SET image = ? WHERE id = ?");
    $stmt->execute([$filename, $id]);
}
?>
<h3 class="m-5 title">Add Your Product</h3>
<form action="/index.php?page=tambah" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 m-5">
    <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="form-group">    
        <label for="Decription">Description</label>
        <input type="text" name="deskripsi" id="deskripsi" class="form-control">
    </div>
    <div class="form-group">
        <label for="Price">Price</label>
        <input type="number" name="harga" id="harga" class="form-control">
    </div>
    <div class="form-group">
        <label for="stok">Stock</label>
        <input type="number" name="stok" id="stok" class="form-control">
    </div>
    <div class="form-group">
        <label for="gambar">Image</label>
        <input type="file" name="gambar" id="gambar" accept=".png, .jpg, .jpeg" class="form-control">
    </div>
    <input type="submit" value="submit" name="submit" class="btn btn-success">
</form>