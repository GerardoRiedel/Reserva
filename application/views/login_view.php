<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cetep-Soluciones Sustentables en Salud Mental</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../assets/css/login_view.css" />    
    <link rel="icon" href="<?php echo base_url(); ?>../favicon.ico" type="image/x-icon"/>
    <script src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
        $('.forgot-pass').click(function(event) {
        $(".pr-wrap").toggleClass("show-pass-reset");
        }); 
        $('.pass-reset-submit').click(function(event) {
        $(".pr-wrap").removeClass("show-pass-reset");
        }); 
        });
    </script> 
    <style>

	

	.left-addon input  { padding-left:  30px; }
	.right-addon input { padding-right: 30px; }

	.login-username,
	.login-password {
		position: absolute;
		padding : 20px;
		left : 50px;
		background-repeat: no-repeat;
		background-position: 12px center;
	}

	.login-username {
		background-image: url(<?php echo base_url(); ?>../assets/img/icons/user.png);
	}

	.login-password {
		background-image: url(<?php echo base_url(); ?>../assets/img/icons/key.png);
	}

</style>
   


</head>




<body>
    	<!-- start Login box -->
        <div class="container" id="login-block" >
    		<div class="row">
			    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
		
			       <div class="login-box clearfix animated flipInY"style="background-color: #f0f0e1">
                                   <div class="login-logo" style="height:140px; padding-top: 30px">
                            <a href="#"><img src="<?php echo base_url(); ?>../assets/img/MirandesTrans.png" alt="Company Logo" width="220" /></a>
                        </div>
			        	<hr/>
                                        <?php IF(empty($recuperar)){;?>
			        	<div class="login-form">
			        	 		<form action="<?php echo base_url().'login/new_user'; ?>" method="post"  >
						            <div class="left-addon">
							            <i class="login-username"></i>
							            <input type="text" class="login-box" placeholder="Ingrese Usuario" name="username" id="usuario" required/>
						            </div>
						            <div class="left-addon">
							            <i class="login-password "></i>
						   		 <input type="password" class="login-box" placeholder="Password" name="password" id="pass" required/>
							            </div>
						   		 <p style="line-height: 70px; text-align: center;"><button type="submit" class="btn btn-success">Ingresar</button> 
                                                                     <?=form_hidden('token',$token)?>
                                                        </form>	
                                            <div align="center">
                                            <a href="<?php echo base_url().'login/forget'; ?>">Recuperar Contraseña</a>
                                            </div>	 		
			        	</div> 
                                        <?php } ELSEIF (empty($info)) {;?>
                                        <div class="login-form">
                                            <form action="<?php echo base_url().'login/doforget'; ?>" method="post"  >
                                                <div class="left-addon"><div align="center">Ingrese correo del usuario que desea recuperar</div><br>
                                                        <input type="text" class="login-box" style=" min-width: 250px"placeholder="Ingrese Email" name="email" required/>
                                                </div>
						            
						   		 <p style="line-height: 70px; text-align: center;"><button type="submit" class="btn btn-success">Enviar Email</button> 
                                                                     <?=form_hidden('token',$token)?>
                                                        </form>
                                        </div>
                                        <?php } ELSEIF (!empty($info)) {;?>
                                        <div class="login-form">
						            <div align="center"><?php echo $info;?>
							            </div>
                                                                <form action="<?php echo base_url().'login/new_user'; ?>" method="post"  >
						   		 <p style="line-height: 70px; text-align: center;"><button type="submit" class="btn btn-success">Volver</button> 
                                                                     </form>	
                                        </div>
                                        <?php };?>
			       </div>
			  	   	
			       
			    </div>
			</div>
    	</div>
     
      	<!-- End Login box -->
     	<footer class="container">
         <div class="clearfix animated bounceinUp">
     		<p class="lead" id="footer-text"><small>Copyright &copy; Cetep 2016, Todos los derechos reservados.</small></p>
            </div>
     	</footer>

        <script src="<?php echo base_url(); ?>../lib/jquery/1.11.1/jquery-1.11.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>../lib/jquery/1.11.1/jquery-1.11.1.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>../lib/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>