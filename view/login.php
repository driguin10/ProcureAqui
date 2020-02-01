



<?php
include_once("cabecalho-principal.php");
?>



<body>
   <link href="view/css/stilo-login.css" rel="stylesheet" media="all">
   <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">LOGIN</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">REGISTRAR</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form  data-toggle="validator" class="login-form" id="login-form" action="logar" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control login-email" placeholder="Email" value="" autocomplete="off" required>
									</div>
									<div class="form-group">
										<input type="password" name="senha" id="senha" tabindex="2" class="form-control login-senha" data-minlength="6" placeholder="Senha" autocomplete="off" required>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" tabindex="3" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Entrar">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover" tabindex="5" class="forgot-password">Esqueceu a senha?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form data-toggle="validator" class="register-form" id="register-form" method="POST"   role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="nome" id="username" tabindex="1" class="form-control register-nome" placeholder="Nome" value="" autocomplete="off"required >
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="2" class="form-control register-email" placeholder="Email" value="" autocomplete="off" required data-error="Este Email não é válido!!">
										<div class="help-block with-errors"></div>
									</div>
									  <div class="form-group">									 
									    <div class="form-inline row">
									      <div class="form-group col-sm-6" >
									        <input type="password" data-minlength="6" tabindex="3"class="form-control register-senha" id="inputPassword" placeholder="Senha" required style="width: 100%;">
									        <div class="help-block">Minimo 6 caracteres</div>
									      </div>
									      <div class="form-group col-sm-6">
									        <input type="password" tabindex="4" class="form-control register-confirm" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Senhas não são iguais" placeholder="Confirme a Senha" required style="width: 100%;">
									        <div class="help-block with-errors"></div>
									      </div>
									    </div>
									  </div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" tabindex="5" name="register-submit" id="register-submit" tabindex="4" data-disable="true" class="form-control btn btn-register" value="Registrar">
												
											</div>

										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
   
   
   
		<script src="view/frameworks/bootstrap/js/jquery.min.js"></script>
    <script src="view/js/scripts-login.js"></script>
    <script src="view/frameworks/bootstrap/js/bootstrap.min.js"></script>
    <script src="view/frameworks/sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="view/js/validator.min.js"></script>
    


