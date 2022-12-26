@extends('paginas.partials.app')
@section('content')
<div class="espacio-nav"></div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.0647158450847!2d-58.363181203191445!3d-34.7165173557204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332b0ae5497b1%3A0x4bfeb02addacee01!2sGervasio%20A.%20de%20Posadas%201034%2C%20B1824%20Lan%C3%BAs%2C%20Provincia%20de%20Buenos%20Aires%2C%20Argentina!5e0!3m2!1ses!2sve!4v1663683003689!5m2!1ses!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-100" style="height:450px;"></iframe>
<div class="py-5">
    <div class="container mx-auto">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span class="d-block">{{$error}}</span>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
        @endif
        @if (Session::has('mensaje'))
            <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('mensaje') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                    
        @endif
        <form action="{{ route('send-contact') }}" method="post" class="mb-5">
            @csrf
            <div class="row justify-content-between">
                <div class="col-sm-12">
                    <h1 class="text-uppercase font-size-36 mb-4">Contacto</h1>
                </div>
                <div class="col-sm-12 col-md-4 font-size-14">
                    <div class="font-size-16 fw-light mb-4">Complete el formulario para que podamos contactarnos con usted a la brevedad</div> 
                    <div class="d-flex align-items-center mb-4">
                        <span class="d-block"> {{ $data->address }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        @php $phone = Str::of($data->phone1)->explode('|') @endphp
                        @if (count($phone) == 2)
                            <a href="tel:{{ $phone[0] }}" class="underline text-dark text-decoration-none">{{ $phone[1] }}</a>
                        @else 
                            <a href="tel:{{ $data->phone1 }}" class="underline text-dark text-decoration-none">{{ $data->phone1 }}</a>
                        @endif        
                    </div> 
                    @if ($data->phone3)
                        @php $phone3 = Str::of($data->phone3)->explode('|') @endphp
                        <div class="d-flex align-items-center mb-4">
                            @if(count($phone3) == 2)
                                <a href="https://wa.me/{{$phone3[0]}}" class="underline text-dark text-decoration-none">{{ $phone3[1] }}</a>
                            @else
                                <a href="https://wa.me/{{$data->phone3}}" class="underline text-dark text-decoration-none">{{ $data->phone3 }}</a>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex align-items-center mb-4">
                        <div class="">
                            <a href="mailto:{{ $data->email }}" class="underline text-dark text-decoration-none">{{ $data->email }}</a><br> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="d-block fw-bold mb-2" style="font-weight: 400;">Nombre *</label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="d-block fw-bold mb-2" style="font-weight: 400;">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="d-block fw-bold mb-2" style="font-weight: 400;">Teléfono *</label>
                                <input type="tel" name="telefono" value="{{ old('telefono') }}" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <label class="d-block fw-bold mb-2" style="font-weight: 400;">Empresa</label>
                                <input type="text" name="empresa" value="{{ old('empresa') }}" class="form-control font-size-14 input-fondo">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <label class="d-block fw-bold mb-2" style="font-weight: 400;">Mensaje</label>
                                <textarea name="mensaje" class="form-control font-size-14 input-fondo" cols="30" rows="5">
                                    {{ old('mensaje') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3">
                            <div class="form-group pt-4">{!! app('captcha')->display() !!}</div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 mb-sm-3">
                            <button type="submit" class="btn bg-blue font-size-14 py-2 mb-sm-3 mb-md-0 text-white px-5" style="border-radius: 0;">ENVIAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('head')
@endpush
@push('scripts')	
@endpush
       

