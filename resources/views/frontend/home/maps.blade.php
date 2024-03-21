<section class="mt-4 py-4">
    <div class="container">
        <h5 class="section-title text-start">Rekomendasi Kos Terdekat</h5>
        <h6 class="text-start text-muted">Rekomendasi Kos Terdekat Saat Ini Dari Kami</h6>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center" id="loading">
            </div>
        </div>
        <div class="row justify-content-center" id="recomended">

        </div>
    </div>
</section>
<section class="mt-4 py-4">
    <div class="container">
        <h5 class="section-title text-start">Tracking Kost</h5>
        <h6 class="text-start text-muted">Lihat Kost Terdekat Saat Ini</h6>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <button class="btn btn-outline-dark" onclick="refresh()"><i class="bi bi-pin"></i> Cek
                            Lokasi Anda Saat Ini</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="carousel-inner">
                    <div id="carouselExampleControls" class="carousel sliders" data-bs-ride="carousel">
                        <div class="carousel-inner slider">

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <h4 class="title-modal mt-2"></h4>
                <div class="deskripsi">

                </div>
                <div class="operasional">
                    <span class="buka mb-1 btn bg-primary text-light fw-bold"></span>
                    <span class="tutup btn bg-danger text-light fw-bold"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-lg" id="ModaldetailWisata" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-2" id="exampleModalLongTitle"></h5>
            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    </div>
                    <div class="carousel-inner cr-2">

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="deskripsi-2 mt-4">

                </div>
                <div class="deskripsi-3 mt-2">

                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('vendor/routing/leaflet-routing-machine.js') }}"></script>
<script src="{{ asset('vendor/routing/Control.Geocoder.js') }}"></script>
<script src="{{ asset('vendor/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendor/lodash/core.js') }}"></script>
<script>
    const detailWisata = new bootstrap.Modal('#ModaldetailWisata', {
        keyboard: false
    })

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    const detail = async (id) => {
        await fetch(`/api/v1/detail/${id}`)
            .then(response => response.json())
            .then((data) => {
                if (data.status == true) {
                    const datas = data.data
                    $(".modal-title-2").html(`${datas.nama_titik}`)
                    $(".deskripsi-2").text(`${datas.deskripsi}`)
                    $(".deskripsi-3").html(`${datas.deskripsi_full}`)
                    let images = datas.image.split(",").map(String)
                    var html = `<div class="carousel-item active">
                                        <img src="/assets/image/${images[0]}" class="d-block w-100"
                                            alt="${images[0]}">
                                    </div>`
                    images.map((item, index) => {
                        html += `<div class="carousel-item">
                                    <img src="/assets/image/${item}" class="d-block w-100"alt="...">
                                    </div>`
                    })
                    $(".cr-2").html(html)

                }
            })
            .catch((error) => {
                console.log(error)
            })
        detailWisata.show()
    }
    const myModal = new bootstrap.Modal('#exampleModalLong', {
        keyboard: false
    })
    let map = L.map('map').setView([0.546004, 123.106773], 13);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);
    const refresh = () => {
        window.location.reload()
        pos()
    }

    function onClick(data) {
        alert(data);
    }
    async function pos() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                let datasWisata = null
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                let ResultPosition = new L.Routing.Waypoint(L.latLng(latitude, longitude))
                console.log({
                    latitude,
                    longitude
                });
                let BestTitik = []
                L.marker([latitude, longitude], {
                        icon: L.icon({
                            iconUrl: '/theme/img/placeholder.png',
                            iconSize: [35, 35],
                        })
                    }).addTo(map)
                    .bindPopup(
                        `<strong>Posisi Anda Saat Ini</strong>`
                    ).openPopup();
                fetch('/api-peta')
                    .then(response => response.json())
                    .then((data) => {
                        let datas = data.data
                        // console.log(datas)

                        datas.map((item, index) => {
                            let routeUs = L.Routing.osrmv1();
                            routeUs.route([ResultPosition, new L.Routing.Waypoint(L.latLng(item
                                .latitude, item.longitude))], (err, routes) => {
                                if (!err) {
                                    let best = 100000000000000;
                                    let bestRoute = 0;
                                    for (i in routes) {
                                        /// mencari rute terdekat dari setiap titik
                                        /// membandingkan total setiap titik dengan mengambil jarak (Distance) dan membandikngkan dengan titik best
                                        if (routes[i].summary.totalDistance < best) {
                                            bestRoute = i;
                                            best = routes[i].summary.totalDistance;
                                            if (datas[index].categori.slug != 'hotel') {
                                                BestTitik.push(routes[i])
                                            }
                                        }
                                    }
                                }
                                /// menandai setiap ujung titik
                                L.marker([item.latitude, item.longitude], {
                                        riseOnHover: true,
                                        myUrl: `/detail-wisata/${item.uuid}`,
                                        icon: L.icon({
                                            iconUrl: `/theme/img/home.png`,
                                            iconSize: [35,
                                                35
                                            ], // size of the icon
                                        })
                                    }).addTo(map)
                                    .bindPopup(
                                        `<strong>${item.nama_titik}</strong>`
                                    ).openPopup().on('click', function(evt) {
                                        window.location.href = evt.target.options
                                            .myUrl
                                    });
                            })
                        })
                        datasWisata = BestTitik

                        // console.log(datasWisata)
                    })
                    .catch(error => console.log(error))
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

                            L.Routing.control({
                                waypoints: [
                                    L.latLng(latitude, longitude),
                                    L.latLng(minValue.lat, minValue.lon)
                                ],
                                showAttribution: false
                            }).addTo(map);
                            L.marker([minValue.lat, minValue.lon]).addTo(map)
                                .bindPopup(
                                    `<strong>Kos Terdekat Saat Ini</strong>`
                                ).openPopup();
                            // menampilkan modal dan konten dari info
                            let images = datass.image.split(",").map(String)
                            var html = `<div class="carousel-item active">
                                        <img src="/assets/image/${images[0]}" class="d-block w-100"
                                            alt="${images[0]}">
                                    </div>`
                            images.map((item, index) => {
                                html += `<div class="carousel-item">
                                    <img src="/assets/image/${item}" class="d-block w-100"alt="...">
                                    </div>`
                            })
                            $(".sliders").html(html)
                            $(".title-modal").text(datass.nama_titik)
                            $(".modal-title").text(
                                `Kos / Penginapan Terdekat dalam posisi anda saat ini yaitu  : ${datass.nama_titik}`
                            )
                            $(".deskripsi").html(`<p>${datass.deskripsi}</p>`)
                            $(".buka").html(`Jam Buka : ${datass.jam_buka}`)
                            $(".tutup").html(`Jam Tutup :${datass.jam_tutup}`)
                            $(".price").html(
                                ` Rp. ${formatRupiah(datass.price)} (Bulan Pertama)`)
                        });
                    myModal.show()
                }, 5000)
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    pos()
</script>
<script>
     function diskon(diskon,price)
     {
       if(diskon > 0)
       {
        let rumus = price - (price * diskon / 100)
        console.log(rumus);
        return rumus
       }else{
        console.log(price);
        return price
       }
        
     }
     function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    async function getRecomendedLocation() {
        let loading = document.querySelector("#loading")
        let produkAll = document.querySelector("#recomended")
        let html = "";
        const uniqueTitiks = new Set();
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        let ResultRekomendasi = []
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                let datasWisata = null
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                let ResultPosition = new L.Routing.Waypoint(L.latLng(latitude, longitude))
                let BestTitik = []
                loading.innerHTML = ` <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`
                fetch('/api-peta')
                    .then(response => response.json())
                    .then((data) => {
                        let datas = data.data

                        datas.map((item, index) => {
                            let routeUs = L.Routing.osrmv1();
                            routeUs.route([ResultPosition, new L.Routing.Waypoint(L.latLng(item
                                .latitude, item.longitude))], async (err, routes) => {
                                if (!err) {
                                    let best = 30000;
                                    let bestRoute = [];
                                    for (i in routes) {
                                        /// mencari rute terdekat dari setiap titik
                                        /// membandingkan total setiap titik dengan mengambil jarak (Distance) dan membandikngkan dengan titik best
                                        if (routes[i].summary.totalDistance <
                                            best) {
                                            bestRoute = i;
                                            best = routes[i].summary.totalDistance;
                                            let images = item.image.split(",").map(String)
                                            loading.innerHTML = ``;
                                            html += `<div class="col-lg-4">
                                    <div class="card">
                                    
                                        <div class="carousel-item active">
                                            <img src="/assets/image/${images[0]}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                        <div class="card-body bg-wraper">
                                            <div class="text-center">
                                            <a href="/detail-wisata/${item.uuid}" style="text-decoration: none;" class="text-dark"><strong>${item.nama_titik}</strong></a>
                                                    
                                            <h5>${item.diskon > 0 ? `<span class="price-diskon text-danger">Rp ${formatRupiah(item.price)} </span> / <span class="text-muted"> ${item.diskon}%</span>` : `Rp. ${formatRupiah(item.price)}`}</h5>
                                            <h5 class="text-success">${formatter.format(diskon(item.diskon,item.price))}</h5>
                                            
                                            </div>
                                        </div>  
                                    </div>
                                </div>`
                                        }
                                    }
                                }
                                produkAll.innerHTML = html
                            })
                        })
                    })
                    .catch(error => console.log(error))
                // setTimeout(() => {

                //     BestTitik.map(async (item, index) => {
                //         let fetchData = await fetch("api/v1/api-maps/" + item
                //             .inputWaypoints[1].latLng.lat + "/" + item
                //             .inputWaypoints[1].latLng.lng)
                //         let getResponse = await fetchData.json();
                //         loading.innerHTML = ``;
                //         ResultRekomendasi[index] = getResponse
                //     })
                //     ResultRekomendasi.map((item, index) => {
                //         console.log(item);
                //     })
                //     // console.log(ResultRekomendasi);
                // }, 5000)
            });

        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    getRecomendedLocation()
</script>
