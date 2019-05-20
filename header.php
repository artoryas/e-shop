<?php 
require 'db.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/reset.css">
    <link rel="stylesheet" href="./css/header_top.css">
    <link rel="stylesheet" href="./css/header_bottom.css">
    <link rel="stylesheet" href="./css/page.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./css/products.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body class="page" link="white" vlink="white" alink="white">
    <header class="header__top">
      <a class="logo" href="index.php">
        joyce
      </a>
      <div class="header__buttons">
        <img class="phone__svg" src="./img/phone.svg">
        <div class="header__text">+7 (747) 669 52 49</div>
      </div>
      <?php if (isset($_SESSION['logged_user'])) { //проверка на наличии сессии ?> 
        <div class="header__text">Привет, <?php echo $_SESSION['logged_user']->login; ?>!</div>
        <a class="header__buttons" href="logout.php">
          <img src="./img/cabinet.svg">
          <div class="header__text">Выйти</div>
        </a>
      <?php 
        if ($_SESSION['logged_user']->moder == 1) { ?>
         <a class="header__buttons" href="addproduct.php">
          <img src="./img/cabinet.svg">
          <div class="header__text">Добавить товар</div>
        </a>
       <?php }
       }else{ ?>
        <a class="header__buttons" href="login.php">
          <img src="./img/cabinet.svg">
          <div class="header__text">Войти</div>
        </a>
      <?php }

      ?>
      <a class="header__buttons" href="bag.php">
        <img src="./img/bag.svg">
        <div class="header__text">Корзина</div>
      </a>
    </header>
     <header class = "header__bottom">
      <div class = "header__bottom_links">
        <a href="videocards.php" class = "header__bottom_link">
          ВИДЕОКАРТЫ
          <img class = "header__bottom_arrow" src="https://img.icons8.com/ios/50/000000/video-card.png">
        </a>
        <a href ="cpu.php" class = "header__bottom_link">
          ПРОЦЕССОРЫ  
          <img class = "header__bottom_arrow" src="https://img.icons8.com/ios/50/000000/processor.png">
        </a>
        <a href ="ram.php" class = "header__bottom_link">
          ОПЕРАТИВНАЯ ПАМЯТЬ
          <img class = "header__bottom_arrow" src="https://img.icons8.com/ios/50/000000/smartphone-ram.png">
        </a>
        <a href ="hdd.php" class = "header__bottom_link">
          ЖЕСТКИЕ ДИСКИ
          <img class = "header__bottom_arrow" src="https://img.icons8.com/ios/50/000000/hdd.png">
        </a>
        <a href ="mb.php" class = "header__bottom_link">
          МАТЕРИНСКАЯ ПЛАТА
          <img class = "header__bottom_arrow" src="https://img.icons8.com/ios/50/000000/motherboard.png">
        </a>
        <a href ="case.php" class = "header__bottom_link">
          КЕЙСЫ
          <img class = "header__bottom_arrow" src="https://img.icons8.com/dotty/80/000000/server-shutdown.png">
        </a>
      </div>
    </header>