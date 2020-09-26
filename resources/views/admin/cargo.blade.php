@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Cargos</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="listacargos-tab" data-toggle="tab" href="#listacargos" role="tab" aria-controls="listacargos" aria-selected="true">Lista de Cargos</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="nuevocargo-tab" data-toggle="tab" href="#nuevocargo" role="tab" aria-controls="nuevocargo" aria-selected="false">Crear Cargo</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="modificarcargo-tab" data-toggle="tab" href="#modificarcargo" role="tab" aria-controls="modificarcargo" aria-selected="false">Modificar Cargo</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-danger" id="eliminarcargo-tab" data-toggle="tab" href="#eliminarcargo" role="tab" aria-controls="eliminarcargo" aria-selected="false">Eliminar Cargo</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="listacargos" role="tabpanel" aria-labelledby="listacargos-tab">
    {!!$tabla!!}
  </div>
  <div class="tab-pane fade" id="nuevocargo" role="tabpanel" aria-labelledby="nuevocargo-tab">
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=cargo&accion=new">
      <div class="form-group">
        <label for="nombre_cargo_new">Nombre:</label>
        <input required type="text" class="form-control" id="nombre_cargo_new" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="descripcion_cargo_new">Descripcion</label>
        <textarea class="form-control" id="descripcion_cargo_new" rows="3" name="descripcion"></textarea>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </form>
  </div>
  <div class="tab-pane fade" id="modificarcargo" role="tabpanel" aria-labelledby="modificarcargo-tab">
    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="cargo_sel" class="custom-select">                   
          {!!$select_items!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" {{$btn_status}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=cargo&accion=update">
      <div class="form-group">
        <label for="up_nombre_cargo">Nombre:</label>
        <input required type="text" class="form-control" id="up_nombre_cargo" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="up_desc_cargo">Descripcion</label>
        <textarea class="form-control" id="up_desc_cargo" rows="3" name="descripcion"></textarea>
      </div>
      <input type="text" id="hash_hidden" name="hash_hidden" hidden>
      <div class="form-group row">
        <div class="col-sm-10">
          <button id="btn_mod_cargo" type="submit" class="btn btn-primary" disabled>Actualizar</button>
        </div>
      </div>
    </form>            
  </div>
  <div class="tab-pane fade" id="eliminarcargo" role="tabpanel" aria-labelledby="eliminarcargo-tab">
    <div class="row">
      <div class="col-md-2 mt-2"></div>
      <div class="col-md-4 mt-2">
        <select id="delete_car_sel" class="custom-select">                   
          {!!$select_items!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-danger" onclick="borrar_cargo()" {{$btn_status}}>Eliminar</button>
      </div>
    </div>
  </div>
</div>  
@endsection
@section('inside_scripts')
function llenar_updateform()
{
  h=$("#cargo_sel").val();
  if(h!=null)
  {
    $("#hash_hidden").val(h);
    $.ajax({
      type: "POST",
      url: "controlador/c-update-cargo.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var objcargo = JSON.parse(text);
            $("#up_nombre_cargo").val(objcargo.nombre);
            $("#up_desc_cargo").val(objcargo.descripcion);
            $("#btn_mod_cargo").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
} 
function borrar_cargo()
{
  h=$("#delete_car_sel").val();
  if(h!=null)
  {
    $.ajax({
      type: "POST",
      url: "controlador/c-delete-cargo.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text=="ok")
          {
            location = "index.php?ruta=cargo";
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