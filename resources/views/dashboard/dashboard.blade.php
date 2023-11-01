@extends('master.layout', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @if (Auth::user()->role == "admin")
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="mt-4 far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Admin</h4>
                                </div>
                                <div class="card-body">
                                    {{ $admin }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-light">
                                <i class="mt-4 fa fa-map text-dark"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Titik Pemeteaan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $peta }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($kategori as $item)
                        @php
                            $datas = App\Models\WisataCategory::with('maping')
                                ->where('id', $item->id)
                                ->first();
                        @endphp
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="mt-4 fa fa-map text-light"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total {{ $item->nama }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ count($datas->maping) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ Route('bycategori', $item->slug) }}" class="btn btn-primary text-white mb-4">{{ $item->nama }}
                        <strong>{{ count($datas->maping) }}</strong></a> --}}
                    @endforeach    
                @endif
            </div>
        </div>
    </section>
@endsection
