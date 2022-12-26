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
@isset($categories)
    @if (count($categories))
        <div class="py-5" style="overflow-x: hidden;">
            <div class="container mx-auto row px-0">
                @foreach ($categories as $c)
                    <div class="col-sm-12 col-md-3 mb-4">
                        @includeIf('paginas.partials.categoria', ['c' => $c])
                    </div>
                @endforeach		
            </div>
        </div>
    @endif
@endisset

@endsection
