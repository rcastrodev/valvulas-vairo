@extends('adminlte::page')
@section('title', 'Editar producto')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Editar producto</h1>
        <a href="{{ route('product.content') }}" class="btn btn-sm btn-primary">ver productos</a>
    </div>
@stop
@section('content')
<div class="row">
    @includeIf('administrator.partials.mensaje-exitoso')
    @includeIf('administrator.partials.mensaje-error')
</div>
<form action="{{ route('product.content.update') }}" method="post" enctype="multipart/form-data" class="card card-primary" data-sync="no">
    @method('put')
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="card-header">Producto</div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body row">
        <div class="form-group col-sm-12 col-md-5">
            <label for="">Nombre del producto</label>
            <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Nombre del producto">
        </div>
        <div class="form-group col-sm-12 col-md-5">
            <label for="">Categorías</label>
            <select name="category_id" class="form-control" >
                <option selected disabled>Escoger marca</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-2">
            <label for="">Orden</label>
            <input type="text" name="order" value="{{$product->order}}" class="form-control" placeholder="Ej AA BB CC">
        </div>
        @if ($product->data_sheet)
            <div class="form-group col-sm-12">
                <a href="{{ route('ficha-tecnica', ['id'=> $product->id]) }}" class="btn btn-sm btn-primary rounded-pill" target="_blank">Ficha técnica</a>
                <button class="btn btn-sm rounded-circle btn-danger" id="borrarFicha" data-url="{{ route('borrar-ficha-tecnica', ['id'=> $product->id]) }}">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>          
        @endif
        <div class="form-group col-sm-12">
            <label>Ficha técnica</label>
            <input type="file" name="data_sheet" class="form-control-file">
        </div>
        <div class="form-group col-sm-12">
            <label for="">Descripción</label>
            <textarea name="description" class="form-control ckeditor" cols="30" rows="2">{{$product->description}}</textarea>
        </div>  
        <div class="form-group col-sm-12 col-md-6">
            <label for="">Video 1</label>
            <input type="text" name="extra1" value="{{$product->extra1}}" class="form-control">
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <label for="">Video 2</label>
            <input type="text" name="extra2" value="{{$product->extra2}}" class="form-control">
        </div>  
    </div>
      <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
<div class="row pb-5">
    <div class="col-sm-12">
        <div class="d-flex mb-3">
            <h3 class="mr-3">Imágenes</h3>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">Subir</button>
        </div>
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orden</th>
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
            <h3 class="mr-3">Características</h3>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-application">Subir</button>
        </div>
        <table id="page_table_aplications" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orden</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@includeIf('administrator.product.images.create')
@includeIf('administrator.product.images.update') 
@includeIf('administrator.product.applications.create')
@includeIf('administrator.product.applications.update') 
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('product.content')}}">
    <meta name="content_find" content="{{route('content')}}">
    <meta name="url2" content="{{route('product.slider.get-images', ['id' => $product->id])}}">
    <meta name="url3" content="{{route('product.slider.get-application', ['id' => $product->id])}}">
    
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script>
        $('document').ready(function(){
            $('.select2').select2()
        })
        
        // borrar ficha técnica 
        let borrarFicha = document.getElementById('borrarFicha')
        if (borrarFicha) {
            borrarFicha.addEventListener('click', function(e){
                e.preventDefault()
                axios.delete(this.dataset.url)
                .then(r => {
                    this.closest('div').remove()
                })
                .catch(e => console.error( new Error(e) ))      
            })  
        }
    </script>

    <script>
        // images products
        let table = $('#page_table_slider').DataTable({
            serverSide: true,
            ajax: `${$('meta[name="url2"]').attr('content')}`,
            bSort: true,
            order: [],
            destroy: true,
            columns: [
                { data: "id" },
                { data: "order" },
                { data: "image" },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
            }, 
        });

        async function findContentImageProduct(id)
        {
            // get content 
            let url = `${document.querySelector('meta[name="url"]').getAttribute('content')}/image-product`
            if(url){
                if(id){
                    try {
                        let result = await axios.get(`${url}/${id}`)
                        let content = result.data.content 
                        dataImageProduct(content)
                    } catch (error) {
                        console.log(new Error(error));
                    }
                }
            }
        }

        function dataImageProduct(content)
        {
            let form = document.getElementById('form-update-slider')
            form.reset()
            form.querySelector('input[name="id"]').setAttribute('value', content.id)
            if (content.order) 
                form.querySelector('input[name="order"]').setAttribute('value', content.order)
        }

        function modalDestroyProduct(id)
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
                    elementDestroy2(id)
                }
            })
        }

        function elementDestroy2(id)
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


<script>
    // aplications product
    let table2 = $('#page_table_aplications').DataTable({
        serverSide: true,
        ajax: `${$('meta[name="url3"]').attr('content')}`,
        bSort: true,
        order: [],
        destroy: true,
        columns: [
            { data: "id" },
            { data: "order" },
            { data: "image" },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
        }, 
    });

    async function findContentApplicationProduct(id)
    {
        // get content 
        let url = `${document.querySelector('meta[name="url"]').getAttribute('content')}/application-product`
        if(url){
            if(id){
                try {
                    let result = await axios.get(`${url}/${id}`)
                    let content = result.data.content 
                    dataApplicationProduct(content)
                } catch (error) {
                    console.log(new Error(error));
                }
            }
        }
    }

    function dataApplicationProduct(content)
    {
        let form = document.getElementById('form-update-application')
        form.reset()
        form.querySelector('input[name="id"]').setAttribute('value', content.id)
        if (content.order) 
            form.querySelector('input[name="order"]').setAttribute('value', content.order)
    }
</script>
@stop

