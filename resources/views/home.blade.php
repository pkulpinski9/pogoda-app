@extends('layouts.app')

@section('content')
    <section class="vh-100" style="background-color: #C1CFEA;">
        <div class="container py-5 h-100">
            <div class="row" style="color: #282828;">
                <div class="col col-md-9 col-lg-7 col-xl-5">
                    <div class="col card mb-4 gradient-custom" style="border-radius: 25px;">
                        <div class="card-body p-4">
                            <div id="demo1" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ul class="carousel-indicators mb-0">
                                    <li data-target="#demo1" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo1" data-slide-to="1"></li>
                                    <li data-target="#demo1" data-slide-to="2"></li>
                                </ul>
                                <!-- Carousel inner -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="d-flex justify-content-between mb-4 pb-2">
                                            @if(count($user->cities)>0)
                                            <div>
                                                <h2 class="display-2"><strong>{{ $city->current_temp }}°C</strong></h2>
                                                <p class="text-muted mb-0">{{ $city->name }}</p>
                                                <p class="text-muted mb-0">{{ $city->country }}</p>
                                            </div>
                                            <div>
                                                <img src="http://openweathermap.org/img/wn/{{ $city->icon }}@4x.png"width="160px">
                                            </div>
                                            @else
                                                <h2 class="display-2"><strong>Dodaj miasto</strong></h2>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="border-radius: 25px;">
                        <div class="card-body p-4">

                            <div id="demo3" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ul class="carousel-indicators mb-0">
                                    <li data-target="#demo3" data-slide-to="0"></li>
                                    <li data-target="#demo3" data-slide-to="1"></li>
                                    <li data-target="#demo3" data-slide-to="2" class="active"></li>
                                </ul>
                                <!-- Carousel inner -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">

                                        <div class="d-flex justify-content-around text-center mb-4 pb-3 pt-5">
                                            <div class="flex-column">
                                                <p class="small"><strong></strong></p>
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col card" style="border-radius: 25px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="row">
                                        <input  class="col form-control" type="search" name="search" placeholder="Szukaj miasto">
                                        <button class="col btn btn-light mx-2" type="submit" name="submit" value="store" style="max-width: 70px;">Dodaj</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <p class="text-center my-2">{{ session('mssg') }}</p>
                            </div>
                        </div>
                        <div class="overflow-auto">
                            <div class="row" style="max-height: 350px; width: auto">
                                @foreach($user->cities as $city)
                                    <div class="city-small col card mb-4 pb-3 pt-2" style="max-width: 200px; min-width: 200px; border-radius: 25px; border-color: #f7f7f7; margin: 10px; text-decoration: none; color: #1a1a1a">
                                        <a href="/detailed_weather/{{ $city->id }}" class="city-small col card mb-4 pb-3 pt-2" style="border-radius: 25px; border-color: #f5f5f5; margin: 10px; background-color: #F5F5F5; text-decoration: none; color: #1a1a1a">
                                            <div class="flex-column">
                                                <p class="small text-center"><strong>{{ $city->name }}</strong></p>
                                                <p class="mb-0 text-center"><strong>{{ $city->current_temp }}°C</strong></p>
                                            </div>
                                        </a>
                                        <a href="/detach/{{ $city->id }}" style="text-align: center; border-radius: 25px; border-color: #f5f5f5; background-color: #F5F5F5; text-decoration: none; color: #1a1a1a">usuń</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
