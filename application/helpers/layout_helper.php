<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 22/06/17
 * Time: 11:41
 */
class Layout_Helper
{
    static function breadcrumb($obj)
    {
        $breadcrumb = "<div id=\"breadcrumb\">";

        if($obj->uri->total_segments() == 1)
        {
            $breadcrumb .= "<a href='" . base_url($obj->uri->segment(1) . '/principal') . "' title='Ir a la pantalla principal' class='tip-bottom'><i class='fa fa-home'></i>Inicio</a>";
        }
        elseif($obj->uri->total_segments() == 2)
        {
            $breadcrumb .= "<a href='" . base_url($obj->uri->segment(1) . '/principal') . "' title='Ir a la pantalla principal' class='tip-bottom'><i class='fa fa-home'></i>Inicio</a>";
            $breadcrumb .= "<a href='#' class='current'>" . ucfirst(str_replace('-',' ',str_replace('_',' ',$obj->uri->segment(2)))) . "</a>";
        }
        elseif($obj->uri->total_segments() >= 3)
        {
            $breadcrumb .= "<a href='" . base_url($obj->uri->segment(1) . '/principal') . "' title='Ir a la pantalla principal' class='tip-bottom'><i class='fa fa-home'></i>Inicio</a>";
            $breadcrumb .= "<a href='" . base_url($obj->uri->segment(1) . "/" . $obj->uri->segment(2)) . "'>" . ucfirst(str_replace('-',' ',str_replace('_',' ',$obj->uri->segment(2)))) . "</a>";
            $breadcrumb .= "<a href='#' class='current'>" . ucfirst(str_replace('-',' ',str_replace('_',' ',$obj->uri->segment(3)))) . "</a>";
        }

        $breadcrumb .= "</div>";

        return $breadcrumb;
    }

   static function cargaVista(&$obj,$view,$data,$restriccion = null)
    {
       //die(var_dump($obj->session->userdata('perfil')));
		
      //if($obj->session->userdata('perfil') == '1'){
      //	 //die('111111111111111111111111');
      //        $no_vistas_perfil1 = array("ingresos");
      //        if (in_array($restriccion, $no_vistas_perfil1)) {
      //                $obj->load->view('panel/layout/head', $data);
      //                //$obj->load->view('panel/layout/user_nav',$data);
      //                $obj->load->view('panel/layout/left');
      //                $obj->load->view('panel/calidad/' . str_replace('-','_',$obj->uri->segment(2)) . '/' . $view,$data);
      //                $obj->load->view('panel/layout/footer');
      //        }else{
      //                Layout_Helper::restringido($obj,$data);
      //        }
       IF($obj->session->userdata('perfil') == '2'){ 
        	//die('22222222222222222222222222');
                $no_vistas_perfil1 = array("visita");
                if (in_array($restriccion, $no_vistas_perfil1)) {
                        $obj->load->view('panel/layout/head', $data);
                        //$obj->load->view('panel/layout/user_nav',$data);
                        //$obj->load->view('panel/layout/left');
                        $obj->load->view('panel/reserva/reserva/'.$view,$data);
                        $obj->load->view('panel/layout/footer');
                }else{
                        Layout_Helper::restringido($obj,$data);
                }
        }
        ELSE {
            
            $obj->load->view('panel/layout/head', $data);
                        //$obj->load->view('panel/layout/user_nav',$data);
                        //$obj->load->view('panel/layout/left');
                        $obj->load->view('panel/reserva/reserva/'.$view,$data);
                        $obj->load->view('panel/layout/footer');
            
            
            //Layout_Helper::restringido($obj,$data);
    }
       //elseif($obj->session->userdata('perfil') == '3' || $obj->session->userdata('perfil') == '4'){
       //	//die('333333333333333333');
       //       $no_vistas_perfil1 = array("ingresos");
       //       if (in_array($restriccion, $no_vistas_perfil1)) {
       //               $obj->load->view('panel/layout/head', $data);
       //               //$obj->load->view('panel/layout/user_nav',$data);
       //               $obj->load->view('panel/layout/left');
       //               $obj->load->view('panel/calidad/gestion/'.$view,$data);
       //               $obj->load->view('panel/layout/footer');
       //       }else{
       //               Layout_Helper::restringido($obj,$data);
       //       }
       //elseif(empty($obj->session->userdata('perfil'))){
       //
       //   $no_vistas_perfil1 = array("ingresos");
       //       if (in_array($restriccion, $no_vistas_perfil1)) {
       //               $obj->load->view('panel/layout/head', $data);
       //               //$obj->load->view('panel/layout/user_nav',$data);
       //               //$obj->load->view('panel/layout/left');
       //               $obj->load->view('panel/calidad/gestion/'.$view,$data);
       //               $obj->load->view('panel/layout/footer');
       //       }else{
       //               Layout_Helper::restringido($obj,$data);
       //       }
       //else {
            //redirect(base_url());
            
        //     Layout_Helper::restringido($obj,$data);
        //}


    }
    static function restringido($obj,$data){
                $data['title'] = 'Acceso Restringido';
                $obj->load->view('panel/layout/head', $data);
                $obj->load->view('panel/sinpermiso_view.php');
       // }
    }


	
	static function menuLateralAlertas(){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \" style=\"\">
   
   <a href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\"  >
 <div >      
               <center>  <h4 >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a  href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\" >
 <div >          
               <center>  <h4 >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a style=\"color:#ffffff;\" href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\" style=\" background-color: #6DA2BF;border-color:#6DA2BF; \" >
 <div >         
               <center>  <h4 style=\"color:#ffffff;\" >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
   

    
    
    <a href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" >
 <div >
               <center>  <h4 >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

static function menuLateralCesfam(){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \">
   
   <a href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\"  >
 <div >      
               <center>  <h4 >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a  href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\" >
 <div >          
               <center>  <h4 >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a  href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\"  >
 <div >         
               <center>  <h4  >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
       
    
    <a href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" >
 <div >
               <center>  <h4 >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

static function menuLateralHoras(){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \">
   
   <a href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\"  >
 <div >      
               <center>  <h4 >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a  style=\"color:#ffffff;\" href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
 <div >          
               <center>  <h4 style=\"color:#ffffff;\" >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a  href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\"  >
 <div >         
               <center>  <h4  >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
      
    
    <a href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" >
 <div >
               <center>  <h4 >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

static function menuLateralMensajes(){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \">
   
   <a href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\"  >
 <div >      
               <center>  <h4 >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a   href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\"  >
 <div >          
               <center>  <h4  >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a  href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\"  >
 <div >         
               <center>  <h4  >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
   
    
    <a href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" >
 <div >
               <center>  <h4 >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

static function menuLateralPrincipal($color = null){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \">
   
   <a style=\"color:#ffffff;\" href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
 <div >      
               <center>  <h4 style=\"color:#ffffff;\"  >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a   href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\"  >
 <div >          
               <center>  <h4  >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a  href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\"  >
 <div >         
               <center>  <h4  >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
 
    <a href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" >
 <div >
               <center>  <h4 >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

static function menuLateralUsuarios(){
		$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-4 \">
   
   <a  href=\"".base_url()."callcenter/principal/\" >
   <div class=\"bhoechie-menu\"  >
 <div >      
               <center>  <h4   >Inicio</h4></center>    
 </div> 
   </div>
    </a>    
    
     <a   href=\"".base_url()."callcenter/horas/inicio\">
         <div class=\"bhoechie-menu\"  >
 <div >          
               <center>  <h4  >Horas</h4></center> 
 </div> 
   </div>
    </a>
   
    <a  href=\"".base_url()."callcenter/alertas/inicio\" >
   <div class=\"bhoechie-menu\"  >
 <div >         
               <center>  <h4  >Alertas</h4></center>      
 </div> 
   </div>
   </a>
   
 
    <a style=\"color:#ffffff;\" href=\"".base_url()."callcenter/usuarios/index\" >
   <div class=\"bhoechie-menu\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
 <div >
               <center>  <h4 style=\"color:#ffffff;\" >Usuarios</h4></center>             
 </div> 
   </div>
    </a>
    
</div>";
		
		return $menu;
	}

	static function menuLateralSome($menuOpcion,$perfil){
	$menu = "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 \">";
	
  if($menuOpcion == 'inicio'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/principal/\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div  style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-home hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\"> Inicio</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/principal\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div style=\"min-height:24px\" >          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-home hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Inicio</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
  
    if($menuOpcion == 'usuarios'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/usuarios/buscarusuario\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div style=\"min-height:24px\" >      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Usuarios</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/usuarios/buscarusuario\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Usuarios</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
  
   if($menuOpcion == 'horas'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/horas/inicio\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div  style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-clock-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Horas</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/horas/inicio\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-clock-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Horas</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
  
  if($perfil==2 || $perfil==4){
	  if($menuOpcion == 'profesionales'){
		   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/profesionales/inicio\" >
		   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
		 <div  style=\"min-height:24px\">      
		               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user-md hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Profesionales</span></h4></center>    
		 </div> 
		   </div>
		    </a> ";   
	  }else{
	  	$menu .= "<a   href=\"".base_url()."some/profesionales/inicio\">
	         <div class=\"bhoechie-menu colorGrisSobre\"  >
	 <div style=\"min-height:24px\" >          
	               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user-md hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Profesionales</span></h4></center> 
	 </div> 
	   </div>
	    </a>";
	  }
  }

  if($menuOpcion == 'mensajes'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/mensajes/inicio\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div  style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-sticky-note-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Notas</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/mensajes/inicio\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-sticky-note-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Notas</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
  
  if($perfil==2 || $perfil==4){
	  if($menuOpcion == 'reportes'){
		   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/reportes_usuarios/inicio\" >
		   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
		 <div style=\"min-height:24px\" >      
		               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-file-text-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Reportes</span></h4></center>    
		 </div> 
		   </div>
		    </a> ";   
	  }else{
	  	$menu .= "<a   href=\"".base_url()."some/reportes_usuarios/inicio\">
	         <div class=\"bhoechie-menu colorGrisSobre\"  >
	 <div style=\"min-height:24px\" >          
	               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-file-text-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Reportes</span></h4></center> 
	 </div> 
	   </div>
	    </a>";
	  }
  }
  
  if($perfil==2 || $perfil==4){
	  if($menuOpcion == 'gestion'){
		   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/plataforma/usuarios\" >
		   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
		 <div style=\"min-height:24px\" >      
		               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-cogs hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Gestón plataforma</span></h4></center>    
		 </div> 
		   </div>
		    </a>";   
	  }else{
	  	$menu .= "<a   href=\"".base_url()."some/plataforma/usuarios\">
	         <div class=\"bhoechie-menu colorGrisSobre\"  >
	 <div style=\"min-height:24px\">          
	               <center>  <h4  style=\"\" ><i style=\"float:left; margin-left: 10px\"  class=\"fa fa-cogs hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Gestón plataforma</span></h4></center> 
	 </div> 
	   </div>
	    </a>";
	  }
  }
	$menu .= "</div>";
		return $menu;
	}


 static function menuLateralSomeMobile($menuOpcion,$perfil){
	$menu = "<div style=\"max-width:40px;float:left;margin-right:20px\" class=\" \">";
	
  if($menuOpcion == 'inicio'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/principal/\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div class=\"colorGris\" style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-home hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\"> Inicio</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/principal\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div style=\"min-height:24px\" >          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-home hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Inicio</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
  $menu .= "</div><div style=\"max-width:40px;float:left;margin-right:20px\" class=\"\">";
    if($menuOpcion == 'usuarios'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/usuarios/buscarusuario\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div style=\"min-height:24px\" >      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Usuarios</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/usuarios/buscarusuario\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Usuarios</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
    $menu .= "</div>";
    $menu .= "<div style=\"max-width:40px;float:left;margin-right:20px\"  class=\"\">";
	
   if($menuOpcion == 'horas'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/horas/inicio\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div  style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-clock-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Horas</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/horas/inicio\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-clock-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Horas</span></h4></center> 
 </div> 
   </div>
    </a>";
  }
   
	

	$menu .= "</div>";
if($perfil==2 || $perfil==4){
    $menu .= "<div style=\"max-width:40px;float:left;margin-right:20px\"  class=\"\">";
	  if($menuOpcion == 'profesionales'){
		   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/profesionales/inicio\" >
		   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
		 <div  style=\"min-height:24px\">      
		               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user-md hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Profesionales</span></h4></center>    
		 </div> 
		   </div>
		    </a> ";   
	  }else{
	  	$menu .= "<a   href=\"".base_url()."some/profesionales/inicio\">
	         <div class=\"bhoechie-menu colorGrisSobre\"  >
	 <div style=\"min-height:24px\" >          
	               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-user-md hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Profesionales</span></h4></center> 
	 </div> 
	   </div>
	    </a>";
	  }
	  
    $menu .= "</div>";
 }
    $menu .= "<div style=\"max-width:40px;float:left;margin-right:20px\"  class=\"\">";
	
  if($menuOpcion == 'mensajes'){
	   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/mensajes/inicio\" >
	   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
	 <div  style=\"min-height:24px\">      
	               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-sticky-note-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Notas</span></h4></center>    
	 </div> 
	   </div>
	    </a> ";   
  }else{
  	$menu .= "<a   href=\"".base_url()."some/mensajes/inicio\">
         <div class=\"bhoechie-menu colorGrisSobre\"  >
 <div  style=\"min-height:24px\">          
               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-sticky-note-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Notas</span></h4></center> 
 </div> 
   </div>
    </a>";
  }

	$menu .= "</div>";
	
if($perfil==2 || $perfil==4){
    $menu .= "<div style=\"max-width:40px;float:left;margin-right:20px\"  class=\"\">";
		  if($menuOpcion == 'reportes'){
			   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/reportes_usuarios/inicio\" >
			   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
			 <div style=\"min-height:24px\" >      
			               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-file-text-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Reportes</span></h4></center>    
			 </div> 
			   </div>
			    </a> ";   
		  }else{
		  	$menu .= "<a   href=\"".base_url()."some/reportes_usuarios/inicio\">
		         <div class=\"bhoechie-menu colorGrisSobre\"  >
		 <div style=\"min-height:24px\" >          
		               <center>  <h4 style=\"\" ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-file-text-o hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Reportes</span></h4></center> 
		 </div> 
		   </div>
		    </a>";
		  }

    $menu .= "</div>";
 }	
if($perfil==2 || $perfil==4){
    $menu .= "<div style=\"max-width:40px;float:left;margin-right:20px\"  class=\"\">";
		  if($menuOpcion == 'gestion'){
			   $menu .= "<a style=\"color:#ffffff;\" href=\"".base_url()."some/plataforma/usuarios\" >
			   <div class=\"bhoechie-menu colorGris\" style=\" background-color: #6DA2BF; border-color:#6DA2BF;\" >
			 <div style=\"min-height:24px\" >      
			               <center>  <h4 style=\"color:#ffffff;\"  ><i style=\"float:left; margin-left: 10px\" class=\"fa fa-cogs hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Gestón plataforma</span></h4></center>    
			 </div> 
			   </div>
			    </a> ";   
		  }else{
		  	$menu .= "<a   href=\"".base_url()."some/plataforma/usuarios\">
		         <div class=\"bhoechie-menu colorGrisSobre\"  >
		 <div style=\"min-height:24px\">          
		               <center>  <h4  style=\"\" ><i style=\"float:left; margin-left: 10px\"  class=\"fa fa-cogs hidden-md  hidden-sm\" aria-hidden=\"true\"></i><span class=\"  hidden-xs\">Gestón plataforma</span></h4></center> 
		 </div> 
		   </div>
		    </a>";
		  }

}
		$menu .= "</div>";
		return $menu;
	}

}