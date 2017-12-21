<html>
<head>
   <meta charset="utf-8">
   <title>Mostrar Ventana Modal de forma Automático</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   
</head>
<body  style="opacity: 0.8">
    <div class="modal-dialog" id="mostrarmodal">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Envio Exitoso...</h3>
           </div>
           <div class="modal-body">
               
                        <h4>Estimado colaborador,</h4>
                        <h4>Su respuesta a sido guardada y una copia se ha enviado al departamento de Calidad para su revisión y despacho.</h4>
                        <br>
                        <h5>Gracias por su preferencia.</h5>
           </div>
           <div class="modal-footer">
              <?php IF(!empty($this->session->userdata('perfil'))) { ?>
                    <a  href="<?php echo base_url();?>login/salirIntranet" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
              <?php }ELSE{ ?>
                    <a  href="http://www.cetep.cl/intracetep" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
              
              <?php } ?>
           </div>
      </div>
   </div>
</body>
</html>