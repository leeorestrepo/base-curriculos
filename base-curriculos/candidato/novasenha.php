<?php
require_once('functions.php');
require_once('_optionS.php');
include(HEADER_TEMPLATE);

@session_start();

$db = open_database();

if ( !isset ( $_SESSION['empresa'] ) ) {
	
	unset($_SESSION['empresa']);
	unset($_SESSION["login"]);
	unset($_SESSION["senha"]);
	unset($_SESSION["nivel_acesso"]);
	unset($_SESSION["id"]);
	unset($_SESSION["nome"]);
	unset($_SESSION["cpf"]);
	unset($_SESSION["data_nasc"]);
	unset($_SESSION["sexo"]);
	unset($_SESSION["estado_civil"]);
	unset($_SESSION["filhos"]);
	unset($_SESSION["cod_nacionalidade"]);
	
}

if ( !empty ( $_SESSION['empresa'] ) == true && !empty ( $_SESSION['id'] ) == true ) {
	// Após as verificações, começo a exibir o conteúdo:
	$logado = $_SESSION["login"];
	
	$cand = new Candidato( $_SESSION['id'] );
	
	if ( @$_GET['go'] == 'altpass' ) {
		if ( $cand->getSenha() == $_POST['senha_atual'] ) {
			$cand->setSenha( $_POST['nova_senha'] );		
		} else {
			$_SESSION ['message'] = 'Sua senha atual informada está inválida.';
			$_SESSION ['type'] = 'danger';
		}
		
		echo "<script>window.location.replace('" . BASEURL . "candidato/novasenha.php');</script>";
	}
	
	?>

<div class="container" style="padding-top:20px;">
<div class="row">
            <div class="col-lg-8 col-lg-offset-2">
	            <form id="altpassForm" method="post" class="form-horizontal" action="?go=altpass">
                    <div class="panel-group" id="steps">
                        <!-- Step 1 -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#steps" href="#stepOne">Alterar Senha</a></h4>
                            </div>
                            <div id="stepOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Senha Atual</label>
                                        <div class="col-lg-4">
                                            <input type="password" class="form-control" name="senha_atual" data-toggle="password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nova Senha</label>
                                        <div class="col-lg-4">
                                            <input type="password" class="form-control" name="nova_senha" data-toggle="password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Confirmar Senha</label>
                                        <div class="col-lg-4">
                                            <input type="password" class="form-control" name="confirma_nova_senha" data-toggle="password" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-9 col-lg-offset-3">
                                            <button type="submit" class="btn btn-primary" value="Salvar">Salvar</button>
                                            <a href="<?php echo BASEURL; ?>" class="btn btn-default" >Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#altpassForm').bootstrapValidator({
        message: 'This value is not valid',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
			senha_atual: {
				validators: {
					notEmpty: {
						message: 'O campo com sua senha atual é obrigatoria'
					}
				}
			},
         	nova_senha: {
                validators: {
                    notEmpty: {
                    	message: 'O campo nova senha é obrigatória'
                    }
                }
            },
            confirma_nova_senha: {
                validators: {
                    identical: {
                        field: 'nova_senha',
                        message: 'As senhas precisam ser iguais'
                    },
                    notEmpty: {
                    	message: 'O campo de confirmação de nova senha é obrigatória'
                    }
                }
            }
        }
    }).on('error.form.bv', function(e) {
        console.log('error');

        // Active the panel element containing the first invalid element
        var $form         = $(e.target),
            validator     = $form.data('bootstrapValidator'),
            $invalidField = validator.getInvalidFields().eq(0),
            $collapse     = $invalidField.parents('.collapse');

        $collapse.collapse('show');
    });
});
</script>

<?php } else {
	// Caso não passe pela verificação, exibe a pagina não encontrada (error 404):
	
	include(NOTFOUND);

}

include(FOOTER_TEMPLATE); ?>