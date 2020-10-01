<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TECMES | HOME</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    

<?php include('../template/footer.php') ?>
</body>
</html>