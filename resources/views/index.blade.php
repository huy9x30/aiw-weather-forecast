<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Weather Forecasts</title>
		<link rel="stylesheet" href="{{ asset("/css/style.css") }}">
	</head>
	<body>
		<div class="header">
			<h1>Ha Noi</h1>
			<span id="time_span"></span>
		</div>
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
									{{ str_replace('w/', 'with', $detail['day']) }}
								</div>
		        </section>
						@endforeach
		    </div>
		</main>
		<script type="text/javascript">
			function updateTime(){
				var currentTime = new Date()
				var hours = currentTime.getHours()
				var minutes = currentTime.getMinutes()
				var seconds = currentTime.getSeconds()

				if (minutes < 10) { minutes = "0" + minutes }
				if (seconds < 10) { seconds = "0" + seconds }
				var t_str = hours + ":" + minutes + ":" + seconds + " ";
				
				if(hours > 11){ t_str += "PM"; } else { t_str += "AM"; }
				document.getElementById('time_span').innerHTML = t_str;
			}
			setInterval(updateTime, 1000);
		</script>
	</body>
</html>
