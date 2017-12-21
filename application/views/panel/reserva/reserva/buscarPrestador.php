
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
        <div class="col-lg-1"><i class="fa fa-chevron-left" aria-hidden="true" onclick="goBack()" style="color:green; cursor: pointer"></i></div>
        <div class="col-lg-7" align="center">
            <label style="font-size:20px">
            <?php 
                $date = new DateTime($fecha);
                $dia = $date->format('D'); IF($dia ==='Mon')$dia='Lunes';ELSEIF($dia ==='Tue')$dia='Martes';ELSEIF($dia ==='Wed')$dia='Miercoles';ELSEIF($dia ==='Thu')$dia='Jueves';ELSEIF($dia ==='Fri')$dia='Viernes';ELSEIF($dia ==='Sat')$dia='Sabado';
                $d = $date->format('d');
                $m = $date->format('m'); IF($m === '12')$m='Diciembre';ELSEIF($m === '1')$m='Enero';
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
                    <td align="center">
                        <?php  $date = new DateTime($item['hora']); echo $date->format('H:i'); ?>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <img  style="width: 70px" src="<?php echo base_url();?>../assets/img/prestadores/<?php echo strtoupper($item['nombres']).' '. strtoupper($item['apellidoPaterno'])?>.jpg"  onerror="this.src='<?php echo base_url();?>../assets/img/prestadores/Medico-icono-150x150.png';"/>
                                </td>
                                <td>
                                    <label>
                                    <?php IF($especialidad==='1')echo ' Dr(a). '?>
                                    <?php echo strtoupper($item['nombres']).' '. strtoupper($item['apellidoPaterno']).' '. strtoupper($item['apellidoMaterno']);?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php IF(!empty($item['descripcion']))$descripcion =$item['descripcion'] ; 
                                                ELSEIF($especialidad==='1') $descripcion ='Médico Psiquiatra';  
                                                ELSEIF($especialidad==='2') $descripcion ='Psicologo';  
                                                echo ' '.$descripcion;?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <?php IF($centro==='1')echo 'Providencia'; ELSEIF($centro==='2')echo 'Rancagua'; IF($centro==='3')echo 'Concepción';//echo $centro->centro; ?>
                    </td>
                    <td align="center">
                        <a class="tip-bottom" title="Reservar Hora" href="<?php echo base_url("reserva/reserva/confirmarReserva/" . $item['id'].'_'.$rut )?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    
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