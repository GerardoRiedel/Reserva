<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Calendario codeigniter</title>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="<?=base_url()?>css/estilos.css" />
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/pepper-grinder/jquery-ui.css" />
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>   
      <script type="text/javascript" src="<?=base_url()?>js/funciones.js"></script>
      <style>
          .calendario{
    background: #523a45;
    color: #fff;
    padding: 10px;
    text-align: center;
    margin: auto;
    width: 60%;
    margin-top: 50px;
 }
.previo{
    background: #f2f2f2;
    border-right: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    box-shadow: inset 1px 1px 0px white;
}

.siguiente{
    background: #f2f2f2;
    border-right: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    box-shadow: inset 1px 1px 0px white;
}

.previo a{
    color:#a2a2a2;
}

.siguiente a{
    color:#a2a2a2;
}

 a{
    text-decoration:none;
}

.fecha_actual{
    font-family: helvetica, arial;
    font-weight: normal;
    padding:3%;
    text-align: center;
    color: #3E424B;
    font-size: 125%;
    background: #f2f2f2;
    border-right: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    box-shadow: inset 1px 1px 0px white;
}

.dias_semana {
    font-family: helvetica, arial; 
    font-size: 95%;
    color: #3E424B;
    background: #f2f2f2;
    border-right: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    box-shadow: inset 1px 1px 0px white;
    text-align: center;
    text-transform: uppercase;
}
.highlight {
    color: #2a2a3c;
}
ul li a{
    text-align: left;
}

.dia {
    font-family: Georgia; 
    width:8%;
    height:5%;
    color: #949494;
    font-size: 170%;
    padding: 5px;
    text-align: center;
    cursor: pointer;
    border-right: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    box-shadow: inset 1px 1px 0px white;
    background: -moz-linear-gradient(top, rgba(250,250,250,1) 0%, rgba(240,240,240,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(242,242,242,0)), color-stop(100%,rgba(240,240,240,1))); /*   Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(240,240,240,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(240,240,240,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, rgba(250,250,250,1) 0%,rgba(240,240,240,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom, rgba(250,250,250,1) 0%,rgba(240,240,240,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00f2f2f2', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
}
.dia:hover {
    background: #dcdcdc;
}


.individual {
    vertical-align: top
}

/*estilos día reservado*/


/*estilos día completo*/
#oc_11 {
    background: red;
    color: white;
    text-shadow: 1px 1px #fff;
    
    }
/*estilos días anteriores*/
#oc_ant{
    color: #d2d2d2;
    text-shadow: 1px 1px #fff;
}
/*estilos fin de semana*/
#oc_fest{
    color: #d2d2d2;
    text-shadow: 1px 1px #fff;
}
      </style>
  </head>

  <body>
    <?=$calendario?>
    <input type="hidden" value="<?=$this->uri->segment(3)?>" class="year" />
    <input type="hidden" value="<?=$this->uri->segment(4)?>" class="month" />
    <div id="midiv"></div>
  </body>
</html>

<script>
    $(document).ready(function() {
  //al pulsar en un campo del calendario
  $('.dia').on('click', function() {

    //obtenemos el número del día
    var num_dia = $(this).find('div').html();

    //citas nos da el número de citas para ese día 
    //ejemplo: 1 = solo 1 hora escogida, sobran 10 horas ese día
    var citas = $(this).find('div').attr('id');
    //console.log(citas)

    //obtenemos el día de hoy
    var hoy = $(this).find('.highlight').html();

    //si pulsamos en un cuadro que no es un día mostramos el siguiente mensaje
    if (num_dia == null) 
    {
      new_popup("Por favor, escoge un día disponible.","Error");
      return false;
    }
    //si es hoy podemos decimos que no se puede reservar para hoy
    if (hoy) 
    {
      new_popup("Hoy no se pueden hacer reservas.","Hoy");
      return false;
    }

    //obtenemos el año a través del campo oculto del formulario
    var year = $(".year").val();

    //obtenemos el mes a través del campo oculto del formulario
    var month = $(".month").val();

    //obtenemos el mes a través del campo oculto del formulario
    //y le restamos uno porque en javascript los meses igual que
    //los días empiezan en 0, si es enero debe ser 0 y no 1
    var monthjs = $(".month").val() - 1;

    //anteponemos el 0 si es un sólo número para poder trabajar
    //correctamente la fecha
    if (num_dia.lenght == 1) {
      num_dia = '0' + num_dia;
    }

    //anteponemos el 0 si es un sólo número para poder trabajar
    //correctamente la fecha
    if (month.lenght == 1) {
      month = '0' + month;
    }

    //creamos la fecha sobre la que el usuario ha pulsado
    var fecha = new Date(year, monthjs, num_dia);

    //creamos un array con los meses de año para mostrar un mensaje final
    //más útil para el usuario
    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    var mes_escogido = meses[fecha.getMonth()];

    //lo mismo que con el mes, pero con los días de la semana
    var dias_semana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    var dia_escogido = dias_semana[fecha.getDay()];

    //si es sábado o domingo, 0 es domingo y 6 es sábado en javascript
    if ((fecha.getDay() == 0) || (fecha.getDay() == 6)) 
    {

      new_popup("Sábados y Domingos festivos, escoge un dia laboral.", "Dia festivo");
      return false;

    }

    //si es un día anterior al día de hoy
    if (fecha < new Date()) 
    {
      new_popup("Escoja un dia actual.","Dia anterior");
      return false;
    }
    //si es distinto de nulo significa que hemos pulsado en un cuadro
    //del calendario que tiene número
    //si num no es null, significa que el usuario ha picado en un campo del formulario que contiene números dejamos seguir
    if (num_dia != null) {
      //si el día ya contiene el límite de visitas no permitimos insertar nuevos registros
      //de 10 a 20 incluídas van 11 horas, así que es oc_11
      if (citas == 'oc_11') 
      {
        new_popup("El " + dia_escogido + " " + num_dia + " de " + mes_escogido + " de " + year + " esta completo.","Dia completo");
        //en otro caso si
      } else {
        year = $('.year').val();
        month = $(".month").val();
        //console.log(num_dia + "-" + month + "-" + year)
        $.ajax({
          type : 'POST',
          url : 'http://localhost/calendario_ci/calendario/coger_hora',
          data : {
            'num' : num_dia,
            'year' : year,
            'month' : month,
            'dia_escogido' : dia_escogido,
            'mes_escogido' : mes_escogido
          },
          beforeSend : function() {

          },

          success : function(data) {
            if (data) {
              $('#midiv').html(data);
              $("#midiv").dialog({
                modal : true,
                width : 400,
                title : 'Escoge una hora',
                buttons : {
                  "Confirmar cita" : function() 
                  {
                    //validamos el formulario con 
                    if($("#desde_hora").val() == ""){
                      new_popup("Debes seleccionar una hora.", "Error formulario");
                      return;
                    }

                    if($("#comentario").val() == ""){
                      new_popup("El campo comentario no puede estar vacio.", "Error formulario");
                      return;
                    }
                    
                    $.ajax({
                      url : $('#form_coger_cita').attr("action"),
                      type : 'POST',
                      data : $('#form_coger_cita').serialize(),
                      beforeSend : function() {
                        $("#midiv").dialog('close');
                        $('<div class="procesando">Procesando la petición, espere por favor</div>').dialog({
                          modal : true,
                          title : 'Procesando petición',
                        });
                        
                      },
                      success : function(data) {
                        $(".procesando").dialog('close');
                        new_popup("Usted ha reservado cita, la fecha sera: " + data + ".", "Cita concertada");
                        $(".procesando").dialog('close');
                        
                      },
                      error : function() {
                        $('.formulario_citas').html("<div>Ha ocurrido un error, intentelo de nuevo más tarde.</div>");
                      }
                    });
                    return false;

                  },
                  "Cerrar" : function() {
                    $(this).dialog('close');
                  }
                }
              });
            }
          },
          error : function() {
            alert('Ha habido un error, inténtalo de nuevo más tarde');
          }
        });
        return false;
      }

    }

  })
}); 

//mostramos un popup con un error personalizado pasando el mensaje y el título 
//que queremos mostrar, al ser una cosa demasiado repetitiva mejor escribirla una
//vez y llamarla las veces necesarias
function new_popup(message, titulo)
{
  $("<div>" + message + "</div>").dialog({
    title : titulo,
    height : 260,
    width : 350,
    modal : true,
    buttons : {
      "Aceptar" : function() {
        $(this).dialog('close');
      }
    }
  });
}
</script>