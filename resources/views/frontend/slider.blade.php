<section class="slider container">
    <div class="row justify-content-center">    
        <div class="col-lg-12  rounded-4">
            <div class="card bg-transparent">
                @if ($slider->count() > 0)
                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="{{asset('assets/fasilitas/'.$slider[0]->image)}}"
                                    class="d-block w-100" alt="...">
                            </div>
                            @foreach ($slider as $y)
                                <div class="carousel-item" data-bs-interval="2000">
                                    <img src="{{asset('assets/fasilitas/'.$y->image)}}"
                                        class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="text-center">
                        <div class="p-4 bg-danger text-light tex-center fw-bold">Belum Ada Data Slider</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>