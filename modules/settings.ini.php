<?php
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