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
$regex=get_option('htimeline_regex');
$display_order=get_option('htimeline_order');
$customfield=get_option('htimeline_customfield');

$allYears=$wpdb->get_results("SELECT DISTINCT meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key='$customfield'");
$already_viewed=array();
$keys=array();
$matrix=array();
foreach($allYears as $thisYear) {
	$yearVars=get_object_vars($thisYear);
	$year = $yearVars['meta_value'];
	$correlati=get_posts("meta_key=$customfield&meta_value=$year&order=ASC&orderby=title");
	$i=0;
	$post_t=get_object_vars($correlati[0]);
	
	$posts = array();
	for($i;$i<=count($correlati);$i++){
		$posts[]=get_object_vars($correlati[$i]);
	}
	$keys[]=$year;

	$article = array();
	$article['tag']=$year;
	$article['posts']=$posts;
	$matrix[$year]=$article;
}


$string="<div id=\"history_timeline\">";
$alt=0;

if($display_order=="sort") sort($keys);
else rsort($keys);

foreach($keys as $key){
	$article=$matrix[$key];
	$year=$key;
	
	$posts = $article['posts'];
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

function formatPosts($posts) {
	$result = '';
	foreach($posts as $post_t) {
		$titolo = $post_t['post_title'];
		$titolo = preg_replace('/\(\d{2,4}\)$/', '', $titolo);
		$link=get_permalink($post_t['ID']);
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
