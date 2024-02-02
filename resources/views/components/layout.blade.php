<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title>তুমিও পারবে - Event Registration</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Indie+Flower&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Bengali:wght@100;200;300;400;500;600;700;800;900&family=Noto+Serif+Bengali:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">



	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/all.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-light.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-regular.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-solid.css')}}">
	<link rel="stylesheet" href="{{asset('css/slick.css')}}">
	<link rel="stylesheet" href="{{asset('css/lc_lightbox.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/minimal.css')}}">
	<link rel="stylesheet" href="{{asset('css/aos.css')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="{{asset('css/responsive.css')}}">


	<link rel="stylesheet" href="{{asset('css/all.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-solid.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-regular.css')}}">
	<link rel="stylesheet" href="{{asset('css/sharp-light.css')}}">

	<link rel="icon" href="{{asset('images/logo.ico')}}">

</head>

<body>
	{{-- <div id="particles"></div> --}}
	<button type="button" class="darkmode-btn" id="dark-mode-toggle">
		<i class="color-theme-icon fa-solid fa-lightbulb"></i>
	</button>

	<section id="home">
		<div class="container">
			<img class="logo" src="{{asset('images/logo.png')}}" alt="Tumio Parbe">
			<h1 class="title">
				Annual Awards Ceremony
				<br>
				& Cultural Function 2024
			</h1>

			<div class="event-details">
				<p class="date">
					<i class="fa-regular fa-calendar-alt"></i>
					8 March, 2024 (Friday)
				</p>
				<p class="location">
					<i class="fa-regular fa-map-marker-alt"></i>
					<span>International Mother Language Institute, Segunbagicha, Dhaka-1000 <a href="#venue">(Show map)</a></span>
				</p>
			</div>

			{{ $slot }}


			<h2 class="title">
				Venue
			</h2>
			<div class="event-details">
				<p class="location">
					<i class="fa-regular fa-map-marker-alt"></i>
					<span>আন্তর্জাতিক মাতৃভাষা ইনস্টিটিউট, সেগুন বাগিচা, ঢাকা-১০০০</a></span>
				</p>
			</div>
			<iframe id="venue" class="map"
				src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5165.1701477601455!2d90.40449098790114!3d23.735721655263678!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8f25c6effb9%3A0xdb923d496bcb57f0!2zSW50ZXJuYXRpb25hbCBNb3RoZXIgTGFuZ3VhZ2UgSW5zdGl0dXRlIOClpCDgpobgpqjgp43gpqTgprDgp43gppzgpr7gpqTgpr_gppUg4Kau4Ka-4Kak4KeD4Kat4Ka-4Ka34Ka-IOCmh-CmqOCmuOCnjeCmn-Cmv-Cmn-Cmv-CmieCmnw!5e0!3m2!1sen!2sbd!4v1706836887167!5m2!1sen!2sbd"
				height="300" style="border:0;" allowfullscreen="" loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<footer>
			<p>
				Copyright {{ date('Y')}} &copy; <a href="https://tumioparbe.com">TUMIO PARBE</a>
			</p>
			<p>
				Designed & Developed by Aminul Islam
			</p>
		</footer>

	</section>


	<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
	<script src="{{asset('js/particles.min.js')}}"></script>
	<script src="{{asset('js/embed.min.js')}}"></script>
	<script src="{{asset('js/lc_lightbox.lite.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('js/slick.min.js')}}"></script>
	<script src="{{asset('js/aos.js')}}"></script>
	<script src="{{asset('js/platform.js')}}"></script>
	<script src="{{asset('js/app.js')}}"></script>
</body>

</html>