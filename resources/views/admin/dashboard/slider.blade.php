<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-primary">
                    PHB
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block" style="width: 100%; height: 295px"
                                        src="{{ Storage::url($setting->slide1) ?? '' }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" style="width: 100%; height: 295px"
                                        src="{{ Storage::url($setting->slide2) ?? '' }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" style="width: 100%; height: 295px"
                                        src="{{ Storage::url($setting->slide3) ?? '' }}" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" style="width: 100%; height: 295px"
                                        src="{{ Storage::url($setting->slide4) ?? '' }}" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                Statistik
            </div>
            <div class="card-body">

            </div>
        </div>
    </div> --}}

</div>
