<?php
require_once 'config.php';
require_once DBAPI;

include (HEADER_TEMPLATE);

?>

<style>

.bannerOpacity {
    opacity: 0.5;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}

.bannerOpacity:HOVER {
    opacity: 1.0;
    filter: alpha(opacity=100); /* For IE8 and earlier */
}
</style>

<div id="bannerSobre" class="container-fluid" style=" margin-top:20px; cursor: pointer ">
	<div class="form-group">
		<a href="http://www.brabusmitsubishi.com.br/">
		<div class="col-md-12 text-center bannerOpacity" style=" padding: 39px; background:#e40f0a; ">
			<img src="<?php echo BASEURL; ?>images/marcaMitsubishiWhite.png" alt="Mitsubishi">
		</div></a>
	</div>
</div>

<div class="container" style="padding-left:50px;">
      <div class="row">
        <div class="col-sm-8">
          <h2 class="mt-4">A Brabus</h2>
          <p>O grupo Brabus iniciou suas atividades no ano de 1991 com a inauguração de sua primeira loja e hoje é referência entre os grupos de concessionárias no País. São mais de 500 colaboradores, entre eles 50 técnicos treinados e certificados pelas montadoras para cuidar das revisões e manutenções do seu veículo.
          <p>Esta equipe faz da Brabus hoje uma das maiores concessionárias das Américas e também a mais completa, com venda de veículos novos, seminovos, peças originais, serviços de mecânica e funilaria.</p>
          <p>Todos os serviços do mercado de veículos premium com atendimento personalizado com o objetivo de proporcionar ao cliente a melhor experiência.</p> 
          <p>
          </p>
        </div>

        <div class="col-sm-3">
			<h3 class="mt-4">Valores</h3>
			<button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#modalIntegridade">Integridade</button>
			<button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#modalComprometimento">Comprometimento</button>
			<button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#modalEmpreendedor">Espírito Empreendedor</button>
			<button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#modalPerformance">Performance</button>
			<button type="button" class="btn btn-default col-sm-6" data-toggle="modal" data-target="#modalExcelencia">Excelência</button>
			<button type="button" class="btn btn-default col-sm-6" data-toggle="modal" data-target="#modalHarmonia">Harmonia</button>
        </div>
        
        <div class="col-sm-8">
			<h2 class="mt-4">Visão</h2>
			<p>Ser reconhecida e mencionada como exemplo no país, proporcionando ao cliente a melhor experiência em termos de relacionamento com uma concessionária.</p>
		</div>
        
		<div class="col-sm-8">
			<h2 class="mt-4">Missão</h2>
			<p>Manter relacionamento transparente e ético com o cliente, valorizando profissionais engajados, que sejam obcecados pela excelência e que pratiquem diariamente o espírito de servir.</p> 
		</div>
	</div>
      <!-- /.row -->
</div>

  <!-- Modal integridade -->
  <div class="modal fade" id="modalIntegridade" role="dialog">
    <div class="modal-dialog">
      
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Integridade</h4>
	        </div>
	        <div class="modal-body">
	          <p>- Valorizamos pessoas que tenham uma conduta íntegra e ética para lidar com os clientes e colegas de trabalho.
				<br>- Nós trabalhamos com a verdade, com o cliente, superiores, pares e subordinados. 
				<br>- Utilizamos todas as informações que temos acesso de forma transparente, respeitando as regras da empresa. 
				<br>- Diante disso, quando erramos, assumimos nossos erros e focamos em buscar a melhor solução. 
				<br>- Buscamos trabalhar em um ambiente agradável e que favoreça boas relações pessoais e profissionais. 
				<br>- O compromisso com a verdade é o nosso caminho para qualidade das nossas relações. 
				<br>- Não abrimos mão da integridade em nenhuma hipótese.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
		</div>
	</div>
      
    <!-- /.integridade -->
    
    <!-- Modal comprometimento -->
	<div class="modal fade" id="modalComprometimento" role="dialog">
		<div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Comprometimento</h4>
	        </div>
	        <div class="modal-body">
				<p>- Trabalhamos com responsabilidade e com qualidade, pensando e agindo como dono da empresa. 
				<br>- O sucesso da nossa empresa depende de nós, por isso cumprimos o que prometemos e buscamos fazer o melhor possível com as ferramentas disponíveis.
				<br>- Comprometimento é vestir a camisa, e cuidar da empresa como se fosse nossa.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	    </div>
	  </div>
    <!-- /.comprometimento -->
    
    <!-- Modal espirito empreendedor -->
	<div class="modal fade" id="modalEmpreendedor" role="dialog">
		<div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Espírito Empreendedor</h4>
	        </div>
	        <div class="modal-body">
				<p>- Trabalhamos com responsabilidade e com qualidade, pensando e agindo como dono da empresa. 
				<br>- O sucesso da nossa empresa depende de nós, por isso cumprimos o que prometemos e buscamos fazer o melhor possível com as ferramentas disponíveis.
				<br>- Comprometimento é vestir a camisa, e cuidar da empresa como se fosse nossa.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	    </div>
	  </div>
    <!-- /.espirito empreendedor-->
    
    <!-- Modal performance -->
	<div class="modal fade" id="modalPerformance" role="dialog">
		<div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Performance</h4>
	        </div>
	        <div class="modal-body">
				<p>- Trabalhamos com metas desafiadoras e realizáveis. Atuamos com dedicação e esforço para sempre atingi-las e se possível superá-las.
				<br>- Buscamos sempre o melhor desempenho. Só devemos manter em nossos quadros colaboradores que frequentemente alcançam suas metas, contribuindo efetivamente com seu setor.
				<br>- Ter boa performance é fazer acontecer, acompanhando e avaliando os resultados.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	    </div>
	  </div>
    <!-- /.performance-->
    
    <!-- Modal excelência -->
	<div class="modal fade" id="modalExcelencia" role="dialog">
		<div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Excelência</h4>
	        </div>
	        <div class="modal-body">
				<p>- Apreciamos a atenção aos detalhes, e entendemos que eles contribuem para essência da nossa empresa.
				<br>- Não devemos colocar a qualidade em segundo plano, visando apenas resultado financeiro. Precisamos aliar essas duas questões.
				<br>- Almejamos a excelência em todos os processos e atividades, independente da sua complexidade ou relevância.
				<br>- A importância que atribuímos a excelência garantirá a satisfação do nosso cliente e sua fidelização com a nossa concessionária.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	    </div>
	  </div>
    <!-- /.excelência-->
    
    <!-- Modal hamornia-->
	<div class="modal fade" id="modalHarmonia" role="dialog">
		<div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center" style="padding:5px 0px 5px 30px;">Excelência</h4>
	        </div>
	        <div class="modal-body">
				<p>- Buscamos a harmonia do trabalho em equipe que cultivamos com as demais áreas da empresa. 
				<br>- Valorizamos colaboradores que buscam a satisfação e parceria nos seus setores, pois dessa forma acreditamos que podemos atingir resultados superiores. 
				<br>- Atraímos pessoas através de um ambiente saudável e acolhedor com resultados sustentáveis. 
				<br>- Espírito de equipe e comunicação entre as equipes é o que fará diferença para conseguirmos crescer com qualidade. 
				<br>- Respeitamos todos os colaboradores independente de raça, sexo, credo, idade ou orientação sexual. 
				<br>- As pessoas que trabalham conosco gostam de sorrir. Acreditamos que essa característica é indispensável para todos que trabalham no ramo do varejo. 
				<br>- Interesses individuais têm que estar alinhados aos da empresa e da equipe como um todo. 
				<br>- Queremos trabalhar com Líderes e Colaboradores, e não com generais e soldados.</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	    </div>
	  </div>
    <!-- /.harmonia-->

<?php include(FOOTER_TEMPLATE); ?>