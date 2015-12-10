<?php

/* Proper way to enqueue scripts and styles */
function mytheme_custom_styles(){
    wp_enqueue_style( 'openlayers', get_stylesheet_directory_uri() . '/api/OpenLayers/css/ol.css');
}

function mytheme_custom_scripts(){  
    // Register and Enqueue a Script
    // get_stylesheet_directory_uri will look up child theme location
    wp_enqueue_script( 'bccvl-search', get_stylesheet_directory_uri() . '/js/bccvl-search.js', array( 'jquery' ));
    // Add bootstrap   
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.js', array( 'jquery' ));
    // Add openlayers
    wp_enqueue_script( 'openlayers', get_stylesheet_directory_uri() . '/api/OpenLayers/build/ol.js', array(), '3.7.0', true);   
    wp_enqueue_script( 'demosdm', get_stylesheet_directory_uri() . '/js/demosdm.js', array( 'jquery' ));  
}

add_action('wp_print_styles', 'mytheme_custom_styles');
add_action('wp_enqueue_scripts', 'mytheme_custom_scripts');

function submit_demo_sdm(){
    $login = 'demosdm';
    $password = <replace-with-password>;
    $url = 'https://app.bccvl.org.au/experiments/API/em/v1/demosdm';
    $fields = array(
        'lsid' => urlencode($_POST['lsid'])
        );
    //url-ify the data for the POST
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string, '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    $result = curl_exec($ch);
    curl_close($ch);  
    echo $result;
    wp_die();
}

function check_job_status_plone(){
    $login = 'demosdm';
    $password = <replace-with-password>;
    $lsid = rawurldecode($_GET['lsid']);
    $url = 'https://app.bccvl.org.au/API/job/v1/query?lsid='.$lsid;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => "$login:$password"
    ));
    $result = curl_exec($ch);
    curl_close($ch);
    header('Content-type: application/json');
    echo $result;
    wp_die();
}

add_action('wp_ajax_nopriv_submit_demo_sdm', 'submit_demo_sdm');
add_action('wp_ajax_submit_demo_sdm', 'submit_demo_sdm');
add_action('wp_ajax_nopriv_check_job_status_plone', 'check_job_status_plone');
add_action('wp_ajax_check_job_status_plone', 'check_job_status_plone');
?>