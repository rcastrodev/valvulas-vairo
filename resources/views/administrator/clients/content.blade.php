@extends('adminlte::page')
@section('title', 'Clientes')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Clientes</h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">crear</button>
    </div>
@stop
@section('content')
@include('administrator.partials.mensaje-exitoso')
@include('administrator.partials.mensaje-error')
<div class="row mb-5">
    <div class="col-sm-12">
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row pb-5">
    <div class="col-sm-12">
        <div class="d-flex mb-3">
            <h3 class="mr-3">Sectores</h3>
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
@includeIf('administrator.clients.modals.create')
@includeIf('administrator.clients.modals.update')
@includeIf('administrator.clients.images.create')
@includeIf('administrator.clients.images.update') 
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('clients.content')}}">
    <meta name="url2" content="{{ route('clients.slider.get-images', ['id'=> $content->id]) }}">
    <meta name="content_find" content="{{route('content')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop
@section('js')
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/clients/index.js') }}"></script>
    <script>
        let table2 = $('#page_table_images').DataTable({
            serverSide: true,
            ajax: `${$('meta[name="url2"]').attr('content')}`,
            bSort: true,
            order: [],
            destroy: true,
            columns: [
                { data: "order" },
                { data: "image" },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
            }, 
        });

        async function findContentImage(id)
        {
            // get content 
            let url = `${document.querySelector('meta[name="url"]').getAttribute('content')}/image`
            if(url){
                if(id){
                    try {
                        let result = await axios.get(`${url}/${id}`)
                        let content = result.data.content 
                        dataImage(content)
                    } catch (error) {
                        console.log(new Error(error));
                    }
                }
            }
        }

        function dataImage(content)
        {
            let form = document.getElementById('form-update-image')
            form.reset()
            form.querySelector('input[name="id"]').setAttribute('value', content.id)
            if (content.order) 
                form.querySelector('input[name="order"]').setAttribute('value', content.order)

            if (content.description) 
                form.querySelector('input[name="description"]').setAttribute('value', content.description)
        }

        function modalImageDestroy(id)
        {
            Swal.fire({
                title: 'Deseas eliminar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    imageDestroy2(id)
                }
            })
        }

        function imageDestroy2(id)
        {
            axios.delete(`${$('meta[name="url"]').attr('content')}/image/${id}`).then(r => {
                Swal.fire(
                    'Eliminado!',
                    '',
                    'success'
                )

                if(typeof table !== 'undefined')    
                    table.ajax.reload()

                if(typeof table2 !== 'undefined')    
                    table2.ajax.reload()
                
            }).catch(error => console.error(error))

        }
    </script>
@stop

