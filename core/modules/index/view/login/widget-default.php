<?php
if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""){
	print "<script>window.location='index.php?view=home';</script>";
}
?>
<body style="background-color:#ffffff;">
<div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><img alt="image" src="img/logo.jpg" /></h1>
            </div>
            <h3>SISTEMA DE REGISTRO DE EXPOSICIONES DE PERROS PASTORES ALEMANES</h3>
            <p>Ingreso Sistema - Inicia Sesión</p>
            
            <?php if(isset($_COOKIE['password_updated'])):?>
    		<div class="alert alert-success">
    		<p><i class='glyphicon glyphicon-off'></i> Se ha cambiado la contrase&#241;a exitosamente!</p>
    		<p>Inicie sesi&oacute;n con su nueva contrase&#241;a</p>

    		</div>
    		<?php setcookie("password_updated","",time()-18600);
			endif; ?>
           
            <form class="m-t" role="form" method="post" action="index.php?view=processlogin">
                <div class="form-group">
                    <input type="mail" class="form-control" placeholder="Usuario" required="" name="username" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contrase&#241;a" required="" name="password" >
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Iniciar Sesi&oacute;n</button>
 

                <h3><a href="./correo/index.html"><small>Registrate...</a> </h3>
            </form>
            <p class="m-t"> <small></small> </p>
        </div>
</div>
</body>