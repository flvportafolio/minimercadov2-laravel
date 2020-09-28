@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Usuarios</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="lista_usuarios-tab" data-toggle="tab" href="#lista_usuarios" role="tab" aria-controls="lista_usuarios" aria-selected="true">Lista de Usuarios</a>
  </li>
  <li class="nav-item dropdown" role="presentation">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >Crear Usuarios</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" id="crear_usuarios1-tab" data-toggle="tab" href="#crear_usuarios1" role="tab" aria-controls="crear_usuarios1" aria-selected="false">Administrador</a>
      <a class="dropdown-item" id="crear_usuarios2-tab" data-toggle="tab" href="#crear_usuarios2" role="tab" aria-controls="crear_usuarios2" aria-selected="false">Empleado</a>
    </div>
  </li>
  <li class="nav-item dropdown" role="presentation">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >Modificar Usuarios</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" id="modificar_usuarios1-tab" data-toggle="tab" href="#modificar_usuarios1" role="tab" aria-controls="modificar_usuarios1" aria-selected="false">Administrador</a>
      <a class="dropdown-item" id="modificar_usuarios2-tab" data-toggle="tab" href="#modificar_usuarios2" role="tab" aria-controls="modificar_usuarios2" aria-selected="false">Empleado</a>
    </div>
  </li>            
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="lista_usuarios" role="tabpanel" aria-labelledby="lista_usuarios-tab">
    {!!$table_US_EU!!}
  </div>
  <div class="tab-pane fade" id="crear_usuarios1" role="tabpanel" aria-labelledby="crear_usuarios1-tab">
    <legend>Crear Usuario Administrador</legend>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="{{route('admin.store')}}" enctype="multipart/form-data">              
    @csrf
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputname">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="inputname" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="inputalias">Alias</label>
          <input required type="text" name="alias" class="form-control" id="inputalias" placeholder="Alias">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapp">Apellido Paterno</label>
          <input required type="text" name="app" class="form-control" id="inputapp" placeholder="Apellido Paterno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapm">Apellido Materno</label>
          <input required type="text" name="apm" class="form-control" id="inputapm" placeholder="Apellido Materno">
        </div>
      </div>
  
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputprof">Profesión</label>
          <input type="text" name="prof" class="form-control" id="inputprof" placeholder="Profesión">
        </div>
        <div class="form-group col-md-4">
          <label for="inputdir">Direccion</label>
          <input type="text" name="dir" class="form-control" id="inputdir" placeholder="Direccion">
        </div>
        <div class="form-group col-md-5">
          <label for="inputfoto">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="inputfoto" accept="image/png, image/jpeg">
        </div>            
      </div>
  
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-2">
          <label for="inputdate">Fecha de Nacimiento</label>
          <input required class="form-control" name="fecha" type="date" value="" id="inputdate">
        </div>
        <div class="form-group col-md-2">
          <label for="inputtelf">Telefono</label>
          <input type="text" name="telf" class="form-control" id="inputtelf" placeholder="Telefono">
        </div>
        <div class="form-group col-md-2">
          <label for="inputestado">Estado Civil</label>
          <select name="e_civil" id="inputestado" class="form-control">
            <option value="S" selected>Soltero</option>
            <option value="C">Casado</option>
            <option value="D">Divorciado</option>
            <option value="V">Viudo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputniveledu">Nivel Educativo</label>
          <select name="n_edu"id="inputniveledu" class="form-control">
            <option value="E" selected>Estudiante</option>
            <option value="B">Bachiller</option>
            <option value="U">Universitario</option>
            <option value="G">Graduado</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputpais">Pais de Origen</label>
          <input type="text" name="pais" class="form-control" id="inputpais" placeholder="Pais">
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12 ">Genero</label>
          <div class=" form-check-inline">
            <input required type="radio" name="gen" class="form-check-input" id="radiogen1" value="M">
            <label class="form-check-label " for="radiogen1">Masculino</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="gen" class="form-check-input" id="radiogen2" value="F">
            <label class="form-check-label " for="radiogen2">Femenino</label>
          </div>
        </div>            
      </div>
      
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-4">
          <label for="inputcorreo">Correo</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputlogoemail">@</span>
            </div>
            <input required type="email" name="email" class="form-control" id="inputcorreo" placeholder="Correo">
          </div>
        </div>
        <div class="form-group col-md-2">
          <label for="inputuser">Usuario</label>
          <input required type="text" name="user" class="form-control" id="inputuser" placeholder="Usuario">
        </div>
        <div class="form-group col-md-2">
          <label for="inputPassword">Contraseña</label>
          <input pattern=".{8,20}" required type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password">
          <small id="passwordHelpBlock2" class="form-text text-muted">Tu Contraseña debe tener entre 8 y 20 caracteres.</small>
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12 ">Estado</label>
          <div class=" form-check-inline">
            <input checked type="radio" name="estado" class="form-check-input" id="radioestado1" value="A">
            <label class="form-check-label " for="radioestado1">Activo</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="estado" class="form-check-input" id="radioestado2" value="I">
            <label class="form-check-label " for="radioestado2">Inactivo</label>
          </div>
        </div>
        <div class="form-group col-md-2">
          <label>&nbsp;</label>
          <button type="submit" class="form-control  btn btn-primary ">Registrar</button>
        </div>
      </div>                        
    </form>

  </div>
  <div class="tab-pane fade" id="crear_usuarios2" role="tabpanel" aria-labelledby="crear_usuarios2-tab">
    <legend>Crear Usuario Empleado</legend>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="{{route('empleado.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputname2">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="inputname2" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapp2">Apellido Paterno</label>
          <input required type="text" name="app" class="form-control" id="inputapp2" placeholder="Apellido Paterno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapm2">Apellido Materno</label>
          <input required type="text" name="apm" class="form-control" id="inputapm2" placeholder="Apellido Materno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputci">Carnet de Identidad</label>
          <input required type="text" name="ci" class="form-control" id="inputci" placeholder="Nro. de Carnet">
        </div>
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputprof2">Profesión</label>
          <input type="text" name="prof" class="form-control" id="inputprof2" placeholder="Profesión">
        </div>
        <div class="form-group col-md-4">
          <label for="inputdir2">Direccion</label>
          <input type="text" name="dir" class="form-control" id="inputdir2" placeholder="Direccion">
        </div>
        <div class="form-group col-md-5">
          <label for="inputfoto2">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="inputfoto2" accept="image/png, image/jpeg">
        </div>            
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-2">
          <label for="inputdate2">Fecha de Nacimiento</label>
          <input required class="form-control" name="fecha" type="date" max="{{$date_now}}" id="inputdate2">
        </div>
        <div class="form-group col-md-2">
          <label for="inputtelf2">Telefono</label>
          <input type="text" name="telf" class="form-control" id="inputtelf2" placeholder="Telefono">
        </div>
        <div class="form-group col-md-2">
          <label for="inputestado2">Estado Civil</label>
          <select name="e_civil" id="inputestado2" class="form-control">
            <option value="S" selected>Soltero</option>
            <option value="C">Casado</option>
            <option value="D">Divorciado</option>
            <option value="V">Viudo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputniveledu2">Nivel Educativo</label>
          <select name="n_edu"id="inputniveledu2" class="form-control">
            <option value="E" selected>Estudiante</option>
            <option value="B">Bachiller</option>
            <option value="U">Universitario</option>
            <option value="G">Graduado</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputpais2">Pais de Origen</label>
          <input type="text" name="pais" class="form-control" id="inputpais2" placeholder="Pais">
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12">Genero</label>
          <div class="form-check-inline">
            <input required type="radio" name="gen" class="form-check-input" id="radiogen3" value="M">
            <label class="form-check-label" for="radiogen3">Masculino</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="gen" class="form-check-input" id="radiogen4" value="F">
            <label class="form-check-label" for="radiogen4">Femenino</label>
          </div>
        </div>
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-4">
          <label for="inputcorreo2">Correo</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputlogoemail2">@</span>
            </div>
            <input required type="email" name="email" class="form-control" id="inputcorreo2" placeholder="Correo">
          </div>
        </div>
        <div class="form-group col-md-2">
          <label for="inputuser2">Usuario</label>
          <input required type="text" name="user" class="form-control" id="inputuser2" placeholder="Usuario">
        </div>
        <div class="form-group col-md-2">
          <label for="inputPassword2">Contraseña</label>
          <input pattern=".{8,20}" required type="password" name="pass" class="form-control" id="inputPassword2" placeholder="Password">
          <small id="password_details" class="form-text text-muted">Tu Contraseña debe tener entre 8 y 20 caracteres.</small>
        </div>
        <div class="form-group col-md-2">
          <label for="inputcargo">Cargo</label>
          <select required name="cargo" id="inputcargo" class="form-control">
            {!!$select_cargos!!}
          </select>
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12">Estado</label>
          <div class="form-check-inline">
            <input checked type="radio" name="estado" class="form-check-input" id="radioestado3" value="A">
            <label class="form-check-label" for="radioestado3">Activo</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="estado" class="form-check-input" id="radioestado4" value="I">
            <label class="form-check-label" for="radioestado4">Inactivo</label>
          </div>
        </div>                                                      
      </div>
      <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar</button>
    </form>

  </div>
  <div class="tab-pane fade" id="modificar_usuarios1" role="tabpanel" aria-labelledby="modificar_usuarios1-tab">
    <legend>Modificar Usuario Administrador</legend>
    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="user_admin_sel" class="custom-select">                   
        {!!$select_items!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" {{$btn_status}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 my-2" method="post" action="?ruta=usuario&accion=updateadmin" enctype="multipart/form-data">              
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputname3">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="inputname3" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="inputalias2">Alias</label>
          <input required type="text" name="alias" class="form-control" id="inputalias2" placeholder="Alias">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapp3">Apellido Paterno</label>
          <input required type="text" name="app" class="form-control" id="inputapp3" placeholder="Apellido Paterno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapm3">Apellido Materno</label>
          <input required type="text" name="apm" class="form-control" id="inputapm3" placeholder="Apellido Materno">
        </div>
      </div>
  
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputprof3">Profesión</label>
          <input type="text" name="prof" class="form-control" id="inputprof3" placeholder="Profesión">
        </div>
        <div class="form-group col-md-4">
          <label for="inputdir3">Direccion</label>
          <input type="text" name="dir" class="form-control" id="inputdir3" placeholder="Direccion">
        </div>
        <div class="form-group col-md-5">
          <label for="inputfoto3">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="inputfoto3" accept="image/png, image/jpeg">
          <input type="text" id="foto_us_up" name="foto_default" hidden>
        </div>            
      </div>
  
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-2">
          <label for="inputdate3">Fecha de Nacimiento</label>
          <input required class="form-control" name="fecha" type="date" value="" id="inputdate3">
        </div>
        <div class="form-group col-md-2">
          <label for="inputtelf3">Telefono</label>
          <input type="text" name="telf" class="form-control" id="inputtelf3" placeholder="Telefono">
        </div>
        <div class="form-group col-md-2">
          <label for="inputestado3">Estado Civil</label>
          <select name="e_civil" id="inputestado3" class="form-control">
            <option value="S" selected>Soltero</option>
            <option value="C">Casado</option>
            <option value="D">Divorciado</option>
            <option value="V">Viudo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputniveledu3">Nivel Educativo</label>
          <select name="n_edu" id="inputniveledu3" class="form-control">
            <option value="E" selected>Estudiante</option>
            <option value="B">Bachiller</option>
            <option value="U">Universitario</option>
            <option value="G">Graduado</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputpais3">Pais de Origen</label>
          <input type="text" name="pais" class="form-control" id="inputpais3" placeholder="Pais">
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12 ">Genero</label>
          <div class=" form-check-inline">
            <input required type="radio" name="gen" class="form-check-input" id="radio_upgen1" value="M">
            <label class="form-check-label " for="radio_upgen1">Masculino</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="gen" class="form-check-input" id="radio_upgen2" value="F">
            <label class="form-check-label " for="radio_upgen2">Femenino</label>
          </div>
        </div>            
      </div>
      
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-4">
          <label for="inputcorreo3">Correo</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputlogoemailupdate1">@</span>
            </div>
            <input required type="email" name="email" class="form-control" id="inputcorreo3" placeholder="Correo">
          </div>
        </div>
        <div class="form-group col-md-2">
          <label for="inputuser3">Usuario</label>
          <input required type="text" name="user" class="form-control" id="inputuser3" placeholder="Usuario">
        </div>
        <div class="form-group col-md-2">
          <label for="inputPassword3">Contraseña</label>
          <input pattern=".{8,20}" required type="password" name="pass" class="form-control" id="inputPassword3" placeholder="Password">
          <small id="passwordHelpBlock3" class="form-text text-muted">Tu Contraseña debe tener entre 8 y 20 caracteres.</small>
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12 text-danger"><b>Estado</b></label>
          <div class="form-check-inline">
            <input checked type="radio" name="estado" class="form-check-input" id="radioestadoup1" value="A">
            <label class="form-check-label" for="radioestadoup1">Activo</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="estado" class="form-check-input" id="radioestadoup2" value="I">
            <label class="form-check-label text-danger" for="radioestadoup2"><b>Inactivo</b></label>
          </div>
        </div>
        <input type="text" id="hash_ad_hidden" name="hash_hidden" hidden>
        <div class="form-group col-md-2">
          <label>&nbsp;</label>
          <button id="btn_mod_us" type="submit" class="form-control  btn btn-primary" disabled>Modificar</button>
        </div>
      </div>                        
    </form>
  </div>
  <div class="tab-pane fade" id="modificar_usuarios2" role="tabpanel" aria-labelledby="modificar_usuarios2-tab">
    <legend>Modificar Usuario Empleado</legend>
    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="user_emp_sel" class="custom-select">                   
        {!!$select_emp!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform2()" {{$btn_status_emp}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=usuario&accion=update_empleado" enctype="multipart/form-data">
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputname_upemp">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="inputname_upemp" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapp_upemp">Apellido Paterno</label>
          <input required type="text" name="app" class="form-control" id="inputapp_upemp" placeholder="Apellido Paterno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputapm_upemp">Apellido Materno</label>
          <input required type="text" name="apm" class="form-control" id="inputapm_upemp" placeholder="Apellido Materno">
        </div>
        <div class="form-group col-md-3">
          <label for="inputci_upemp">Carnet de Identidad</label>
          <input required type="text" name="ci" class="form-control" id="inputci_upemp" placeholder="Nro. de Carnet">
        </div>
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="inputprof_upemp">Profesión</label>
          <input type="text" name="prof" class="form-control" id="inputprof_upemp" placeholder="Profesión">
        </div>
        <div class="form-group col-md-4">
          <label for="inputdir_upemp">Direccion</label>
          <input type="text" name="dir" class="form-control" id="inputdir_upemp" placeholder="Direccion">
        </div>
        <div class="form-group col-md-5">
          <label for="inputfoto_upemp">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="inputfoto_upemp" accept="image/png, image/jpeg">
          <input type="text" id="foto_empl_up" name="foto_default" hidden>
        </div>            
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-2">
          <label for="inputdate_upemp">Fecha de Nacimiento</label>
          <input required class="form-control" name="fecha" type="date" max="{{$date_now}}" id="inputdate_upemp">
        </div>
        <div class="form-group col-md-2">
          <label for="inputtelf_upemp">Telefono</label>
          <input type="text" name="telf" class="form-control" id="inputtelf_upemp" placeholder="Telefono">
        </div>
        <div class="form-group col-md-2">
          <label for="inputestado_upemp">Estado Civil</label>
          <select name="e_civil" id="inputestado_upemp" class="form-control">
            <option value="S" selected>Soltero</option>
            <option value="C">Casado</option>
            <option value="D">Divorciado</option>
            <option value="V">Viudo</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputniveledu_upemp">Nivel Educativo</label>
          <select name="n_edu"id="inputniveledu_upemp" class="form-control">
            <option value="E" selected>Estudiante</option>
            <option value="B">Bachiller</option>
            <option value="U">Universitario</option>
            <option value="G">Graduado</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputpais_upemp">Pais de Origen</label>
          <input type="text" name="pais" class="form-control" id="inputpais_upemp" placeholder="Pais">
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12">Genero</label>
          <div class="form-check-inline">
            <input required type="radio" name="gen" class="form-check-input" id="radiogen_upemp1" value="M">
            <label class="form-check-label" for="radiogen_upemp1">Masculino</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="gen" class="form-check-input" id="radiogen_upemp2" value="F">
            <label class="form-check-label" for="radiogen_upemp2">Femenino</label>
          </div>
        </div>
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-4">
          <label for="inputcorreo_upemp">Correo</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputlogoemail_upemp">@</span>
            </div>
            <input required type="email" name="email" class="form-control" id="inputcorreo_upemp" placeholder="Correo">
          </div>
        </div>
        <div class="form-group col-md-2">
          <label for="inputuser_upemp">Usuario</label>
          <input required type="text" name="user" class="form-control" id="inputuser_upemp" placeholder="Usuario">
        </div>
        <div class="form-group col-md-2">
          <label for="inputPassword_upemp">Contraseña</label>
          <input pattern=".{8,20}" required type="password" name="pass" class="form-control" id="inputPassword_upemp" placeholder="Password">
          <small id="password_details2" class="form-text text-muted">Tu Contraseña debe tener entre 8 y 20 caracteres.</small>
        </div>
        <div class="form-group col-md-2">
          <label for="inputcargo_upemp">Cargo</label>
          <select name="cargo" id="inputcargo_upemp" class="form-control">
          {!!$select_cargos!!}
          </select>
        </div>
        <div class="form-group col-md-2">
          <label class="col-md-12">Estado</label>
          <div class="form-check-inline">
            <input checked type="radio" name="estado" class="form-check-input" id="radioestado_upemp1" value="A">
            <label class="form-check-label" for="radioestado_upemp1">Activo</label>
          </div>
          <div class="form-check-inline">
            <input type="radio" name="estado" class="form-check-input" id="radioestado_upemp2" value="I">
            <label class="form-check-label" for="radioestado_upemp2">Inactivo</label>
          </div>
        </div>                                                      
      </div>
      <input type="text" id="hash_empl_hidden" name="hash_hidden" hidden>
      <button id="btn_mod_empl" type="submit" class="btn btn-primary btn-sm btn-block" disabled>Modificar</button>
    </form>
  </div>            
</div>
@endsection
@section('inside_scripts')
function llenar_updateform()
{
  h=$("#user_admin_sel").val();
  if(h!=null)
  {
    $("#hash_ad_hidden").val(h);
    $.ajax({
      type: "POST",
      url: "controlador/c-update-usuario-sistema.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var obj_UsuarioSistema = JSON.parse(text);
            $("#inputname3").val(obj_UsuarioSistema.idUsuario.nombre);
            $("#inputalias2").val(obj_UsuarioSistema.alias);
            $("#inputapp3").val(obj_UsuarioSistema.idUsuario.apellidoPaterno);
            $("#inputapm3").val(obj_UsuarioSistema.idUsuario.apellidoMaterno);
            $("#inputprof3").val(obj_UsuarioSistema.idUsuario.profesion);
            $("#inputdir3").val(obj_UsuarioSistema.idUsuario.direccion);
            $("#foto_us_up").val(obj_UsuarioSistema.idUsuario.foto);
            $("#inputdate3").val(obj_UsuarioSistema.idUsuario.fecha_nac);
            $("#inputtelf3").val(obj_UsuarioSistema.idUsuario.telefono);
            $("#inputestado3").val(obj_UsuarioSistema.idUsuario.estado_civil);
            $("#inputniveledu3").val(obj_UsuarioSistema.idUsuario.nivel_educ);
            $("#inputpais3").val(obj_UsuarioSistema.idUsuario.pais_nac);
            //caso del radiobutton de genero
            (obj_UsuarioSistema.idUsuario.genero=="M")? $("#radio_upgen1").prop("checked",true):$("#radio_upgen2").prop("checked",true);
            $("#inputcorreo3").val(obj_UsuarioSistema.idUsuario.correo);
            $("#inputuser3").val(obj_UsuarioSistema.user);
            $("#inputPassword3").val(obj_UsuarioSistema.password);
            //caso del radiobutton de estado
            (obj_UsuarioSistema.estado=="A")? $("#radioestadoup1").prop("checked",true):$("#radioestadoup2").prop("checked",true);
            $("#btn_mod_us").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
}

function llenar_updateform2()
{
  h=$("#user_emp_sel").val();
  if(h!=null)
  {
    $("#hash_empl_hidden").val(h);
    $.ajax({
      type: "POST",
      url: "controlador/c-update-usuario-empleado.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var obj_emp = JSON.parse(text);
            $("#inputname_upemp").val(obj_emp.idEmpleado.nombre);
            $("#inputci_upemp").val(obj_emp.ci);
            $("#inputapp_upemp").val(obj_emp.idEmpleado.apellidoPaterno);
            $("#inputapm_upemp").val(obj_emp.idEmpleado.apellidoMaterno);
            $("#inputprof_upemp").val(obj_emp.idEmpleado.profesion);
            $("#inputdir_upemp").val(obj_emp.idEmpleado.direccion);
            $("#foto_empl_up").val(obj_emp.idEmpleado.foto);
            $("#inputdate_upemp").val(obj_emp.idEmpleado.fecha_nac);
            $("#inputtelf_upemp").val(obj_emp.idEmpleado.telefono);
            $("#inputestado_upemp").val(obj_emp.idEmpleado.estado_civil);
            $("#inputniveledu_upemp").val(obj_emp.idEmpleado.nivel_educ);
            $("#inputpais_upemp").val(obj_emp.idEmpleado.pais_nac);
            //caso del radiobutton de genero
            (obj_emp.idEmpleado.genero=="M")? $("#radiogen_upemp1").prop("checked",true):$("#radiogen_upemp2").prop("checked",true);
            $("#inputcorreo_upemp").val(obj_emp.idEmpleado.correo);
            $("#inputuser_upemp").val(obj_emp.user);
            $("#inputPassword_upemp").val(obj_emp.password);
            //caso del select cargo
              $("#inputcargo_upemp").val(obj_emp.idCargoFK.hash);
            //caso del radiobutton de estado
            (obj_emp.estado=="A")? $("#radioestado_upemp1").prop("checked",true):$("#radioestado_upemp2").prop("checked",true);
            $("#btn_mod_empl").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
} 
@endsection