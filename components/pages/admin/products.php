<?php
use api\ProductController;

include 'api/SecurityFunctions.php';
$functions = new \api\SecurityFunctions();

$functions->is_authorised(["admin"]);


$object = new ProductController();
$products = $object->getProducts();

// Check if the delete action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'deleteProduct') {
    // Check if the order ID is provided
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Call the deleteOrder method
        $object->deleteProduct($id);
        // Redirect to the appropriate page after deletion
        exit();
    }
}
?>

<style type="text/css">
    .card {
        min-height: 900px !important;
        padding: 50px
    }
</style>

<div class="container">
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order table</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Id #</th>
                            <th scope="col">name</th>
                            <th scope="col">Description</th>
                            <th scope="col">img_address</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">category id</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $products = $object->getProducts();
                        foreach ($products as $product) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $product['id'] ?></th>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo mb_strimwidth($product['description'], 0, 20, "...")  ?></td>
                            <td><?php echo $product['img_address'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td><?php echo $product['quantity'] ?></td>
                            <td><?php echo $product['category_id'] ?></td>
                            <td>
                                <a href="?content=pages/admin/products&action=deleteProduct&id=<?php echo $product['id'] ?>">
                                    <i aria-hidden="true" class="fa fa-ban"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/index.php?content=pages/admin/edit-product&id=<?php echo $product['id'] ?>">
                                    <i aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                    <a href="./index.php?content=pages/admin/add-product">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary"  type="button">Add new booking</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

