<?php

function get_header()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/styles/normalize.css" />
        <link rel="stylesheet" href="/assets/styles/style.css" />
        <title>LUX PM</title>
    </head>

    <body>
        <header class='wrapper header flex-col'>
            <div class="flex">
                <a class="link" href="/"><img src="/assets/images/luxPM1.jpg" width="230"></a>
                <div class='header__links'>
                    <a href="/index.php" class="link header__link">Главная</a>
                    <a href="/about.php" class="link header__link">О нас </a>
                    <a href="/price-list.php" class="link header__link">Услуги </a>
                    <a href="/portfolio.php" class="link header__link">Наши работы </a>
                    <a href="/comments.php" class="link header__link">Отзывы</a>
                    <a href="/booklet.php" class="link header__link">Рекомендации </a>
                    <a href="/videos.php" class="link header__link">Видео</a>
                    <?php if (!user::is_master()) : ?>
                        <a href="/zapisat.php" class="link header__link">Записаться</a>
                        <a href="/lk.php" class="link header__link">Личный кабинет</a>
                    <?php endif; ?>
                    <?php if (user::is_master()) : ?>
                        <a href="/admin.php" class="link header__link">Панель управления</a>
                    <?php endif; ?>
                    <?php if (!user::is_guest()) : ?>
                        <a href="/logout.php" class="link header__link">Выход</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="line"></div>
        </header>
    <?php
}

function get_footer()
{
    ?>
        <footer class='wrapper flex-col'>
            <div class="line"></div>
            <div class="flex footer">
                <div class="flex">
                    <div class="flex-col">
                        <h3>Режим работы</h3>
                        <div class="flex-col footer-block">
                            <span>‌ПН — ‌СБ: с ‌10:00 до 19:00</span>
                            <span>ВС: ВЫХОДНОЙ</span>
                        </div>
                    </div>
                    <div class="flex-col">
                        <h3>Контакты</h3>
                        <div class="flex">
                            <div class="flex-col footer-block">
                                <span>Алиса</span>
                                <a class="link text-accent link-accent" href="tel:89125411928">89125411928</a>
                                <img src="/assets/images/QRcodAlisac.jpg" class="image qr-code-small">
                            </div>
                            <div class="flex-col footer-block">
                                <span>Евгения</span>
                                <a class="link text-accent link-accent" href="tel:89121155554">89121155554</a>
                                <img src="/assets/images/QRcodEvg1.jpg" class="image qr-code-small">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-col">
                    <h3>Адрес</h3>
                    <span>г. Ухта, Дзержинского 1</span>
                </div>
            </div>
        </footer>
    </body>

    </html>
<?php
}

function month($month)
{
    $list = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
    return $list[$month - 1];
}
