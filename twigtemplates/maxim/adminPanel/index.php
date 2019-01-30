<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="login/login.php" method="post">
      <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <label for="inputEmail" class="sr-only" >Email address</label>
      <input type="email" id="inputEmail" class="form-control" name="correo" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" name="clave" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="sigin" type="submit"> Sign in </button>
      <p class="mt-5 mb-3 text-muted">&copy; David Serrano Alonso</p>
    </form>
    
    <a href="https://dwse-scorpions.c9users.io/practicaUsuarios/">
      <button id="volver" class="btn btn-lg btn-primary btn-block" type="submit"> Volver </button>
    </a>
    
    </br>
  </body>
</html>