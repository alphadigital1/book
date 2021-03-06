<?php
    include_once("share/header-standard.php");

    $username = $_SESSION['ulogin'];
    $password = $_SESSION['upaswd'];
    $user_id = $_SESSION['user_id'];
    $profile_id = $_SESSION['profile_id'];
    $email = $_SESSION['email'];

    $inactive_time = 10800;

    if(time() - $_SESSION['timestamp'] > $inactive_time) { //verifica tempo de inatividade
        echo "<script>
        alert('Sessão encerrada por inatividade!');
        window.location.href='logout.php';
        </script>";
        //echo"<script>alert('Sessão encerrada por inatividade');</script>";
        //header("Location: logout.php"); //vai para logout.php
    } else {
        $_SESSION['timestamp'] = time(); //seta novo timestamp
    }


    $menu = MenuSetup::getInstance();
    $contato = Contact::getInstance();

    $lista = $contato->select("user_id={$user_id}");
    $lista = (object) $lista[0];

    $menu->setImage("../publico/img/projeto/logo_brasao.png");
    $menu->setImageAlt("ial");
    $menu->setTitle('<strong>Clube</strong> <strong class="text-primary text-lowercase"> do</strong> <strong>Livro</strong>');
    $menu->setSmallTitle('<strong class="text-primary">IAL</strong>');
    $menu->setName($lista->name);
    $menu->create( $profile_id );

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo WEBAPP_NAME; ?></title>
    <meta name="description" content=" <?php echo WEBAPP_DESCRIPTION; ?> ">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <?php
        include_once("share/header-custom.php");
    ?>

</head>


<body <?php if($profile_id > 5) echo 'oncopy="return false" oncut="return false"'; ?> >   

    <?php 
        if( empty( $_GET["link"] ) ) 
            $id = 1;
        else 
            $id = $_GET["link"];

        $menu->setActiveMenu( $id ) ;
        echo $menu->setMenu();
        $link = $menu->getPage( $id );

        $fileArray = array();
        $fileArray[] =  $menu->getPageArray();
        $_SESSION['fileArray'] = $fileArray;

        if( !empty($link) ){
            if( file_exists( $link ) ) 
                include $link;
            else 
                include "home/welcome.php";
        }else 
            include "home/welcome.php";
    ?>

    <footer class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <p>&copy; 2019 - Instituto Alpha Lumen - Clube do Livro - designed by <span class="text-success">Aprendizes</span></p>
                </div>
                <div class="col-sm-4 text-right">
                    <p>Version 1.3.0</p>
                </div>
            </div>
        </div>
    </footer>

</div>

    <?php
        //declaração de plugins (scripts)
        include_once("share/footer-standard.php");

        //customizações
        include_once("share/footer-custom.php");
    ?>

</body>
</html>