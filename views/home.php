<?php

    $data1 = new CategoriesController();
    $categories = $data1->getAllCategories();

    if(isset($_POST['cat_id'])){
        $products = new ProductsController();
        $products = $products->getProductsByCategory($_POST['cat_id']);
    }else{
        $data = new ProductsController();
        $products = $data->getAllProducts();
    }

?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-8">
            <div class="row">
                <?php
                    if(count($products) > 0) :   
                ?>
                <?php
                    foreach($products as $product) :                
                ?>
                <div class="col-md-6 mb-2">
                    <div class="card h-100 bg-white rounded p-2">
                        <div class="card-header bg-light">
                            <form id="form" method="POST" action="<?php echo BASE_URL;?>show">
                                <input type="hidden" name="product_id" id="product_id">
                            </form>
                            <h3 class="card-title">
                                <?php echo $product['title']; ?>
                            </h3>
                        </div>
                        <div class="card-img-top">
                            <img src="./public/uploads/<?php echo $product["image"]; ?>" alt="" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php echo $product['short_descr']; ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge badge-danger p-2">
                                <?php echo $product['price']; ?> dh
                            </span>
                            <span class="badge badge-dark p-2">
                                <strike>
                                    <?php echo $product['old_price']; ?> dh
                                </strike>
                            </span>
                            <form method="POST" class="d-flex justify-content-md-end" action="show">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;                
                ?>
                <?php
                    else:
                ?>
                <div class="alert alert-info"> Aucun produits trouvé</div>
                <?php
                    endif;                
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="text-secondary m-3 text-center">
                Catégories
            </h3>
            <ul class="list-group">
                <?php
                    foreach($categories as $category) :                
                ?>
                <li class="list-group-item text-center">
                    <form id="catPro" method="POST" action="<?php echo BASE_URL;?>">
                        <input type="hidden" name="cat_id" id="cat_id">
                    </form>
                    <a onclick="getCatProducts(<?php echo $category['id'];?>)" class="btn btn-link text-secondary" style="text-decoration:none;font-size:20px;cursor:pointer">
                        <?php echo $category['title']; ?>
                        (<?php 
                            $productsByCat = new ProductsController();
                            $productsByCat = $productsByCat->getProductsByCategory($category['id']);
                            echo count($productsByCat);
                        ?>)
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>