<?
include_once("../includes/db.php");
// var_dump($oneComment);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style/all.css">
    <link rel="stylesheet" href="/style/style.css">
</head>

<body>
    <div class="wrap">
        <header class="header">
            <a href="/" class="logo">PROWEB</a>
            <div class="singIn">
                <a href="/page/login.php" class="singIn__link">Вход</a>
                <a href="/page/registration.php" class="singIn__link">Регистрация</a>
            </div>
            <div class="user">
                <div class="user__profile">
                    <img src="/img/2.jpg" alt="" class="user__profile-img">
                    <h4 class="user__profile-name">Имя</h4>
                </div>
                <ul class="user__menu">
                    <li><a href="#" class="user__menu-link"><i class="far fa-external-link"></i>Выход</a></li>
                </ul>
            </div>
        </header>
        <aside class="menu">
            <div class="menu__reviews">
                <span class="menu__reviews_span" data-href="https://proweb.uz">
                    <i class="far fa-chevron-right"></i>
                </span>
                <span class="menu__reviews_text">Оставить озыв</span>
            </div>
            <ul class="menu__list">
                <li><a href="/" class="menu__list-link active"><i class="fal fa-home"></i>Главная</a></li>
                <li><a href="/page/contact.php" class="menu__list-link"><i class="fal fa-address-book"></i>Контакты</a></li>
                <li><a href="/page/table.php" class="menu__list-link"><i class="fas fa-times"></i>Таблица умножения</a></li>
                <li><a href="/page/calc.php" class="menu__list-link"><i class="fas fa-calculator-alt"></i>Калькулятор</a></li>
                <li><a href="/page/slide.php" class="menu__list-link"><i class="far fa-presentation"></i>Слайдер</a></li>
                <li><a href="/page/guest.php" class="menu__list-link"><i class="fal fa-books"></i>Гостевая книга</a></li>
                <li><a href="/page/test.php" class="menu__list-link"><i class="fal fa-vial"></i>Тест</a></li>
            </ul>
        </aside>
        <main class="main">
            <section class="head">
                <h2 class="head__title">Гостевая книга</h2>
                <p class="head__date">Сегодня 03 Март 2020 год</p>
            </section>
            <? if ($_GET["error"] == 1) {
                echo "<h2>Не удалось записать коментарий</h2>";
            } ?>
            <form action=<?= isset($_GET["id"]) ? "../includes/comment-update.php?id=".$_GET["id"] : "../includes/comment-add.php"?> class="form" method="post">
                <label class="form__label">
                    <span class="form__text">Введите имя</span>
                    <input type="text" class="form__input" name="name" value="<?= $oneComment['user-login'] ?>">
                </label>
                <label class="form__label">
                    <span class="form__text">Оставте отзыв</span>
                    <textarea class="form__input" name="descr"><?= $oneComment['comment_text']?></textarea>
                </label>
                <button class="form__btn">Отправить</button>
            </form>
            <div class="comments">
                <?
                foreach ($comments as $value) : ?>
                                   <div class="comments__item">
                    <p class="comments__item-time"><?= date("H:i", $value['comment_time']) ?></p>
                    <section class="comments__body">
                        <div class="comments__head">
                            <h2 class="comment__head-title"><?= $value['user_login'] ?></h2>
                            <!-- <img src="/img/1.jpg" alt="" class="comments__head-img"> -->
                        </div>
                        <p class="comments__body-descr"><?= $value['comment_text'] ?></p>
                        <?
                        if ($_SESSION["user-comment"] == $value["user_id"]) : ?>
                              <div class="comments__footer">
                                 <a href="./guest.php?id=<?= $value['comment_id'] ?>" class="comments__footer-link"><i class="fal fa-edit"></i></a>
                                 <a href="../includes/comment-del.php?id=<?= $value['comment_id'] ?>" class="comments__footer-link"><i class="fal fa-trash"></i></a>
                                 <? 
                                 if (isset($_GET["error"]) == 3) {
                                    echo " <span>Не удалось удолить</span>";
                                 }
                                 ?>
                                </div>
                       <? endif; ?>
                      
                    </section>
                </div> 
               <? endforeach; ?>

            </div>
        </main>
    </div>

    <script src="/js/script.js"></script>
</body>

</html>