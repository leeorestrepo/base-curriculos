function maskIt(w,e,m,r,a){
	// Cancela se o evento for Backspace
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;

	// Variáveis da função
	var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
	var mask = (!r) ? m : m.reverse();
	var pre  = (a ) ? a.pre : "";
	var pos  = (a ) ? a.pos : "";
	var ret  = "";

	if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

	// Loop na máscara para aplicar os caracteres
	for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
		if(mask.charAt(x)!='#'){
			ret += mask.charAt(x); x++; } 
		else {
			ret += txt.charAt(y); y++; x++; }
	}

	// Retorno da função
	ret = (!r) ? ret : ret.reverse()	
			w.value = pre+ret+pos; }

	// Novo método para o objeto 'String'
	String.prototype.reverse = function(){
	return this.split('').reverse().join(''); };

function qtdItem(local) {
	var qtdCursoS = $(local).filter(function(idx){
		return $(this).text() != ""
	}).length - 1;
	
	$('#hiddenCursoS').val(qtdCursoS);

}

function showArea(campo, item) {
 
	if ( $(campo).is(':hidden') ) {
		$(campo).show();
		if (item) $(item).text('-');
	} else if ( $(campo).is(':visible') ) {
		$(campo).hide();
		if (item) $(item).text('+');
	}

}

function checkThisBox(item, hidden = null) {

	if ( $(item).is(':checked') ) {
		$(item).val('1');
		if (hidden) $(hidden).val('1');
	} else {
		$(item).val('0');
		if (hidden) $(hidden).val('0');
	}
}

function getEndereco(id) {
	
	var cep = document.getElementById(id).value;
	
    // Se o campo CEP não estiver vazio
    if($.trim(cep) != ""){
         /*
              Para conectar no serviço e executar o json, precisamos usar a função
              getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
              dataTypes não possibilitam esta interação entre domínios diferentes
              Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
              http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
         */
         $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(),
function(){
            // o getScript dá um eval no script, então é só ler!
            //Se o resultado for igual a 1
            if(  resultadoCEP["resultado"] ){
            // troca o valor dos elementos
            	$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
            	$("#bairro").val((unescape(resultadoCEP["bairro"])));
            	//$("#cidade").val("");
            	//$("#cidade").val((unescape(resultadoCEP["cidade"])));
            	//$("#enderecoCompleto").show("slow");
            }else{
               return false;
            }
          });
       }
}

/** APP FUNCTIONS**/
function formatar(mascara, documento){
var i = documento.value.length;
var saida = mascara.substring(0,1);
var texto = mascara.substring(i);

if (texto.substring(0,1) != saida){
        documento.value += texto.substring(0,1);
}

}

function idade (){
var data=document.getElementById("dtnasc").value;
var dia=data.substr(0, 2);
var mes=data.substr(3, 2);
var ano=data.substr(6, 4);
var d = new Date();
var ano_atual = d.getFullYear(),
    mes_atual = d.getMonth() + 1,
    dia_atual = d.getDate();
    
    ano=+ano,
    mes=+mes,
    dia=+dia;
    
var idade=ano_atual-ano;

if (mes_atual < mes || mes_atual == mes_aniversario && dia_atual < dia) {
    idade--;
}
return idade;
}

function exibe(i) {
	document.getElementById(i).readOnly= true;
}

function desabilita(i){

 document.getElementById(i).disabled = true;    
}
function habilita(i)
{
    document.getElementById(i).disabled = false;
}


function showhide() {
   var div = document.getElementById("newpost");
   
   if(idade()>=18){

div.style.display = "none";
}
else if(idade()<18) {
div.style.display = "inline";
}

}

/** PAINEIS DO CADASTRO **/
function showPanel(){
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function() {

		this.classList.toggle("active");
		var panel = this.nextElementSibling;

			if (panel.style.maxHeight){
				panel.style.maxHeight = null;
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
			} 
		}
	}
}

function inputNumber(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}

function getDate(){
    return new Date();
}

function formatDate(data) {
    var dia = data.getDate();
    if (dia.toString().length == 1)
      dia = "0"+dia;
    var mes = data.getMonth()+1;
    if (mes.toString().length == 1)
      mes = "0"+mes;
    var ano = data.getFullYear();  
    return dia+"/"+mes+"/"+ano;
}

$(document).ready(function() {
	$('#defaultForm').bootstrapValidator({
        message: 'Verifique se o campo está preenchido corretamente',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

        	/** DADOS PESSOAIS **/
        	candidato_nome: {
                validators: {
                    notEmpty: {
                        message: 'O campo nome é obrigatório'
                    },
                    regexp: {
                        regexp: /^[a-záàâãéèêíïóôõöúçñ ]+$/i,
                        message: 'O nome só pode consistir em caracteres alfabéticos'
                    }
                }
            },
            candidato_cpf: {
            	validators: {
            		notEmpty: {
            			message: 'O campo CPF é obrigatório'
            		},
            		callback: {
            			message: 'Informe um CPF válido',
            			callback: function(value) {

            				// Retirar máscarar e não-númerais   
            				cpf = value.replace(/[^\d]+/g,'');

            				if(cpf == '') return false;
					
            				if (cpf.length != 11) return false;
					       
            				// Verificar se os 11 digitos são iguais, que não pode.
            				var valido = 0; 
            				
            				for (i=1; i < 11; i++){
            					if (cpf.charAt(0)!=cpf.charAt(i)) valido = 1;
        					}
            				
            				if (valido==0) return false;
					             
					       // Calcular primeira parte  
            				aux = 0;
            				
            				for (i=0; i < 9; i ++)       
            					aux += parseInt(cpf.charAt(i)) * (10 - i);  
            				check = 11 - (aux % 11);
            				
            					if (check == 10 || check == 11)     
            						check = 0;    
            					if (check != parseInt(cpf.charAt(9)))     
            						return false;      

					       // Calcular segunda parte  
            				aux = 0;    
            				
            				for (i = 0; i < 10; i ++)        
            					aux += parseInt(cpf.charAt(i)) * (11 - i);  
            					check = 11 - (aux % 11);  
            				
            					if (check == 10 || check == 11) 
            						check = 0;    
            					if (check != parseInt(cpf.charAt(10)))
            						return false;       
            					return true; 
            			}
            		}
            	}
            },
            candidato_data_nasc: {
            	validators: {
            		notEmpty: {
                        message: 'O campo data de nascimento é obrigatória'
                    },
                    callback: {
            			message: 'Informe uma data de nascimento válida',
            			callback: function(value) {
            				if (value.length > 9){
            					var d_nasc = value.split("/")
            					d_nasc = new Date(d_nasc[2], d_nasc[1] - 1, d_nasc[0]);
            					var d_atual = getDate();
            					d_atual.setYear(d_atual.getFullYear() - 14);

	            			    if ( d_nasc >= d_atual || d_nasc.getFullYear() < 1900) return false;
	            			    else return true;
	            			    
            				} else {
            					return false;
            				}
            			}
            		}
                }
            },
            candidato_sexo: {
                validators: {
                    notEmpty: {
                        message: 'O campo sexo é obrigatório'
                    }
                }
            },
            candidato_estado_civil: {
                validators: {
                    notEmpty: {
                        message: 'O campo estado civil é obrigatório'
                    }
                }
            },
            candidato_filhos: {
                validators: {
                    notEmpty: {
                        message: 'O campo filhos é obrigatório'
                    }
                }
            },
            candidato_nacionalidade: {
                validators: {
                    notEmpty: {
                        message: 'O campo nacionalidade é obrigatória'
                    }
                }
            },
            candidato_senha: {
                validators: {
                    notEmpty: {
                    	message: 'O campo senha é obrigatória'
                    }
                }
            },
            candidato_confirmar_senha: {
                validators: {
                    identical: {
                        field: 'candidato_senha',
                        message: 'As senhas precisam ser iguais'
                    },
                    notEmpty: {
                    	message: 'O campo de confirmação de senha é obrigatória'
                    }
                }
            },
            
            /** ENDEREÇO **/
            candidato_cep: {
                validators: {
                    notEmpty: {
                        message: 'O campo CEP é obrigatório'
                    }
                }
            },
            candidato_endereco: {
                validators: {
                    notEmpty: {
                        message: 'O campo endereço é obrigatório'
                    }                    	
                }
            },
            candidato_endereco_numero: {
            	validators: {
            		notEmpty: {
            			message: 'O campo número é obrigatório'
            		}
            	}
            },
            candidato_bairro: {
            	validators: {
            		notEmpty: {
            			message: 'O campo bairro é obrigatório'
            		}
            	}
            },
            candidato_cidade: {
            	validators: {
            		notEmpty: {
            			message: 'O campo cidade é obrigatório'
            		}
            	}
            },
            candidato_estado: {
            	validators: {
            		notEmpty: {
            			message: 'O campo estado é obrigatório'
            		}
            	}
            },

            /** CONTATO **/
            candidato_email: {
        		validators: {
        		    notEmpty: {
        		    	message: 'O campo e-mail é obrigatório'
        		    },
        			emailAddress: {
        		        message: 'Informe um e-mail válido'
        		    }
        		}
            },
            candidato_celular: {
        		validators: {
        		    notEmpty: {
        		    	message: 'O campo celular é obrigatório'
        		    },
        			phone: {
        				country: 'BR',
        		        message: 'Informe um número de celular válido'
        		    }
        		}
            },
            candidato_preferencia_contato: {
        		validators: {
        		    notEmpty: {
        		    	message: 'O campo preferência de contato é obrigatório'
        		    }
        		}
            },
            
            /** DEFICIENCIA **/
            candidato_deficiente: {
            	validators: {
            		notEmpty: {
            			message: 'É obrigatório informar se possui ou não algum tipo de deficiência'
            		},
            		callback: {
            			callback: function(value) {
            				if (value == 1){
            					$('#deficiencia').show();
            					return true;
            				} else {
            					$('#deficiencia').hide();
            					return true;
            				} 
            			}
            		}
            	}
            },
            deficiencia: {
            	validators: {
            		callback: {
            			message: 'Você informou que possui algum tipo de deficiencia, especifique qual',
            			callback: function(value){
            				if ( $('#deficiente').val() == 1 ){
            					if ($("#auditiva").is(':checked') || $("#fala").is(':checked') || $("#fisica").is(':checked') || $("#mental").is(':checked') || $("#visual").is(':checked') ) return true;
            						else return false;
            				} else if ( $('#deficiente').val() == 0 ) {
            					return true;
            				} else {
            					return false;
            				}
            			}
            		}
            	}
            },
            
            /** OBJETIVOS **/
            candidato_objetivo: {
            	validators: {
            		notEmpty: {
            			message: 'O campo objetivo é obrigatório'
            		}
            	}
            },
            candidato_setor1: {
            	validators: {
            		notEmpty: {
            			message: 'O campo setor é obrigatório'
            		}
            	}
            },
            candidato_cargo1: {
            	validators: {
            		notEmpty: {
            			message: 'O campo cargo é obrigatório'
            		}
            	}
            },
            candidato_nivel_interesse: {
            	validators: {
            		notEmpty: {
            			message: 'O campo nivel é obrigatório'
            		}
            	}
            },
            candidato_pretensao_salarial: {
            	validators: {
            		notEmpty: {
            			message: 'O campo de pretensão salarial é obrigatório'
            		}
            	}
            },
            candidato_regiao_interesse: {
            	validators: {
            		callback: {
            			message: 'É obrigatório informar pelo menos 1 região de interesse',
            			callback: function(value){
        					if ($("#regiao_sp").is(':checked') || $("#regiao_abc").is(':checked') || $("#regiao_barueri").is(':checked') ) return true;
        						else return false;
        				}
        			}
        		}
        	},
        	
        	/** Formação Acadêmica **/
        	candidato_nivel_escolaridade: {
        		validators: {
        			notEmpty: {
        				message: 'O campo nivel escolaridade é obrigatório'
        			}
        		}
        	},
        	
        	/** Idiomas **/
        	idioma_nivel_leitura1: {
        		validators: {
        			notEmpty: {
        				message: 'É obrigatório informar seu nível de leitura neste idioma'
        			}
        		}
        	},
        	
        	idioma_nivel_escrita1: {
        		validators: {
        			notEmpty: {
        				message: 'É obrigatório informar seu nível de escrita neste idioma'
        			}
        		}
        	},
        	
        	idioma_nivel_conversacao1: {
        		validators: {
        			notEmpty: {
        				message: 'É obrigatório informar seu nível de conversação neste idioma'
        			}
        		}
        	},
        	
        	/** Experiência Profissional **/
        	primeiro_emprego: {
            	validators: {
            		notEmpty: {
            			message: 'É obrigatório informar se esse seria ou não seu primeiro emprego'
            		},
            		callback: {
            			callback: function(value) {
            				if (value == 2){
            					$('#trabalhou').show();
            					return true;
            				} else {
            					$('#trabalhou').hide();
            					return true;
            				} 
            			}
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

$(document).ready(function() {
	$('#forgot-pass-form').bootstrapValidator({
        message: 'Verifique se o campo está preenchido corretamente',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	recover_cpf: {
            	validators: {
            		notEmpty: {
            			message: 'O campo CPF é obrigatório'
            		},
            		callback: {
            			message: 'Informe um CPF válido',
            			callback: function(value) {

            				// Retirar máscarar e não-númerais   
            				cpf = value.replace(/[^\d]+/g,'');

            				if(cpf == '') return false;
					
            				if (cpf.length != 11) return false;
					       
            				// Verificar se os 11 digitos são iguais, que não pode.
            				var valido = 0; 
            				
            				for (i=1; i < 11; i++){
            					if (cpf.charAt(0)!=cpf.charAt(i)) valido = 1;
        					}
            				
            				if (valido==0) return false;
					             
					       // Calcular primeira parte  
            				aux = 0;
            				
            				for (i=0; i < 9; i ++)       
            					aux += parseInt(cpf.charAt(i)) * (10 - i);  
            				check = 11 - (aux % 11);
            				
            					if (check == 10 || check == 11)     
            						check = 0;    
            					if (check != parseInt(cpf.charAt(9)))     
            						return false;      

					       // Calcular segunda parte  
            				aux = 0;    
            				
            				for (i = 0; i < 10; i ++)        
            					aux += parseInt(cpf.charAt(i)) * (11 - i);  
            					check = 11 - (aux % 11);  
            				
            					if (check == 10 || check == 11) 
            						check = 0;    
            					if (check != parseInt(cpf.charAt(10)))
            						return false;       
            					return true; 
            			}
            		}
            	}
            },
            recover_nasc: {
            	validators: {
            		notEmpty: {
                        message: 'O campo data de nascimento é obrigatória'
                    },
                    callback: {
            			message: 'Informe uma data de nascimento válida',
            			callback: function(value) {
            				if (value.length > 9){
            					var d_nasc = value.split("/")
            					d_nasc = new Date(d_nasc[2], d_nasc[1] - 1, d_nasc[0]);
            					var d_atual = getDate();
            					d_atual.setYear(d_atual.getFullYear() - 14);

	            			    if ( d_nasc >= d_atual || d_nasc.getFullYear() < 1900) return false;
	            			    else return true;
	            			    
            				} else {
            					return false;
            				}
            			}
            		}
                }
            },
            recover_email: {
        		validators: {
        		    notEmpty: {
        		    	message: 'O campo e-mail é obrigatório'
        		    },
        			emailAddress: {
        		        message: 'Informe um e-mail válido'
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

$(document).ready(function() {
	$('#access-form').bootstrapValidator({
        message: 'Verifique se o campo está preenchido corretamente',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	cpf: {
            	validators: {
            		notEmpty: {
            			message: 'O campo CPF é obrigatório'
            		},
            		callback: {
            			message: 'Informe um CPF válido',
            			callback: function(value) {

            				// Retirar máscarar e não-númerais   
            				cpf = value.replace(/[^\d]+/g,'');

            				if(cpf == '') return false;
					
            				if (cpf.length != 11) return false;
					       
            				// Verificar se os 11 digitos são iguais, que não pode.
            				var valido = 0; 
            				
            				for (i=1; i < 11; i++){
            					if (cpf.charAt(0)!=cpf.charAt(i)) valido = 1;
        					}
            				
            				if (valido==0) return false;
					             
					       // Calcular primeira parte  
            				aux = 0;
            				
            				for (i=0; i < 9; i ++)       
            					aux += parseInt(cpf.charAt(i)) * (10 - i);  
            				check = 11 - (aux % 11);
            				
            					if (check == 10 || check == 11)     
            						check = 0;    
            					if (check != parseInt(cpf.charAt(9)))     
            						return false;      

					       // Calcular segunda parte  
            				aux = 0;    
            				
            				for (i = 0; i < 10; i ++)        
            					aux += parseInt(cpf.charAt(i)) * (11 - i);  
            					check = 11 - (aux % 11);  
            				
            					if (check == 10 || check == 11) 
            						check = 0;    
            					if (check != parseInt(cpf.charAt(10)))
            						return false;       
            					return true; 
            			}
            		}
            	}
            },
            pwd: {
                validators: {
                    notEmpty: {
                    	message: 'O campo senha é obrigatória'
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

$(document).ready(function() {
	$('#index-form').bootstrapValidator({
        message: 'Verifique se o campo está preenchido corretamente',
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	cpf: {
            	validators: {
            		notEmpty: {
            			message: 'O campo CPF é obrigatório'
            		},
            		callback: {
            			message: 'Informe um CPF válido',
            			callback: function(value) {

            				// Retirar máscarar e não-númerais   
            				cpf = value.replace(/[^\d]+/g,'');

            				if(cpf == '') return false;
					
            				if (cpf.length != 11) return false;
					       
            				// Verificar se os 11 digitos são iguais, que não pode.
            				var valido = 0; 
            				
            				for (i=1; i < 11; i++){
            					if (cpf.charAt(0)!=cpf.charAt(i)) valido = 1;
        					}
            				
            				if (valido==0) return false;
					             
					       // Calcular primeira parte  
            				aux = 0;
            				
            				for (i=0; i < 9; i ++)       
            					aux += parseInt(cpf.charAt(i)) * (10 - i);  
            				check = 11 - (aux % 11);
            				
            					if (check == 10 || check == 11)     
            						check = 0;    
            					if (check != parseInt(cpf.charAt(9)))     
            						return false;      

					       // Calcular segunda parte  
            				aux = 0;    
            				
            				for (i = 0; i < 10; i ++)        
            					aux += parseInt(cpf.charAt(i)) * (11 - i);  
            					check = 11 - (aux % 11);  
            				
            					if (check == 10 || check == 11) 
            						check = 0;    
            					if (check != parseInt(cpf.charAt(10)))
            						return false;       
            					return true; 
            			}
            		}
            	}
            },
            pwd: {
                validators: {
                    notEmpty: {
                    	message: 'O campo senha é obrigatória'
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