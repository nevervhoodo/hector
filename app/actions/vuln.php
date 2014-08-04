<?php
/**
 * This is the default subcontroller for vulnerability
 * reports
 * 
 * @author Josh Bauer <joshbauer3@gmail.com>
 * @author Justin C. Klein Keane <jukeane@sas.upenn.edu>
 * @package HECTOR
 * @version 2013.08.29
 * 
 */

/**
 * Require the factory class
 */
require_once($approot . 'lib/class.Collection.php');
$vuln_detailcoll = new Collection('Vuln_detail');
$vuln_details = array();
if (is_array($vuln_detailcoll->members)) {
	foreach($vuln_detailcoll->members as $item) $vuln_details[] = $item;
}

$javascripts .= '<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>' . "\n";
$javascripts .= '<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">' . "\n";

include_once($templates . 'admin_headers.tpl.php');
include_once($templates . 'vuln.tpl.php');
?>