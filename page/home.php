<?php
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM product");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$products = $stmt->fetchAll();
?>

<div class="Header">
    <!-- <img class="home-rice" src="/image/ricefield.png" alt="ricefield"> -->
    <p class="text1">Supplier of agricultural commodities worldwide</p>
    <p class="text2">Helping farmers to increase the yield of agricultural commodities in Pati Regency – Indonesia</p>
    <a type="button" href="/index.php?page=tambah" class="btn btn-success">Add Your Product</a>
</div>

<div class="product">
    <p class="title">Our Product</p>
    <div class="row-product">
        <?php foreach ($products as $product) : ?>
            <div class="col-product">
                <a href="/index.php?page=detail&id=<?php echo $product['id'] ?>">
                    <img class="gambar1" src="<?php echo $product['image'] ?>" alt=" ">
                    <p><?php echo $product['Name'] ?></p>
                    <p class="Harga">Rp <?php echo number_format($product['Price'], 3); ?> / 1 KG</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>