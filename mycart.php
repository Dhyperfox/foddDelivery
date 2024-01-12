<?php
$page_title = 'My Cart';
include "head.php";
include "db_config.php";
// Check the session variable for products in cart
$mycart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($mycart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $items = implode(',', array_fill(0, count($mycart), '?'));
    $stmt = $db_pdo->prepare('SELECT * FROM foods WHERE food_id IN (' . $items . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($mycart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$mycart[$product['food_id']];
    }
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
}
?>


<div class="container rounded my-5 p-4 bg-white">

    <h1>Shopping Cart</h1>
    <form action="mycart.php" method="post">
        <table class="table rounded shadow p-2">
            <thead class="thead-dark">
                <tr>
                    <td scope="col" colspan="2">Product</td>
                    <td scope="col">Price</td>
                    <td scope="col">Quantity</td>
                    <td scope="col">Total</td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['food_id']?>">
                            <img src="<?=$product['img']?>" width="50" height="50" alt="<?=$product['food_name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="foods.php?cat=<?=$product['category_id']?>&fid=<?=$product['food_id']?>"><?=$product['food_name']?></a>
                        <br>
                    </td>
                    <td class="price">RSD <?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['food_id']?>" value="<?=$mycart[$product['food_id']]?>" min="1" placeholder="Quantity" required>
                    </td>
                    <td class="price">RSD <?=$product['price'] * $mycart[$product['food_id']]?></td>
                    <td>
                        <a href="mycart.php?remove=<?=$product['food_id']?>" class="remove"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">RSD <?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>
<? include "footer.php"; ?>