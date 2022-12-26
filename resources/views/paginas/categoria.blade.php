@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
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
@isset($productos)
    <div class="py-5">
        <div class="container row mx-auto px-0">
			<aside class="col-sm-12 col-md-3">
                <ul class="p-0" style="list-style: none;">
                    @foreach ($categorias as $c)
                        <li class="py-2"> 
                            <a     
                                @if (! $c->product_direct)
                                    href="{{ route('categoria', ['id'=> $c->id ]) }}"
                                @else
                                    @if (count($c->products)) href="{{ route('producto', ['id'=> $c->products()->first()->id ]) }}" @endif
                                @endif 
                                class="d-block p-2 text-decoration-none  text-decoration-none font-size-16 position-relative text-dark"
                                style="@if($c->id == $categoria->id) font-weight: 700; @endif">{{$c->name}}
                            </a>
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


       
