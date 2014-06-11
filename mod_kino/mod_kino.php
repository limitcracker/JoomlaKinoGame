<?php
defined('_JEXEC') or die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*------------------------------------------------------------------------
# kino - Joomla Kino Game
# ------------------------------------------------------------------------
# author    John Gyftakis
# copyright Copyright (C) 2013 joomlagifts.com. All Rights Reserved.
# Websites: http://www.joomlagifts.com
# Technical Support: admin@joomlagifts.com
# license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/


// Setting
$kino_size = 	$params->get( 'kino_size', 'small' ); 

$layout = $params->get('layout','default');


$mainframe = JFactory::getApplication();
if (!class_exists( 'mod_kino' )) require('helper.php');

require(JModuleHelper::getLayoutPath('mod_kino',$layout));

?>
