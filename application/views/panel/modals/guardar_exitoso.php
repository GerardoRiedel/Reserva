<html>
<head>
   <meta charset="utf-8">
   <title>Mostrar Ventane Modal de forma Automático</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
          setTimeout(function() {window.location.href='http://www.cetep.cl/web/?page_id=39'}, 2000);
         
      });
    </script>
</head>
<body  style="opacity: 0.8">
    <div class="modal-dialog" id="mostrarmodal">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Confirmación Exitosa</h3>
           </div>
           <div class="modal-body">
              <h4>Muchas gracias por reservar su hora medica con Cetep</h4>
              Se ha enviado un correo con los datos de su cita a su correo
              <br>
              
              
       </div>
           <div class="modal-footer">
          <a href="http://www.cetep.cl/web/?page_id=39" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</body>
</html>
