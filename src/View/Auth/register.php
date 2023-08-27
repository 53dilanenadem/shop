<?php
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\AuthController;
use Core\FlashMessages\Flash;

(new AuthController())->register();
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'Life_header.php';

?>
<div class="d-flex justify-content-center  align-items-center mx-auto">
	<section id="contact-us" class="contact-us section  test-center">
		<div class="container">
			<div class="contact-head">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="form-main">
							<form method="post" action="">
								<div class="text-center my-5">
									<h2 class="text-center">INSCRIPTION</h2>
								</div>
								<div class="my-3">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label for="u">Nom de l'utilisateur<span>*</span></label>
												<input id="u" name="username" type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Mot de passe<span>*</span></label>
												<input name="pwd" type="password"class="form-control"  required>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Votre Adresse email<span>*</span></label>
												<input name="email" type="email"class="form-control"  required>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Role<span>*</span></label>
												<input name="role_id" type="numder" class="form-control"  required>
											</div>
										</div>

										<div class=" col-12">
											<div class="form-group button">
												<button type="submit" name="register" class="btn ">Valider</button>
											</div>
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
<div>