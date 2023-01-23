<?php
require_once 'config.php';
require_once DBAPI;

include (HEADER_TEMPLATE);

?>

<div class="row">
        <div class="col-sm-12">
        <h2 class="mt-4"><span class="fa fa-map-marker"></span> Unidades</h2>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniNacoes.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 1</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniBand.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 2</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniEuropa.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 3</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniKennedy.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 4</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

		<div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniStoAndre.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 5</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniRudge.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Empresa 6</h4>
              <span class="card-text"><b>Serviços</b></span><br>
              <span class="card-text">Endereço, Número</span>
              <p><span class="card-text">Cidade, Estado</span></p>
              <p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>

<?php include(FOOTER_TEMPLATE); ?>