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
                                            <div>
{{--                                                <h2 class="display-2"><strong>{{round($currentWeather['main']['temp'])}}°C</strong></h2>--}}
{{--                                                <p class="text-muted mb-0">{{$currentWeather['name']}}</p>--}}
                                            </div>
                                            <div>
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-weather/ilu3.webp"
                                                     width="150px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mb-4" style="border-radius: 25px;">
                        <div class="card-body p-4">

                            <div id="demo2" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ul class="carousel-indicators mb-0">
                                    <li data-target="#demo2" data-slide-to="0"></li>
                                    <li data-target="#demo2" data-slide-to="1" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="2"></li>
                                </ul>
                                <!-- Carousel inner -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="d-flex justify-content-around text-center mb-4 pb-3 pt-2">
                                            <div class="flex-column">
                                                <p class="small"><strong>21°C</strong></p>
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>12:00</strong></p>
                                                <p class="mb-0 text-muted" style="font-size: .65rem;">PM</p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>2°C</strong></p>
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>1:00</strong></p>
                                                <p class="mb-0 text-muted" style="font-size: .65rem;">PM</p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>20°C</strong></p>
                                                <i class="fas fa-cloud fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>2:00</strong></p>
                                                <p class="mb-0 text-muted" style="font-size: .65rem;">PM</p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>19°C</strong></p>
                                                <i class="fas fa-cloud fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>3:00</strong></p>
                                                <p class="mb-0 text-muted" style="font-size: .65rem;">PM</p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>18°C</strong></p>
                                                <i class="fas fa-cloud-showers-heavy fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>4:00</strong></p>
                                                <p class="mb-0 text-muted" style="font-size: .65rem;">PM</p>
                                            </div>
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
                                        <div class="d-flex justify-content-around text-center mb-4 pb-3 pt-2">
                                            <div class="flex-column">
                                                <p class="small"><strong>21°C</strong></p>
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>Mon</strong></p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>20°C</strong></p>
                                                <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>Tue</strong></p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>16°C</strong></p>
                                                <i class="fas fa-cloud fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>Wed</strong></p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>17°C</strong></p>
                                                <i class="fas fa-cloud fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>Thu</strong></p>
                                            </div>
                                            <div class="flex-column">
                                                <p class="small"><strong>18°C</strong></p>
                                                <i class="fas fa-cloud-showers-heavy fa-2x mb-3" style="color: #ddd;"></i>
                                                <p class="mb-0"><strong>Fri</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col card gradient-custom" style="border-radius: 25px;">
                    <div class="card-body">
                        <form>
                            <input type="search" name="search" placeholder="Szukaj miasto">
                            <button type="submit">Dodaj</button>
                            <p class="text-center my-2">{{ session('mssg') }}</p>
                        </form>
                        <div class="row">
                            @foreach($cities as $city)
                            <a href="/detailed_weather/{{ $city->id }}" class="city-small col card mb-4 pb-3 pt-2" style="border-radius: 25px; border-color: #f5f5f5; margin: 10px; background-color: #F5F5F5; text-decoration: none; color: #1a1a1a">
                                <div class="flex-column">
                                    <p class="small"><strong>{{ $city->name }}</strong></p>
                                    <i class="fas fa-sun fa-2x mb-3" style="color: #ddd;"></i>
                                    <p class="mb-0"><strong>{{ $city->current_temp }}°C</strong></p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
