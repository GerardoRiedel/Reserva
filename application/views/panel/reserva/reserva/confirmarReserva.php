
<div style="margin-left:0px; margin-top:65px; min-height:500px">
    <div class="col-lg-12">
        <?php $attributes = array('id' => 'form');
               echo form_open('reserva/reserva/guardarReserva',$attributes);
        ?>
        <div class="noCelular" style="margin-top: -130px"></div>
        <input type="hidden" name="hora" value="<?php echo $data->id;  ?>">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 cajaCabeza" style="border-radius: 15px 15px 15px 15px;padding-top:15px">
            
                <label>Reserva de Horas en Línea</label>
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-1" onclick="goBack()" style="color:green; cursor: pointer"><i class="fa fa-chevron-left" aria-hidden="true" ></i> Volver<br><br></div>
        <div class="col-lg-12"></div>
        <div class="col-lg-1"></div>
        
        <div class="col-lg-3" align='center'>
            <?php $imgNombre=strtoupper($data->nombres).' '.strtoupper($data->apellidoPaterno); $imgNombre= str_replace('Ñ','N', $imgNombre); ?>
                            
            <img  style="width: 200px;border-radius: 10px;box-shadow: 8px 8px 15px #888888;background: #888888;" src="<?php echo base_url();?>../assets/img/prestadores/<?php echo $imgNombre; ?>.jpg"  onerror="this.src='<?php echo base_url();?>../assets/img/prestadores/Medico-icono-150x150.png';"/>
        </div>     
        <div class="col-lg-6"  align="left"><br>
            <label>Profesional: </label>
                <?php echo strtoupper($data->nombres).' '. strtoupper($data->apellidoPaterno).' '. strtoupper($data->apellidoMaterno);?>
            <br>
            <label>Especialidad: </label>
                <?php echo $data->especialidad;?>
            <br>
            <label>En: </label>
                <?php echo $data->direccion.' '; //  IF($data->ciudad==='1')echo 'Providencia.'; ELSEIF($data->ciudad==='2')echo 'Rancagua.'; IF($data->ciudad==='3')echo 'Concepción.';?>
            <br>
            <label>El día: </label>
                <?php 
                   $date = new DateTime($data->hora);
                   echo '<span style="color:orange;text-shadow:1px 1px #999"><b>'.$date->format('d-m-Y').'</b></span> a las <span style="color:orange;text-shadow:1px 1px #999"><b>'.$date->format('H:i').'</b></span> horas.';
                ?>
            <br>
            <hr style="height: 3px; background-color: rgb(52, 180, 77)"><br>
        </div>
        
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4"style="margin-top:-60px"><br>
            <!--Para reservar la hora, complete el siguiente formulario:-->
        </div>
         <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-3 celular" style="margin-top: -70px" align="left">
            <label style="color:orange;font-size: 18px;text-shadow:1px 1px #999">Información del Paciente</label>
        </div>
        <div class="col-lg-3 noCelular">
            <label style="color:orange;font-size: 18px;text-shadow:1px 1px #999">Información del Paciente</label>
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Rut</label>
        </div>
        <div class="col-lg-1">
            <input type="text" readonly name="rut" value="<?php echo formatearRut($rut) ?>" placeholder="Ej: 12.345.678-9">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Nombre</label>
        </div>
        <div class="col-lg-1">
            <input type="text" required name="nombre" value="<?php  IF(!empty($paciente->nombres)) echo strtoupper($paciente->nombres) ?>">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Apellido Paterno</label>
        </div>
        <div class="col-lg-1">
            <input type="text" required name="apellidoPaterno" value="<?php  IF(!empty($paciente->apellidoPaterno)) echo strtoupper($paciente->apellidoPaterno) ?>">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Apellido Materno</label>
        </div>
        <div class="col-lg-1">
            <input type="text" required name="apellidoMaterno" value="<?php  IF(!empty($paciente->apellidoMaterno)) echo strtoupper($paciente->apellidoMaterno) ?>">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Teléfono 1</label>
        </div>
        <div class="col-lg-1" >
            <input type="text" required name="telefonoFijo" pattern="[0-9]{9}" title="Ingrese telefono valido"value="<?php  IF(!empty($paciente->telefono)) echo strtoupper($paciente->telefono) ?>">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Teléfono 2</label>
        </div>
        <div class="col-lg-1">
            <input type="text" name="telefonoCelular" pattern="[0-9]{9}"  title="Ingrese telefono valido de nueve digitos"value="<?php  IF(!empty($paciente->celular)) echo strtoupper($paciente->celular) ?>">
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2" align="left">
            <label>Email de contacto</label>
        </div>
        <div class="col-lg-1">
            <input type="text" required name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="Ingrese correo valido. ej: mail@ejemplo.com" value="<?php  IF(!empty($paciente->email)) echo strtoupper($paciente->email) ?>">
        </div>
        
        
        
        
        <div class="col-lg-12"></div>
        <div class="col-lg-1"></div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-12" align="center">
                <?php echo form_submit('','Confirmar','class="btn btn-primary btn-sm btnCetep"');?>
                <?php echo form_close();?>
            <br><br>
        </div>
             
             
    
        
       
</div>
    
</div>
<?php
function formatearRut( $rut ) {
     while($rut[0] == "0") {
            $rut = substr($rut, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($rut) - 1; $i >= 0; $i--) {
            $suma += $factor * $rut[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        $rut=  $rut . $dv;
return number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );
}
?>
<script>
    function goBack()
    {
        window.history.go(-1);
    }
</script>
