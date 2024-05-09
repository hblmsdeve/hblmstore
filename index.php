<?php

    require_once ('./autoload.php');
    require_once ('./views/includes/header.php');

    $home = new HomeController();

    $page = [
        'home','cart','dashboard','updateProduct','deleteProduct','addProduct','emptycart','show',
        'cancelCart','register','login','checkout','logout','addOrder','products','orders'
    ];

    if(isset($_GET['page'])){
        if(in_array($_GET['page'], $page)){
            $page = $_GET['page'];
            if($page === "dashboard" || $page === "products" || $page === "addProduct" || $page === "deleteProduct" ||
                $page === "orders" || $page === "updateProduct"){
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
                    $admin = new AdminController();
                    $admin->index($page);
                }else{
                    include('views/includes/404.php');
                }
            }else{
                $home->index($page);
            }
        }else{
            include('views/includes/404.php'); 
        }
    }else{
        $home->index("home");
    }



    require_once ('./views/includes/footer.php');
?>
