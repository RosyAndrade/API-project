<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sessão de Usuário</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <div class="row" style="height: 25%;">
  </div>
  <div class="row">
	<div class="col-12">		
		<div class="card text-center">
		  <div class="card-header bg-dark text-white">
			<b><div id="resultado"></div></b>
		  </div>
		  <div class="card-body">
			<form>
			<div class="form-group">				
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Login</span>
				  </div>
				  <input id="login" name="login" type="text" class="form-control" aria-label="Login" aria-describedby="inputGroup-sizing-default" required>
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Password</span>
				  </div>
				  <input id="password" name="password" type="password" class="form-control" aria-label="Password" aria-describedby="inputGroup-sizing-default" required>
				</div>
				<br>
				<a href="#" id="fechar_sessao" class="btn btn-dark">Logout</a>
				<a href="#" id="abrir_sessao" class="btn btn-dark">Login</a>
			</div>
			</form>
		  </div>
		  <div class="card-footer bg-dark text-white text-muted"></div>
		</div>
	</div>
  </div>
</div>

<script>
	$( document ).ready(function() {
		$( "#resultado" ).html("Login");
		
		$.ajax({
		  method: "POST",
		  url: "../loginphp",
		  data: { operation: "load" }
		}).done(function(resposta) {
		  var obj = $.parseJSON(resposta);
		  
		  if (obj.nome != 'undefined') {
			  $( "#nome" ).val(obj.nome);
			  $( "#login" ).val(obj.login);
			  $( "#resultado" ).html("Bem vindo, " + obj.nome + " !");
			  $( "#fechar_sessao" ).toggle(true);
			  $( "#abrir_sessao" ).toggle(false);
		  } else {
			  $( "#fechar_sessao" ).toggle(false);
			  $( "#abrir_sessao" ).toggle(true);
		  }
		});
	});

	$( "#abrir_sessao" ).click(function(){
		var v2 = $( "#login" ).val();
		var v3 = $( "#password" ).val();
		
		$.ajax({
		  method: "POST",
		  url: "../loginphp",
		  data: { operation: "login" },
		  beforeSend: function (xhr) {
			xhr.setRequestHeader("Authorization", "Basic " + btoa(v2 + ":" + v3));
		  },
		  error : function(xhr) {
			 $( "#resultado" ).html("Usuário e/ou senha inválidos.");
		  }
		},
		).done(function(resposta) {
		  var obj = $.parseJSON(resposta);
	  
		  if (obj.status == 'logado') {
			  $( "#nome" ).val(obj.nome);
			  $( "#login" ).val(obj.login);
			  $( "#password" ).val("");
			  $( "#resultado" ).html("Bem vindo, " + obj.nome + " !");
			  $( "#fechar_sessao" ).toggle(true);
			  $( "#abrir_sessao" ).toggle(false);
		  }
		});
	});
	
	$( "#fechar_sessao" ).click(function(){
		$.ajax({
		  method: "POST",
		  url: "../loginphp",
		  data: { operation: "logout" }
		}).done(function(resposta) {
		  var obj = $.parseJSON(resposta);
		  
		  if (obj.nome == 'undefined') {
			  $( "#nome" ).val("");
			  $( "#login" ).val("");
			  $( "#password" ).val("");
			  $( "#resultado" ).html("Login");
			  $( "#fechar_sessao" ).toggle(false);
			  $( "#abrir_sessao" ).toggle(true);
		  }
		});
	});
</script>

</body>
</html>