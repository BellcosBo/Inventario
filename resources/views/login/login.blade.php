<!DOCTYPE html>
<html> 


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 14:08:43 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BELLCOS | Login</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div  >
        <div >

            <h1 class="logo-name">BELB</h1>

        </div>
            
            <h3>Bienvenidos a Bellcos</h3>
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="form-group {{$errors->has('email')? 'has-error':''}}">
                    <input type="email" name="email" class="form-control" placeholder="Correo Electronico" value="{{old('email')}}">
                    {!! $errors->first('email','<span class="help-block">:message </span>')!!}
                </div>
                <div class="form-group  {{$errors->has('password')? 'has-error':''}}">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" >
                    {!! $errors->first('password','<span class="help-block">:message </span>')!!}
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>Bellcos Bolvia  &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 14:08:43 GMT -->
</html>
