<?php $color = '#e9c899';
$color = '#f4f4f2';
IF(empty($menu)){
    $menu ='';
    $color = '#f4f4f2';
}
IF(empty($submenu)){$submenu='';}?>

<div id="sidebar" style="background-color: <?php echo $color;?>">
    
    <ul class="menu-left" style="">
        <!-- Personal CETEP-->
        <?php IF($this->session->userdata('perfil') == '1'){?>
            <li class="submenu <?php if($menu === 'gestion' )echo "active open" ?>">
                    <a href=""><i class="fa fa-envelope-o" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Contacto</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitacion')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/felicitacion"); ?>">Felicitación</a></li>            
                        <li <?php if($submenu === 'reclamo') echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/reclamo"); ?>">Reclamo</a></li>
                    </ul> 
            </li>
            <li class="submenu <?php if($menu === 'planilla' )echo "active open" ?>">
                    <a href=""><i class="fa fa-list-alt" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Planilla</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'planilla')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/NoConforme"); ?>">Servicio No Conforme</a></li>            
                    </ul> 
            </li>
            <li>
                    <a href="<?php echo base_url();?>login/salirIntranet"><i class="fa fa-sign-out" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Salir</span></a>
             </li>
             
             
             
             
        <?php }ELSEIF($this->session->userdata('perfil') == '2'){ ?>
            <!--VISITA-->
            <li class="submenu <?php if($menu === 'gestion' )echo "active open" ?>">
                    <a href=""><i class="fa fa-envelope-o" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Contacto</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitacion')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/sugerencia/felicitacion"); ?>">Felicitación</a></li>            
                        <li <?php if($submenu === 'reclamo') echo "class='active'" ?>><a href="<?php echo base_url("calidad/sugerencia/reclamo"); ?>">Reclamo</a></li>
                    </ul> 
            </li>
            <li>
                    <a href="<?php echo base_url();?>login/salir"><i class="fa fa-sign-out" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Salir</span></a>
            </li>
            
            
            
<!--ADMINISTRADOR-->
            <?php }ELSEIF($this->session->userdata('perfil') == '3'){?>

            <!--VISITA-->
            <li class="submenu <?php if($menu === 'gestion' )echo "active open" ?>">
                    <a href=""><i class="fa fa-envelope-o" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Contacto</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitacion')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/felicitacion"); ?>">Felicitación</a></li>            
                        <li <?php if($submenu === 'reclamo') echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/reclamo"); ?>">Reclamo</a></li>
                    </ul> 
            </li>
            <li class="submenu <?php if($menu === 'planilla' )echo "active open" ?>">
                    <a href=""><i class="fa fa-list-alt" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Planilla</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'planilla')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/NoConforme"); ?>">Servicio No Conforme</a></li>            
                    </ul> 
            </li>
            <li class="submenu <?php if($menu === 'listar' )echo "active open" ?>">
                    <a href=""><i class="fa fa-sitemap" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Gestion</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitaciones')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/listar_felicitaciones"); ?>">Listar Felicitaciones</a></li>            
                        <li <?php if($submenu === 'reclamos')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/listar_reclamos"); ?>">Listar Reclamos</a></li>            
                        <li <?php if($submenu === 'noConforme')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/listar_noConforme"); ?>">Listar Servicios No Conforme</a></li>            
                    </ul> 
            </li>
            <li>
                    <a href="<?php echo base_url();?>login/salirIntranet"><i class="fa fa-sign-out" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Salir</span></a>
            </li>

        
         <!--JEFE-->
            <?php }ELSEIF($this->session->userdata('perfil') == '4'){?>

            <!--VISITA-->
            <li class="submenu <?php if($menu === 'gestion' )echo "active open" ?>">
                    <a href=""><i class="fa fa-envelope-o" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Contacto</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitacion')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/felicitacion"); ?>">Felicitación</a></li>            
                        <li <?php if($submenu === 'reclamo') echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/reclamo"); ?>">Reclamo</a></li>
                    </ul> 
            </li>
            <li class="submenu <?php if($menu === 'planilla' )echo "active open" ?>">
                    <a href=""><i class="fa fa-list-alt" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Planilla</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'planilla')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/NoConforme"); ?>">Servicio No Conforme</a></li>            
                    </ul> 
            </li>
            <li class="submenu <?php if($menu === 'listar' )echo "active open" ?>">
                    <a href=""><i class="fa fa-sitemap" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Gestion</span> <i class="arrow fa fa-chevron-right"></i></a>
                    <ul>
                        <li <?php if($submenu === 'felicitaciones')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/listar_felicitaciones_jefe"); ?>">Listar Felicitaciones</a></li>            
                        <li <?php if($submenu === 'reclamos')  echo "class='active'" ?>><a href="<?php echo base_url("calidad/gestion/listar_reclamos_jefe"); ?>">Listar Reclamos</a></li>            
                    </ul> 
            </li>
            <li>
                    <a href="<?php echo base_url();?>login/salirIntranet"><i class="fa fa-sign-out" aria-hidden="true" style=" width: 20px;text-align: center"></i> <span>Salir</span></a>
            </li>

        <?php } ?>   
            
    </ul>
</div><!-- sidebar -->
