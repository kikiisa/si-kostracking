@extends('frontend.master')
@section('content')
    @include('frontend.slider')
    <section class="product container mt-4">
        <h4>Daftar Kos</h4>
        <hr>
        <div class="row">       
            @forelse ($wisata as $item)
                <div class="col-lg-4">
                    <div class="card">
                        <?php $y = collect($service->returnStringMerge($item->image)); ?>
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/image/' . $y[0]) }}" class="d-block w-100"
                                alt="...">
                        </div>
                        @foreach (collect($service->returnStringMerge($item->image)) as $x)
                            <div class="carousel-item">
                                <img src="{{ asset('assets/image/' . $x) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        @endforeach
                        
                        <div class="card-body bg-wraper">
                            <div class="text-center">
                                <a href="{{Route('detail.wisata',$item->uuid)}}" style="text-decoration: none;" class="text-dark"><strong>{{$item->nama_titik}}</strong></a>
                                <p class="text-muted ">{{ $item->deskripsi }}</p>
                                @if ($item->diskon > 0)
                                <h6><span class="price-diskon text-danger">Rp {{number_format($item->price, 0, ',', '.')}} </span> / <span class="text-muted"> {{$item->diskon}}%</span></h6>
                            @endif
                            @php
                                $price = $item->price - ($item->price * $item->diskon / 100)
                            @endphp
                            <h5 class="text-success fw-bold">Rp.{{number_format($price, 0, ',', '.')}}</h5>
                            </div>
                        </div>  
                    </div>
                </div>
            @empty
                <div class="col-lg-4">
                    <div class="bg-danger p-4 rounded-4 border-0 fw-bold text-center text-white">Belum Ada Data Kos</div>
                </div>
            @endforelse
            
        </div>
    </section>
    @include('frontend.home.maps')
@endsection
