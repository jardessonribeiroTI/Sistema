<?php 
	if(isset($_SESSION['usuario'])){
		session_destroy();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/funcoes.js"></script>
</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Memorando</div>
					<div class="panel panel-body">
						<p>
							<img src="img/LogoNeuroCentro.png"  width="100%">
						</p>
						<form id="frmLogin">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Senha</label>
							<input type="password" name="senha" id="senha" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
							
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>
<script>

  window.addEventListener("keydown", checkKeyPress, false);

  function checkKeyPress(key){

    if(key.keyCode ==  "13"){
    	var nome = document.getElementById('usuario').value;
    	var senha = document.getElementById('senha').value;
    	if(nome != "" && senha != ""){

    		entrarSistema();

    	}else{

    		alert("Preencha os campos!!");
    	}

    }

  }

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

			entrarSistema();

		});

	});
</script>

<script>
	function entrarSistema(){

		vazios=validarFormVazio('frmLogin');

		if(vazios > 0){
			alert("Preencha os campos!!");
			return false;
		}

		dados=$('#frmLogin').serialize();
	
		$.ajax({
			type:"POST",
			data:dados,
			url:"controle/usuario/logarSistema.php",
			success:function(r){ 
				
				if(r==1){

					window.location="views/inicio.php";

				}
				if(r==2){

					alert("Acesso Negado!!");

				}else{

					alert("Caractere não aceito!!");
				}
			}
		});

	}
</script>