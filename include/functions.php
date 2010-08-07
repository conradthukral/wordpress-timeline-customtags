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

function stringToDate($string, $option){
	$separator="-";
	if(substr($option,0,1)=="Y")
	  {
	  if(strlen($option)>1){
		list($y, $m, $d) = explode($separator, $string);
	  }
	  else {
	          $d=1;
		  $m=1;
		  $y=$string;			
		}
	   }
	if(substr($option,0,1)=="d")  list($d, $m, $y) = explode($separator, $string);
	if(substr($option,0,1)=="m"){
		$d=1;	  
		list($m, $y) = explode($separator, $string);
	}
	
	$date = new DateTime($y.'-'.$m.'-'.$d);
	return $date;
}

?>
