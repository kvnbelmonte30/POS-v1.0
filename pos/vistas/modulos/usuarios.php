<div class="content-wrapper">
   
    <!-- cabezera del modulo -->
    
    <section class="content-header">
      
      <h1>
        
        Administración de Usuarios
        
      
      </h1>
     
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar usuarios</li>
      
      </ol>
    
    </section>

    
    <section class="content">

      <div class="box">

      <!-- boton agregar usuario -->

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

            Agregar usuario

          </button>

        </div>

        <!-- tabla de usuarios -->

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas">
            
            <thead>
              
              <tr>
                
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>

              </tr>

            </thead>
            <tbody>

              <?php 

              $id= 0;
              $item= null;
              $valor= null;
              $usuarios= ControladorUsuarios:: ctrMostrarUsuarios($item, $valor);
              foreach ($usuarios as $key => $value) {
                
                $id= $id + 1;
                echo '
                <tr>

                <td>'.$id.'</td>

                <td>'.$value["nombre"].'</td>

                <td>'.$value["usuario"].'</td>';

                if ($value["foto"] != "") {
                  
                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                }else{

                  echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                }
                
                echo'
                <td>'.$value["perfil"].'</td>
                
                <td><button class="btn btn-success btn-s">Activado</button></td>
                
                <td>'.$value["ultimo_login"].'</td>
                
                <td>
                  
                  <div class="btn-group">
                    
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#EditarUsuario" title="Editar Usuario"><i class=" fa fa-pencil"></i></button>
                      <button class="btn btn-danger" title="Eliminar Usuario"><i class=" fa fa-times"></i></button>

                  </div>

                </td>
              </tr>';
              }

               ?>

            </tbody>

          </table>
        
        </div>
       
        
        
      </div>
      

    </section>
    
  </div>

<!--========================================================
VENTANA MODAL AGREGAR USUARIO
=========================================================-->


<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
  <!--========================================================
  Cabeza del modal 
  =========================================================-->

        <div class="modal-header" style="background: #3cBdbc;color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Usuario</h4>

        </div>
  <!--====================================================
  CUERPO DEL MODAL
  =====================================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- entrada nombre -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- entrada usuario -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario" required>

              </div>

            </div>

            <!-- entrada contraseña -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="contraseña" placeholder="Ingresar Contraseña" required>

              </div>

            </div>

            <!-- entrada seleccion de perfil -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">

                  <option value="">Seleccione perfil</option>
                  
                  <option value="administrador">Administrador</option>
                  
                  <option value="Especial">Especial</option>
                 
                  <option value="Entregas">Entregas</option>

                </select>

              </div>

            </div>

            <!-- entrada para subir foto -->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            
            </div>

          </div>

        </div>

  <!--========================================================
  PIE DEL MODAL
  =========================================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary"> Guardar Usuario</button>
       
        </div>
     
        <?php 

          $crearUsuario = new ControladorUsuarios();
         $crearUsuario-> ctrCrearUsuario();

        ?> 

     </form>

     </div>

  </div>

</div>

<!--========================================================
VENTANA MODAL EDITAR USUARIO
=========================================================-->


<div id="EditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!-- Cabeza del modal -->

        <div class="modal-header" style="background: #3cBdbc;color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Usuario</h4>

        </div>
        
        <!-- CUERPO DEL MODAL -->

        <div class="modal-body">

          <div class="box-body">

            <!-- entrada nombre -->

            <div class="form-group">
  
              <div class="input-group">
      
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- entrada usuario -->

            <div class="form-group">
    
              <div class="input-group">
      
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" required>

              </div>

            </div>

            <!-- entrada contraseña -->

            <div class="form-group">
    
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" id="editarContraseña" name="editarContraseña" placeholder="Escriba nueva contraseña" required>

              </div>

            </div>

            <!-- entrada seleccion de perfil -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">

                  <option value="" id="editarPerfil"></option>
                  
                  <option value="Administrador">Administrador</option>
                  
                  <option value="Especial">Especial</option>
                 
                  <option value="Entregas">Entregas</option>

                </select>

              </div>

            </div>

            <!-- entrada para subir foto -->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            
            </div>

          </div>

        </div>

        <!--========================================================
        PIE DEL MODAL
        =========================================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary"> Guardar cambios</button>

        </div>

        <!-- <?php 

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario-> ctrCrearUsuario();

        ?>  -->

      </form>

    </div>

  </div>

</div>