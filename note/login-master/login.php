<?php
   session_start();
   if (isset($_SESSION['loggedIN'])) {
      header('Location: view-gestao-atividades-localstorage.php');
       exit();
  }
    if (isset($_POST['login'])) {
          $connection = new mysqli( "localhost", "root", "", "login");

          $email = $connection->real_escape_string($_POST['emailPHP']);
          $password = $connection->real_escape_string($_POST['passwordPHP']);

          $data = $connection->query("SELECT id FROM users WHERE email='$email' AND password='$password'");
            if ($data->num_rows > 0) {
              $_SESSION['loggedIN'] = '1';
              $_SESSION['email'] = '1';
                exit('sucess');
          } else
                exit('failed');
  }    
?>
<html>
<head>
    <title>Login</title>
</head>

<body>
    <form method="post" action="login.php">
    <div class="container">
        <div class="row" style="height: 25%;">
  </div>
    <div class="col-12 card text-center">
    <div class="card-body">
    <div class="form-group">
                <div class="input-group mb-3">
				  <div class="input-group-prepend" >
					<span class="input-group-text" id="inputGroup-sizing-default">Login</span>
				  </div>
				  <input scope="col" style="width: 91%;" type="text" id="email" placeholder="email"><br>
				</div>

                <div class="input-group mb-3">
				  <div class="input-group-prepend ">
					<span class="input-group-text" id="inputGroup-sizing-default">Password</span>
				  </div>
                  <input scope="col" style="width: 88%;" type="password" id="password" placeholder="password"><br>
				</div>

                  <input class="btn btn-dark" type="button" value="Log In" id="login">
                  </div> 
                  </div>  
                 </div>
                 </div>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
    crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
           $("#login").on('click', function () {
               var email = $("#email").val();
               var password = $("#password").val();
               
               if(email == "" || password == "")
                 alert('Credenciais incorretas');

               else{
                
                $.ajax(
                     {
                         url: 'login.php',
                         method:'POST',
                         data:{
                             login: 1,
                             emailPHP: email,
                             passwordPHP:password
                         },
                         sucess: function (reponse) {
                            $("#response").html(response);

                            if(response.indexOf('sucess') >= 0)
                              window.location = 'view-gestao-atividades-localstorage.php';
                         },
                         dataType: 'text'
                     }
                 );
               }
           });
        });
    </script>
</body>

</html>