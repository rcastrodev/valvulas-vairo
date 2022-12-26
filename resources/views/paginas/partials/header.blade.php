<div class="fixed-top">
    <header class="header bg-blue d-sm-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="d-flex font-size-15">
                <div class="d-flex align-items-center ms-3">
                    <i class="fas fa-map-marker-alt text-white d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                    <address class="text-start text-white text-decoration-none underline font-size-15 fw-light mb-0">{{ $data->address }}</address>  
                </div>
                @if ($data->phone1)
                    @php $phone = Str::of($data->phone1)->explode('|') @endphp
                    <div class="d-flex align-items-center ms-3">
                        <i class="fal fa-phone text-white d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                        <div class="text-start">
                            @if(count($phone) == 2)
                                <a href="tel:{{$phone[0]}}" class="text-white text-decoration-none underline font-size-15 fw-light">{{ $phone[1] }}</a>
                            @else
                                <a href="tel:{{ $data->phone1 }}" class="text-white text-decoration-none underline font-size-15 fw-light">{{ $data->tel }}</a> 
                            @endif
                        </div>
                    </div>          
                @endif
                <div class="d-flex align-items-center ms-3">
                    <i class="far fa-envelope text-white d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                    <div class="text-start">
                        <a href="mailto:{{ $data->email }}" class="text-white text-decoration-none underline font-size-15 fw-light">{{ $data->email }}</a>        
                    </div>     
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light w-100 py-md-4 py-sm-1 bg-white">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ route('index') }}">
                <img src="{{ asset($data->logo_header) }}" class="img-fluid logo-header d-block me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end bg-white" id="navbarNav">
                <ul class="navbar-nav position-relative align-items-center justify-content-between">
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('empresa')) position-relative @endif">
                        <a class="nav-link font-size-18 text-black @if(Request::is('empresa')) active @endif" href="{{ route('empresa') }}">Empresa</a>
                    </li>
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('valvulas') || Request::is('valvulas/*') || Request::is('producto/*')) position-relative @endif">            
                        <a class="nav-link font-size-18 text-black @if(Request::is('valvulas') || Request::is('valvulas/*') || Request::is('producto/*')) active @endif" href="{{ route('valvulas') }}">Productos</a>
                    </li>
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('servicios')) position-relative @endif">
                        <a class="nav-link font-size-18 text-black @if(Request::is('servicios')) active @endif" href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('calidad')) position-relative @endif">
                        <a class="nav-link font-size-18 text-black @if(Request::is('calidad')) active @endif" href="{{ route('calidad') }}">Calidad</a>
                    </li>
                    
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('clientes')) position-relative @endif">
                        <a class="nav-link font-size-18 text-black @if(Request::is('clientes')) active @endif" href="{{ route('clientes') }}">Clientes</a>
                    </li>
                    <li class="nav-item me-sm-0 me-md-4 @if(Request::is('contacto')) position-relative @endif">
                        <a class="nav-link font-size-18 text-black @if(Request::is('contacto')) active @endif" href="{{ route('contacto') }}" >Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
</div>


