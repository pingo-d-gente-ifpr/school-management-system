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
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                    <div class="carousel-inner bg-white rounded dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="carousel-item active">
                        <img src="{{asset("assets/images/banners/banner1.png")}}" class="d-block w-100" >
                      </div>
                      <div class="carousel-item">
                        <img src="{{asset("assets/images/banners/banner2.png")}}" class="d-block w-100" >
                      </div>
                      <div class="carousel-item">
                        <img src="{{asset("assets/images/banners/banner3.png")}}" class="d-block w-100" >
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>

                  <hr style="color:#ff6b8a">

                  <div class="container bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded">
                      <div class="text-gray-900 dark:text-gray-100 p-10">
                          {{ __("You're logged in!") }}
                      </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>