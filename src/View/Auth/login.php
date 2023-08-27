<?php
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\AuthController;
use Core\FlashMessages\Flash;

(new AuthController())->login();
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
								<h2 class="text-center">CONNEXION</h2>
								<p class="my-3"><?= Flash::render() ?></p>
								<div class="row my-3">
									<div class="col-12 my-3">
										<div class="form-group">
											<label  for="u">Nom de l'utilisateur<span>*</span></label>
											<input id="u"  name="username" type="text" class="form-control"  required>
										</div>
									</div>
									<div class="col-12  my-3">
										<div class="form-group">
											<label>Mot de passe<span>*</span></label>
											<input name="pwd" type="password" class="form-control"  required>
										</div>
									</div>
									<div class="col-12 my-3">
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
</div>