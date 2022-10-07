<?php

function checkIsLogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('user_id')) {
        redirect('auth');
    }
}

function goToDefaultPage()
{
    $ci = get_instance();
    if ($ci->session->userdata('lvl_access') == 'admin') {
        redirect('dashboard');
    }
}

// change the readable datetime to unix datetime
function changeUnixTime($datetime)
{
    $date = date_create_from_format('d/m/Y', $datetime);
    $isodate = date_format($date, 'Y-m-d');
    return strtotime($isodate);
}