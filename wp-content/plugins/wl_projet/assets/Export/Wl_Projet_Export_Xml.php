<?php

$path= DIR;
preg_match('/(.)wp-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');

global $wpdb;
$table_pays = $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

$sql = "SELECT FROM $table_pays";

$pays = $wpdb->get_results($sql,'ARRAY_A');

ob_start();

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Type: text/xml; charset=UTF-8');

$xml = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?>\n<Pays/>");

foreach ($pays as $pays) :
    $event = $xml->addChild("Liste des pays");
    $iso= $pays['code_ISO'];
    $note= $pays['note'];
    $accessibilite=$pays['accessibilité'];
    $disponibilite=$pays['disponibilité'];


    foreach ($pays as $key => $value)
        $$key = $value;


    $event->addChild("pays", $pays . " " . $iso);
    $event->addChild("note", $note);

    if ($accessibilite==1)
        $event->addChild("accessibilité", "oui");
    else
        $event->addChild("accessibilité", "non");


    if ($disponibilite==1)
        $event->addChild("disponibilité", "disponibilité");
    else
        $event->addChild("disponibilité", "indisponibilité");


endforeach;

print $xml->asXML();

$filename = sprintf('Wl_Projet_ExportXML%s.xml', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="' . $filename . '";');
header('Content-Transfer-Encoding: binary');

ob_end_flush();
