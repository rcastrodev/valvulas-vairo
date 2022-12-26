@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
<div class="position-relative" style="height: 110px; background: #F5F5F5;">
	<div class="container mx-auto">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">	
				<li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-dark underline">Inicio</a></li>
				<li class="breadcrumb-item active text-dark" aria-current="page" style="font-weight: 600">Clientes</li>
			</ol>
		</div>
		<h2 class="text-uppercase position-absolute" style="bottom: 0px;">Clientes</h2>
	</div>
</div>
@isset($clientes)
	@if (count($clientes))
        <section class="row container mx-auto py-5">
            @foreach ($clientes as $cliente)
                @if ($cliente->image)
                    @if (Storage::disk('public')->exists($cliente->image))
                        <div class="col-sm-12 col-md-3 d-flex align-items-center justify-content-center mb-4">
                            <img src="{{ asset($cliente->image) }}" alt="{{ $cliente->content_1 }}" class="img-fluid" style="object-fit: contain; max-height: 130px;">
                        </div>      
                    @endif
                @endif
            @endforeach
        </section>
	@endif
@endisset
</div>
@isset($sector)
    @if (count($sector->images))
        <section class="row container mx-auto py-5">
            <h2 class="col-sm-12 mb-5 font-size-30">SECTORES</h2>
            @foreach ($sector->images as $sector)
                @if ($sector->image)
                    @if (Storage::disk('public')->exists($sector->image))
                        <div class="col-sm-12 col-md-3 mb-4">
                            <div class="d-flex align-items-center justify-content-center mb-4 py-3" style="border: 1px solid #D8D8D8;">
                                <img src="{{ asset($sector->image) }}" alt="{{ $sector->content_1 }}" class="img-fluid" style="object-fit: contain; height: 120px;">
                            </div>     
                            <div class="text-center font-size-20">{{ $sector->description }}</div>
                        </div>
                    @endif
                @endif
            @endforeach
        </section>
    @endif
@endisset

@endsection