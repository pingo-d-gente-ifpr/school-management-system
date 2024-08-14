<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-10 mx-auto my-4">
                <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div
                        class="carousel-inner bg-white rounded dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/banners/banner1.png') }}" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/banners/banner2.png') }}" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/banners/banner3.png') }}" class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="container">
                    <div class="d-flex align-items-center" style="width: 100%;">
                        <h5 style="color: #787878; margin-right: 10px;">Turmas</h5>
                        <hr style="flex-grow: 1; border-top: 1px solid #ff6b8a;">
                    </div>


                    <div class="row row-cols-1 row-cols-md-3 g-2">
                        @foreach ($classes as $class)
                            <div class="col">
                                <div class="card h-100 position-relative">
                                    <div class="card-img-wrapper">
                                        <img class="card-img-top"
                                            src="{{ $class->photo
                                                ? (Storage::exists('public/' . $class->photo)
                                                    ? Storage::url($class->photo)
                                                    : asset('assets/' . $class->photo))
                                                : asset('assets/images/logo/subject-default.png') }}"
                                            alt="Card image cap">
                                        <div class="card-icon-overlay">
                                            <a href="{{ route('classes.show', $class->id) }}">
                                                <i class="fas fa-book"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <h5 class="card-title ms-2">{{ $class->name }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        .card {
            border: none;
            background: transparent;
        }

        .card-img-wrapper {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 10px;
        }


        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;

        }

        .card-icon-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card-icon-overlay i {
            font-size: 30px;
            color: white;
            background-color: #FF6B8A;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .card:hover .card-img-wrapper {
            opacity: 0.8;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
            /* Um leve zoom na imagem */
        }

        .card:hover .card-icon-overlay {
            opacity: 1;
        }
    </style>
</x-app-layout>
