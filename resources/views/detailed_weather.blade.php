@extends('layouts.app')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col col-md-9 col-lg-7 col-xl-5">
                    <div class="col card mb-4 gradient-custom">
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
                                                <h2 class="display-2"><strong>{{ $city->current_temp }}°C</strong></h2>
                                                <p class="city-name text-muted mb-0">{{ $city->name }}</p>
                                                <p class="text-muted mb-0">{{ $city->country }}</p>
                                                <p class="text-muted mb-0">{{ __('Wilgotność') }}: {{ $city->humidity }}%</p>
                                            </div>
                                            <div>
                                                <img src="http://openweathermap.org/img/wn/{{ $city->icon }}@4x.png"width="160px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
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
                                                <div class="chart" id="chartContainer"></div>
                                        </div>
                                        <button class="btn btn-light" id="dataHumidity">Wykres wilgotności</button>
                                        <button class="btn btn-light" id="dataTemp">Wykres temperatury</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col py-2">
                                <form>
                                    <div class="row">
                                        <input  class="col form-control" type="search" name="search" placeholder="Szukaj miasto">
                                        <button class="search-btn col btn btn-light mx-2" type="submit" name="submit" value="store">Dodaj</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <p class="text-center my-2">{{ session('mssg') }}</p>
                            </div>
                        </div>
                        <div class="overflow-auto">
                            <div class="city-row row">
                                @foreach($user->cities as $userCity)
                                    @if($userCity->id == $city->id)
                                        <div class="myCity-btn col card mb-4 pb-3 pt-2">
                                            <a href="/detailed_weather/{{ $userCity->id }}" class="city-href col card mb-4 pb-3 pt-2">
                                                <div class="flex-column">
                                                    <p class="small text-center"><strong>{{ $userCity->name }}</strong></p>
                                                    <p class="mb-0 text-center"><strong>{{ $userCity->current_temp }}°C</strong></p>
                                                </div>
                                            </a>
                                            <a class="detach-btn" href="/detach/{{ $userCity->id }}">usuń</a>
                                        </div>
                                    @else
                                    <div class="city-btn col card mb-4 pb-3 pt-2">
                                        <a href="/detailed_weather/{{ $userCity->id }}" class="city-href col card mb-4 pb-3 pt-2">
                                            <div class="flex-column">
                                                <p class="small text-center"><strong>{{ $userCity->name }}</strong></p>
                                                <p class="mb-0 text-center"><strong>{{ $userCity->current_temp }}°C</strong></p>
                                            </div>
                                        </a>
                                        <a class="detach-btn" href="/detach/{{ $userCity->id }}">usuń</a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('scripts.chart')
    </section>
@endsection



