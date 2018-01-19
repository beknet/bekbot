<?php
global $wpdb;

$server_output = connData(json_encode(array('ac' => 'ini','db' => $wpdb->get_row("SELECT id, idacc, lickey FROM ".$wpdb->prefix."beknetbot"))));
$datadb_output = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."beknetbot");