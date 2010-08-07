<?
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


$date_formats_list=array();
$date_formats=array('date'=>'Y-m-d','regex'=>'^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])$');
$date_formats_list[]=$date_formats;
$date_formats=array('date'=>'d-m-Y','regex'=>'^([0-3][0-9])-([0-1][0-9])-([0-9]{2,4})$');
$date_formats_list[]=$date_formats;
$date_formats=array('date'=>'m-Y','regex'=>'^([0-1][0-9])-([0-9]{2,4})$');
$date_formats_list[]=$date_formats;
$date_formats=array('date'=>'Y','regex'=>'^([0-9]{2,4})$');
$date_formats_list[]=$date_formats;

$date_print_formats=array('Y-m-d (1985-08-06)'=> 'Y-m-d',
			  'd-m-Y (06-08-1985)'=>'d-m-Y',
			  'm-Y (08-1985)'=>'m-Y',
			  'D d M Y (Fri 6 Aug 2010)'=>'D d M Y',
			  'd M Y (6 Aug 2010)'=>'d M Y',
			  'M Y (Aug 2010)'=>'M Y',
			  'Y/m/d (1985/08/06)'=> 'Y/m/d',
			  'd/m/Y (06/08/1985)'=>'d/m/Y',
			  'm/Y (08/1985)'=>'m/Y',
			  'Y (1985)'=>'Y',);

$default_css="
#history_timeline{
width: 600px; margin: 0 auto;
}

#history_timeline .timeline_row{
clear: both; display:block;
}

#history_timeline a {
display: block;
margin-bottom: 10px;
}

#history_timeline .timeline_left{
width: 40%; float: left; text-align: right; padding-right: 10px;
padding-bottom: 10px; padding-top: 10px;
}

#history_timeline .timeline_left.withborder{
border-right: 1px solid #000;
}

#history_timeline .timeline_right{
width: 40%; float: left; padding-left: 10px;
padding-bottom: 10px; padding-top: 10px;
}

#history_timeline .timeline_right.withborder {
border-left: 1px solid #000;
}

#history_timeline .timeline_tag{
font-weight: bold;
}

#history_timeline .timeline_tag a{
text-decoration: none;
color: #000;
}

#history_timeline .timeline_clear{
clear: both; display:block;
}
";

?>
