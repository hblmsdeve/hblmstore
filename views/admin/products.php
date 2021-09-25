<?php

    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
        $data = new ProductsController();
        $products = $data->getAllProducts();
    }else{
        Redirect::to("home");
    }

?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-10 mx-auto">
            <div class="form-group">
                <a href="<?php echo BASE_URL; ?>addProduct" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
            <div class="card bg-light p-3">
                <table class="table table-hover table-inverse">
                <h3 class="font-weight-bold">Commandes</h3>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) :?>
                        <tr>
                            <td scope="row"><?php echo $product["title"]; ?></td>
                            <td><?php echo $product["price"]; ?></td>
                            <td><?php echo $product["quantity"]; ?></td>
                            <td><?php echo substr($product["description"], 0, 100); ?></td>
                            <td><img width="50" height="50" src="./public/uploads/<?php echo $product["image"]; ?>" alt="" class="img-fluid"></td>
                            <td class="d-flex flex-row">
                                <form method="POST" class="mr-1" action="updateProduct">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                </form>
                                <form method="POST" class="mr-1" action="deleteProduct">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>