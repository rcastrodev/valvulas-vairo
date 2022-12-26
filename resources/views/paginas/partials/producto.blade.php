<a href="{{ route('producto', ['id'=> $p->id ]) }}" class="card producto text-decoration-none bg-light d-flex justify-content-center align-items-center text-dark" style="height: 365px;">
    @if (count($p->images))
        @if (count($p->images()->where('name', 'image')->get()))
            @if (Storage::disk('public')->exists($p->images()->where('name', 'image')->first()->image))
                <img src="{{ asset($p->images()->where('name', 'image')->first()->image) }}" class="img-fluid img-product mb-3" style="min-height:284px; max-height:284px; object-fit: contain;">
            @else
                <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product mb-3" style="min-height:284px; max-height:284px; object-fit: contain;">
            @endif 
        @else
            <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product mb-3" style="min-height:284px; max-height:284px; object-fit: contain;">  
        @endif
    @else
        <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product mb-3" style="min-height:284px; max-height:284px; object-fit: contain;">
    @endif
    <div class="card-body d-block w-100" style="border-top: 1px solid #D9D9D9;">
        <p class="card-text text-center mb-0 ">
            <span class="fw-bold font-size-20">{{ Str::limit($p->name, 20) }}</span>
        </p>
    </div>
</a>

