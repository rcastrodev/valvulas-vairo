@extends('paginas.partials.app')
@section('content')
@if(count($sliders))
	<div id="sliderHero" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			@foreach ($sliders as $k => $item)
				<button type="button" data-bs-target="#sliderHero" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
			@endforeach
		</div>
		<div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
			@foreach ($sliders as $key => $slider)
				<div class="carousel-item @if(!$key) active @endif" style="background-image: url({{$slider->image}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
					<div class="container mx-auto contentHero">
						<div class="mt-sm-2 text-start text-white" style="max-width: 800px !important;">
							<h1 class="font-size-72 hero-content-slider mb-sm-2 mb-md-5">{{ $slider->content_1 }}</h1>
							<p class="hero-content-slider font-size-19 mb-5 fw-light" style="color: #F5F5F5;">{{ $slider->content_2 }}</p>
							<a href="{{ route('empresa') }}" class="btn bg-blue text-white py-2 px-5 text-uppercase font-size-17" style="border-radius: 0;">MÁS INFORMACIÓN</a>
						</div>
					</div>
				</div>			
			@endforeach
		</div>	
	</div>	
@endif
@isset($categories)
@if (count($categories))
	<div class="py-5" style="overflow-x: hidden;">
		<div class="row container mx-auto mt-sm-0 mt-md-5">
			<div class="col-sm 12-col-md-6">
				<h3 class="text-dark text-center font-size-36 mb-5 text-uppercase" style="font-weight: 400;">nuestros productos</h3>
			</div>
		</div>
		<div class="container mx-auto row">
			@foreach ($categories as $c)
				<div class="col-sm-12 col-md-3 mb-4">
					@includeIf('paginas.partials.categoria', ['c' => $c])
				</div>
			@endforeach		
		</div>
	</div>
@endif
@endisset
@isset($section2)
	<section id="section2" class="py-3">
		<div class="row">
			<div class="col-sm-12 col-md-6 px-0 d-sm-none d-md-flex align-items-center">
				@if (Storage::disk('public')->exists($section2->image))
					<img src="{{ asset($section2->image) }}" class="img-fluid w-100" style="height:580px; object-fit:cover;">
				@endif
			</div>
			<div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-center py-sm-2 py-md-0">
				<div class="text-dark" style="max-width: 95%">
					<h3 class="font-size-36 mt-md-4 mt-sm-0 mb-4" style="font-weight: 500">{{ $section2->content_1 }}</h3>
					<div class="font-size-20 mb-5" style="font-weight: 400">{!! $section2->content_2 !!}</div>
					<a href="{{ route('empresa') }}" class="text-uppercase btn bg-blue text-white py-2 px-5" style="border-radius: 0;">MÁS INFORMACIÓN</a>
				</div>
			</div>
		</div>
	</section>
@endisset
@isset($clientes)
	@if (count($clientes))
		<div class="py-5 bg-light d-sm-none d-md-block">
			<div class="row container mx-auto mb-5">
				<div class="col-sm 12-col-md-6">
					<h3 class="text-dark fw-bold font-size-30 text-center text-uppercase" style="font-weight: 400;">Clientes</h3>
				</div>
			</div>
			<div class="container mx-auto px-0 slick">
				@foreach ($clientes as $cl)
					<div class="card-slick"><img src="{{ asset($cl->image) }}" class="img-fluid"></div>
				@endforeach		
			</div>
		</div>
	@endif
@endisset
@endsection
@push('head')
	<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
	<style>
		@media(min-width:992px){
			#section2 .row{
				min-height: 540px;
			}
		}
		.card-slick {
			height: 128px;
			display: flex !important;
			align-items: center;
			justify-content: center;
		}
		.slick-list .card.producto{
			margin-right: 10px;
		}
		.slick-dots li{
			margin-right: 10px;
		}
		.slick-dots li button:before{
			content: '';
			width: 30px;
			height: 5px;
			background-color: black;
		}
		.slick-next:before{
			content: url("{{ asset('images/right.svg') }}")  !important;
		}
		.slick-prev:before{
			content: url("{{ asset('images/left.svg') }}")  !important;
		}
		.slick-dots {
			bottom: -55px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{ asset('vendor/slick/slick.js') }}"></script>
	<script>
		$('.slick').slick({
			dots: true,
			infinite: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			responsive: [
				{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					infinite: true,
					dots: false
				}
				},
				{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
				},
				{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
				}
			]
		});
	</script>
@endpush


