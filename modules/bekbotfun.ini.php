<?php
/*
      ФУНКЦИЯ connData
=================================================== */
function connData($data){
  $options = array(
      CURLOPT_RETURNTRANSFER => true,     // return web page
      CURLOPT_HEADER         => false, //'Accept:application/json',    // don't return headers
      CURLOPT_FOLLOWLOCATION => true,     // follow redirects
      CURLOPT_ENCODING       => "",       // handle all encodings
      CURLOPT_USERAGENT      => "spider", // who am i
      CURLOPT_AUTOREFERER    => true,     // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
      CURLOPT_TIMEOUT        => 120,      // timeout on response
      CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
      CURLOPT_SSL_VERIFYPEER => false,    // Disabled SSL Cert checks
      CURLOPT_POSTFIELDS     => $data
  );

  $ch      = curl_init( BEKBOT_URL.'/api/api.ini.php' );
  curl_setopt_array( $ch, $options );
  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  //echo "<pre>$content</pre>";
  //var_dump($content);//die();

  $header['errno']   = $err;
  $header['errmsg']  = $errmsg;
  $header['content'] = json_decode($content);
  return (object) $header;
}

/*
      ФУНКЦИИ ВЫВОДА НА ЭКРАН
=================================================== */
function status($data){
  return $data->content->status;
}

function idacc($data){
  return $data->content->idacc;
}

function lickey($data){
  return $data->content->lickey;
}


function tlgroup($data){
  return $data->datatl ? $data->datatl : null;
}

function vkgroup($data){
  return $data->datavk ? $data->datavk : null;
}
/*
      ФУНКЦИИ АКТИВАЦИИ И РЕГИСТРАЦИИ
=================================================== */
if(isset($_POST['regPlugin'])){
  $lickey = trim($_POST['serialNumber']);
  $result = connData(json_encode(array(
    'ac' => 'reg',
    'rd' => array('lickey' => $lickey,'dompath' => $_SERVER['HTTP_HOST'],'ipserv' => $_SERVER['SERVER_ADDR'])
  )));
  if(!$result->content->idacc){
    echo '<code>Ошибка регистрации!</code>';
  }else{
    $idacc = $result->content->idacc;
    $wpdb->update( $wpdb->prefix.'beknetbot', array('idacc' => $idacc, 'lickey' => $lickey), array( 'id' => 1 ) );
  }
}
/*
      ФУНКЦИИ TYPE_POSTS
=================================================== */
if(isset($_POST['dataTypePosts'])){
  $types_posts = serialize($_POST['type_posts']);
  $result = $wpdb->update( $wpdb->prefix.'beknetbot', array('datatypes' => $types_posts), array( 'id' => 1 ) );
  if(!$result){
    echo '<code>Ошибка ввода!</code>';
  }else{
    echo '<code>Сохранено!</code>';
  }
}
/*
      ФУНКЦИИ ТЕЛЕГРАМ
=================================================== */
if(isset($_POST['dataTelegram'])){
  $tgchannel = trim($_POST['tgGroup']);
  $result = connData(json_encode(array(
    'ac' => 'tgr',
    'db' => $wpdb->get_row("SELECT id, idacc, lickey FROM ".$wpdb->prefix."beknetbot"),
    'sr' => array('dompath' => $_SERVER['HTTP_HOST'],'ipserv'  => $_SERVER['SERVER_ADDR']),
    'tl' => array('channel' => $tgchannel)
  )));
  if(!$result->content->scalar){
    echo '<code>Ошибка ввода!</code>';
  }else{
    $wpdb->update( $wpdb->prefix.'beknetbot', array('datatl' => $tgchannel), array( 'id' => 1 ) );
    echo '<code>Сохранено!</code>';
  }
}
/*
      ФУНКЦИИ ВКОНТАКТЕ
=================================================== */
if(isset($_POST['dataVK'])){
  $vkgroup = trim($_POST['vkGroup']);
  $result = connData(json_encode(array(
    'ac' => 'vkg',
    'db' => $wpdb->get_row("SELECT id, idacc, lickey FROM ".$wpdb->prefix."beknetbot"),
    'sr' => array('dompath' => $_SERVER['HTTP_HOST'],'ipserv'  => $_SERVER['SERVER_ADDR']),
    'vk' => array('group' => $vkgroup)
  )));

  if(!$result->content->scalar){
    echo '<code>Ошибка ввода!</code>';
  }else{
    $wpdb->update( $wpdb->prefix.'beknetbot', array('datavk' => $vkgroup), array( 'id' => 1 ) );
    echo '<code>Сохранено!</code>';
  }
}
/*
      ФУНКЦИИ ФЕЙСБОК
=================================================== */

/*
      ФУНКЦИИ ОК
=================================================== */


/*
      ОТПРАВКА ДАННЫХ НА ПУБЛИКАЦИЮ БОТУ
=================================================== */
function send_postdata_to_sbekbot( $new_status, $old_status, $post ) {
  global $wpdb;
  $datadb_ou = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."beknetbot");
  $datatypes = unserialize($datadb_ou->datatypes);
  if( $new_status !== $old_status && 'publish' === $new_status && in_array($post->post_type, $datatypes) ){
    $post    = get_post($post->ID);
    $author  = get_userdata($post->post_author);
    $title   = $post->post_title;
    $excerpt = wp_kses( wp_unslash($post->post_content), array() );
    $text    = wp_trim_words( $excerpt, 12, ' ...' );

    $link    = get_permalink( $post->ID );
    $photo   = get_the_post_thumbnail_url($post->ID, 'full');

    // $message = "Hi ".$author->display_name.", Your post, ".$post->post_title." has just been published at ".get_permalink( $post->ID ).". excerpt: ".$excerpt." photo: ".$photo." Well done!".$datadb_output->datatypes."\r\n";


    // // //...отправляем почту
    // $topic    = "Data from plugin BekBot";
    // $email    = "yb@bekker.co.il";
    // $headers  = "From: noreplay@bekbot.com\r\n";
    // $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";

    // mail($email, $topic, $message, $headers);

    $result = connData(json_encode(array(
      'ac' => 'pub',
      'db' => $wpdb->get_row("SELECT id, idacc, lickey FROM ".$wpdb->prefix."beknetbot"),
      'sr' => array('dompath' => $_SERVER['HTTP_HOST'],'ipserv'  => $_SERVER['SERVER_ADDR']),
      'pd' => array('id' => $post->ID, 'title' => $title, 'excerpt' => $text, 'link' => $link, 'photo' => $photo)
    )));

  }
}
add_action( 'transition_post_status', 'send_postdata_to_sbekbot', 10, 3 );
