<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$product = $stmt->fetch();
if (isset($_POST['submit'])) {  
    $conn = connect();  
    $stmt2 = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt2->execute([$id]);
    header('Location: /index.php');
}
if (isset($_GET['action']) && $_GET['action']=='addToCart') {
    //cek apakah produk sudah ada di keranjang
    //jika sudah ada, maka tambahkan qty
    //jika belum, masukkan keranjang
    $ditemukan = false;
    foreach ($_SESSION['cart'] as $key => $cart) {
        if($cart['id']==$product['id']) {
            $cart['qty']++;
            $_SESSION['cart'][$key]=$cart;
            $ditemukan = true;
        }
    }
    if ($ditemukan == false) {
        $_SESSION['cart'][] = [
            'id' => $_GET['id'],
            'qty' => 1,
            'name' => $product['Name'],
            'description' => $product['Description'],
            'price' => $product['Price']
        ];
    }
}
?>

<div class="detail">
    <img class="image" src="<?php echo $product['image'] ?>" alt=" ">
    <div class="mid-content">
        <h4 class="name"><?php echo $product['Name'] ?></h4>
        <div class="deskripsi">
            <h4 class="Harga">Rp <?php echo number_format($product['Price'], 3); ?></h4>
            <p class="name"><?php echo $product['Description'] ?></p>
            <div class="edit flex flex-row flex-wrap gap-2">
                <a href="/index.php?page=edit&id=<?php echo $product['id'] ?>" class="btn btn-primary">Edit</a>
                <form action="/index.php?page=detail&id=<?php echo $product['id'] ?>" method="post" class="d-flex flex-column gap-1">
                    <input type="submit" value="Hapus" name="submit" class="btn btn-danger" style="width:150px">
                </form>
            </div>
        </div>
    </div>
    <div class="right-content">
        <p>Stok: <?php echo $product['Stock'] ?></p>
        <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>&action=addToCart" class="btn btn-outline-success">+Keranjang</a>
        <button type="button" class="btn btn-success">Beli</button>
    </div>
</div>