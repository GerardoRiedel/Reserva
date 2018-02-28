
<div style="margin-left:0px; margin-top:65px; min-height:500px">
    <div class="col-lg-12">
        <?php $attributes = array('id' => 'form');
                echo form_open('reserva/reserva/buscar',$attributes);
        ?>
        <div class="noCelular" style="margin-top: -130px"></div>
        <div class="col-lg-2"></div>
        
        <div class="col-lg-8 cajaCabeza" style="border-radius: 15px 15px 15px 15px;padding-top:15px">
            <div align="left" class="noCelular" style="position:absolute; top:7px"><img src="<?php echo base_url();?>../assets/img/logo_vertical_cetep.png" style="width: 50px"/></div>
            <label>Reserva de Horas en Línea</label>
        </div>
        <div class="celular">
            <div class="col-lg-12"><br></div>
            <div class="col-lg-2"></div>
            <div class="col-lg-2 cajaCabeza" align="center" >
                <br>
                <img src="<?php echo base_url();?>../assets/img/1.png" style="width: 30px; margin-top:-6px;margin-left:-6px"/>
                <label>Seleccione Área Médica</label>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2 cajaCabeza" align="center">
                <br>
                <img src="<?php echo base_url();?>../assets/img/2.png" style="width: 30px; margin-top:-6px;margin-left:-6px"/>
                <label>Seleccione Ubicación</label>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2 cajaCabeza" align="center">
                <br>
                <img src="<?php echo base_url();?>../assets/img/3.png" style="width: 30px; margin-top:-6px;margin-left:-6px"/>
                <label>Datos del paciente</label>
            </div>
        </div>
        <div class="col-lg-12"></div>
        
        <div class="col-lg-2"></div>
        <div class="col-lg-2 caja"><br>
            <div id="esp" align="center">
            <select name="especialidad" required id="especialidad" style="width: 200px">
                <option>Seleccionar Área Médica</option>
                <?php FOREACH($especialidad as $item){ ?>
                    <option value="<?php echo $item->id ?>"><?php echo $item->especialidad;?></option>
                <?php } ?>
            </select>
                <br><br>
                <span id="buscarPrestador" style="cursor: pointer" >ó buscar por prestador</span>
                <img class="icon" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="icon" style="margin-left:-0px;margin-top:-5px"/>
            </div>
            <div id="pre" align="center" >
            <select name="prestador" required id="prestador" style="width: 200px" >
                <option>Seleccionar Prestador</option>
                <?php FOREACH($prestador as $item){ ?>
                    <option value="<?php echo $item->id ?>"><?php echo strtoupper($item->apellidoPaterno).' '.strtoupper($item->apellidoMaterno).' '.strtoupper($item->nombres);  ?></option>
                <?php } ?>
            </select>
                 <br><br>
                 
                 <span id="buscarEspecialidad" style="cursor: pointer">ó buscar por especialidad</span>
                 
            </div>
            
            
            
        </div>
        <div class="col-lg-1 celular"></div>
        <div class="noCelular" style="margin-top: -60px"></div>
        <div class="col-lg-2 caja"  align="center"><br class="celular">
            <div class="noCelular"style="color:#F60"  ><br>Seleccione Centro:<br></div>
            <table>
                <tr>
                    <td><input type="radio" name="centro" value="1" required checked="true"></td>
                    <td><label>&nbsp;&nbsp;Providencia</label></td>
                </tr>
                <tr><td><input type="radio" name="centro" value="2" required readonly></td>
                    <td><label>&nbsp;&nbsp;Rancagua</label></td>
                </tr>
                <tr>
                    <td><input type="radio" name="centro" value="3" required readonly></td>
                    <td><label>&nbsp;&nbsp;Concepción</label></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-1 celular"></div>
        <div class="noCelular" style="margin-top: -10px"></div>
        <div class="col-lg-2 caja"align="center"  ><br class="celular">
            <div class="noCelular" style="color:#F60" >Ingrese rut:<br></div>
            <div class="celular" ><label>ingrese rut</label><br></div>
            <input type="text" name="rut" placeholder="Ej: 12.345.678-9" id="rut" title="Ingrese rut válido">
            <img class="icon celular" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="iconRut" style="margin-left:155px;margin-top:-50px""/>
        </div>
        <div class="col-lg-12 celular"><br class="celular"></div>
        <div class="noCelular" style="margin-top: -90px"></div>
        <div class="col-lg-12" align="center">
                <?php echo form_submit('','Buscar','class="btn btn-primary btn-sm btnCetep"');?>
                <?php echo form_close();?>
        </div>
       
</div>
    
    
</div>
<script>
    $("#icon").hide();
    $("#iconRut").hide();
    $("#pre").hide();
    $("#form").submit(function () { 
       $("#icon").hide();
       $("#iconRut").hide(); 
        
       var rut = $("#rut").val();
       if($("#especialidad").val()==='Seleccionar Área Médica' && $("#prestador").val()==='Seleccionar Prestador'  ) {$("#icon").show();}
       if(rut===''){$("#iconRut").show();}
       
       
       if($("#especialidad").val()==='Seleccionar Área Médica' && $("#prestador").val()==='Seleccionar Prestador'  ) {return false;}
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
    //$("#prestador").prepend("<option selected='selected'>Seleccionar Prestador</option>");
   });
$("#buscarPrestador").click(function(){
    $("#esp").hide();
    $("#pre").show();
    //$("#especialidad").prepend("<option selected='selected'>Seleccionar Área Médica</option>");
});
function validaRut(campo){
   
	if ( campo.length == 0 ){ return false; }
	if ( campo.length < 7 ){ return false; }

	campo = campo.replace('-','')
	campo = campo.replace('.','')
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

