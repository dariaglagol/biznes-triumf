<?php

include 'ajax/dbconnect.php';
$search = mysql_fetch_array(mysql_query("SELECT * FROM `lider__triumf` WHERE `hash` = '" . mysql_real_escape_string($_GET['hash']) . "'"));

?>
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
<main>
	<?php if(!$search['org_form']){ ?>
    <form method="post" action="ajax/two.php" class="reg-ext" onsubmit="return false;">
        <input type="hidden" name="hash" value="<?= $_GET['hash'] ?>">
        <label for="org-form">Организационно-правовая форма СМСП: </label>
        <select id="org-form" name="org_form">
            <option value="ООО">ООО</option>
            <option value="ИП">ИП</option>
            <option value="ОАО">ОАО</option>
            <option value="ЗАО">ЗАО</option>
            <option value="ПАО">ПАО</option>
            <option value="ПТ">ПТ</option>
            <option value="КТ">КТ</option>
            <option value="ПК">ПК</option>
            <option value="ОДО">ОДО</option>
            <option value="КФХ">КФХ</option>
        </select>
        <label for="org-name">Наименование субъекта МСП:</label>
        <input type="text" id="org-name" name="org_name" placeholder="Введите название вашей организации" required="">
        <label for="org-sphere">Сфера деятельности:</label>
        <input type="text" id="org-sphere" name="org_sphere" placeholder="Укажите сферу деятельности компании"
               required="">
        <label for="org-registration-date">Дата государственной регистрации СМСП: </label>
        <input type="text" id="org-registration-date" name="org_registration_date" placeholder="дд.мм.гггг" required="">
        <label for="org-code-of-reason">КПП: </label>
        <input type="text" id="org-code-of-reason" name="org_code_of_reason" required>
        <label for="org-individual tax-num">ИНН: </label>
        <input type="text" id="org-individual-tax_num" name="org_individual_tax_num" required="">
        <label for="org-state-registration-number">ОГРН: </label>
        <input type="text" id="org-state-registration-number" name="org_state_registration_number" required="">
        <label for="org-activity-classifier">ОКВЭД: </label>
        <input type="text" id="org-activity-classifier" name="org_activity_classifier" required="">
        <label for="org-legal-adress">Юридический адрес организации: </label>
        <input type="text" id="org-legal-adress" name="org_legal_adress" required="">
        <label for="org-fact-adress">Фактический адрес: </label>
        <input type="text" id="org-fact-adress" name="org_fact_adress" required="">
        <label for="org-phone">Телефон организации: </label>
        <input type="tel" id="org-phone" name="org_phone" required="">
        <label for="org-email">E-mail организации: </label>
        <input type="email" id="org-email" name="org_email" required="">
        <label for="org-url">Сайт организации: </label>
        <input type="text" id="org-url" name="org_url">
        <label for="org-stuff">Количество сотрудников организации: </label>
        <input type="text" id="org-stuff" name="org_stuff" required="">
        <?php if($search['nominations'] == 'В начале славных дел'){ ?>
            <label for="quart1_2017">Прибыль организации за 1кв. 2017 (рубли)</label>
            <input type="text" id="quart1_2017" name="quart1_2017" required="">
            <label for="2_quart_2017">Прибыль организации за 2кв. 2017 (рубли)</label>
            <input type="text" id="quart2_2017" name="quart2_2017" required="">
        <?php }else{ ?>
            <label for="prib_2015">Прибыль организации за 2015 (рубли)</label>
            <input type="text" id="prib_2015" name="prib_2015" required="">
            <label for="prib_2016">Прибыль организации за 2016 (рубли)</label>
            <input type="text" id="prib_2016" name="prib_2016" required="">
            <label for="prib_2017">Прибыль организации за 2017 (рубли)</label>
            <input type="text" id="prib_2017" name="prib_2017" required="">
        <?php } ?>
        <label for="org-teritory">Территория деятельности организации: </label>
        <select id="teritory" name="teritory" required="">
            <option value="г. Томск и ТО">г . Томск и ТО</option>
            <option value="РФ">Российская Федерация</option>
            <option value="За пределами РФ">За пределами РФ</option>
        </select>
        <label for="org-share" class="only-ooo">Доля участника в уставном капитале субъекта МСП</label>
        <input type="text" id="org-share" name="org_share"  class="only-ooo" required="">
        <input type="checkbox" name="agreement" required checked class="agreement" id="agreement-checkbox">
		<label class="agreement-label"><a href="soglashenie.pdf" target="_blank">Я согласен(-а) на обработку персональных данных</a></label>
        <button type="submit">Отправить</button>
    </form>
	<?php }else{ ?>
		<div class="btn-wrap btn-wrap-title">Ваши данные уже приняты</div>
	<?php } ?>
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
