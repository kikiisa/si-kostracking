@extends('master.layout',['title' => 'Data Pemetaan Wilayah'])
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pemetaan Wilayah</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session()->has('errors'))
            <div class="alert alert-danger">{{session('errors')}}</div>
        @endif
        <a href="{{ route('tambah_peta') }}" class="btn btn-primary"><i class="fa fa-server"></i> Tambah Titik Wilayah</a>
        <div class="section-body py-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Maps</div>
                        <div class="card-body">
                            <div class="map" id="map" style="width: 100%">
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Titik Wilayah</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{$loop->index+=1}}</td>
                                                <td>{{ $item->nama_titik }}</td>
                                                <td>{{ $item->latitude }}</td>
                                                <td>{{ $item->longitude }}</td>
                                                <td>{{ $item->categori->nama }}</td>
                                                <td>
                                                    <form action="{{ route('hapus_pemetaan',$item->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button class="btn btn-danger"><i class="mb-1 fa fa-trash"></i></button>
                                                        <a href="{{ route('edit_pemetaan',$item->uuid) }}" class="btn btn-warning"><i class="mb-1 fa fa-edit"></i></a>        
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('vendor/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
    <script>

            let latt = document.querySelector('#lat');
            let long = document.querySelector('#long');
            // get current lokasi;
            var map = L.map('map').setView([0.546004,123.106773], 13);
            var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            const pos = () => 
            {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    alert("Geolocation is not supported by this browser.");
                }
            }
            
            $(document).ready(function(){
                function showData()
                {
                    $.ajax({
                        type: "GET",
                        url: "/api-peta",
                        cache:false,
                        dataType: "JSON",
                        success: function (response) {
                           const result = response.data;
                           for (let index = 0; index < result.length; index++) {
                                L.marker([result[index].latitude,result[index].longitude]).addTo(map).bindPopup(`<strong>${result[index].nama_titik}</strong>  ${result[index].deskripsi}`).openPopup();
                           }
                        }   
                    });
                }
                showData();
            })
    </script>
@endsection