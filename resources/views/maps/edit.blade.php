@extends('master.layout', ['title' => 'Edit Pemetaan'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Titik Pemetaan</h1>
        </div>
        <div class="section-body py-4">
            <div class="row justify-content-start">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Caption</h4>
                        </div>
                        <div class="card-body">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset('assets/image/'.$image[0])}}" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{$data->nama_titik}}</h5>
                                            <p>{{ strip_tags($data->deskripsi)}}.</p>
                                        </div>
                                    </div>
                                    @foreach ($image as $x)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('assets/image/'.$x)}}" alt="Second slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $data->nama_titik }}</h5>
                                                <p>{{ $data->deskripsi }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Maps</div>
                        <div class="card-body">
                            <div class="map" id="map" style="width: 100%">
                            </div>
                            <form action="{{ route('update_pemetaan', $data->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row mb-4 mt-4">
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Nama Titik</label>
                                        <input type="text" required name="name" value="{{ $data->nama_titik }}"
                                            required id="nama_titik" class="form-control" placeholder="Nama Ttitik">
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Longitude</label>
                                        <input type="text" required name="long" value="{{ $data->longitude }}"
                                            required id="long" class="form-control" placeholder="Longitude">
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Latitude</label>
                                        <input type="text" required name="lat" value="{{ $data->latitude }}" required
                                            id="lat" class="form-control" placeholder="Latitude">
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Deskripsi Singkat</label>
                                        <textarea name="deskripsi"class="form-control" id="" cols="30" rows="10" placeholder="Deskripsi">{{ $data->deskripsi }}</textarea>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Deskripsi Full</label>
                                        <textarea name="deskripsi_full" class="summernote" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi">{{ $data->deskripsi_full }}</textarea>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Kategori Wisata</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="">Pilih Kategori Wisata</option>
                                            @foreach ($kategori as $y)
                                                <option value="{{ $y->id }}" {{ $y->id == $data->bahari_id ? 'selected' : '' }}>{{ $y->nama }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Jam Masuk</label>
                                        <input type="time" value="{{$data->jam_buka}}" required name="jam_buka" class="form-control" id="">
                                     </div>
                                     <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Jam Tutup</label>
                                        <input type="time" value="{{$data->jam_tutup}}" required name="jam_tutup" class="form-control" id="">
                                     </div>
                                     <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Price</label>
                                        <input type="text" value="{{$data->price}}" required name="price" class="form-control">
                                     </div>
                                     <div class="col-sm-12 col-md-12 mb-1">
                                        <label for="">Diskon</label>
                                        <input type="number" value="{{$data->diskon}}" required name="diskon" class="form-control">
                                     </div>
                                    <div class="col-sm-12 col-md-12 mb-1">
                                       <label>Images</label>
                                       <input type="file" name="image[]" multiple id="image" class="form-control">
                                    </div>

                                </div>
                                <button class="btn btn-primary">Simpan titik lokasi</button>
                                <a href="javascript:;" class="btn btn-success" onclick="titik()">Titik Lokasi</a>
                                <a href="{{ route('pemetaan') }}" class="btn btn-light">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
        <script>
            let latt = document.querySelector('#lat');
            let long = document.querySelector('#long');
            // get current lokasi;
            var map = L.map('map').setView([0.546004, 123.106773], 50);
            var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            const showPosition = (posisi) => {
                var popup = L.popup()
                    .setLatLng([posisi.coords.latitude, posisi.coords.longitude])
                    .setContent('Posisi Sekarang')
                    .openOn(map);
            }



            const pos = () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }

            const titik = () => {
                var popup = L.popup()
                    .setLatLng([{{ $data->latitude }}, {{ $data->longitude }}])
                    .setContent('titik wilayah')
                    .openOn(map);
            }
            var popup = L.popup()
                .setLatLng([{{ $data->latitude }}, {{ $data->longitude }}])
                .setContent('titik wilayah')
                .openOn(map);

            function onMapClick(e) {
                var popup = L.popup()
                    .setLatLng([0, 0])
                    .setContent('Titik Sekarang')
                    .openOn(map);
                popup
                    .setLatLng(e.latlng)
                    .setContent('Koordinat Posisi yang anda Klik' + e.latlng.toString())
                    .openOn(map);
                latt.value = e.latlng.lat
                long.value = e.latlng.lng
            }
            map.on('click', onMapClick);
        </script>
    </section>
@endsection
