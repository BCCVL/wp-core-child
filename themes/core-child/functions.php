<?php

/* Proper way to enqueue scripts and styles */
function mytheme_custom_scripts(){  
    // Register and Enqueue a Script
    // get_stylesheet_directory_uri will look up child theme location
    wp_enqueue_script( 'bccvl-search', get_stylesheet_directory_uri() . '/js/bccvl-search.js', array('jquery'));
    // Add bootstrap   
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
    // Add openlayers
    wp_enqueue_script('openlayers', get_stylesheet_directory_uri().'/api/OpenLayers/build/ol.js', array(), '3.7.0', true);    
}

add_action('wp_enqueue_scripts', 'mytheme_custom_scripts');

function swift_fetch(){
    $lsid = rawurldecode($_GET['lsid']);
    $url = 'https://swift.rc.nectar.org.au:8888/v1/AUTH_0bc40c2c2ff94a0b9404e6f960ae5677/demosdm/'.$lsid.'/state.json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    header('Content-type: application/json');
    echo $result;
    wp_die();
}

function submit_demo_sdm(){
    $login = 'demosdm';
    $lsid = rawurldecode($_POST['lsid']);
    $url = 'https://demo.bccvl.org.au/experiments/@@demosdm?lsid='.$lsid;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);  
    header('Content-type: application/json');
    echo $result;
    wp_die();
}

add_action('wp_ajax_nopriv_swift_fetch', 'swift_fetch');
add_action('wp_ajax_swift_fetch', 'swift_fetch');
add_action('wp_ajax_nopriv_submit_demo_sdm', 'submit_demo_sdm');
add_action('wp_ajax_submit_demo_sdm', 'submit_demo_sdm');

?>