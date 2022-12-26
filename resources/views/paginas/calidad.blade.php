@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
<div class="position-relative" style="height: 110px; background: #F5F5F5;">
	<div class="container mx-auto">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">	
				<li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-dark underline">Inicio</a></li>
				<li class="breadcrumb-item active text-dark" aria-current="page" style="font-weight: 600">Calidad</li>
			</ol>
		</div>
		<h2 class="text-uppercase position-absolute" style="bottom: 0px;">Calidad</h2>
	</div>
</div>
@isset($calidad)
	<section id="calidad" class="py-4">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 text-dark">
					<div class="fw-light font-size-16">{!! $calidad->content_1 !!}</div>
					<div class="">
						@foreach ($descargables as $descargable)
							@if ($descargable->image)
								@if (Storage::disk('public')->exists($descargable->image))
									<a href="{{ route('descargar-archivo', ['id'=>$descargable->id, 'reg' => 'image']) }}" class="bg-light d-block py-2 text-dark underline mb-4 px-3 d-flex justify-content-between align-items-center font-size-18">
										<strong>{{ $descargable->content_1 }}</strong>
										<i class="fas fa-arrow-to-bottom"></i>
									</a>
								@endif			
							@endif
						@endforeach
					</div>
				</div>
				@if(count($calidad->images))
					<div class="col-sm-12 col-md-6 mb-sm-4 mb-md-0">
						<div id="sliderSection" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-indicators">
								@foreach ($calidad->images as $k => $item)
									<button type="button" data-bs-target="#sliderSection" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
								@endforeach
							</div>
							<div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
								@foreach ($calidad->images as $key => $slider)
									<div class="carousel-item @if(!$key) active @endif" style="background-image: url({{$slider->image}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
									</div>			
								@endforeach
							</div>	
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>	
@endisset
@endsection
