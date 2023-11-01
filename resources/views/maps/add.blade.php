@extends('master.layout',['title' => 'Tambah Pemetaan'])
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Titik Pemetaan</h1>
    </div>
        @if (session()->has('success'))
            <div class="alert alert-success">Data Berhasil Di Tambahkan</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">Data Gagal Di Tambahkan</div>
        @endif
    <div class="section-body py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Maps</div>
                    <div class="card-body">
                        <div class="map" id="map" style="width: 100%">
                        </div>
                        <form action="{{ route('pemetaan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group row mb-4 mt-4">
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label for="">Nama Titik Pemetaan</label>
                                    <input type="text" name="uuid" value="{{ Str::uuid() }}" hidden>
                                    <input type="text" required name="name" required id="name" class="form-control" placeholder="Nama Ttitik">
                                
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label for="">Longitude</label>
                                    <input type="text" required name="long" required id="long" class="form-control" placeholder="Longitude">
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label for="">Latitutde</label>
                                    <input type="text" required name="lat" required  id="lat" class="form-control" placeholder="Latitude">
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label for="">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" class="form-control" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label>Deskripsi Full</label>
                                    <textarea name="deskripsi_full" class="summernote" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                </div>
                                
                                <div class="col-sm-12 col-md-12 mb-1">
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">Pilih Kategori Pemetaan</option>
                                        @foreach ($kategori as $y)
                                            <option value="{{ $y->id }}">{{ $y->nama }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-12 col-md-12 mb-1">
                                   <label for="">Jam Masuk</label>
                                   <input type="time" required name="jam_buka" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                   <label for="">Jam Tutup</label>
                                   <input type="time" required name="jam_tutup" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                   <label for="">Price</label>
                                   <input type="text" required name="price" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 mb-1">
                                   <label for="">Diskon</label>
                                   <input type="number" required name="diskon" class="form-control">
                                </div>

                                <div class="col-sm-12 col-md-12 mb-1">
                                    <label>Tambah Foto Titik Pemetaan</label>
                                   <input type="file" name="image[]" multiple class="form-control-file">
                                </div>
                            </div>
                            <button class="btn btn-primary mt-1">Simpan titik lokasi</button>
                            <a href="{{ route('pemetaan') }}" class="btn btn-light mt-1">Kembali</a>
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
            var map = L.map('map').setView([0.546004,123.106773], 13);
            var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            const showPosition = (posisi) => 
            {
                var popup = L.popup()
                .setLatLng([posisi.coords.latitude,posisi.coords.longitude])
                .setContent('Posisi Sekarang')
                .openOn(map);
            }
            const pos = () => 
            {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    alert("Geolocation is not supported by this browser.");
                }
            }
            function onMapClick(e) {
                var popup = L.popup()
                .setLatLng([0,0])
                .setContent('Posisi Sekarang')
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