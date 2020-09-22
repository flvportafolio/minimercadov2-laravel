@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Categorias</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="listacategoria-tab" data-toggle="tab" href="#listacategoria" role="tab" aria-controls="listacategoria" aria-selected="true">Lista de Categorias</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="nuevacategoria-tab" data-toggle="tab" href="#nuevacategoria" role="tab" aria-controls="nuevacategoria" aria-selected="false">Crear Categoria</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="modificarcategoria-tab" data-toggle="tab" href="#modificarcategoria" role="tab" aria-controls="modificarcategoria" aria-selected="false">Modificar Categoria</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-danger" id="eliminarcategoria-tab" data-toggle="tab" href="#eliminarcategoria" role="tab" aria-controls="eliminarcategoria" aria-selected="false">Eliminar Categoria</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="listacategoria" role="tabpanel" aria-labelledby="listacategoria-tab">
    {!! $table_cats !!}
  </div>
  <div class="tab-pane fade" id="nuevacategoria" role="tabpanel" aria-labelledby="nuevacategoria-tab">              
    
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=categoria&accion=new">
      <div class="form-group">
        <label for="nombre_cat">Nombre:</label>
        <input required type="text" class="form-control" id="nombre_cat" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="desc_cat">Descripcion</label>
        <textarea class="form-control" id="desc_cat" rows="3" name="descripcion"></textarea>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </form>

  </div>
  <div class="tab-pane fade" id="modificarcategoria" role="tabpanel" aria-labelledby="modificarcategoria-tab">
    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="cat_sel" class="custom-select">                   
         {!! $select_items !!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" {{$btn_status}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=categoria&accion=update">
      <div class="form-group">
        <label for="up_nombre_cat">Nombre:</label>
        <input required type="text" class="form-control" id="up_nombre_cat" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="up_desc_cat">Descripcion</label>
        <textarea class="form-control" id="up_desc_cat" rows="3" name="descripcion"></textarea>
      </div>
      <input type="text" id="hash_hidden" name="hash_hidden" hidden>
      <div class="form-group row">
        <div class="col-sm-10">
          <button id="btn_mod_categoria" type="submit" class="btn btn-primary" disabled>Actualizar</button>
        </div>
      </div>
    </form>

  </div>
  <div class="tab-pane fade" id="eliminarcategoria" role="tabpanel" aria-labelledby="eliminarcategoria-tab">
    <div class="row">
      <div class="col-md-2 mt-2"></div>
      <div class="col-md-4 mt-2">
        <select id="delete_cat_sel" class="custom-select">                   
          {!! $select_items !!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
        <button type="button" class="btn btn-danger" onclick="borrar_categoria()" {{$btn_status}}>Eliminar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('inside_scripts')
function llenar_updateform()
{
  h=$("#cat_sel").val();
  if(h!=null)
  {
    $("#hash_hidden").val(h);
    $.ajax({
      type: "POST",
      url: "controlador/c-update-categoria.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var objcat = JSON.parse(text);
            $("#up_nombre_cat").val(objcat.nombre);
            $("#up_desc_cat").val(objcat.descripcion);
            $("#btn_mod_categoria").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
}

function borrar_categoria()
{
  h=$("#delete_cat_sel").val();
  if(h!=null)
  {
    $.ajax({
      type: "POST",
      url: "controlador/c-delete-categoria.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text=="ok")
          {
            location = "index.php?ruta=categoria";
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