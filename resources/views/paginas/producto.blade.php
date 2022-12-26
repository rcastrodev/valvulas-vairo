@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
<div class="position-relative" style="height: 110px; background: #F5F5F5;">
	<div class="container mx-auto">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">	
				<li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-dark underline">Inicio</a></li>
				<li class="breadcrumb-item active text-dark" aria-current="page" style="font-weight: 600">Válvulas</li>
			</ol>
		</div>
		<h2 class="text-uppercase position-absolute" style="bottom: 0px;">Válvulas</h2>
	</div>
</div>
<div class="py-5">
    <div class="row container mx-auto mb-5 px-0">
        <aside class="col-sm-12 col-md-3">
            <ul class="p-0" style="list-style: none;">
                @foreach ($categorias as $c)
                    <li class="py-1"> 
                        <a href="{{ route('categoria', ['id'=> $c->id]) }}" class="d-block p-2 text-decoration-none  text-decoration-none font-size-16 position-relative text-dark"
                        style="@if($c->id == $producto->category->id) font-weight: 700; @endif">{{$c->name}}</a>
                    </li>              
                @endforeach
            </ul>             
        </aside>
        <div class="col-sm-12 col-md-9 row">
            <div class="col-sm-12 col-md-5 mb-5">
                <div class="mb-2 bg-white">
                    @if (count($producto->images))
                        <img src="{{ asset($producto->images()->where('name', 'image')->first()->image) }}" id="imagen-actual" class="img-fluid w-100 img-product" style="">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" id="imagen-actual" class="img-fluid w-100 img-product">
                    @endif  
                </div>
                @if (count($producto->images()->where('name', 'image')->get()))
                    <ul class="d-flex flex-wrap p-0" style="list-style: none;">
                        @foreach ($producto->images()->where('name', 'image')->orderBy('order', 'ASC')->get() as $i)
                            <li class="me-2 mb-1" style="border: 1px solid #D8D8D8;">
                                <img src="{{ asset($i->image) }}" class="img-fluid imagenes" style="height: 79px; width:79px; object-fit: cover; cursor:pointer;">
                            </li>                
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-12 col-md-7">
                <h1 class="font-size-28 mt-2 mb-4">{{ $producto->name }}</h1>
                <div class="ul-style font-size-16 mb-4 fw-light">{!! $producto->description !!}</div>
                <div class="row mb-5">
                    <div class="col-sm-12 col-md-6">
                        <a href="{{ route('contacto') }}" class="d-block w-100 bg-blue text-white py-2 btn text-uppercase position-relative" style="border-radius: 0">
                            CONSULTAR
                        </a>
                    </div>
                    @if (Storage::disk('public')->exists($producto->data_sheet))
                        <div class="col-sm-12 col-md-6">
                            <a href="{{ route('ficha-tecnica', ['id'=>$producto->id]) }}" class="w-100 py-2 d-block mt-sm-2 mt-md-0 text-center underline text-uppercase" style="border: 1px solid #11579F; color:#11579F; border-radius:0;">descargar ficha</a>    
                        </div>
                    @endif
                </div>
            </div>
            @if (count($producto->images))
                <div class="mb-5 col-sm-12">
                    <h4 class="font-size-24" style="font-weight:500">Características</h4>
                    <div class="row">
                        @foreach ($producto->images()->where('name', 'application')->orderBy('order', 'ASC')->get() as $applicaction)
                            <div class="col-sm-12 {{-- col-md-4 mb-4 --}}">
                                @if (Storage::disk('public')->exists($applicaction->image))
                                    <img src="{{ asset($applicaction->image) }}" class="img-fluid" style="height: 373px; object-fit:contain;">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" class="img-fluid w-100" style="height: 373px; object-fit:contain;">
                                @endif
                            </div> 
                            {{-- 
                                <div class="col-sm-12 col-md-8 mb-4 tabla font-size-16">
                                    {!! $applicaction->description !!}
                                </div>     
                            --}}
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($producto->extra1 || $producto->extra2)
                <div class="row col-sm-12 videos">
                    <div class="col-sm-12"><h2>Videos</h2></div>
                    <div class="col-sm-12 col-xxl-6 mb-3">{!! $producto->extra1 !!}</div>
                    <div class="col-sm-12 col-xxl-6 mb-3">{!! $producto->extra2 !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('head')
    <style>
        .videos iframe{
            max-width: 100%;
        }
        .ul-style ul{
            list-style: none;
            padding: 0
        }
        .tabla table{
            width: 100%;
        }
        .tabla th, .tabla td{
            border: 1px solid #D8D8D8;
            padding: 5px 2px;
            max-width: 140px;
            text-align: center;
        }
        .tabla p{
            margin-bottom: 0;
        }
    </style>
@endpush
@push('scripts')
<script>
    $('.imagenes').click(function (e){
        e.preventDefault()
        $('#imagen-actual').attr('src', e.target.src)
    })
</script>
@endpush


       
