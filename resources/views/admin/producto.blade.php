@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Productos</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="listar_prod-tab" data-toggle="tab" href="#listar_prod" role="tab" aria-controls="listar_prod" aria-selected="true">Listar Productos</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="crear_prod-tab" data-toggle="tab" href="#crear_prod" role="tab" aria-controls="crear_prod" aria-selected="false">Crear Producto</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="modificar_prod-tab" data-toggle="tab" href="#modificar_prod" role="tab" aria-controls="modificar_prod" aria-selected="false">Modificar Producto</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-danger" id="eliminar_prod-tab" data-toggle="tab" href="#eliminar_prod" role="tab" aria-controls="eliminar_prod" aria-selected="false">Eliminar Producto</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="listar_prod" role="tabpanel" aria-labelledby="listar_prod-tab">
    {!! $table_prod !!}
  </div>
  <div class="tab-pane fade" id="crear_prod" role="tabpanel" aria-labelledby="crear_prod-tab">

    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="?ruta=producto&accion=new" enctype="multipart/form-data">
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="new_nombre">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="new_nombre" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="new_subcategoria">Subcategoria</label>
          <select required name="subcategoria" id="new_subcategoria" class="form-control">
            {!! $select_subcat !!}
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="new_marca">Marca</label>
          <select required name="marca" id="new_marca" class="form-control">
            {!! $select_marca !!}
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="new_foto">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="new_foto" accept="image/png, image/jpeg">
        </div>                                    
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-12">
          <label for="new_desc_prod">Descripcion</label>
          <textarea class="form-control" id="new_desc_prod" rows="3" name="descripcion"></textarea>
        </div>                              
      </div>                                                
      <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar Producto</button>
    </form>

  </div>
  <div class="tab-pane fade" id="modificar_prod" role="tabpanel" aria-labelledby="modificar_prod-tab">
    <div class="row">
      <div class="col-md-4 mt-2">
        <select id="up_prod_sel" class="custom-select">                   
          {!!$select_prod!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
          <button type="button" class="btn btn-outline-dark" onclick="llenar_updateform()" {{$btn_status}}>Buscar</button>
      </div>
    </div>
    <form class="border border-dark rounded px-2 py-2 mt-2" method="post" action="{{route('producto.update')}}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-3">
          <label for="up_nombre">Nombre</label>
          <input required type="text" name="nombre" class="form-control" id="up_nombre" placeholder="Nombre">
        </div>
        <div class="form-group col-md-3">
          <label for="up_subcategoria">Subcategoria</label>
          <select name="subcategoria" id="up_subcategoria" class="form-control">
            {!!$select_subcat!!}
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="up_marca">Marca</label>
          <select name="marca" id="up_marca" class="form-control">
            {!!$select_marca!!}
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="up_foto">Fotografia</label>
          <input type="file" name="img" class="form-control-file" id="up_foto" accept="image/png, image/jpeg">
          <input type="text" id="foto_producto_up" name="foto_default" hidden>
        </div>                                    
      </div>

      <div class="form-row justify-content-md-center">
        <div class="form-group col-md-12">
          <label for="up_desc_prod">Descripcion</label>
          <textarea class="form-control" id="up_desc_prod" rows="3" name="descripcion"></textarea>
        </div>                              
      </div>
      <input type="text" id="hash_hidden" name="hash_hidden" hidden>                                            
      <button id="btn_mod_producto" type="submit" class="btn btn-primary btn-sm btn-block" disabled>Modificar Producto</button>
    </form>
  </div>
  <div class="tab-pane fade" id="eliminar_prod" role="tabpanel" aria-labelledby="eliminar_prod-tab">

    <div class="row">
      <div class="col-md-2 mt-2"></div>
      <div class="col-md-4 mt-2">
        <select id="delete_prod_sel" class="custom-select">                   
          {!!$select_prod!!}
        </select>
      </div>
      <div class="col-md-4 mt-2">
        <button type="button" class="btn btn-danger" onclick="borrar_producto()" {{$btn_status}}>Eliminar</button>
      </div>
    </div>  

  </div>
</div>
@endsection
@section('inside_scripts')
function llenar_updateform()
{
  h=$("#up_prod_sel").val();
  if(h!=null)
  {
    $("#hash_hidden").val(h);
    $.ajax({
      headers: { 'X-CSRF-TOKEN':'{{csrf_token()}}' },
      type: "POST",
      url: "{{route('producto.edit')}}",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text!="error")
          {
            var objprod = JSON.parse(text);
            $("#up_nombre").val(objprod.nombre);
            $("#up_desc_prod").val(objprod.descripcion);
            $("#foto_producto_up").val(objprod.foto);
            $("#up_subcategoria").val(objprod.subcategoria);
            $("#up_marca").val(objprod.marca);

            $("#btn_mod_producto").prop("disabled", false);
          }
          else
          {
            alert(text);
          }
      }
    });
  }
}
function borrar_producto()
{
  h=$("#delete_prod_sel").val();
  if(h!=null)
  {
    $.ajax({
      headers: { 'X-CSRF-TOKEN':'{{csrf_token()}}' },
      type: "DELETE",
      url: "{{route('producto.destroy')}}",
      data: "hash="+ h,
      success : function(text)
      {   
          if(text=="ok")
          {
            location = "{{route('admin.producto')}}";
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