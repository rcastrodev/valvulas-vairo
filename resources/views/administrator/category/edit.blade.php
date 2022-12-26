@extends('adminlte::page')
@section('title', 'Editar categoría')
@section('content')
@include('administrator.partials.mensaje-error')
<form action="{{ route('category.content.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data" class="row mb-5" data-sync="no">
    @csrf
    <input type="hidden" name="id" value="{{$category->id}}">
    <div class="col-sm-12 col-md-10">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" placeholder="Nombre" value="{{ $category->name }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label for="">Orden</label>
            <input type="text" name="order" placeholder="Orden" value="{{ $category->order }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label for="">Destacado</label>
            <input type="checkbox" name="outstanding" value="1" @if($category->outstanding == '1') checked @endif>
        </div>   
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label for="">Producto directo</label>
            <input type="checkbox" name="product_direct" value="1" @if($category->product_direct == '1') checked @endif>
        </div>   
    </div>
    <div class="w-100"></div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">Imagen</label>
            <input type="file" name="image" class="">
            @if (Storage::disk('public')->exists($category->image))
                <img src="{{ asset($category->image) }}" class="img-fluid" style="display: block; margin-top:10px; object-fit:cover;">
            @endif
            <small>Tamaño recomendado de 288x284px</small>
        </div>
    </div>
    <div class="col-sm-12 mt-4">
        <button class="btn btn-primary w-100">Guardar</button>
    </div>
</form>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <meta name="root" content="{{route('category.content')}}">
@stop
@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@stop