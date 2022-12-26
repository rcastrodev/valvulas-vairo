@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
<div class="position-relative" style="height: 110px; background: #F5F5F5;">
	<div class="container mx-auto">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">	
				<li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-dark underline">Inicio</a></li>
				<li class="breadcrumb-item active text-dark" aria-current="page" style="font-weight: 600">Empresa</li>
			</ol>
		</div>
		<h2 class="text-uppercase position-absolute" style="bottom: 0px;">Servicios</h2>
	</div>
</div>
@isset($section1)
	<section id="section1" class="py-4">
		<div class="container">
			<div class="row mb-4">
				@if(count($section1->images))
					<div class="col-sm-12 col-md-6 mb-sm-4 mb-md-0">
						<div id="sliderSection" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-indicators">
								@foreach ($section1->images as $k => $item)
									<button type="button" data-bs-target="#sliderSection" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
								@endforeach
							</div>
							<div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
								@foreach ($section1->images as $key => $slider)
									<div class="carousel-item @if(!$key) active @endif" style="background-image: url({{$slider->image}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
									</div>			
								@endforeach
							</div>	
						</div>
					</div>
				@endif
				<div class="col-sm-12 col-md-5 text-dark servicios">
					<div class="fw-light font-size-16 mb-4">{!! $section1->content_1 !!}</div>
					<a href="{{ route('empresa') }}" class="text-uppercase btn bg-blue text-white py-2 px-5" style="border-radius: 0;">CONSULTAR</a>
				</div>
			</div>
		</div>
	</section>	
@endisset
@endsection
@push('head')
	<style>
		li{
			margin-bottom: 10px;
		}

		.servicios ul li{
			list-style-image: url({{ asset('images/check.png') }})
		}
	</style>
@endpush

