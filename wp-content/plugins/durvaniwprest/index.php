<?php

/*
 * Plugin Name: Custom API
 * Plugin URI: http://durvani.com
 * Description: Rest End Points
 * Version: 1.0
 * Author: Durvani
 * Author URI: http://durvani.com
 */
global $wpdb;
if (!defined( 'WPINC') ){
    die;
}

//  Create Action

function durvani_posts() {
    $args = [
        'numberposts' => 9999,
        'post_type' => 'post'
    ];

    $posts = get_posts($args);
    $data = [];
    $i = 0;
    foreach($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = $post->post_content;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID,'thumbnail');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID,'medium');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID,'large');
        $i++;

    }
    return $data;
}

function durvani_post($slug) {
    $args = [
        'name' => $slug,
        'post_type' => 'post'
    ];

    $posts = get_posts($args);
    $data = [];
    $i = 0;
    foreach($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = $post->post_content;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID,'thumbnail');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID,'medium');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID,'large');
        $i++;

    }
    return $data;
}
function durvani_videos() {
    $args = [
        'numberposts' => 9999,
        'post_type' => 'post'
    ];
    $msg = "";
    $error = "";

    // $posts = get_posts($args);
     $urldata = $_POST['urldata'];
     $category = $_POST['category'];
     $file = $_FILES['excel'];
    //  wp_handle_upload($file,array("test_form"=> false));
     $target_dir = wp_upload_dir();
     $target_file = $target_dir['path'] .'/'.strval(date('m')) . basename($_FILES["excel"]["name"]);

     $check = filesize($_FILES["excel"]["tmp_name"]);
     if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
        $msg = "The file ". htmlspecialchars( basename( $_FILES["excel"]["name"])). " has been uploaded.";
      } else {
        $msg = "Sorry, there was an error uploading your file.";
      }
      try{
        $myfile = fopen('http://amazon.test/wp-content/uploads/2020/'.strval(date('m')).'/'.strval(date('m')) . basename($_FILES["excel"]["name"]), "r") or die("Unable to open file!");
        $textvals = fgets($myfile);
        fclose($myfile);

      }
      catch (Exception $e) {
          $error = strval($e);

      }
      finally {
          $something = "";
      }
      
    

    $data = array("url"=>$urldata,"category"=>explode('\n',$category), 
    "message"=> strval($msg),"filecontent"=>$textvals,
    "error" => $error);
    
    $i = 0;
    // foreach($posts as $post) {
    //     $data[$i]['id'] = $post->ID;
    //     $data[$i]['title'] = $post->post_title;
    //     $data[$i]['content'] = $post->post_content;
    //     $data[$i]['slug'] = $post->post_name;
    //     $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID,'thumbnail');
    //     $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID,'medium');
    //     $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID,'large');
    //     $i++;

    // }
    return $data;
}

add_action('rest_api_init', function(){
    register_rest_route('durvani/v1','posts', [
        'methods' => 'GET',
        'callback' => 'durvani_posts'
    ]);
    register_rest_route('durvani/v1','videos', [
        'methods' => 'POST',
        'callback' => 'durvani_videos'
    ]);
    register_rest_route('durvani/v1','posts/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'durvani_post'
    ));
});


function process_contact_form(){
    $api_response = wp_remote_get('https://jsonplaceholder.typicode.com/todos/1');
    $api_response_body = wp_remote_retrieve_body($api_response);
    // $filesize = $_FILES["excel"];
    $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','xlsx/xls');
    $upload = wp_upload_bits($_FILES["excel"]["name"], null, file_get_contents($_FILES["excel"]["tmp_name"]));
    // if (in_array($_FILES['excel']['type'], $arr_img_ext)) {
        
    //     //$upload['url'] will gives you uploaded file path
    // }
    // wp_die();
    
    
    wp_send_json_success([$api_response_body,$_REQUEST,'filetype'=>$upload['url']]);
  }
  add_action('wp_ajax_send_contact_form', 'process_contact_form');
  add_action('wp_ajax_nopriv_send_contact_form', 'process_contact_form');

function importcsvtovideos(){
    global $wpdb;
    $totalInserted = 0;
    $csvFile = fopen($_REQUEST['filename'], 'r');
    $tablename = $_REQUEST['tablename'];
    
    
    while(($csvData = fgetcsv($csvFile)) !== FALSE){
        $csvData = array_map("utf8_encode", $csvData);
        // $dataLen = count($csvData);
        // Assign value to variables
        $URL = trim($csvData[0]);
        $IMAGE = trim($csvData[1]);
        $DURATION = trim($csvData[2]);
        $CHANNEL = trim($csvData[3]);

        // Check record already exists or not
        $cntSQL = "SELECT count(*) as count FROM {$tablename} where URL='".$URL."'";
        $record = $wpdb->get_results($cntSQL, OBJECT);

        if($record[0]->count==0){
            // Insert Record
          $wpdb->insert($tablename, array(
            'URL' =>$URL,
            'IMAGE' =>$IMAGE,
            'DURATION' =>$DURATION,
            'CHANNEL' => $CHANNEL
          ));

          if($wpdb->insert_id > 0){
            $totalInserted++;
          }
        }
    }
    wp_send_json_success([$_REQUEST,$totalInserted]);

}

add_action('wp_ajax_importcsvtovideos', 'importcsvtovideos');
add_action('wp_ajax_nopriv_importcsvtovideos', 'importcsvtovideos');

