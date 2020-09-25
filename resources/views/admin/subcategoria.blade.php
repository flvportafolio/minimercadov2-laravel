@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Subcategorias</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="listar_subcategoria-tab" data-toggle="tab" href="#listar_subcategoria" role="tab" aria-controls="listar_subcategoria" aria-selected="true">Listar SubCategorias</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="crear_subcategoria-tab" data-toggle="tab" href="#crear_subcategoria" role="tab" aria-controls="crear_subcategoria" aria-selected="false">Crear SubCategoria</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="modificar_subcategoria-tab" data-toggle="tab" href="#modificar_subcategoria" role="tab" aria-controls="modificar_subcategoria" aria-selected="false">Modificar SubCategoria</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-danger" id="eliminar_subcategoria-tab" data-toggle="tab" href="#eliminar_subcategoria" role="tab" aria-controls="eliminar_subcategoria" aria-selected="false">Eliminar SubCategoria</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="listar_subcategoria" role="tabpanel" aria-labelledby="listar_subcategoria-tab">
    {!!$table_subcat!!}
  </div>
  <div class="tab-pane fade" id="crear_subcategoria" role="tabpanel" aria-labelledby="crear_subcategoria-tab">
    
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=subcategoria&accion=new">
      <div class="form-group">
        <label for="nombre_subcat">Nombre:</label>
        <input required type="text" class="form-control" id="nombre_subcat" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="desc_subcat">Descripcion:</label>
        <textarea class="form-control" id="desc_subcat" rows="3" name="descripcion"></textarea>
      </div>
      <div class="form-group">
        <label for="inputcat">Categoria:</label>
        <select required name="categoria" id="inputcat" class="form-control">
        {!!$select_cat!!}
        </select>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </form>

  </div>
  <div class="tab-pane fade" id="modificar_subcategoria" role="tabpanel" aria-labelledby="modificar_subcategoria-tab">

    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="subcat_sel" class="custom-select">                   
        {!!$select_subcat!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" {{$btn_status}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=subcategoria&accion=update">
      <div class="form-group">
        <label for="up_nombre_subcat">Nombre:</label>
        <input required type="text" class="form-control" id="up_nombre_subcat" name="nombre">
      </div>                          
      <div class="form-group">
        <label for="up_desc_subcat">Descripcion:</label>
        <textarea class="form-control" id="up_desc_subcat" rows="3" name="descripcion"></textarea>
      </div>
      <div class="form-group">
        <label for="up_inputcat">Categoria:</label>
        <select name="categoria" id="up_inputcat" class="form-control">
        {!!$select_cat!!}
        </select>
      </div>
      <input type="text" id="hash_hidden" name="hash_hidden" hidden>
      <div class="form-group row">
        <div class="col-sm-10">
          <button id="btn_mod_subcategoria" type="submit" class="btn btn-primary" disabled>Actualizar</button>
        </div>
      </div>
    </form>

  </div>
  <div class="tab-pane fade" id="eliminar_subcategoria" role="tabpanel" aria-labelledby="eliminar_subcategoria-tab">
    
    <div class="row">
      <div class="col-md-2 mt-2"></div>
      <div class="col-md-4 mt-2">
        <select id="delete_subcat_sel" class="custom-select">                   
        {!!$select_subcat!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
        <button type="button" class="btn btn-danger" onclick="borrar_subcategoria()" {{$btn_status}}>Eliminar</button>
      </div>
    </div>  

  </div>
</div>
@endsection
@section('inside_scripts')
function llenar_updateform()
{
  h=$("#subcat_sel").val();
  if(h!=null)
  {
    $("#hash_hidden").val(h);
    $.ajax({
      type: "POST",
      url: "controlador/c-update-subcategoria.php",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var objsubcat = JSON.parse(text);
            $("#up_nombre_subcat").val(objsubcat.nombre);
            $("#up_desc_subcat").val(objsubcat.descripcion);                
            $("#up_inputcat").val(objsubcat.idCategoriaFK.hash);
            
            $("#btn_mod_subcategoria").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
}
function borrar_subcategoria()
{
  h=$("#delete_subcat_sel").val();
  if(h!=null)
  {
    $.ajax({
      headers: { 'X-CSRF-TOKEN':'{{csrf_token()}}' },
      type: "DELETE",
      url: "{{route('subcategoria.destroy')}}",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text=="ok")
          {
            location = "{{route('admin.subcategoria')}}";
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