		   <!-- Menú superior derecha-->
          <ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('usuario'); ?><b class="caret"></b></a>
					  <ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user"></i> Mi perfil</a></li>
							<li class="divider"></li>
							<li><a href="/index.php/usuarios/logout"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
					  </ul>
				</li>
          </ul>
        </div><!--se abre en el head_html.php-->
    </nav><!--se abre en el head_html.php-->