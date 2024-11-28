<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- Style -->
    <link rel="stylesheet" href="./css/login.css">
    <!-- SweetAlert2 Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
    require_once 'db/db_connection.php';
	
    if (isset($_POST['acceder'])) {
        
        if(!empty ($_POST['email']) and ($_POST['password'])) {
            $email=$_POST['email'];
            $password=$_POST['password'];
        
            // Preparar la consulta
            $sql = $conn->query("SELECT * FROM admin_table WHERE email='$email' AND password='$password' ");
        
            if($data=$sql->fetch_object()) {
                $_SESSION['email']=$data->email;
                $_SESSION['password']=$data->password;
                $_SESSION['role']=$data->role;
                echo '<script type="text/javascript">
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Cuenta verificada, en un momento se iniciara sesión!",
                    showConfirmButton: false,
                    timer: 3000
                    }).then(function(){
                        window.location="admin.php"
                    })
                });
                </script>';
            }else{
                echo '<script type="text/javascript">
                    $(document).ready(function(){
                        Swal.fire({
                        icon: "error",
                        title: "Datos incorrectos o cuenta no existente!",
                        showConfirmButton: false,
                        timer: 3000
                        }).then(function(){
                            window.location="login.php"
                        })
                    });
                </script>';
            }
    }
}
    ob_end_flush();
?>
</head>
<body>
    <div class="wrapper">
            <img src="./img/logo.png" alt="" height="150px" width="250px">
        <form action="" method="post" id="access-form" autocomplete="off" class="p-3 mt-3">
            <div class="input-field d-flex align-items-center">
                <span class="far fa-user"></span> 
                <input type="text" name="email" id="email" placeholder="Correo">
            </div>
            <div class="input-field d-flex align-items-center"> 
                <span class="fas fa-key"></span> 
                <input type="password" name="password" id="password" placeholder="Contraseña"> 
            </div> 
            <button class="btn mt-3" type="submit" name="acceder" id="acceder">Entrar</button>
        </form>
    </div>
    <script>
            $(document).ready(function() {
            $("#acceder").click(function(){
                let FormatEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                let FormatPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]{8,}$/;
                if ($("#email").val() == "" || !FormatEmail.test($("#email").val())){
                    Swal.fire({
                        icon: 'warning',
                        title: '<strong class="swal2-title" style="font-size: 1.6rem;">CAMPO E-MAIL INVÁLIDO</strong>',
                        text: 'Nota: ¡Introduzca correctamente su dirección de correo electrónico!',
                        timerProgressBar: true,
                        timer: 8000,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<b>Aceptar</b>',
                        showCloseButton: true
                    });
                    return false;
                }
                else if ($("#password").val() == "" || !FormatPassword.test($("#password").val())){
                    Swal.fire({
                        icon: 'warning',
                        title: '<strong class="swal2-title" style="font-size: 1.4rem;">CAMPO CONTRASEÑA INVÁLIDO</strong>',
                        text: 'Nota: Se requiere un mínimo de 8 caracteres y su contraseña debe contener al menos una (mayúscula, minúscula y un número).',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<b>Aceptar</b>',
                        showConfirmButton: true,
                        showCloseButton: true,
                        timerProgressBar: true,
                        timer: 8000
                    });
                    return false;
                }
            });
        });
    </script>
</body>
</html>