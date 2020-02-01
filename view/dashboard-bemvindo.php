<div class="container">
  <div class="row">
    <div class="col-md-12" style="text-align:center">
      <h1 style="text-align:center">Seja bem vindo <?php echo $nome; ?> !</h1>
        <h2 style="text-align:center"> Torne-se um prestador e insira anuncios, ofertas e aumente suas vendas...</h2>
           

			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Tornar-se Prestador <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
			</button>
			<div class="collapse" id="collapseExample">
				<div class="well">
   			 <form  data-toggle="validator"  action="finalizaCadastro"  enctype="multipart/form-data" class="" id="finaliza-cad" action="finalizaCadastro" method="POST" role="form" style="display: block;">
					<input type="hidden" class="idPessoa" name="idPessoa" value=<?php echo  '"'.$id_pessoa.'"'; ?> >
					<input type="hidden" class="idUsuario" name="idUsuario" value=<?php echo  '"'.$id_usuario.'"'; ?> >

					<div class="row">

						<div class="col-md-6 form-group">
	            <div class="file-upload-prestador ">
	              <button class="file-upload-btn-prestador" type="button" onclick="$('.file-upload-input-prestador').trigger( 'click' )">Adicionar Imagem</button>
	              <div class="image-upload-wrap-prestador ">
	                <input class="file-upload-input-prestador cadprestador-imagem" tabindex="1" name="cadprestador-imagem" type='file' onchange="readURLPrestador(this);" accept="image/*" />
	                <div class="drag-text-prestador">
	                  <h3>Arraste e solte uma imagem aqui</h3>
	                </div>
	              </div>
	              <div class="file-upload-content-prestador">
	                <img class="file-upload-image-prestador" src="#" alt="your image" />
	                <div class="image-title-wrap-prestador">
	                  <button type="button" onclick="removeUploadPrestador()" class="remove-image-prestador">Remover</button>
	                </div>
	              </div>
	            </div>
	        	</div>

	        	<div class="form-group col-md-6">
		    			<label>Nome da Empresa</label>
							<input type="text" name="nomeFantasia" id="nomeFantasia" tabindex="2" class="form-control cadastro-nomeFantasia"  placeholder="nome Fantasia" autocomplete="off" required>
						</div>

						<div class="form-group col-md-6">
						<label>Razão social</label>
							<input type="text" name="razao" id="razao" tabindex="3" class="form-control cadastro-razao" placeholder="razao social" value="" autocomplete="off" required>
						</div>
		    	</div>

						<div class="row">
							<div class="form-group col-md-6">
								<input type="text" name="nome" id="nome" tabindex="4" class="form-control cadastro-nome" placeholder="nome" value=<?php echo "'$nome'"; ?> autocomplete="off" required>
							</div>

								<div class="form-group col-md-3">
									<input type="text" name="cpf" id="cpf" tabindex="5" class="form-control cadastro-cpf" placeholder="cpf" maxlength="14" value="" autocomplete="off" required onkeypress="formatarCpf('###.###.###-##', this);">
								</div>

								

								<div class="form-group col-md-3">
									<input type="text" name="cnpj" id="cnpj" tabindex="6" class="form-control cadastro-cnpj" data-minlength="6" placeholder="cnpj" maxlength="18" autocomplete="off" required onkeypress="formatarCnpj('##.###.###/####-##', this);">
								</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
							<input type="text" name="endereco" id="endereco" tabindex="7" class="form-control cadastro-endereco" placeholder="endereco" value="" autocomplete="off" required>
						</div>
	   									


						<div class="form-group col-md-3">
							<select name="estado" id="cbEstado" class="selectpicker cbEstado" tabindex="8" data-live-search="true" title="estado" data-size="3" required>
								<option value= "AC" >ACRE</option> 
		                          <option value= "AL" >ALAGOAS</option> 
		                          <option value= "AP" >AMAPA</option> 
		                          <option value= "AM" >AMAZONAS</option>                              
		                          <option value= "BA" >BAHIA</option>                               
		                          <option value= "CE" >CEARA</option>                               
		                          <option value= "DF" >DISTRITO FEDERAL</option>                       
		                          <option value= "ES" >ESPIRITO SANTO</option>               
		                          <option value= "RR" >RORAIMA</option>                                
		                          <option value= "GO" >GOIAS</option>                                
		                          <option value= "MA" >MARANHAO</option>                              
		                          <option value= "MT" >MATO GROSSO</option>                            
		                          <option value= "MS" >MATO GROSSO DO SUL</option>                    
		                          <option value= "MG">MINAS GERAIS</option>                       
		                          <option value= "PA" >PARA</option>                               
		                          <option value= "PB" >PARAIBA</option>                              
		                          <option value= "PR" >PARANA</option>                              
		                          <option value= "PE" >PERNAMBUCO</option>                          
		                          <option value= "PI" >PIAUI</option>                               
		                          <option value= "RJ" >RIO DE JANEIRO</option>                        
		                          <option value= "RN" >RIO GRANDE DO NORTE</option>                   
		                          <option value= "RS" >RIO GRANDE DO SUL</option>                     
		                          <option value= "RO" >RONDONIA</option>                               
		                          <option value= "TO" >TOCANTINS</option>                             
		                          <option value= "SC" >SANTA CATARINA</option>                         
		                          <option value= "SP" >SAO PAULO</option>                             
		                          <option value= "SE" >SERGIPE</option>  
							</select>
					</div>
					<div class="form-group col-md-3">
						<select name="cidade"  tabindex="9" id="cbCidade" class="selectpicker cbCidade" data-live-search="true" title="cidade" data-size="3" required>
						</select>
					</div>
				</div>

				<div class="row">
					

					<div class="form-group col-md-3">
						<input type="number" name="numero" id="numero" tabindex="10" class="form-control cadastro-numero" placeholder="numero" value="" autocomplete="off" required>
					</div>

					<div class="form-group col-md-3">
						<input type="number" name="cep" id="cep" tabindex="11" class="form-control cadastro-cep" placeholder="cep" value="" autocomplete="off" required>
					</div>

					<div class="form-group col-md-6">
						<input type="text" name="telefone" id="telefone" tabindex="12" class="form-control cadastro-telefone bfh-phone" data-format="+55 (dd) ddddd-dddd" value="" autocomplete="off" required>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="sel1">Selecione o tipo de assinatura</label>
							  <select name="tipoConta" tabindex="13"id="cbPlano" class="form-control cbPlano"  required>
								  <option value="1">Basic</option>
								  <option value="2">Premium</option>
								  <option value="3">Enterprise</option>
							  </select>
					</div>

				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<button class="bt-salvar btn btn-primary">Salvar</button>
					</div>
				</div>


			<div class="row opPagamento" style="display: none">

					<div class="col-md-12">
						<div class="btn-group" data-toggle="buttons">
						  <label class="btn btn-primary active">
						    <input type="radio" tabindex="14" name="options" id="option1" autocomplete="off" checked> <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> BOLETO BANCARIO
						  </label>
						  <label class="btn btn-primary">CARTÃO DE CREDITO 
						   <input type="radio" tabindex="15" name="options" id="option2" autocomplete="off"> <!--<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>-->
						  </label>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 PagamentoBoleto container">
							<p>MÉTODO DE PAGAMENTO ( BOLETO) </p>
							<button class="bt-pagar-boleto btn btn-primary">Efetuar Pagamento</button>
						</div>
						<div class="col-md-12 PagamentoCartao container" >
							<p>MÉTODO DE PAGAMENTO ( CARTÃO )</p>
			        	<button class="bt-pagar-cartao btn btn-primary">Efetuar Pagamento</button>
						</div>
					</div>
				</div>

										
					
			</form>
  	</div>
	</div>
</div>  
</div>
</div>

<br>
<br>
<br>

<div class="container content" style="display: block;">
	<div class="row">
		<div class="col-md-4">
			<div class="pricing pricing-active hover-effect pricing-basico">
				<div class="pricing-head pricing-head-active pricingH-basico">
					<h3>Basico <span>
					conta iniciante </span>
					</h3>
					<h4>Gratis !!</i>
					<span> . </span>
					</h4>
				</div>
				<ul class="pricing-content list-unstyled">
					<li>
						1 X Anúncio
					</li>
					<li>
						0 X Ofertas
					</li>
					<li>
						Baixa Visualizações
					</li>
					<li>
						<strike>Distaque na tela inicial</strike>
					</li>
				</ul>
				<div class="pricing-footer">
					<a href="javascript:;" class="btn yellow-crusta bt-planoBasico">
					Adiquirir este plano
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="pricing hover-effect pricing-premium">
				<div class="pricing-head pricingH-premium">
					<h3>Premium <span>
					conta intermediaria </span>
					</h3>
					<h4><i>R$</i>8<i>.50</i>
					<span>
					Por Mês </span>
					</h4>
				</div>
				<ul class="pricing-content list-unstyled">
					<li>
						3 x Anúncios
					</li>
					<li>
						3 x Ofertas
					</li>
					<li>
						Média visualizações
					</li>
					<li>
						Destaque na tela inicial
					</li>
				</ul>
				<div class="pricing-footer">
				
					<a href="javascript:;" class="btn yellow-crusta bt-planoPremium">
					Adiquirir este plano
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="pricing hover-effect pricing-enterprise">
				<div class="pricing-head pricingH-enterprise">
					<h3>Enterprise <span>
					conta avançada </span>
					</h3>
					<h4><i>R$</i>13<i>.99</i>
					<span>
					Por Mês </span>
					</h4>
				</div>
				<ul class="pricing-content list-unstyled">
					<li>
						Anúncios ilimitados
					</li>
					<li>
						Ofertas ilimitadas
					</li>
					<li>
						Maior visualização
					</li>
					<li>
						Destaque na tela inicial
					</li>
				</ul>
				<div class="pricing-footer">
					<a href="javascript:;" class="btn yellow-crusta bt-planoEnterprise">
					Adiquirir este plano
					</a>
				</div>
			</div>
		</div>
	</div>
	<p>** Os planos PREMIUM e ENTERPRISE terá um prazo de 30 dias perante pagamento, após vencimento a conta se tornará basica.</p>
</div>


<div class="modal fade" id="modal-edit-prestador" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="CadastroOfertas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="CadastroOfertas">Editar Informações</h4>
      </div>


      <div class="modal-body">

       <div class="painel-usuario">
              <form data-toggle="validator" class="form-atualizaUser" id="register-form" method="POST"   role="form">
                  

              <div class="form-group">
                <div class="row">
                  <div class="form-group col-sm-8 col-sm-offset-2" >
                    <input type="hidden" class="idUsuario" name="idUsuario" value=<?php echo '"'.$id.'"'; ?>>
                    <input type="email" name="email" id="email" tabindex="2" class="form-control register-email" placeholder="Email" value=<?php echo '"'.$email.'"'; ?> autocomplete="off" required data-error="Este Email não é válido!!">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>



                    <div class="form-group ">                   
                      <div class="row">
                        <div class="form-group col-sm-4 col-sm-offset-2" >
                          <input type="password" data-minlength="6" tabindex="3" class="form-control register-senha" id="inputPassword" placeholder="Nova Senha"   style="width: 100%;">
                          <div class="help-block">Minimo 6 caracteres</div>
                        </div>
                        <div class="form-group col-sm-4">
                          <input type="password" tabindex="4" class="form-control register-confirm" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Senhas não são iguais" placeholder="Confirme a Senha"  style="width: 100%;">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" tabindex="5" name="submit-edituser" id="submit-edituser" tabindex="4" data-disable="true" class="form-control btn btn-success " value="SALVAR">
                        
                      </div>

                    </div>
                  </div>
                </form>
              </div>
      </div>
      
    </div>
  </div>
</div>











<script src="/procureaqui/view/frameworks/bootstrap/js/jquery.min.js"></script>
<script src="/procureaqui/view/frameworks/bootstrap/js/bootstrap.min.js"></script>
<script src="/procureaqui/view/frameworks/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/procureaqui/view/frameworks/FormHelpers/dist/js/bootstrap-formhelpers.min.js"></script>
<script src="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.min.js"></script>
<script src="/procureaqui/view/js/validator.min.js"></script>
<script src="/procureaqui/view/frameworks/bootstrap-validator/js/bootstrapValidator.js"></script>
<script src="/procureaqui/view/js/scripts-dashboard.js"></script>
<script src="/procureaqui/view/js/scripts-dashboard-ofertas.js"></script>
<script src="/procureaqui/view/js/scripts-dashboard-servicos.js"></script>
<script src="/procureaqui/view/js/scripts-dashboard-favoritos.js"></script>
<script src="/procureaqui/view/js/scripts-dashboard-prestador.js"></script>

</body>
</html>

