
<div style="margin-left:0px; margin-top:100px; min-height:500px">
    <div class="col-lg-12">
        <?php $attributes = array('id' => 'form');
             //   echo form_open('reserva/reserva/buscar',$attributes);
        ?>
        <div class="col-lg-2"></div>
         <div class="col-lg-8 cajaCabeza" style="border-radius: 15px 15px 15px 15px;padding-top:5px">
            Servicio en Línea<br>
                <label>Reserva de Horas</label>
                
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"><i class="fa fa-chevron-left" aria-hidden="true" onclick="goBack()" style="color:green; cursor: pointer"> Ver calendario</i></div>
        <div class="col-lg-7" align="center" style="margin-left:-125px">
            <label style="font-size:20px">
            <?php 
                $date = new DateTime($fecha);
                $dia = $date->format('D'); IF($dia ==='Mon')$dia='Lunes';ELSEIF($dia ==='Tue')$dia='Martes';ELSEIF($dia ==='Wed')$dia='Miercoles';ELSEIF($dia ==='Thu')$dia='Jueves';ELSEIF($dia ==='Fri')$dia='Viernes';ELSEIF($dia ==='Sat')$dia='Sabado';
                $d = $date->format('d');
                $m = $date->format('m'); IF($m === '12')$m='Diciembre';ELSEIF($m === '01')$m='Enero';ELSEIF($m === '02')$m='Febrero';ELSEIF($m === '03')$m='Marzo';
                echo $dia.', '.$d.' de '.$m;
            ?>
            </label>
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <table  class='table table-bordered table-hover table-striped data-table'>
                <thead>
                <tr>
                    <th>Hora</th>
                    <th>Profesional</th>
                    <th>Centro</th>
                    <th>Reservar</th>
                </tr>
                </thead>
                <tbody>
            <?php FOREACH($data as $item){ ;?>
                
                <tr>
                    <td align="center" style="vertical-align: middle;font-size:20px;">
                        <b>
                            <a class="tip-bottom" title="Reservar Hora" style="color:#F60" href="<?php echo base_url("reserva/reserva/confirmarReserva/" . $item['id'].'_'.$rut )?>">
                            <?php  $date = new DateTime($item['hora']); echo $date->format('H:i'); ?>
                            </a>
                        </b>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td rowspan="2" style="background-color:transparent">
                                    <?php $imgNombre=strtoupper($item['nombres']).' '.strtoupper($item['apellidoPaterno']); $imgNombre= str_replace('Ñ','N', $imgNombre); ?>
                                    <img  style="width: 70px;border-radius: 6px;box-shadow: 3px 3px 15px #888888;background: transparent;" src="<?php echo base_url();?>../assets/img/prestadores/<?php echo $imgNombre?>.jpg"  onerror="this.src='<?php echo base_url();?>../assets/img/prestadores/Medico-icono-150x150.png';"/>
                                </td>
                                <td style="padding: 10px;background-color:transparent">
                                    <label>
                                    <?php IF($especialidad==='1')echo ' Dr(a). '?>
                                    <?php echo strtoupper($item['nombres']).' '.strtoupper($item['apellidoPaterno']).' '.strtoupper($item['apellidoMaterno']);?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px">
                                    <?php 
                                                IF(!empty($item['descripcion']))$descripcion =$item['descripcion'] ; 
                                                ELSEIF($especialidad==='1') $descripcion ='Médico Psíquiatra';  
                                                ELSEIF($especialidad==='2') $descripcion ='Psícologo Clínico';  
                                                echo ' '.$descripcion;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td align=center style="vertical-align: middle">
                        <?php IF($centro==='1')echo 'Providencia'; ELSEIF($centro==='2')echo 'Rancagua'; IF($centro==='3')echo 'Concepción';//echo $centro->centro; ?>
                    </td>
                    <td align="center" style="vertical-align: middle">
                        <a class="tip-bottom" title="Reservar Hora" href="<?php echo base_url("reserva/reserva/confirmarReserva/" . $item['id'].'_'.$rut )?>"><img  style="width: 110px; border-radius: 6px;box-shadow: 3px 3px 15px #888888;background: transparent;" src="<?php echo base_url();?>../assets/img/reservar.png"  />
                               </a>
                                    
                    </td>
                </tr>
            <?php } ?>
                </tbody>
                   
            </table>
        </div>
        
       
</div>
    
</div>
<script src="<?php echo base_url(); ?>../assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/hs.tables.js"></script>
<script>
    function goBack()
    {
        window.history.go(-1);
    }
</script>