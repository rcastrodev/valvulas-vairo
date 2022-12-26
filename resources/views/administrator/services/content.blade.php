@extends('adminlte::page')
@section('title', 'Servicios')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Servicios</h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">crear</button>
    </div>
@stop
@section('content')
@include('administrator.partials.mensaje-exitoso')
@include('administrator.partials.mensaje-error')
@isset($section1)
    <form action="{{ route('services.content.updateInfo') }}" method="post" class="row mt-5 mb-5" data-sync="no" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$section1->id}}">
        <div class="form-group col-sm-12">
            <textarea name="content_1" cols="30" rows="10" class="ckeditor" placeholder="Contenido">{{ $section1->content_1 }}</textarea>
        </div>
        <div class="text-right col-sm-12">
            <button type="submit" class="btn btn-primary w-100">Actualizar</button>
        </div> 
    </form>
@endisset
<div class="row pb-5">
    <div class="col-sm-12">
        <div class="d-flex mb-3">
            <h3 class="mr-3">Imágenes</h3>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-image">Subir</button>
        </div>
        <table id="page_table_images" class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@includeIf('administrator.services.images.create')
@includeIf('administrator.services.images.update') 
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('services.content')}}">
    <meta name="content_find" content="{{route('content')}}">
    <meta name="url2" content="{{ route('services.slider.get-images', ['id'=> $section1->id]) }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop
@section('js')
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/services/index.js') }}"></script>
@stop

