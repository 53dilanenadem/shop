<?php
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

require_once dirname(__DIR__) . DS . 'Elements' . DS . 'admin_header.php';
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'header_product.php';

use App\Controller\ProductController;

(new productController())->Select();

?>

<body>
    
    </style>
    <div class="container-fluid">
        <div class="row">
            <section class="mt-5">
                <h1 class=" text-primary  text-center bg-dark">Liste des produits</h1>
                <a href="<?= VIEWS . 'products/create.php' ?>" class="btn btn-warning mt-5"> Ajouter un produit</a>
                <table class="table table-striped mt-5">
                    <thead class="table-dark  ">
                        <th>ID</th>
                        <th>NOM</th>
                        <th>IMAGE</th>
                        <th>PRIX</th>
                        <th>DESCRIPTION</th>
                        <th>SHOP-ID</th>
                        <th>NUMERO DE L'UTILISATEUR</th>
                        <th>OPTION</th>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>

                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['image'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['shop_id'] ?></td>
                                <td><?= $product['user_id'] ?></td>
                                <td>
                                   <div class="d-flex ">
                                   <a href="<?= VIEWS . 'produits/edite.php' ?>" class="btn btn-warning">
                                        éditer 
                                    </a>

                                    <a href="<?= VIEWS . "produits/delete.php" ?>">
                                        <button class="btn btn-danger  m-1">suppimer</button>
                                    </a>
                                   </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>