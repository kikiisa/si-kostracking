@extends('master.layout', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h3>Selamat Datang, <strong>{{ Auth::user()->name }}</strong></h3>
        </div>
        <div class="section-body">
            <div class="row">
                @if (Auth::user()->role == 'admin')
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

                @if (Auth::user()->role == 'users')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- <h6>{{ $data->count() }} Kost Telah Di Upload</h6> --}}
                                @if ($data->count() > 0)
                                    <h3>{{ $data->count() }} Kost Telah Di Upload</h3>
                                @else
                                    <small class="badge bg-danger text-white mb-2">Anda Belum Mengupload Data Kost</small>
                                @endif
                                <a href="javascript:void(0)" class="btn btn-primary" onclick="return openModal('{{Auth::user()->dokument}}')">Dokument Legalitas</a>
                                            
                                <div class="row mt-2">
                                    <div class="form-group col-lg-6">
                                        <label>Nama Lengkap</label>
                                        <input type="text" disabled placeholder="Nama Lengkap"
                                            value="{{ Auth::user()->name }}" name="name" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Email</label>
                                        <input type="text" disabled placeholder="Email" value="{{ Auth::user()->email }}"
                                            name="email" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Telephone</label>
                                        <input type="text" disabled placeholder="Phone" value="{{ Auth::user()->phone }}"
                                            name="phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">File Legalitas Pajak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" type="application/pdf" height="600px" class="legalitasdoc w-100" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const documentShow = document.querySelector(".legalitasdoc");
        const openModal = (data) => 
        {
            documentShow.src = data
            $('#modal').modal({
                backdrop: 'static',
                keyboard: false
            }).show()
        }
    </script>
@endsection
