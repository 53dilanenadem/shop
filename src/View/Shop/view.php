<?php 
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'admin_header.php';

use App\Controller\ShopController;
use App\Controller\ShopControllerController;
use App\View\Helpers\DateHelper;
use Core\FlashMessages\Flash;

(new ShopController())->shop();

?>

<main id="main" class="container-fluid my-3">
	<div class="pagetitle">
		<h1> Informations de l'entreprise </h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?=VIEWS . 'Home/admin.php' ?>"> Accueil </a></li>
				<li class="breadcrumb-item active"> L'entreprise </li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section profile">
		<div class="row mb-3">
            
            <?= Flash::render() ?>

            <div class="col-xl-4">

                <div class="card h-100">
                    <div class="card-body pt-4 d-flex flex-column align-items-center">
                        <img src="<?= IMAGES ?>shops-illustration.png" alt="Company Image" class="w-100">
                        <h2 class=""><?= $shops->getName() ?></h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card h-100">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Informations détaillées sur la boutique</h5>

                        <div class="table my-5">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>Raison sociale</th>
                                        <td><?= $shops->getName() ?: 'Non défini' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nom du responsable</th>
                                    </tr>
                                    <tr>
                                        <th>Adresse de localisation</th>
                                        <td><?= $shops->getLocalizationShops() ?: 'Non défini'  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Adresse e-mail</th>
                                        <td><?= $shops->getEmail() ?: 'Non défini'  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Téléphone </th>
                                        <td><?= $shops->getPhoneShop() ?: 'Non défini'  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dernière modification</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once dirname(__DIR__) . DS . 'Elements' . DS . 'admin_footer.php'; ?>