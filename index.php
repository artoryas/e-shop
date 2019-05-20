<?php include 'header.php'?>
    <h2 class="title">Уважаемые клиенты! График работы торгового зала и сервисного центра: ► 29, 30 апреля; 2, 3, 4, 6, 8 мая - с 09.00 до 20.00. ► 9 мая - выходной день.   1, 5, 7, 10, 11, 12 мая - с 10.00 до 17.00. В праздничные и выходные дни сервисный центр производит только прием не подошедшего товара, с момента покупки которого прошло не более 14 дней. </h2>
    <hr class="line" size="1">
      <div class="wrap">
        <div class="slider"> <!-- слайдер -->
            <div class="item">
                <img src="img/vchd.jpg" alt="Первый слайд">
                <div class="slideText">ВЫСОКОКАЧЕСТВЕННЫЕ ВИДЕОКАРТЫ СПОСОБНЫЕ ПОДДЕРЖИВАТЬ 4К</div>
            </div>
            <div class="item">
                <img src="img/mb.jpg" alt="Второй слайд">
                <div class="slideText">ПРОЦЕССОРЫ С ПОТЕНЦИАЛОМ ДЛЯ РАЗГОНА</div>
            </div>

            <div class="item">
                <img src="img/game.jpg" alt="Третий слайд">
                <div class="slideText">ИГРАЙ В ИГРЫ КАК БЫЛО ЗАДУМАНО</div>
            </div>

            <a class="prev" onclick="minusSlide()">&#10094;</a>
            <a class="next" onclick="plusSlide()">&#10095;</a>
        </div>

      <div class="slider-dots">
          <span class="slider-dots_item" onclick="currentSlide(1)"></span> 
          <span class="slider-dots_item" onclick="currentSlide(2)"></span> 
          <span class="slider-dots_item" onclick="currentSlide(3)"></span> 
      </div>
    </div>
<?php include 'footer.php' ?>