<?php

declare(strict_types=1);

namespace App\Controller;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Service\shopsServices;
use Core\Auth\Auth;
use Core\FlashMessages\Flash;

class ShopController

{
    public function index()
	{
        $auth_user = (new Auth())->getAuthUser();
        if(empty($auth_user) || $auth_user->getRole()->getCode() != 'ADM'){
            header('Location: ' . VIEWS . 'Shop/shop.php');
            exit;
        }

        if (isset($_POST['shop'])) {
            
			$shops = (new shopsServices())->shop($_POST);
            if ($shops) {
                Flash::success("Les informations de l'entreprise ont été mis à jour avec succès.");
            }
        }

		$_SESSION['page_title'] = 'Boutique';
        unset($_SESSION['subpage_title']);

        $shops = (new shopsServices())->getShops();

        $GLOBALS['shops'] = $shops;
	}

    /**
     * Index method
     * @return void
     */
    public function shop()
	{
		$_SESSION['page_title'] = 'Boutique';
        unset($_SESSION['subpage_title']);

        $shops = (new shopsServices())->getShops();

        $GLOBALS['shops'] = $shops;
	}  
}