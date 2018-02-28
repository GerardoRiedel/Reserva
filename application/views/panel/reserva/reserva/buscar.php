<link rel='stylesheet' href='<?php echo base_url(); ?>../assets/fullcalendar-2.6.1/fullcalendar.css' />
<script src='<?php echo base_url(); ?>../assets/fullcalendar-2.6.1/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>../assets/fullcalendar-2.6.1/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>../assets/fullcalendar-2.6.1/fullcalendar.js'></script>
<script src='<?php echo base_url(); ?>../assets/fullcalendar-2.6.1/lang/es.js'></script>


<script>
$(document).ready(function() {
  
    
    var especialidad = $("#especialidad").val();
    var centro = $("#centro").val();
    var rut = $("#rut").val();	
                                $.ajax({
                                            type: "GET",
                                            url: "<?php echo base_url(); ?>" + "api/horas/index/"+especialidad+"_"+centro+"_"+rut,
                                            dataType: 'json',
                                            success: function(data){
                                                    var calendar = $('#calendar').fullCalendar({
                                                        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                                                            events: data,
                                                 //          dayClick: function(date, jsEvent, view) {
                                                   //                   window.location.assign('detalleDia/' + date.format()+'_'+rut+'_'+especialidad+'_'+centro);
                                                  //                    $(this).css('background-color', 'green');
                                                   //         }
                                                   })
                                            }
                                        });
});
</script>
<style type='text/css'>
            #calendar {
                width: 100%;
                height: 100%;
                margin: 0 auto;
            }
</style>
<div class="noCelular" style="margin-top: -88px"></div>
<div class="col-lg-12"></div>
<div class="col-lg-12">
    <br>
    <div class="col-lg-2"></div>
    <div class="col-lg-8 cajaCabeza" style="border-radius: 15px 15px 15px 15px;padding-top:15px">            
        <label>Reserva de Horas en Línea</label>
    </div>
    <div class="col-lg-12"><br></div>
    <input type="hidden" id="especialidad" value="<?php IF(!empty($especialidad) && $especialidad !== 'Selecciona Área Médica')echo $especialidad; ELSEIF(!empty($data[1]['especialidad']))echo $data[1]['especialidad']; ?>">
    <input type="hidden" id="centro" value="<?php echo $centro;?>">
    <input type="hidden" id="rut" value="<?php echo $rut;?>">
    <input type="hidden" id="data" value="<?php IF(!empty($data[1]['nombres']))echo $data[1]['nombres'];ELSE echo '0';?>">
    <div class="col-lg-2"></div>
    <div class="col-lg-1" onclick="goBack()" style="color:green; cursor: pointer"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</div>
        <?php IF(!empty($data)){ ?>
        <div class="col-lg-12"></div>
		<div class="col-lg-2"></div>
		<div class="col-lg-8" id="prestador">
			<div align="center">
				<table style="width:100%">
					<tr>
						<td align="center" style="width: 250px">
                        <?php $imgNombre=strtoupper($data[1]['nombres']).' '.strtoupper($data[1]['apellidoPaterno']); $imgNombre= str_replace('Ñ','N', $imgNombre); ?>
						<img  style="width: 200px;border-radius: 10px;box-shadow: 8px 8px 15px #888888;background: #888888;" src="<?php echo base_url();?>../assets/img/prestadores/<?php echo $imgNombre?>.jpg"  onerror="this.src='<?php echo base_url();?>../assets/img/prestadores/Medico-icono-150x150.png';"/>
						</td>
						<td>
							<label style="font-size:20px">
                            <?php IF($data[1]['especialidad']==='1')echo ' Dr(a). '?>
                            <?php echo strtoupper($data[1]['nombres']).' '. strtoupper($data[1]['apellidoPaterno']).' '. strtoupper($data[1]['apellidoMaterno']); ?></label>
                            <br>
                            <label>Especialidad: </label>
                            <?php  
                                IF(!empty($data[1]['descripcion']))$descripcion =$data[1]['descripcion'] ; 
                                ELSEIF($especialidad==='1') $descripcion ='Médico Psíquiatra Adultos';  
                                ELSEIF($especialidad==='10') $descripcion ='Médico Psíquiatra Infantil-Adolecente';  
                                ELSEIF($especialidad==='2') $descripcion ='Psícologo Clínico Adultos';  
                                ELSEIF($especialidad==='8') $descripcion ='Psícologo Clínico Infantíl';  
                                ELSEIF($especialidad==='7') $descripcion ='Psicopedagoga';  
                                ELSEIF($especialidad==='4') $descripcion ='Terapeuta Ocupacional';  
                                ELSE $descripcion=$especialidad;
                            echo ' '.$descripcion;
                            ?>
                            <br>
                            <label>Centro: </label>
                                <?php IF($centro==='1')echo 'Providencia.'; ELSEIF($centro==='2')echo 'Rancagua.'; IF($centro==='3')echo 'Concepción.';?>
                            <br>
                            <hr style="height: 3px; background-color: rgb(52, 180, 77)">
						</td>
					</tr>
				</table>            
			</div>
			<div class="col-lg-12"></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
                <table class='table table-bordered table-hover table-striped data-table'>
                    <thead>
                        <tr>
                            <td style="display:none"></td>
                            <td>Día</td>
                            <td>Hora</td>
                            <td>Reservar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php FOREACH($data as $item){ ?>
                        <?php 
                                $date = new DateTime($item['hora']);
                                $dia = $date->format('D'); IF($dia ==='Mon')$dia='Lunes';ELSEIF($dia ==='Tue')$dia='Martes';ELSEIF($dia ==='Wed')$dia='Miercoles';ELSEIF($dia ==='Thu')$dia='Jueves';ELSEIF($dia ==='Fri')$dia='Viernes';ELSEIF($dia ==='Sat')$dia='Sabado';
                                $d = $date->format('d');
                                $hora = $date->format('H:i');
                                $m = $date->format('m'); IF($m === '12')$m='Diciembre';ELSEIF($m === '01')$m='Enero';ELSEIF($m === '02')$m='Febrero';ELSEIF($m === '03')$m='Marzo';

                       ?>
                        <tr>
                            <td style="display: none"><?php  echo $date->format('Y-m-d'); ?></td>
                            <td align="left" style="padding-left:100px"><?php  echo $dia.', <b style="color:#F60";>'.$d.'</b> de '.$m; ?></td>
                            <td align="center" style="font-size:20px;color:#F60;"><b><?php  echo $hora; ?></b></td>
                            <td align="center">
                              <a class="tip-bottom" title="Reservar Hora" href="<?php echo base_url("reserva/reserva/confirmarReserva/" . $item['id'].'_'.$rut )?>"><img  style="width: 110px; border-radius: 6px;box-shadow: 8px 8px 15px #888888;background: #888888;" src="<?php echo base_url();?>../assets/img/reservar.png"  /></a>
                          </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
          </div>
      </div>
      </div>      
      <?php } ;?>
      <div class="col-lg-12"></div>
      <div class="col-lg-3"></div>
      <div class="col-lg-7">
          <?php IF(!empty($data[1]['espNombre'])){ ?>
          <br><br>
          <!--
          <hr style="height: 3px; background-color: rgb(52, 180, 77)">
          -->
          <div class="col-lg-12"  id="textCalendario">
          <label>Ver mas horas disponibles de <span style="color:#F60; font-size: 20px;cursor: pointer" id="buscarCalendario"><?php echo $data[1]['espNombre']; ?></span></label><br><br>
          </div>
        <?php } ELSE { ?>
          
         <?php } ?>
      </div>
      <div class="col-lg-12"></div>
      <div class="col-lg-3"></div>
      <div class="col-lg-8 celular" >
            <div id="textPrestador" style="margin-left:140px">
                <label>Seleccionar día a agendar para ver horarios disponibles </label><br><br>
            </div>
      </div>
      <div class="col-lg-12"></div>
      <div class="col-lg-2"></div>
      <div class="col-lg-8" id="calendario" >
          <div id='calendar' style="max-width:650px"></div>
      </div>             
   </div>
</div><!-- content -->
<script>
    function goBack()
    {
        window.location.assign('../');
       // window.history.go(-1);
    }
    if($("#data").val() != '0'){ $("#calendario").hide();$("#textPrestador").hide();}
    
    $("#buscarCalendario").click(function(){
		$("#calendario").show();
		$("#textCalendario").hide();
		$("#textPrestador").show();
        $("#prestador").hide();
	});
</script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/hs.tables.js"></script>