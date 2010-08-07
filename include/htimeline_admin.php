<?php  
/*
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

include('variables.php');
 
        if($_POST['htimeline_hidden'] == 'Y') {  
         //Form data sent  
         $regex = $_POST['regex'];
	 $output_format = $_POST['output_format'];
	 $order = $_POST['order'];
	 $css = $_POST['css'];
         update_option('htimeline_regex', $regex);
	 update_option('htimeline_output_format', $output_format); 
	 update_option('htimeline_order', $order);
	 update_option('htimeline_css', $css);
           
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
        <?php  
     } else {  
        $regex = get_option('htimeline_regex');
	$output_format = get_option('htimeline_output_format');
	$order = get_option('htimeline_order');
	$css = get_option('htimeline_css');
    }  
 ?>  

<div class="wrap">
<h2>History Timeline</h2>
<table class="widefat">
	<tbody>
	<tr>
	<td scope="col">
		<div style="position: relative; float: left; width: 55%;">
			<h3>How to use history timeline</h3>
			<p class="tagcode">
				Copy and paste this code in your article, page or widget content.<br/>
			</p>
			<b>[history_timeline]</b><br>
			
			<h3>Customize options</h3>
			<form name="htimeline_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
			<p><input type="hidden" name="htimeline_hidden" value="Y">
			<?php _e("Input date format: " ); ?>
			&nbsp;
			<select name="regex">
			<? foreach($date_formats_list as $format){
				if($format['regex']==$regex) echo "<option value=\"".$format['regex']."\" selected>".$format['date']."</option>";
				else echo "<option value=\"".$format['regex']."\">".$format['date']."</option>";
			}
			?>
			</select> 
			<i>You must to write tag in the selected format</i>
			</p>
			<p>
			<?php _e("Output date format: " ); ?>
			&nbsp;
			<select name="output_format">
			<? foreach($date_print_formats as $label => $format){
				if($format==$output_format) echo "<option value=\"".$format."\" selected>".$label."</option>";
				else echo "<option value=\"".$format."\">".$label."</option>";
			}
			?>
			</select>
			<p>
			<?php _e("Order: " ); ?>
			&nbsp;
			<select name="order">
				<option <? if($order=="sort") echo "selected"; ?> value="sort">lowest to highest</option>			
				<option <? if($order=="rsort") echo "selected"; ?> value="rsort">highest to lowest</option>
			</select>
			 <i>The diplay order of the timeline</i>
			</p>
			<h3>Stylesheet<h3>
			<textarea name="css" cols="60" rows="15"><? if($css=="") echo $default_css;
                           else echo $css;	
			?></textarea>
			</p>				
			<p class="submit">
			&nbsp;<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
			</p>
			</form>
			<p>
			</p>
		</div>
	</td>
	</tr>
	</tbody>
	</table>
</div>
