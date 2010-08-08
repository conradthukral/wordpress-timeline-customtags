<?php  
/* 
Plugin Name: History timeline, custom field edition
Plugin URI: http://github.com/conradmueller/wordpress-timeline-customtags
Description: Plugin for displaying a timeline based on custom fields. Based on Mauro Rocco's "History timeline" v0.3
Author: Jan Schuster, Conrad Müller, Mauro Rocco
Version: 0.1
Author URI: http://www.schoenerlesen.de 

Original software: Copyright 2009 Mauro Rocco (email: fireantology@gmail.com)
Modifications: Copyright 2010 Conrad Müller (email: conrad@direktorat.org)

This file is part of History timeline, custom field edition (HTCF).

HTCF is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

HTCF is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with HTCF.  If not, see <http://www.gnu.org/licenses/>.
*/

function print_timeline($atts) {
include('include/functions.php'); 
include('include/variables.php');

global $wpdb;
$display_order=get_option('htimeline_order');
$customfield=get_option('htimeline_customfield');
$output_format=get_option('htimeline_output_format');
$year_only=get_option('htimeline_year_only');

$allPostsWithDates=$wpdb->get_results("SELECT post_id, meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key='$customfield'");
$matrix=array();

foreach($allPostsWithDates as $postWithDate) {
	$date_parsed = parseDate($postWithDate->meta_value, $year_only);
	$date_output = formatDate($date_parsed, $year_only, $output_format);
	$post = get_post($postWithDate->post_id);
	
	if (array_key_exists($date_output, $matrix)) {
		$values = $matrix[$date_output];
	} else {
		$values = array();
	} 
	$values []= $post;
	$matrix[$date_output] = $values;
}

$string="<div id=\"history_timeline\">";
$alt=0;

$keys = array_keys($matrix);
if($display_order=="sort") sort($keys);
else rsort($keys);

foreach($keys as $key){
	$posts=$matrix[$key];
	uasort($posts, "compare_posts_by_title");
	$year=$key;
	
	$string.="<div class=\"timeline_row\">";
	if($alt%2==0){
		$string.="<div class=\"timeline_left\"><span class=\"timeline_tag\">$year</span></div><div class=\"timeline_right withborder\">";
		$string.=formatPosts($posts);
		$string.="</div>";
	} else{
		$string.="<div class=\"timeline_left withborder\">";
		$string.=formatPosts($posts);
		$string.="</div><div class=\"timeline_right\"><span class=\"timeline_tag\">$year</span></div>";
	}
	$string.="<div class=\"timeline_clear\"></div></div>";
	$alt++;
}



$string.="<div style=\"clear: both; display:block;\"></div></div>";
return $string;
}

add_shortcode('history_timeline', 'print_timeline');

function parseDate($dateStr, $year_only) {
	if ($year_only) {
		return $dateStr;
	}
	return new DateTime($dateStr);
}

function formatDate($date, $year_only, $output_format) {
	if ($year_only) {
		return $date;
	}
	return $date->format($output_format);
}

function compare_posts_by_title($a, $b) {
    return strcmp($a->post_title, $b->post_title);
}

function formatPosts($posts) {
	$result = '';
	foreach($posts as $post) {
		$titolo = $post->post_title;
		$titolo = preg_replace('/\(\d{2,4}\)$/', '', $titolo);
		$link=get_permalink($post->id);
		$result.="<a href=\"$link\">".$titolo."</a>";
	}
	return $result;
}

function history_timeline_css() {
$css=get_option('htimeline_css');
echo "<style type=\"text/css\">\n";
echo $css;
echo "\n</style>";
}

add_action('wp_head', 'history_timeline_css');

function history_timeline_admin_actions() {  
     add_options_page("History Timeline", "History Timeline", "manage_options", "HistoryTimeline", "htimeline_admin");  
}  

function htimeline_admin() {  
     include('include/htimeline_admin.php');  
}  
   
add_action('admin_menu', 'history_timeline_admin_actions');  

?>
