<footer class="font-size-14 text-sm-center text-md-start bg-white">
    <div class="row justify-content-between container mx-auto py-sm-2 py-md-5">
        <div class="col-sm-12 col-md-2" style="">
            @if (Storage::disk('public')->exists($data->logo_footer))
                <div class="d-sm-none d-md-block">
                    <img src="{{ asset($data->logo_footer) }}" class="d-block img-fluid">
                </div>
            @endif
        </div>
        <div class="col-sm-12 col-md-2 d-sm-none d-md-block">
            <div class="row justify-content-between">
                <div class="col-sm-12">    
                    <div class="row">
                        <h6 class="text-dark fw-bold mb-4 text-sm-start pe-5 pb-2 w-100 font-size-16">Secciones</h6>
                        <div class="col-sm-12 col-md-6">
                            <a href="{{ route('empresa') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Empresa</a>
                            <a href="{{ route('valvulas') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Productos</a>
                            <a href="{{ route('servicios') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Servicios</a>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <a href="{{ route('calidad') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Calidad</a>
                            <a href="{{ route('clientes') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Clientes</a>
                            <a href="{{ route('contacto') }}" class="d-block text-decoration-none text-dark mb-2 underline font-size-12">Contacto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 d-sm-none d-md-block">
            <div class="row justify-content-between">
                <div class="col-sm-12">    
                    <div class="row">
                        <h6 class="text-dark fw-bold mb-4 text-sm-start pe-5 pb-2 w-100 font-size-16">Newsletter</h6>
                        <form action="{{ route('newsletter.store') }}" id="formNewsletter">
                            @csrf
                            <div class="">
                                <div class="input-group font-size-12">
                                    <input type="email" name="email" autocomplete="off" class="form-control font-size-12" placeholder="Ingresa tu email" style="background-color: #F5F5F5; border-radius:0px;">
                                    <button type="submit" id="" class="input-group-text bg-blue-1 text-white bg-blue font-size-12" style="border: none; border-radius:0px;">SUSCRIBITE</button>
                                </div>
                                <div id="mensaje-newsletter" class="text-dark"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 font-size-13 px-sm-3 px-md-0">
            <h6 class="text-dark fw-bold mb-4 text-sm-start pe-5 pb-2 font-size-16">Contacto</h6>
            <div class="row">
                <div class="col-sm-12">
                    @if ($data->address)
                        <div class="d-flex align-items-center mb-3 text-start">
                            <address class="d-block text-dark m-0"> {{ $data->address }}</address>
                        </div>             
                    @endif
                    @if ($data->phone1)
                        @php $phone = Str::of($data->phone1)->explode('|') @endphp
                        <div class="d-flex align-items-center mb-3">
                            @if(count($phone) == 2)
                                <a href="tel:{{$phone[0]}}" class="text-dark text-decoration-none underline">{{ $phone[1] }}</a>
                            @else
                                <a href="tel:{{$data->phone1}}" class="text-dark text-decoration-none underline">{{ $data->phone1 }}</a>
                            @endif
                        </div>          
                    @endif
                    @if ($data->email)
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-start">
                                <a href="mailto:{{ $data->email }}" class="text-dark text-decoration-none underline">{{ $data->email }}</a>        
                            </div>     
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 bg-black font-size-14">
        <div class="container text-center d-flex justify-content-between">
            <span class="text-white">© Copyright 2022 Válvulas Vairo. Todos los derechos reservados</span>
            <a href="https://osole.com.ar/" class="text-white text-decoration-none underline">BY OSOLE</a>
        </div>
    </div>
</footer>
@if($data->phone3)
    <a href="https://wa.me/{{$data->phone3}}" class="position-fixed" style="background-color: #0DC143; color: white; font-size: 40px; padding: 0px 13px; border-radius: 100%; bottom: 30px; right: 40px;">
        <i class="fab fa-whatsapp"></i>
    </a>
@endif
