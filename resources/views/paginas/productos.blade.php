@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
@isset($productos)
    <div class="py-5 bg-light">
        <div class="container row mx-auto">
			<div class="col-sm-12 mb-3">
				<h2 class="text-uppercase mb-4 font-size-36" style="font-weight: 500">Productos</h2>
			</div>
			<aside class="col-sm-12 col-md-3">
                @includeIf('paginas.partials.form-productos')
				<h4 class="font-size-15 pb-3" style="color:#9F9F9F; font-weight:300; border-bottom:1px solid #D9D9D9;">CATEGORIAS</h4>
                <ul class="p-0" style="list-style: none;">
                    @foreach ($categorias as $c)
                        <li class="py-2"> 
                            <a href="{{ route('categoria', ['id'=> $c->id]) }}" class="d-block p-2 text-decoration-none  text-decoration-none font-size-16 position-relative text-dark">{{$c->name}}</a>
                        </li>                        
                    @endforeach
                </ul>             
            </aside>
            <div class="col-sm-12 col-md-9">
                @if ($productos->count())
                    <section class="row font-size-14 my-3">
                        @foreach ($productos as $p)
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                @includeIf('paginas.partials.producto', ['p' => $p])
                            </div>
                        @endforeach                
                    </section>    
                @else
                    <h2 class="text-center my-5">No tenemos productos cargados en la actualidad</h2>
                @endif
            </div>
        </div>
    </div>
@endisset
@endsection


       
