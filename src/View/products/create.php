
<?php 
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

require_once dirname(__DIR__) . DS . 'Elements' . DS . 'admin_header.php';
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'header_product.php';



use App\Controller\ProductController;

(new productController())->Add();

?>
<body>
    <div class="container mt-5">
        <div class="cil-ml-12">
            <h1 class="text-success">Création d'un produit</h1>
            <div class="col-12">
                <form action="" method="POST">
                    <div class="from-group mt-2">
                        <label for="name" class="mt-3">NOM</label>
                        <input type="text" id ="name" name="name" class="form-control">
                    </div>
                    <div class="from-group mt-2">
                        <label for="image">IMAGE</label>
                        <input type="file" multiple="multiple" id ="image" name="image" class="form-control">
                    </div>
                    <div class="from-group mt-2">
                        <label for="price">PRIX</label>
                        <input type="text" id ="price" name="price" class="form-control">
                    </div>
                    <div class="from-group mt-2">
                        <label for="description">DESCRIPTION</label>
                        <input type="text" id ="description" name="description" class="form-control">
                    </div>
                    <div class="from-group mt-2">
                        <label for="shop_id">IDENTIFIANT DE LA BOUTIQUE</label>
                        <input type="text" id ="shop_id" name="shop_id" class="form-control">
                    </div>
                    <div class="from-group mt-2">
                        <label for="user_id">IDENTIFIANT DE L'UTILISATEUR</label>
                        <input type="text" id ="user_id" name="user_id" class="form-control">
                    </div>
                    <div class="from-group mt-4">
                        <button type="submit" class="btn btn-dark">Valider</button>
                        <a href="<?= VIEWS .'products/index.php'?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
</div>
<?php
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'admin_header.php';

?>