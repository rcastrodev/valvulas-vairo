<a 
    @if (! $c->product_direct)
        href="{{ route('categoria', ['id'=> $c->id ]) }}"
    @else
        @if (count($c->products)) href="{{ route('producto', ['id'=> $c->products()->first()->id ]) }}" @endif
    @endif
    class="card producto text-decoration-none bg-light" style="height: 365px;">
        @if ($c->image)
            <img src="{{ asset($c->image) }}" class="img-fluid img-product" style="min-height: 284px; max-height:284px; object-fit: contain;">
        @else
            <img src="{{ asset('images/default.jpg') }}" class="img-fluid img-product" style="min-height: 284px; max-height:284px; object-fit: contain;">
        @endif
    <div class="card-body d-flex align-items-center justify-content-center">
        <p class="card-text text-center mb-0 fw-bold ps-2">
            <span class="font-size-18 text-dark" style="font-weight: 500;">{{ Str::limit($c->name, 40) }}</span>
        </p>
    </div>
</a>
