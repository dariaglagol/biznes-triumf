<?php
$required = array(
    'user_name',
    'user_birthdate',
    'sex',
    'reg_place',
    'nominations',
    'phone',
    'email',
    'institution',
);

include 'dbconnect.php';
include 'functions.php';
$post = $_POST;

foreach ($required as $row) {
    if (!$post[$row]) {
        $data['error'] = $row;
    }
    //$form[$row] = $post[$row];
    $form[$row] = trim(mysql_real_escape_string($post[$row]));

}

if (!$data['error']) {


    $date = date('Y-m-d H:i:s');
    $hash = md5($date);
    mysql_query($sql = "INSERT INTO `lider__triumf`
                  (`date`,`hash`,`user_name`,`user_birthdate`,`sex`,`reg_place`,`nominations`,`phone`,`email`,`institution`) 
                  VALUES
                  ('$date','$hash'
                  ,'" . $form['user_name'] . "'
                  ,'" . date('Y-m-d', strtotime($form['user_birthdate'])) . "'
                  ,'" . $form['sex'] . "'
                  ,'" . $form['reg_place'] . "'
                  ,'" . $form['nominations'] . "'
                  ,'" . $form['phone'] . "'
                  ,'" . $form['email'] . "'
                  ,'" . $form['institution'] . "'
                  )");

    $data['status'] = 'success';

    $data['view'] = '<form method="post" action="ajax/two.php" class="reg-ext" onsubmit="return false;">
        <a href="/" class="btn-back" onclick="send(' . mysql_insert_id() . ');return false;" style="margin-bottom:30px;">Отправить позже</a>
        <input type="hidden" name="hash" value="' . $hash . '">
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
        <label for="org-stuff">Количество сотрудников организации^ </label>
        <input type="text" id="org-stuff" name="org_stuff" required="">';

    if ($form['nominations'] == 'В начале славных дел') {
        $data['view'] .= '<label for="1_quart_2017">Прибыль организации за 1кв. 2017 (рубли)</label>
            <input type="text" id="1_quart_2017" name="quart1_2017" required="">
            <label for="2_quart_2017">Прибыль организации за 2кв. 2017 (рубли)</label>
            <input type="text" id="2_quart_2017" name="quart2_2017" required="">';
    } else {
        $data['view'] .= '<label for="prib_2015">Прибыль организации за 2015 (рубли)</label>
            <input type="text" id="prib_2015" name="prib_2015" required="">
            <label for="prib_2016">Прибыль организации за 2016 (рубли)</label>
            <input type="text" id="prib_2016" name="prib_2016" required="">
            <label for="prib_2017">Прибыль организации за 2017 (рубли)</label>
            <input type="text" id="prib_2017" name="prib_2017" required="">';
    }
    $data['view'] .= '<label for="org-teritory">Территория деятельности организации: </label>
        <select id="teritory" name="teritory" required="">
            <option value="г. Томск и ТО">г . Томск и ТО</option>
            <option value="РФ">Российская Федерация</option>
            <option value="За пределами РФ">За пределами РФ</option>
        </select>
        <label for="org-share" class="only-ooo">Доля участника в уставном капитале субъекта МСП</label>
        <input type="text" id="org-share" name="org_share"  class="only-ooo" required="">
        <button type="submit">Отправить</button>
        <a href="/" class="btn-back" onclick="send(' . mysql_insert_id() . ');return false;">Отправить позже</a>
    </form>';

    $data['error'] = mysql_error();
	mail_first_step($form['email']);
	
} else {
    $data['status'] = 'error';
}

die(json_encode($data));