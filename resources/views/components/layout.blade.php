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
			
			{{ $slot }}
				
    </div>
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