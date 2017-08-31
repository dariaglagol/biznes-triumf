<?php

$required = array(
    'org_form',
    'org_name',
    'org_sphere',
    'org_registration_date',
    'org_code_of_reason',
    'org_individual_tax_num',
    'org_state_registration_number',
    'org_activity_classifier',
    'org_legal_adress',
    'org_fact_adress',
    'org_phone',
    'org_email',
    'org_stuff',
    'teritory',
);


include 'dbconnect.php';
include 'functions.php';
$post = $_POST;
$search = mysql_fetch_array(mysql_query("SELECT * FROM `lider__triumf` WHERE `hash` = '" . mysql_real_escape_string($post['hash']) . "'"));
$data['search'] = $search;
if ($search['nominations'] == 'В начале славных дел') {
    $required[] = 'quart1_2017';
    $required[] = 'quart2_2017';
} else {
    $required[] = 'prib_2015';
    $required[] = 'prib_2016';
    $required[] = 'prib_2017';
}

if ($post['org_form'] == 'ООО') {
    $required[] = 'org_share';
}


foreach ($required as $row) {
    if (!$post[$row]) {
        $data['error'][] = $row;
    }
    $form[$row] = trim(mysql_real_escape_string($post[$row]));

}
$form['org_url'] = trim(mysql_real_escape_string($post['org_url']));
$hash = mysql_real_escape_string($post['hash']);

if (!$data['error']) {

    mysql_query($sql = "UPDATE `lider__triumf` SET 
                `org_form` = '" . $form['org_form'] . "',
                `org_name` = '" . $form['org_name'] . "',
                `org_sphere` = '" . $form['org_sphere'] . "',
                `org_registration_date` = '" . $form['org_registration_date'] . "',
                `org_code_of_reason` = '" . $form['org_code_of_reason'] . "',
                `org_individual_tax_num` = '" . $form['org_individual_tax_num'] . "',
                `org_state_registration_number` = '" . $form['org_state_registration_number'] . "',
                `org_activity_classifier` = '" . $form['org_activity_classifier'] . "',
                `org_legal_adress` = '" . $form['org_legal_adress'] . "',
                `org_fact_adress` = '" . $form['org_fact_adress'] . "',
                `org_phone` = '" . $form['org_phone'] . "',
                `org_email` = '" . $form['org_email'] . "',
                `org_url` = '" . $form['org_url'] . "',
                `org_stuff` = '" . $form['org_stuff'] . "',
                `org_profit` = '" . $form['org_profit'] . "',
                `quart1_2017` = '" . $form['quart1_2017'] . "',
                `quart2_2017` = '" . $form['quart2_2017'] . "',
                `prib_2015` = '" . $form['prib_2015'] . "',
                `prib_2016` = '" . $form['prib_2016'] . "',
                `prib_2017` = '" . $form['prib_2017'] . "',
                `teritory` = '" . $form['teritory'] . "',
                `org_share` = '" . $form['org_share'] . "' 
                WHERE `hash` = '$hash'
                ");

    $data['status'] = 'success';
    $data['view'] = '<div class="btn-wrap">';
    $data['view'] .= 'Ваша заявка принята';
    $data['view'] .= '</div>';
    $data['sql'] = $sql;
    $data['error'] = mysql_error();

    mail_second_step($search['email']);

} else {
    $data['status'] = 'error';
}

die(json_encode($data));