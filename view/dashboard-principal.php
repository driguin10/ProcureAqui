<?php
$activeS = "active";
$activeF = "";
if(isset($_GET['aba']))
{
$activeS = "";
$activeF = "active";
}

?>
 <link href="view/css/stilodashboardPrincipal.css" rel="stylesheet" media="all">

 <section class="painels">
        <p class="info-assinatura">
          <?php  
            if($assinatura == 1)
              echo "Conta Basica <i class='fa fa-star-o' aria-hidden='true'></i>";
            else
              if($assinatura == 2)
                echo "Conta Premium <i class='fa fa-star-half-o' aria-hidden='true'></i>";
              else
                echo "Conta Enterprise <i class='fa fa-star' aria-hidden='true'></i>";

              if(isset($FlagVencimento))
              {
                echo "<br>".$FlagVencimento;
                echo "  <button class='btn btn-success btn-xs' data-toggle='modal' data-target='#modal-pagamento'>Efetuar Pagamento</button>";
              }
          ?>
        </p>
</section>
    


<section>
    <ul class="nav nav-tabs" role="tablist">
    
        <li role="presentation" id=<?php echo "'".$idPrestador."-".$assinatura."'"; ?> 
          class=<?php echo '"'.$activeS.' bt-servicos"'; ?>><a href="#servicos" aria-controls="servicos" role="tab" data-toggle="tab" id="a-bt-servicos"></a></li>

        <?php 
          if($assinatura != 1)
          {
            echo "<li role='presentation' id='$idPrestador-$assinatura' class='bt-ofertas'><a href='#ofertas'  aria-controls='ofertas' role='tab' data-toggle='tab' id='a-bt-ofertas'>Ofertas</a></li>";
          }
        ?>

        <li role="presentation" id=<?php echo "'".$id_pessoa."-".$assinatura."'"; ?> class=<?php echo '"'.$activeF.' bt-favoritos"'; ?>><a href="#favoritos" id="a-bt-favoritos" aria-controls="favoritos" role="tab" data-toggle="tab">Favoritos </a></li>
    </ul>

  <!-- Tab panes -0-->
  <div class="tab-content">

    <div role="tabpanel" class=<?php echo '"'.$activeS.' tab-pane fade in"'; ?> id="servicos">


        <button type="button" class="btn btn-primary btn-lg add-Serv" data-toggle="modal" data-target="#modal-cadastro-servico">
         <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Serviços
        </button>


<!-- Modal cadastro de serviços -->
<div class="modal fade" id="modal-cadastro-servico" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="CadastroServico">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Inserir Serviço</h4>
      </div>

      
      <div class="modal-body">

         <form data-toggle="validator" enctype="multipart/form-data" class="cadservico-form" id="register-form" method="POST"   role="form" >
              
              <input type="hidden" name="cadservico-type" class="cadservico-type" value="cadastra">
              <input type="hidden" name="cadservico-prestador" class="cadservico-prestador" value=<?php echo "'".$idPrestador."'"; ?>>

                <div class="form-group">
                        <select id="cadservico-categoria"  name="cadservico-categoria" class="selectpicker cadservico-categoria" title="Categoria" data-live-search="true" data-size="3" required>         
                        </select>
                </div>

                <div class="form-group">
                    <input type="text" name="titulo" id="titulo" tabindex="1" class="form-control cadservico-titulo" placeholder="titulo" value="" title="Titulo" autocomplete="off" required >
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <textarea name="descricao" rows="3" id="descricao" tabindex="2" class="form-control cadservico-descricao" placeholder="Descrição" value="" title="Descricao" autocomplete="off" required ></textarea>
                    <div class="help-block with-errors"></div>
                </div>

               

              <div class="form-group">
                        <div class="file-upload-cadservico">
                          <button class="file-upload-btn-cadservico" type="button" onclick="$('.file-upload-input-cadservico').trigger('click')">Adicionar Imagem</button>
                          <div class="image-upload-wrap-cadservico ">
                            <input class="file-upload-input-cadservico cadservico-imagem" name="cadservico-imagem" type='file' onchange="readURLcadservicos(this);" accept="image/*" />
                            <div class="drag-text-cadservico">
                              <h3>Arraste e solte uma imagem aqui</h3>
                            </div>
                          </div>
                          <div class="file-upload-content-cadservico">
                            <img class="file-upload-image-cadservico-antiga" style="display: none"/>
                            <img class="file-upload-image-cadservico" src="#" alt="your image" />
                            <div class="image-title-wrap-cadservico">
                              <button type="button" onclick="removeUploadcadservicos()" class="remove-image-cadservico">Remover</button>
                            </div>
                          </div>
                        </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary submit-cadServico" >Salvar</button>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div><!-- Fim Modal cadastro de serviços -->


<!-- Modal editar serviços -->
<div class="modal fade" id="modal-editar-servico" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="EditarServicos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EditarServicos">Editar Serviço</h4>
      </div>

      
      <div class="modal-body">

         <form data-toggle="validator" enctype="multipart/form-data" class="editservico-form" method="POST"   role="form" >
              
              <input type="hidden" name="editservico-type" class="editservico-type" value="editar">
              <input type="hidden" name="editservico-prestador" class="editservico-prestador" value=<?php echo "'".$idPrestador."'"; ?>>

                <div class="form-group">
                        <select id="editservico-categoria"  name="editservico-categoria" class="selectpicker editservico-categoria" title="Categoria" data-live-search="true" data-size="3" required>         
                        </select>
                </div>

                <div class="form-group">
                    <input type="text" name="titulo" id="titulo" tabindex="1" class="form-control editservico-titulo" placeholder="titulo" value="" title="Titulo" autocomplete="off" required >
                    <div class="help-block with-errors"></div>
                </div>

               <!-- <div class="form-group">
                    <input type="text" name="descricao" id="descricao" tabindex="2" class="form-control editservico-descricao" placeholder="Descrição" value="" title="Descricao" autocomplete="off" required >
                    <div class="help-block with-errors"></div>
                </div>-->

                 <div class="form-group">
                    <textarea name="descricao" rows="3" id="descricao" tabindex="2" class="form-control editservico-descricao" placeholder="Descrição" value="" title="Descricao" autocomplete="off" required ></textarea>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                        <div class="file-upload-editservico">
                          <button class="file-upload-btn-editservico" type="button" onclick="$('.file-upload-input-editservico').trigger('click')">Adicionar Imagem</button>
                          <div class="image-upload-wrap-editservico ">
                            <input class="file-upload-input-editservico editservico-imagem" name="editservico-imagem" type='file' onchange="readURLeditservicos(this);" accept="image/*" />
                            <div class="drag-text-editservico">
                              <h3>Arraste e solte uma imagem aqui</h3>
                            </div>
                          </div>
                          <div class="file-upload-content-editservico">
                            <img class="file-upload-image-editservico-antiga" style="display: none"/>
                            <img class="file-upload-image-editservico" src="#" alt="your image" />
                            <div class="image-title-wrap-editservico">
                              <button type="button" onclick="removeUploadeditservicos()" class="remove-image-editservico">Remover</button>
                            </div>
                          </div>
                        </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary submit-editservico" >Salvar</button>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>





            <div class="row campo-servicos">
              <!-- aparece os serviços cadastrados -->
            </div>   
    </div>


<!-- ofertas -->



   
<?php 
          if($assinatura != 1)
          {
            echo " <div role='tabpanel' class='tab-pane fade in' id='ofertas'>

<!-- INICIO FORMULARIO DE OFERTAS-->

<button type='button' class='btn btn-primary btn-lg add-Ofert' data-toggle='modal' data-target='#modal-cadoferta'>
  <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Ofertas
</button>



<div class='modal fade' id='modal-cadoferta' tabindex='-1'  data-backdrop='static' role='dialog' aria-labelledby='CadastroOfertas'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='CadastroOfertas'>Inserir Ofertas</h4>
      </div>


      <div class='modal-body'>

         <form data-toggle='validator' enctype='multipart/form-data' class='cadoferta-form' id='cadoferta-form' method='POST'   role='form' >
                <input type='hidden' name='cadoferta-type' class='cadoferta-type' value='cadastra'>
                <div class='form-group'>
                        <select id='cadoferta-servico'  name='cadoferta-servico' class='selectpicker cadoferta-servico' title='Serviço' data-live-search='true' data-size='3' >       
                        </select>
                        <input type='text' name='cadoferta-servico-label'  class='form-control cadoferta-servico-label' disabled style='display:none'>
                </div>
               
                <div class='form-group'>
                    <input type='text' name='cadoferta-titulo' id='titulo' tabindex='1' class='form-control cadoferta-titulo' title='Titulo' placeholder='titulo' value='' autocomplete='off'  required>
                </div>

               

                <div class='form-group'>
                    <textarea name='cadoferta-descricao' rows='3' id='descricao' tabindex='2' class='form-control cadoferta-descricao' placeholder='Descrição' value=' title='Descricao' autocomplete='off' required ></textarea>
                    
                </div>

                <div class='form-group'>
                <label>Data término</label>
                    <input type='date' name='cadoferta-data-termino' id='data-termino' tabindex='3' class='form-control cadoferta-data-termino'  autocomplete='off'  >
                </div>

                <div class='form-group'>

                        <div class='file-upload-cadoferta'>
                          <button class='file-upload-btn-cadoferta' type='button' onclick=\"$('.file-upload-input-cadoferta').trigger( 'click' )\">Adicionar Imagem</button>

                          <div class='image-upload-wrap-cadoferta'>
                            <input class='file-upload-input-cadoferta cadoferta-imagem' name='cadoferta-imagem' type='file' onchange='readURLcadoferta(this);' accept='image/*' />
                            <div class='drag-text-cadoferta'>
                              <h3>Arraste e solte uma imagem aqui</h3>
                            </div>
                          </div>
                          <div class='file-upload-content-cadoferta'>
                            <img class='file-upload-image-cadoferta-antiga' style='display: none' />
                            <img class='file-upload-image-cadoferta' src='#' alt='your image' />
                            <div class='image-title-wrap-cadoferta'>
                              <button type='button' onclick='removeUploadcadoferta()' class='remove-image-cadoferta'>Remover</button>
                            </div>
                          </div>
                        </div>
                </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
        <button type='submit' class='btn btn-primary submit-cadoferta'>Salvar</button>
      </div>
            </form>
      </div>
      
    </div>
  </div>
</div>

<!--  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  -->


<div class='modal fade' id='modal-editofertas' tabindex='-1'  data-backdrop='static' role='dialog' aria-labelledby='EditarOferta'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='EditarOferta'>Editar Oferta</h4>
      </div>


      <div class='modal-body'>

         <form data-toggle='validator' enctype='multipart/form-data' class='editoferta-form' id='editoferta-form' method='POST'   role='form' >
                <input type='hidden' name='editoferta-type' class='editoferta-type' value='editar'>
                <div class='form-group'>  
                  <input type='text' name='editoferta-servico-label'  class='form-control editoferta-servico-label' disabled >
                </div>
                
                <div class='form-group'>
                    <input type='text' name='editoferta-titulo' id='titulo' tabindex='1' class='form-control editoferta-titulo' title='Titulo' placeholder='titulo' value='' autocomplete='off'  required>
                </div>


                 <div class='form-group'>
                    <textarea name='editoferta-descricao' rows='3' id='descricao' tabindex='2' class='form-control editoferta-descricao' placeholder='Descrição' value=' title='Descricao' autocomplete='off' required ></textarea>
                    
                </div>

                <div class='form-group'>
                <label>Data término</label>
                    <input type='date' name='editoferta-data-termino' id='data-termino' tabindex='3' class='form-control editoferta-data-termino'  autocomplete='off'  >
                </div>

                <div class='form-group'>

                        <div class='file-upload-editoferta'>
                          <button class='file-upload-btn-editoferta' type='button' onclick=\"$('.file-upload-input-editoferta').trigger( 'click' )\">Adicionar Imagem</button>

                          <div class='image-upload-wrap-editoferta'>
                            <input class='file-upload-input-editoferta editoferta-imagem' name='editoferta-imagem' type='file' onchange='readURLeditoferta(this);' accept='image/*' />
                            <div class='drag-text-editoferta'>
                              <h3>Arraste e solte uma imagem aqui</h3>
                            </div>
                          </div>
                          <div class='file-upload-content-editoferta'>
                            <img class='file-upload-image-editoferta-antiga' style='display: none' />
                            <img class='file-upload-image-editoferta' src='#' alt='your image' />
                            <div class='image-title-wrap-editoferta'>
                              <button type='button' onclick='removeUploadeditoferta()' class='remove-image-editoferta'>Remover</button>
                            </div>
                          </div>
                        </div>
                </div>
<div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
        <button type='submit' class='btn btn-primary submit-editoferta'>Salvar</button>
      </div>
            </form>
      </div>
      
    </div>
  </div>
</div>


<!-- FIM DO FORMULARIO DE INSERIR OFERTA -->


            <div class='row campo-ofertas'>
            
    </div></div> ";





          }
        ?>





    <div role="tabpanel"  class=<?php echo '"'.$activeF.' tab-pane fade in campo-favoritos"'; ?>  id="favoritos">
    
    </div>


</div>
</section>





<div class="modal fade bs-example-modal-lg" id="modal-edit-prestador" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="EditarPrestador">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Informações</h4>
      </div>

      
      <div class="modal-body">
        <div class="tabs-edit">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active first"><a href="#empresa" aria-controls="empresa" role="tab" data-toggle="tab">EMPRESA</a></li>
            <li role="presentation"><a href="#usuario" aria-controls="usuario" role="tab" data-toggle="tab">USUARIO</a></li>
            <li role="presentation"><a href="#plano" aria-controls="usuario" role="tab" data-toggle="tab">PLANO</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">

            <div role="tabpanel" class="tab-pane active first" id="empresa">

              <form  data-toggle="validator"    enctype="multipart/form-data" class="form-atualizaPrest" id="form-atualizaPrest"  role="form" style="display: block;">
                <input type="hidden" class="opcao" name="opcao" value="editar">
          <input type="hidden" class="idPessoa" name="idPessoa" value=<?php echo  '"'.$id_pessoa.'"'; ?> >
          <input type="hidden" class="idPrestador" name="idPrestador" value=<?php echo  '"'.$idPrestador.'"'; ?> >

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
                  <img class="file-upload-image-prestador-antiga" style="display: none" />
                  <img class="file-upload-image-prestador" src="#" alt="your image" />
                  <div class="image-title-wrap-prestador">
                    <button type="button" onclick="removeUploadPrestador()" class="remove-image-prestador">Remover</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label>Nome da Empresa</label>
              <input type="text" name="nomeFantasia" id="nomeFantasia" tabindex="2" class="form-control cadastro-nomeFantasia"  placeholder="nome Fantasia" autocomplete="off"  value=<?php echo '"'.$nomeFantasia.'"'; ?> required>
            </div>

            <div class="form-group col-md-6">
            <label>Razão social</label>
              <input type="text" name="razao" id="razao" tabindex="3" class="form-control cadastro-razao" placeholder="razao social"  autocomplete="off" value=<?php echo '"'.$razaoSocial.'"'; ?> required>
            </div>
          </div>

            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="nome" id="nome" tabindex="4" class="form-control cadastro-nome nome" placeholder="nome"  autocomplete="off"  value=<?php echo '"'.$nome.'"'; ?> required>
              </div>

                <div class="form-group col-md-3">
                  <input type="text" name="cpf" id="cpf" tabindex="5" class="form-control cadastro-cpf" placeholder="cpf" maxlength="14" value=<?php echo '"'.$cpf.'"'; ?> autocomplete="off" required onkeypress="formatarCpf('###.###.###-##', this);">
                </div>

                

                <div class="form-group col-md-3">
                  <input type="text" name="cnpj" id="cnpj" tabindex="6" class="form-control cadastro-cnpj" data-minlength="6" maxlength="18" placeholder="cnpj" autocomplete="off" value=<?php echo '"'.$cnpj.'"'; ?> required onkeypress="formatarCnpj('##.###.###/####-##', this);">
                </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
              <input type="text" name="endereco" id="endereco" tabindex="7" class="form-control cadastro-endereco" placeholder="endereco" value=<?php echo '"'.$endereco.'"'; ?> autocomplete="off" required>
            </div>
                      


            <div class="form-group col-md-3">
              <select name="estado" id="cbEstado" class="selectpicker cbEstado" tabindex="8" data-live-search="true" title="estado" data-size="3"  required>
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
            <input type="number" name="numero" id="numero" tabindex="10" class="form-control cadastro-numero" placeholder="numero" value=<?php echo '"'.$numero.'"'; ?> autocomplete="off" required>
          </div>

          <div class="form-group col-md-3">
            <input type="number" name="cep" id="cep" tabindex="11" class="form-control cadastro-cep" placeholder="cep" value=<?php echo '"'.$cep.'"'; ?> autocomplete="off" required>
          </div>

          <div class="form-group col-md-6">
            <input type="text" name="telefone" id="telefone" tabindex="12" class="form-control cadastro-telefone bfh-phone" data-format="+55 (dd) ddddd-dddd" value=<?php echo '"'.$telefone.'"'; ?> autocomplete="off" required>
          </div>
        </div>
   
                    
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <input type="submit" name="login-submit" id="login-submit" tabindex="17" class="form-control btn btn-finalizar btn-success" value="SALVAR">
            </div>
          </div>
        </div>  
      </form>

            </div><!-- fim tab empresa -->


            <div role="tabpanel" class="tab-pane " id="usuario">
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
            </div><!-- fim tab usuario -->


            <div role="tabpanel" class="tab-pane " id="plano"><!--  tab plano -->

              <div class="row">
                <div class="col-md-12">
                  <label>SEU PLANO</label>
                  
                   <p>Plano adquirido =  
                      <?php 
                        if($assinatura == 1)
                          echo "Básico"; 
                        if($assinatura == 2)
                          echo "Premium"; 
                        if($assinatura == 3)
                          echo "Enterprise"; 
                      ?>                        
                    </p>
                  <p>Pagamento = 
                    <?php 
                    if($assinatura == 1 && $pago == 1)
                      echo "Gratis";
                    else
                      if($pago == 1)
                        echo "Pago"; 
                      else
                        echo "Pendente";
                    ?>
                  </p>

                  
                  <p>Data da Assintura = <?php echo date("d-m-Y", strtotime($dataAssinatura));?> </p>
                  <p>Data da Vencimento = 
                    <?php if($assinatura == 1 && $pago == 1)
                          echo "Prazo indefinido";
                          else
                          echo date("d-m-Y", strtotime($dataVencimento));
                      ?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 btPagar">
                  <button class='btn btn-success btn-lg' id="bt-modal-pagamento" class="bt-modal-pagamento" data-toggle='modal' data-target='#modal-pagamento'>Trocar Plano</button>
                </div>
              </div>
              
            </div><!-- fim tab plano -->

          </div><!-- fim tab-content -->
        </div><!-- fim tabs-edit -->
      </div><!-- fim modal-body -->


         </div>
       </div>
     </div>
</div><!-- Fim Modal cadastro de serviços -->





<!-- Modal -->
<div class="modal fade" id="modal-pagamento"  data-backdrop='static'tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assinatura</h4>
      </div>
      <div class="modal-body">
        
<form id="form-pagamento" method="POST" action="manutencaoAssinatura">
  <input type="hidden" name="idPessoa" value=<?php echo "'".$id_pessoa."'"?>>
   <input type="hidden" name="idPrestador" value=<?php echo "'".$idPrestador."'"?>>

        <div class="row">
          <div class="form-group col-md-12">
            <label for="sel1">Selecione o tipo de assinatura</label>
                <select name="tipoConta" tabindex="13" id="edit-cbPlano" class="form-control edit-cbPlano"  required>
                  <option value="1">Basic</option>
                  <option value="2">Premium</option>
                  <option value="3">Enterprise</option>
                </select>
          </div>
        </div>

       <button class="bt-salvar-plano btn btn-primary" >Salvar</button>
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
              <button class="bt-pagar-boleto-2 btn btn-primary">Efetuar Pagamento</button>
            </div>
            <div class="col-md-12 PagamentoCartao container" >
              <p>MÉTODO DE PAGAMENTO ( CARTÃO )</p>
                <button class="bt-pagar-cartao-2 btn btn-primary">Efetuar Pagamento</button>
            </div>
          </div>
        </div>


</form>
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


<script type="text/javascript">
  $('#modal-edit-prestador').on('shown.bs.modal', function () {

    $("#modal-edit-prestador").find(".cadastro-nomeFantasia").val(<?php echo"'".$nomeFantasia."'";?>);
    $("#modal-edit-prestador").find(".cadastro-razao").val(<?php echo"'".$razaoSocial."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-nome").val(<?php echo"'".$nome."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-cpf").val(<?php echo"'".$cpf."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-cnpj").val(<?php echo"'".$cnpj."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-endereco").val(<?php echo"'".$endereco."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-numero").val(<?php echo"'".$numero."'"; ?>);
    $("#modal-edit-prestador").find(".cadastro-telefone").val(<?php echo"'".$telefone."'"; ?>);


    $("#modal-edit-prestador").find(".cbEstado").val(<?php echo"'".$estado."'"; ?>);
    $("#modal-edit-prestador").find('.cbEstado').selectpicker('render');
    $("#modal-edit-prestador").find('.cbEstado').selectpicker('refresh');
    $("#modal-edit-prestador").find(".cbEstado").change();
    $("#modal-edit-prestador").find(".cbPlano").val(<?php echo '"'.$assinatura.'"'; ?>);
    $("#modal-edit-prestador").find('.image-upload-wrap-prestador').hide();
    $("#modal-edit-prestador").find('.file-upload-image-prestador-antiga').attr('src',<?php echo"'".$imagem."'"; ?>);
    $("#modal-edit-prestador").find('.file-upload-image-prestador').attr('src',<?php echo"'".$imagem."'"; ?>);  
    $("#modal-edit-prestador").find('.file-upload-content-prestador').show();

    var tempo_espera;
    tempo_espera = setTimeout(function() { 
        $("#modal-edit-prestador").find(".cbCidade").val(<?php echo"'".$cidade."'"; ?>);
        $("#modal-edit-prestador").find('.cbCidade').selectpicker('render');
        $("#modal-edit-prestador").find('.cbCidade').selectpicker('refresh'); 
    }, 500); 


            
$(".bt-favoritos").trigger("click");
        });
</script>

</body>
</html>