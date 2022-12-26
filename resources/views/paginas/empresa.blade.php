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
		<h2 class="text-uppercase position-absolute" style="bottom: 0px;">Empresa</h2>
	</div>
</div>
@isset($section1)
	<section id="section1" class="py-4">
		<div class="container">
			<div class="row">
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
				<div class="col-sm-12 col-md-5 text-dark">
					<h3 class="font-size-28 mb-sm-3 mb-md-4">{{$section1->content_1}}</h3>
					<div class="fw-light font-size-16">{!! $section1->content_2 !!}</div>
				</div>
			</div>
		</div>
	</section>	
@endisset
@isset($sections3)
	@if (count($sections3))
		<div class="py-5">
			<div class="row container mx-auto mb-5">
				<div class="col-sm-12">
					<h3 class="mb-5 font-size-28 text-uppercase" style="font-weight:400">{{ $section2->content_1 }}</h3>
				</div>
				@foreach ($sections3 as $s3)
					<div class="col-sm-12 col-md-4 mb-4">
						<div class="card-valores bg-white py-5 px-4 d-flex align-items-center">
							<div class="">
								@if (Storage::disk('public')->exists($s3->image))
								<img src="{{ asset($s3->image) }}" class="img-fluid d-block mb-4" style="min-height: 54px; max-height: 54px;">
								@else
									<div class="mb-4" style="min-height: 54px; max-height: 54px;"></div>
								@endif
								<h4 class="mb-3 font-size-24 text-uppercase" style="font-weight: 500">{{ $s3->content_1 }}</h4>
								<div class="font-size-16">{!! $s3->content_2 !!}</div>
							</div>
						</div>
					</div>			
				@endforeach
			</div>
		</div>
	@endif
@endisset
@endsection
