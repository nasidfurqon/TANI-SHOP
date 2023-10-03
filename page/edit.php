<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
if (isset($_POST['submit'])) {
    $conn = connect();
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $filename = "image/$id.$ext";
    unlink($filename);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $filename);
    $stmt2 = $conn->prepare("UPDATE product SET Name = ?, Description = ?, Price = ?, Stock = ?, image = ? WHERE id = $id");
    $stmt2->execute([$_POST['nama'], $_POST['deskripsi'], $_POST['harga'], $_POST['stok'], $filename]); 
}
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$product = $stmt->fetch();
?>
<h3 class="m-5 title">Silahkan Edit Produk dengan id <?php echo "$id" ?> ini Dengan Mengisi Form Dibawah</h3>
<form action="/index.php?page=edit&id=<?php echo $product['id'] ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 m-5">
    <div class="form-group">
        <label for="Nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo $product['Name'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="Deskripsi">Deskripsi</label>
        <input type="text" name="deskripsi" id="deskripsi" value="<?php echo $product['Description'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="Harga">Harga</label>
        <input type="number" name="harga" id="harga" value="<?php echo $product['Price'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" value="<?php echo $product['Stock'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" name="gambar" id="gambar" value="<?php echo $product['image'] ?>" accept=".png, .jpg, .jpeg" class="form-control">
    </div>
    <input type="submit" value="submit" name="submit" class="btn btn-primary">
</form>