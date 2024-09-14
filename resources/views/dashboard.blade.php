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

                                    <div class="col-md-4" href="{{ route('classes.show', $class->id) }}">
                                        <a href="{{ route('classes.show', $class->id) }}">
                                            <div class="profile-card-2"><img src="{{ $class->photo
                                                ? (Storage::exists('public/' . $class->photo)
                                                    ? Storage::url($class->photo)
                                                    : asset('assets/' . $class->photo))
                                                : asset('assets/images/logo/subject-default.png') }}" class="img img-responsive">
                                                <div class="profile-name text-capitalize">{{ $class->name }}</div>
                                                <div class="profile-username">{{App\Enums\Stage::from($class->stage)->name()}}</div>
                                            </div>
                                        </a>
                                    </div>

                                @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
    <style>
            .profile-card-2 {
            width: 100%;
            height: 200px;
            box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            margin: 10px auto;
            cursor: pointer;
            border-radius: 10px;
            background-position: center;
        }

        .profile-card-2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: all linear 0.25s;
        }

        .profile-card-2 .profile-name {
            position: absolute;
            left: 30px;
            bottom: 70px;
            font-size: 30px;
            color: #ff6b8a;
            text-shadow: 0px 0px 20px rgb(255, 255, 255);
            font-weight: bold;
            transition: all linear 0.25s;
        }

        .profile-card-2 .profile-username {
            position: absolute;
            bottom: 50px;
            left: 30px;
            color: #727272;
            font-size: 20px;
            transition: all linear 0.25s;
            text-shadow: 0px 0px 20px rgba(255, 255, 255);
        }


        .profile-card-2:hover img {
            filter:blur(4px);
        }

        .profile-card-2:hover .profile-name {
            bottom: 80px;
        }

        .profile-card-2:hover .profile-username {
            bottom: 60px;
        }

    </style>
</x-app-layout>
