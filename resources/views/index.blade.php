<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Weather Forecasts</title>
		<link rel="stylesheet" href="{{ asset("/css/style.css") }}">
	</head>
	<body>
		<main class="container">
		    <div class="card-wrapper">
					@foreach ($weather_forecasts as $detail)
		        <section class="card anim-flip">
		            <header>
		                <h1 class="card-header">
											{!! $detail['date'] !!}
										</h1>
		            </header>
		            <p class="card-temp box-highlight">{{ $detail['average'] }}</p>
		            <div class="icon">
		                <div class="cloud-group">
												<img src="{{ "https://developer.accuweather.com/sites/default/files/" . ($detail['icon'] < 10 ? '0' : '') . $detail['icon'] . "-s.png" }}" alt="">
		                </div>
		            </div>
		            <div class="card-info">
									{{ $detail['day'] }}
								</div>
		        </section>
						@endforeach
		    </div>
		</main>
	</body>
</html>
