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
                                                <h2 class="display-2"><strong>{{ $city->current_temp }}°C</strong></h2>
                                                <p class="text-muted mb-0" style="font-size: 20px;">{{ $city->name }}</p>
                                                <p class="text-muted mb-0">{{ $city->country }}</p>
                                                <p class="text-muted mb-0">Wilgotność: {{ $city->humidity }}%</p>
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
                                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        </div>
                                        <button class="btn btn-light" id="dataHumidity">Wykres wilgotności</button>
                                        <button class="btn btn-light" id="dataTemp">Wykres temperatury</button>
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
                            <div class="row" style="max-height: 670px; width: auto">
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
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>

    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                fontFamily: "Calibri",
                text: "Wykres wilgotności w czasie"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#ffffff",
                indexLabelPlacement: "inside",
                dataPoints: @php echo json_encode($dataHumidity) @endphp
            }]
        });
        chart.render();

        $("#dataHumidity").click(function () {
            chart.options.title.text = "Wykres wilgotności w czasie";
            chart.options.data[0].dataPoints = @php echo json_encode($dataHumidity) @endphp;
            chart.render();
        });
        $("#dataTemp").click(function () {
            chart.options.title.text = "Wykres temperatury w czasie";
            chart.options.data[0].dataPoints = @php echo json_encode($dataTemp) @endphp;
            chart.render();
        });
    }
</script>
