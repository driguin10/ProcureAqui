<section>
<div class="container">
	<div class="row">

		<div class="pesq col-md-12">
			<div class="container">
				<div class="row">
					 <div class="pesqInfo col-md-5">
					 <h1 style="text-align: center;"><b><?php echo $titulo; ?></b></h1>
					 	<p><?php echo $descricao; ?>.</p>
					 </div>

					 <div class="pesqImagem col-md-7">
					 	<img src=<?php echo "$imagem"; ?>>
					 </div>

					 <div class="col-md-12">	
					 		<h5>Data Publicação: <b><?php echo $dataPub; ?></b></h5>
					 		<?php
					 		if($dataTerm != "")
						 	echo "<h5>Data Tèrmino: <b>".$dataTerm."</b></h5>";

						 	?>

						 	
						 		<div class="jumbotron">
						 			<div class="row">
						 				<div class="col-md-6">
										 	<h3 style="text-align: center;">Dados Da Empresa</h3>
										 	<h5>Empresa: <b><?php echo $nome; ?></b></h5>
										 	<h5>CNPJ: <b><?php echo $cnpj; ?></b></h5>	 
										 	<h5>Razão Social: <b><?php echo $razaoSocial; ?></b></h5>	
										 	<h5>Estado: <b><?php echo $estado; ?></b></h5>	
										 	<h5>Cidade: <b><?php echo $cidade; ?></b></h5>
										 	<h5>Endereço: <b><?php echo $endereco; ?></b></h5>
										 	<h5>Numero: <b><?php echo $numero; ?></b></h5>	
										 	<h5>Cep: <b><?php echo $cep; ?></b></h5>			
										 	<h5>Telefone: <b><?php echo $telefone; ?></b></h5>
										 	<h5>Email: <b><?php echo $email; ?></b></h5>
										  										</div>

										<div class="col-md-6">
											<div class="container conteiner-avalia">
												
												<h3 style="text-align: center;">Avalie esta Empresa</h3>
												<form class="form-avalia" method="post" >
													<div class="estrelas" >
														
														<input type="hidden" name="id" value=<?php  echo "$idPrestador"; ?>>
														<label for="cm_star-1"><i class="fa"></i></label>
														<input type="radio" id="cm_star-1" name="fb" value="1" checked/>

														<label for="cm_star-2"><i class="fa"></i></label>
														<input type="radio" id="cm_star-2" name="fb" value="2"/>

														<label for="cm_star-3"><i class="fa"></i></label>
														<input type="radio" id="cm_star-3" name="fb" value="3"/>

														<label for="cm_star-4"><i class="fa"></i></label>
														<input type="radio" id="cm_star-4" name="fb" value="4"/>

														<label for="cm_star-5"><i class="fa"></i></label>
														<input type="radio" id="cm_star-5" name="fb" value="5"/>
													</div>
													<input type="submit" class="bt-avaliacao" name="enviar" value="Avaliar">
												</form>
											</div>
										</div>
									</div>
								</div>	
						</div>



					</div>
				</div>
			</div> 
		</div><!-- -->
	</div>
	



</section>