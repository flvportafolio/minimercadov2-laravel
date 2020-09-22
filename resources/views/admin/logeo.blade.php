@extends('layouts.admin')
@section('inside_main')
<h1 class="h2 text-center py-2">Menu Logeos</h1>
{!! $tabla !!}
{{ $lista_logs->links() }}
@endsection