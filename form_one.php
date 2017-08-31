<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Бизнес-Триумф: регистрация</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body class="form form--background">
<header>
    <div class="form-head-block container">
        <div class="logo logo--biz-triumf">
            <a href="http://xn--70-9kcqjfc6ag5akmpp.xn--p1ai/"><img src="img/logo-triumf-top.png"
                 alt="Бизнес-Триумф, региональная премия в области моодежного предпринимательства"></a>
        </div>
        <h1 class="form-header">Регистрация участника Бизнес-триумфа</h1>
        <div class="logo logo--fond">
            <div class="logo_contacts">
                <p class="logo_phone">+7 3822 902 984</p>
                <a href="mailto:info@biznestriumf.ru" class="logo_mail">info@biznestriumf.ru</a>
                <a href="http://fondtomsk.ru/" class="logo_site">www.fondtomsk.ru</a>
            </div>
            <img src="img/logo-fond.png" alt="Фонд развития предпринимательства">
        </div>
    </div>
</header>
<main class="spacer">
    <form method="post" action="ajax/one.php" class="reg"  onsubmit="return false;">
        <label>ФИО участника: </label>
        <input type="name" id="name" name="user_name" placeholder="Ваше имя" required="" autofocus>
        <label>Дата рождения:</label>
        <input type="text" id="birthdate" name="user_birthdate" placeholder="дд.мм.гггг" required="">
        <div class="reg_sex-block">
            <p class="reg_sex-desc">Ваш пол: </p>
            <input type="radio" id="sex-male" name="sex" value="male">
            <label for="sex-male">Мужской</label>
            <input type="radio" id="sex-female" name="sex" value="female">
            <label for="sex-female">Женский</label>
        </div>
        <label for="reg-place">Место регистрации участника: </label>
        <input type="text" id="reg-place" name="reg_place" placeholder="Место регистрации участника" required="">
        <label for="nominations">Выберите номинацию:</label>
        <select id="nominations" name="nominations" required="">
            <option value="В начале славных дел">«В начале славных дел»</option>
            <option value="Через тернии к звездам">«Через тернии к звездам»</option>
            <option value="Большой куш">«Большой куш»</option>
            <option value="Битва титанов">«Битва титанов»</option>
        </select>
        <label for="phone">Контактный телефон: </label>
        <input type="text" id="phone" name="phone" placeholder="+7 999 999 99 99" required="">
        <label for="email">Контактный e-mail:</label>
        <input type="email" id="email" name="email" placeholder="Ваш e-mail" required="">
        <label for="institution">Наименование учебного заведения:</label>
        <input type="text" id="institution" name="institution" required="">
        <input type="checkbox" name="agreement" required checked class="agreement" id="agreement-checkbox">
		<label class="agreement-label"><a href="soglashenie.pdf" target="_blank">Я согласен(-а) на обработку персональных данных</a></label>
        <button type="submit">Далее</button>
    </form>
</main>
<footer class="footer container">
    <section class="footer_logos">
        <div class="logo logo--biz-triumf-bottom">
          <a href="http://xn--70-9kcqjfc6ag5akmpp.xn--p1ai/"><img src="img/logo-bottom.png" alt="" width="390"></a>
        </div>
        <div class="logo logo--fond">
            <div class="logo_contacts">
                <p class="logo_phone">+7 3822 902 984</p>
                <a href="mailto:info@biznestriumf.ru" class="logo_mail">info@biznestriumf.ru</a>
                <a href="http://fondtomsk.ru/" class="logo_site">www.fondtomsk.ru</a>
            </div>
            <img src="img/logo-fond.png" alt="Фонд развития предпринимательства" width="80" height="110">
        </div>
    </section>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/ajax.js"></script>
</body>
</html>
