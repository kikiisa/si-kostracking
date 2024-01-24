@extends('frontend.master', ['title' => 'Detail Kos'])
@section('content')
<section class="slider container">
    <div class="row justify-content-center mb-4">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="map" id="map" style="width: 100%;height:500px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-img-top">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $y = collect($service->returnStringMerge($data->image)); ?>
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/image/' . $y[0]) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            @foreach (collect($service->returnStringMerge($data->image)) as $x)
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/image/' . $x) }}" class="d-block w-100"
                                        alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="text-muted">{{$data->nama_titik}}</h4>
                    <hr>
                    @if ($data->diskon > 0)
                        <h6><span class="price-diskon text-danger">Rp {{number_format($data->price, 0, ',', '.')}} </span> / <span class="text-muted"> {{$data->diskon}}%</span></h6>
                    @endif
                    @php
                        $price = $data->price - ($data->price * $data->diskon / 100)
                    @endphp
                    <h5 class="text-success fw-bold">Rp.{{number_format($price, 0, ',', '.')}}</h5>
                    <div class="content">
                        <p class="text-muted">{{$data->deskripsi}}</p>
                       {!! $data->deskripsi_full !!}
                       <button class="btn btn-primary fw-bold">Jam Buka : {{$data->jam_buka}}</button>
                       <button class="btn btn-danger fw-bold">Jam Tutup : {{$data->jam_tutup}}</button>
                       <a href="https://api.whatsapp.com/send?phone={{$data->user->phone}}&text=Apakah anda ingin memesan kost {{$data->nama_titik}} dengan harga Rp,{{number_format($price, 0, ',', '.')}}" class="btn btn-success fw-bold"><i class="fa fa-phone"></i> Whatsapps</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
       
    </div>
</section>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('vendor/routing/leaflet-routing-machine.js') }}"></script>
<script src="{{ asset('vendor/routing/Control.Geocoder.js') }}"></script>
<script src="{{ asset('vendor/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendor/lodash/core.js') }}"></script>
<script>
    let latt = document.querySelector('#lat');
    let long = document.querySelector('#long');
    // get current lokasi;
    var map = L.map('map').setView([0.546004, 123.106773], 50);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);
    const pos = async () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                let datasWisata = null
                let myPositionLat = position.coords.latitude
                let myPositionLon = position.coords.longitude
                let ResultPosition = new L.Routing.Waypoint(L.latLng(myPositionLat, myPositionLon))
                let BestTitik = []
                L.marker([myPositionLat, myPositionLon]).addTo(map)
                    .bindPopup(
                        `<strong>Posisi Anda Saat Ini</strong>`
                    ).openPopup();
                let routeUs = L.Routing.osrmv1();
                routeUs.route([ResultPosition, new L.Routing.Waypoint(L.latLng({{ $data->latitude }},
                    {{ $data->longitude }}))], (err, routes) => {
                    if (!err) {
                        let best = 100000000000000;
                        let bestRoute = 0;
                        for (i in routes) {
                            /// mencari rute terdekat dari setiap titik
                            /// membandingkan total setiap titik dengan mengambil jarak (Distance) dan membandikngkan dengan titik best
                            if (routes[i].summary.totalDistance < best) {
                                bestRoute = i;
                                best = routes[i].summary.totalDistance;
                                BestTitik.push(routes[i])
                            }
                        }
                    }
                    datasWisata = BestTitik
                    setTimeout(() => {
                        const minValue = datasWisata.reduce((acc, obj,
                            index) => {
                            if (obj.summary.totalDistance < acc.value) {
                                return {
                                    value: obj.summary.totalDistance,
                                    index: index,
                                    lat: obj.inputWaypoints[1].latLng.lat,
                                    lon: obj.inputWaypoints[1].latLng.lng,
                                }
                            } else {
                                return acc
                            }
                        }, {
                            value: Infinity,
                            index: -1
                        })
                        fetch(`/api-peta/${minValue.lat}/position/${minValue.lon}`)
                            .then(response2 => response2.json())
                            .then((datass) => {
                                console.log(datass)
                                L.Routing.control({
                                    waypoints: [
                                        L.latLng(myPositionLat, myPositionLon),
                                        L.latLng(minValue.lat, minValue
                                            .lon)
                                    ],
                                    showAttribution: false
                                }).addTo(map);
                                L.marker([minValue.lat, minValue.lon],{
                                    icon: L.icon({
                                        iconUrl: `/theme/img/home.png`,
                                        iconSize: [30,
                                            30
                                        ], // size of the icon
                                    })
                                }).addTo(map).bindPopup(
                                    `<strong>${datass.nama_titik}</strong>  ${datass.deskripsi}`
                                ).openPopup()  
                            });
                    }, 5000)
                })
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    pos()
    var popup = L.popup()
        .setLatLng([{{ $data->latitude }}, {{ $data->longitude }}])
        .setContent('titik wilayah')
        .openOn(map);
</script>
@endsection
