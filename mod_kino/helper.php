<?php
	defined ('_JEXEC') or  die('Direct Access to ' . basename (__FILE__) . ' is not allowed.');
/*------------------------------------------------------------------------
# kino - Joomla Kino Game
# ------------------------------------------------------------------------
# author    John Gyftakis
# copyright Copyright (C) 2013 joomlagifts.com. All Rights Reserved.
# Websites: http://www.joomlagifts.com
# Technical Support: admin@joomlagifts.com
# license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

	
class mod_kino {
	
	function getSelectedNums(){
        //global $mainframe;

        $xml_kino_nums = simplexml_load_file("http://applications.opap.gr/DrawsRestServices/kino/last.xml");
		
		$kino_nums = array();
		foreach ($xml_kino_nums->result as $xml_num)
		{
			array_push($kino_nums, (int)$xml_num );
		}
		
        return $kino_nums;
    }
	
	function getLastDrawNum(){
		global $mainframe;
		$xml_kino = simplexml_load_file("http://applications.opap.gr/DrawsRestServices/kino/last.xml");
		return $xml_kino->drawNo;
	}
	
}
