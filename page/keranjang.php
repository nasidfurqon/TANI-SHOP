<?php
$products = [];
// unset($_SESSION['cart']);
//Ambil dari database berdasarkan $_SESSION['cart'][0]['id']
//$products[] = $product;
if (isset($_GET['action']) && $_GET['action'] == 'checkout') {
    // simpan ke database
    $today = date("Y-m-d");
    $query = "INSERT INTO transaction(date, UserId) VALUES (?, ?);";
    $conn = connect();
    $stmt = $conn->prepare($query);
    $stmt->execute([$today, $_SESSION['UserId']]);

    //simpan transaction_product
    $id = $conn->lastInsertId();
    foreach ($_SESSION['cart'] as $cart) {
        $query = "INSERT INTO transaction_product(transaction_id, product_id, qty, price) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id, $cart['id'], $cart['qty'], $cart['price']]);
    }
    //
    $id = $conn->lastInsertId();
    //hapus session['cart']
    $_SESSION['cart'] = [];
}

?>

<table class="table table-hover ">
    <thead>
        <tr class="table-success">
            <th scope="col">Transaction Id</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $cart) : ?>
            <tr>
                <th scope="row"><?php echo $cart['id'] ?></th>
                <td><?php echo $cart['name'] ?></td>
                <td><?php echo $cart['qty'] ?></td>
                <td><?php echo $cart['price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/index.php?page=keranjang&action=checkout" style="float:right; margin-right: 130px;" class="btn btn-outline-danger">Check Out</a>