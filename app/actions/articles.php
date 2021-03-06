<?php 
/**
 * Show Article data
 * @author Ubani A Balogun <ubani@sas.upenn.edu>
 * @package HECTOR
 */

/**
 * Necessary includes
 */
include_once($approot . 'lib/class.Collection.php');
include_once($approot . 'lib/class.Article_x_Tag.php');
include_once($approot . 'lib/class.Tag.php');

$article_collection = new Collection('Article');
$articles = array();

if (is_array($article_collection->members)){
	foreach ($article_collection->members as $article){
		$articles[] = $article->get_object_as_array();
	}
}

$a_x_tag = new Article_x_Tag();

$tag_frequencies = $a_x_tag->get_field_frequencies($field='tag_id');
if (!empty($tag_frequencies)){
	$tag_names = array();
	$tag_counts = array();
	$tag_total = array_sum($tag_frequencies);
	foreach ($tag_frequencies as $name=>$count){
		$tag_counts[] = round(($count/$tag_total) * 100);
		$tag = new Tag($name);
		$tag_names[] = $tag->get_name();
	}
	
	$labels = json_encode(array_slice($tag_names,0,10));
	$data = json_encode(array_slice($tag_counts,0,10));
}else{
	$labels = $data = '[]';
}


hector_add_js('articles.js');

include_once($templates. 'admin_headers.tpl.php');
include_once($templates . 'articles.tpl.php');
?>