
<div style="margin-left:0px; margin-top:100px; min-height:500px">
    <div class="col-lg-12">
        <?php $attributes = array('id' => 'form');
                echo form_open('reserva/reserva/buscar',$attributes);
        ?>
        <div class="col-lg-2"></div>
        <div class="col-lg-8 cajaCabeza" style="border-radius: 15px 15px 15px 15px;padding-top:5px">
            Servicio en Línea<br>
                <label>Reserva de Horas</label>
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2 cajaCabeza" align="center"><br>
            <label>Selecciona Área Médica</label>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2 cajaCabeza" align="center"><br>
            <label>Selecciona Ubicación</label>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2 cajaCabeza" align="center"><br>
            <label>Ingresa datos del paciente</label>
        </div>
        <div class="col-lg-12"></div>
        
        <div class="col-lg-2"></div>
        <div class="col-lg-2 caja"><br>
            <div id="esp">
            <select name="especialidad" required id="especialidad" style="width: 200px">
                <option>Selecciona Área Médica</option>
                <?php FOREACH($especialidad as $item){ ?>
                    <option value="<?php echo $item->id ?>"><?php echo $item->especialidad; IF($item->id==='1') echo ' Adulto'; ELSEIF($item->id==='2') echo ' Adulto'; ?></option>
                    <?php IF($item->id==='1' || $item->id==='2') { ?>
                    <option value="<?php echo $item->id ?>"><?php echo $item->especialidad.' Infanto-Juvenil';  ?></option>
                   <?php } ?>
                <?php } ?>
            </select>
                <br><br>
                <span id="buscarPrestador" style="cursor: pointer">&nbsp;&nbsp;ó buscar por prestador</span>
                <img class="icon" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="icon" style="margin-left:-0px;margin-top:-5px"/>
            </div>
            <div id="pre"><br>
            <select name="prestador" required id="prestador" style="width: 300px">
                <option>Selecciona Prestador</option>
                <?php FOREACH($prestador as $item){ ?>
                    <option value="<?php echo $item->id ?>"><?php echo strtoupper($item->apellidoPaterno).' '.strtoupper($item->apellidoMaterno).' '.strtoupper($item->nombres);  ?></option>
                <?php } ?>
            </select>
                 <br><br>
                 <!--
                 <span id="buscarEspecialidad" style="cursor: pointer">&nbsp;&nbsp;ó buscar por especialidad</span>
                 -->
            </div>
            
            
            
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2 caja" ><br>
            <input type="radio" name="centro" value="1" required checked="true">  <label> Providencia</label><br>
            <input type="radio" name="centro" value="2" required>  <label> Rancagua</label><br>
            <input type="radio" name="centro" value="3" required>  <label> Concepción</label></option>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-2 caja" ><br>
            <input type="text" name="rut" placeholder="Ej: 12.345.678-9" id="rut" title="Ingrese rut valido">
            <img class="icon" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="iconRut" style="margin-left:155px;margin-top:-50px""/>
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-12" align="center">
                <?php echo form_submit('','Buscar','class="btn btn-primary btn-sm btnCetep"');?>
                <?php echo form_close();?>
        </div>
       
</div>
    
    
</div>
<script>
    $("#icon").hide();
    $("#iconRut").hide();
 //   $("#pre").hide();
    $("#form").submit(function () { 
       $("#icon").hide();
       $("#iconRut").hide(); 
        
       var rut = $("#rut").val();
       if($("#especialidad").val()==='Selecciona Área Médica' && $("#prestador").val()==='Selecciona Prestador'  ) {$("#icon").show();}
       if(rut===''){$("#iconRut").show();}
       
       
       if($("#especialidad").val()==='Selecciona Área Médica' && $("#prestador").val()==='Selecciona Prestador'  ) {return false;}
       if(rut===''){return false;}
       
       
        var validar = validaRut(rut);
        if (validar != true && rut !== ''){alert('rut invalido');return false;}
    });
   
            
     $("#rut").keyup(function (){
                if (event.keyCode == 13 || event.keyCode == 110 || event.keyCode == 190 || event.keyCode == 75 || event.keyCode > 95 && event.keyCode < 106 || event.keyCode == 27 || event.keyCode == 190 || event.keyCode == 111 || event.keyCode == 16 || event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode > 47 && event.keyCode < 58)
                {}
                else {
                texto = $( "#rut" ).val();
                texto = texto.substring(0,texto.length-1);
                document.getElementById("rut").value = texto;
                event.returnValue = false;
                }
    });
    
$("#buscarEspecialidad").click(function(){
    $("#esp").show();
    $("#pre").hide();
    $("#prestador").prepend("<option selected='selected'>Selecciona Prestador</option>");
   });
$("#buscarPrestador").click(function(){
    $("#esp").hide();
    $("#pre").show();
    $("#especialidad").prepend("<option selected='selected'>Selecciona Área Médica</option>");
});
function validaRut(campo){
   
	if ( campo.length == 0 ){ return false; }
	if ( campo.length < 7 ){ return false; }

	campo = campo.replace('-','')
	campo = campo.replace(/\./g,'')

	var suma = 0;
	var caracteres = "1234567890kK";
	var contador = 0;    
	for (var i=0; i < campo.length; i++){
		u = campo.substring(i, i + 1);
		if (caracteres.indexOf(u) != -1)
		contador ++;
	}
	if ( contador==0 ) { return false }
	
	var rut = campo.substring(0,campo.length-1)
	var drut = campo.substring( campo.length-1 )
	var dvr = '0';
	var mul = 2;
	
	for (i= rut.length -1 ; i >= 0; i--) {
		suma = suma + rut.charAt(i) * mul
                if (mul == 7) 	mul = 2
		        else	mul++
	}
	res = suma % 11
	if (res==1)		dvr = 'k'
                else if (res==0) dvr = '0'
	else {
		dvi = 11-res
		dvr = dvi + ""
	}
	if ( dvr != drut.toLowerCase() ) { return false; }
	else { return true; }
}

function formatearRut(rut){
        
        if (!rut || !rut.length || typeof rut !== 'string') {
		return -1;
	}
	// serie numerica
	var secuencia = [2,3,4,5,6,7,2,3];
	var sum = 0;
	//
	for (var i=rut.length - 1; i >=0; i--) {
		var d = rut.charAt(i)
		sum += new Number(d)*secuencia[rut.length - (i + 1)];
	};
	// sum mod 11
        
	var rest = 11 - (sum % 11);
	// si es 11, retorna 0, sino si es 10 retorna K,
	// en caso contrario retorna el numero
	rest === 11 ? 0 : rest === 10 ? "K" : rest;
        if(rest===10)rest='K';else if(rest===11)rest=0;
        //console.log("Rut :"+rest);
        rut = rut+rest;
    
        //console.log("Rut :"+rut);
        var sRut1 = rut;   	//contador de para saber cuando insertar el . o la -
        var nPos = 0; //Guarda el rut invertido con los puntos y el guión agregado
        var sInvertido = ""; //Guarda el resultado final del rut como debe ser
        var sRut = "";
        for(var i = sRut1.length - 1; i >= 0; i-- )
        {
            sInvertido += sRut1.charAt(i);
            if (i == sRut1.length - 1 )
                sInvertido += "-";
            else if (nPos == 3)
            {
                sInvertido += ".";
                nPos = 0;
            }
            nPos++;
        }
        for(var j = sInvertido.length - 1; j >= 0; j-- )
        {
            if (sInvertido.charAt(sInvertido.length - 1) != ".")
                sRut += sInvertido.charAt(j);
            else if (j != sInvertido.length - 1 )
                sRut += sInvertido.charAt(j);
        }
        //Pasamos al campo el valor formateado
        //console.log(sRut);
        return sRut.toUpperCase();
        //return rut
    }

</script>

