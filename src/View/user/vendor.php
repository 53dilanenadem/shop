<?php 
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\AuthController;
use Core\FlashMessages\Flash;

(new AuthController())->vendor();
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'Life_header.php';

?>

<section id="contact-us" class="contact-us section  test-center">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<form  method="post" action="">
                                <h2>CONNEXION</h2>
                                    <?= Flash::render() ?>
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label>Nom de l'utilisateur<span>*</span></label>
												<input name="username" type="text" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Mot de passe<span>*</span></label>
												<input name="pwd" type="password" required>
											</div>	
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" name="login" class="btn ">Valider</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>