        <?php
            session_start("login_usuario");
            
            if(empty($_SESSION['email'])){
                header("location:login.php");
            }
        ?>
   