
<style>
@media (max-width: 600px) {
  
  .bienvenido {
    display: none;
  }
  .perfil {
    display: none;
  }
  .inicio {
    display: none;
  }
  .porVencer{
      display: none;
  }
  .navCelu{
      letter-spacing: 0px !important;
  }
  .navCeluSession{
      display: none;
  }
  .cog{
      display: none;
  }
}
#nav-some{
            background-color:#da812e;
        }
        
</style>

        <div id="nav-some" style="border-right: none; position: fixed; z-index: 99; -moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px; max-height: 35px;top: 0;width:100%;padding-bottom: 10px;">
            
	<a id="menu-trigger" onclick="ocultar()" href="#"><i class="fa fa-bars" style=" height: 100%; width: 100px"></i></a>
	            
        <div style="float: left; letter-spacing: 2px; margin-top: -5px" class="navCeluSession">
            <ul class="btn-group" style="border-left: none;" >
                <li style="border: none;font-size: 10px" class="btn" >
                    <span id="session_timeout_cabeza" style=" background-color: transparent"></span><br>
                    <div id="div_session_timeout" class="ui-state-highlight" style="float: left; width: 100%;  font-size: 10px; text-align: center; border-radius: 5px">
                        
                        <script language="javascript" type="text/javascript">
                             var dateStamp = new Date("<?php echo date('Y-m-d H:i:s'); ?>"); // Obtener la fecha y hora actual del servidor en este formato: Sun May 23 2010 20:14:11
                             var intStamp  = Number(dateStamp); // Convertir a timestamp la fecha y hora actual del servidor
                          
                          function getTime() {
                             
                             now = new Date(intStamp); // Trabajar con el formato timestamp
                             // Obtener la fecha y hora en la que deberá terminar la sessión
                             // en mi caso, la sesión la tengo establecida a 3600 segundos
                             y2k = new Date("<?php echo date($this->session->userdata('reloj'), time() + 3600); ?>");
                             days = (y2k - now) / 1000 / 60 / 60 / 24;
                             daysRound = Math.floor(days);
                             hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
                             hoursRound = Math.floor(hours);
                             minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
                             minutesRound = Math.floor(minutes);
                             seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
                             secondsRound = Math.round(seconds);
                             sec = (secondsRound == 1) ? " segundo" : " segundos";
                             min = (minutesRound == 1) ? " minuto, " : " minutos, ";
                             hr = (hoursRound == 1) ? " hora, " : " horas, ";
                             dy = (daysRound == 1)  ? " d\355a, " : " d\355as, "
                             //document.timeForm.input1.value = "Time remaining: " + daysRound  + dy + hoursRound + hr + minutesRound + min + secondsRound + sec;
                             if (hoursRound > 1 || hoursRound === 23){
                                document.getElementById("session_timeout_cabeza").innerHTML = '<span style="color: red;">La sesi\363n ha expirado.</span>';
                                document.getElementById("session_timeout").innerHTML = '00:00' + min;
                             } else {
                                document.getElementById("session_timeout_cabeza").innerHTML = "Tiempo restante de su sesi\363n:";
                                document.getElementById("session_timeout").innerHTML = minutesRound + ':' + secondsRound + min;
                                //console.log(minutesRound + ':' + secondsRound + min);
                                newtime = window.setTimeout("getTime();", 1000);
                                intStamp = intStamp + 1000; // Para avanzar un segundo en cada iteracion a partir de la fecha y hora actual obtenida desde el servidor
                             } // endif
                          } // end function
                          window.onload=getTime;
                          //  End -->
                       </script>
                       
                       <span id="session_timeout"></span>
                    </div>
                </li>
            </ul>
        </div>
        
                            
        <div style="float: right; letter-spacing: 2px;" class="navCelu">
            <ul class="btn-group" style="border-left: none;" >
                
                
                <li style="border: 1;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px" class="bienvenido" >Bienvenido </span><strong><span style="color: #ffffff; font-size: 15px" class="bienvenido"  >&nbsp;<?php echo $this->session->userdata('nombre_completo');?></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                
                <?php IF ($this->session->userdata('contarMedicamentos') > 0 && ($this->session->userdata('perfil') === '3' || $this->session->userdata('perfil') === '4')){ ?>
                <li style="margin-top: -2px;border: none;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px" class="parpadea" ><a href="<?php echo base_url("clinica_enfermeria/medicamentos/administrar_medicamento_porVencer/")?>"                             style="color: red; font-size: 15px; text-shadow: 1px 1px 2px white;"><b>Medicamentos vencidos</b></a></span><strong class="porVencer"><span style="color: red; font-size: 19px" class="parpadea" ></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <?php }; ?>
                
                
                <?php IF ($this->session->userdata('contarLicencias') > 0 && $this->session->userdata('perfil') != '3' && $this->session->userdata('perfil') < '10'){ ?>
                <li style="margin-top: -2px;border: none;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px" class="parpadea" ><a href="<?php echo base_url("clinica_admision/ingresos/licencias/".$this->session->userdata('contarLicencias'))?>"                style="color: red; font-size: 15px; text-shadow: 1px 1px 2px white;"><b>Licencias por vencer</b></a></span><strong class="porVencer"><span style="color: red; font-size: 19px" class="parpadea" >&nbsp;<?php echo $this->session->userdata('contarLicencias');?></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <?php }; ?>
                <?php IF ($this->session->userdata('contarLicencias') > 0 && $this->session->userdata('perfil') === '3' && $this->session->userdata('perfil') < '10'){ ?>
                <li style="margin-top: -2px;border: none;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px" class="parpadea" ><a href="<?php echo base_url("clinica_enfermeria/ingresos/licencias/".$this->session->userdata('contarLicencias'))?>"                style="color: red; font-size: 15px; text-shadow: 1px 1px 2px white;"><b>Licencias por vencer</b></a></span><strong class="porVencer"><span style="color: red; font-size: 19px" class="parpadea" >&nbsp;<?php echo $this->session->userdata('contarLicencias');?></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <?php }; ?>
                <?php IF ($this->session->userdata('perfil') != '5' && $this->session->userdata('perfil') != '3' && $this->session->userdata('contarCtas') > 0 && $this->session->userdata('perfil') < '10'){ ?>
                <li style="margin-top: -2px;border: none;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px" class="parpadea" ><a href="<?php echo base_url("clinica_admision/devoluciones/cargarDepositosPorVencer/".$this->session->userdata('contarCtas'))?>"  style="color: red; font-size: 15px; text-shadow: 1px 1px 2px white;"><b>Ingresos vencidos</b></a></span>  <strong><span style="color: red; font-size: 19px" class="parpadea" >&nbsp;<?php echo $this->session->userdata('contarCtas');?></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <?php }; ?>
                <?php IF($this->session->userdata('contarMedicamentos') === 0){?>
                <!--
                <li style="border: none;font-size: 10px" class="btn activo"><span style="color: #ffffff; font-size: 15px"  class="perfil">Panel </span><strong><span style="color: #ffffff; font-size: 15px"  class="perfil">&nbsp;
                
                    <?php 
                    IF ($this->session->userdata('perfil') === '2')echo 'Admisión';
                    ELSEIF ($this->session->userdata('perfil') === '3')echo 'Paramédico';
                    ELSEIF ($this->session->userdata('perfil') === '1')echo 'Administrador';
                    ELSEIF ($this->session->userdata('perfil') === '4')echo 'Enfermería';
                    ELSEIF ($this->session->userdata('perfil') === '10')echo 'Administrador';
                    ELSEIF ($this->session->userdata('perfil') === '11')echo 'Hospital de Día';
                    ?>
                        </span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </li>
                -->
                <?php }?>   
                    
                <?php IF ($this->session->userdata('perfil') === '1'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("clinica_admin/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }ELSEIF ($this->session->userdata('perfil') === '2'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("clinica_admision/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }ELSEIF ($this->session->userdata('perfil') === '3'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("clinica_enfermeria/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }ELSEIF ($this->session->userdata('perfil') === '4'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("clinica_enfermeria/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }ELSEIF ($this->session->userdata('perfil') === '5'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("clinica_enfermeria/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }ELSEIF ($this->session->userdata('perfil') >= '11'){; ?>
                    <li style="border-right: none;font-size: 23px ;margin-top: -5px;text-align: center" class="btn cog"><a title="Editar Datos" class="tip-bottom" href="<?php echo base_url("hd_admision/modificar/cargar_usuario/".$this->session->userdata('id_usuario'))?>"><i style="color: #ffffff" class="fa fa-cog"></i> </a></li>
                <?php }; ?>
                
                  
                
                <li style="border-right: none;font-size: 10px ;text-align: center" class="btn"><a title="Cerrar la Sesión" class="tip-bottom" href="<?php echo base_url();?>login/logout_ci"><i style="color: #ffffff" class="fa fa-power-off fa-2x"></i> </a></li>
            </ul>
        </div>
        </div>
    
<script>
    $(document).ready(parpa);
        function parpa() {
            $('.parpadea').fadeIn(500).delay(250).fadeOut(500, parpa)
            setTimeout("$('.parpadea').stop(true,true).css('opacity', 1)", 10000);
        }
</script>