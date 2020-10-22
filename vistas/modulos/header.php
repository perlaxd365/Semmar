<header>
 <div class="header-area ">
            <div id="sticky-header" class="main-header-area" style="background: #0A1172">
                <div class="container-fluid p-0" >
                    <div class="row align-items-center no-gutters" >
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="<?php echo SERVERURL;?>home/">
                                    <img width="190" height="40" src="<?php echo SERVERURL;?>vistas/img/logopng.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="<?php echo SERVERURL;?>home/">Inicio</a></li>
                                        <li><a href="<?php echo SERVERURL;?>about/">Nosotros</a></li>
                                        <li><a href="#">Servicios</a>
                                            <ul class="submenu">
                                                    <li><a href="<?php echo SERVERURL;?>facilities/">Sectores</a></li>
                                                    <li><a href="<?php echo SERVERURL;?>property/1/1">Proyectos</a></li>
                                                    
                        <?php if(isset($_SESSION['tipo_usuario']) && isset($_SESSION['token_semmar'])): ?>
                                                    <li><a href="<?php echo SERVERURL;?>elements/">Elementos</a></li>
                                                    
                        <?php endif; ?>
                                            </ul>
                                        </li>
                                        <li><a href="<?php echo SERVERURL;?>contact/">Contacto</a></li>
                                        
                        <?php if(isset($_SESSION['tipo_usuario']) && isset($_SESSION['token_semmar'])): ?>
                                        <li><a href="<?php echo SERVERURL;?>listado/">listado</a></li>
                                        <li><a href="<?php echo SERVERURL;?>register/">Registro</a></li>
                        <?php else: ?>
                                        <li></li> 
                                        <li></li> 
                                        <li></li> 
                                        <li></li> 
                                        <li></li>
                                        <li></li> 
                                        <li></li> 
                                        <li></li> 
                        <?php endif; ?>
                                        <li></li> 
                                        <li></li> 
                                        
                        <?php if(isset($_SESSION['tipo_usuario']) && isset($_SESSION['token_semmar'])): ?>
                                        <li>
                                         <a class="btn-exit-system"  href="<?php echo $lc->encryption($_SESSION['token_semmar']);?>">Cerrar Sesión</a>
                                          </li> 
                            <li> <a href="#">Llamanos +923 243434</a></li>
                                          
                            <?php else:?>
                            <li>
                            
                            <a href="<?php echo SERVERURL?>login/">Login</a>
                            
                            </li>
                            <li> <a href="#">Llamanos +923 243434</a></li>
              
                                <?php endif;?>
                                     </ul>
                                </nav>
                            </div>
                        </div>

                       
                        
                        



                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>