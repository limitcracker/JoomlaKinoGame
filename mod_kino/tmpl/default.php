<?php 

/*------------------------------------------------------------------------
# kino - Joomla Kino Game
# ------------------------------------------------------------------------
# author    John Gyftakis
# copyright Copyright (C) 2013 joomlagifts.com. All Rights Reserved.
# Websites: http://www.joomlagifts.com
# Technical Support: admin@joomlagifts.com
# license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

 // no direct access
defined ('_JEXEC') or die('Restricted access');

if (!class_exists( 'mod_kino' )) require('helper.php');

?>
<head>
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript">
	var jq191 = jQuery.noConflict(true);
	
	//var lastDrawNo = parseInt("<?php $lastDrawNo = mod_kino::getLastDrawNum(); echo $lastDrawNo; ?>", 10);
	var lastDrawNo = <?php $lastDrawNo = mod_kino::getLastDrawNum(); echo $lastDrawNo; ?>;
	var currDrawNo = lastDrawNo;
	var nav_action = "gotoLast";
	
	jq191(document).ready(function(){
		
		jq191(".mod_kino_div #prev").click(function(){
			jq191(this).prop('src', "<?php echo JURI::root().'modules/mod_kino/images/left_arrow_small_c.jpg' ?>");
			currDrawNo = currDrawNo - 1;
			if (currDrawNo < 1){currDrawNo = 1;}
			nav_action = "gotoElse";
			callChooseDrawAjax(  );
		});
		
		jq191(".mod_kino_div #next").click(function(){
			jq191(this).prop('src', "<?php echo JURI::root().'modules/mod_kino/images/right_arrow_small_c.jpg' ?>");
			currDrawNo = currDrawNo + 1;
			if (currDrawNo > lastDrawNo){currDrawNo = lastDrawNo;}
			nav_action = "gotoElse";
			callChooseDrawAjax(  );
		});
		
		jq191(".mod_kino_div #last").click(function(){
			jq191(this).prop('src', "<?php echo JURI::root().'modules/mod_kino/images/end_arrow_small_c.jpg' ?>");
			//window.currDrawNo = lastDrawNo;//<?php $lastDrawNo = mod_kino::getLastDrawNum(); echo $lastDrawNo; ?>;
			nav_action = "gotoLast";
			callChooseDrawAjax(  );
		});
		
		jq191(".mod_kino_div #search_kino").click(function(){
			//jq191(this).prop('src', "<?php echo JURI::root().'modules/mod_kino/images/search_icon_small_c.jpg' ?>");
			if ( jq191(".mod_kino_div #search_draw_txt").val() >0 && jq191(".mod_kino_div #search_draw_txt").val() < lastDrawNo ){
				jq191(this).prop('src', "<?php echo JURI::root().'modules/mod_kino/images/search_icon_small_c.jpg' ?>");
				currDrawNo = jq191(".mod_kino_div #search_draw_txt").val();
				nav_action = "gotoElse";
				callChooseDrawAjax(  );
			}else{
				jq191(".mod_kino_div #search_draw_txt").val('');
			}
		});
		
	});
	
	function callChooseDrawAjax(){
			
		jq191.ajax({
			type: 'GET',
			url: "<?php echo JURI::root().'index.php?option=com_kino&controller=controller&task=display&format=raw' ?>",
			cache: false,
			data: {
				draw_no: currDrawNo,
				navigation_action: nav_action
			},
			dataType: 'text',
			success: function(data){
			
				jq191("div .mod_kino_playground").load("<?php echo JURI::root().'index.php?option=com_kino&controller=controller&task=chooseDraw&draw_no='?>"
				//jq191("div .mod_kino_playground").load("<?php echo JURI::root().'index.php?option=com_kino&controller=controller&task=chooseDraw&'.JSession::getFormToken() .'=1'.'&draw_no='?>"
										+currDrawNo+"<?php echo '&navigation_action=' ?>"
										+nav_action+"<?php echo '&format=raw' ?>");
				
				if (jq191(".mod_kino_div #prev").prop('src') != "<?php echo JURI::root().'modules/mod_kino/images/left_arrow_small.jpg' ?>"){
					jq191(".mod_kino_div #prev").prop('src', "<?php echo JURI::root().'modules/mod_kino/images/left_arrow_small.jpg' ?>");
				}
				if (jq191(".mod_kino_div #next").prop('src') != "<?php echo JURI::root().'modules/mod_kino/images/right_arrow_small.jpg' ?>"){
					jq191(".mod_kino_div #next").prop('src', "<?php echo JURI::root().'modules/mod_kino/images/right_arrow_small.jpg' ?>");
				}
				if (jq191(".mod_kino_div #last").prop('src') != "<?php echo JURI::root().'modules/mod_kino/images/end_arrow_small.jpg' ?>"){
					jq191(".mod_kino_div #last").prop('src', "<?php echo JURI::root().'modules/mod_kino/images/end_arrow_small.jpg' ?>");
				}
				if (jq191(".mod_kino_div #search_kino").prop('src') != "<?php echo JURI::root().'modules/mod_kino/images/search_icon_small.jpg' ?>"){
					jq191(".mod_kino_div #search_kino").prop('src', "<?php echo JURI::root().'modules/mod_kino/images/search_icon_small.jpg' ?>");
				}
				
				if (nav_action == 'gotoLast'){
					window.currDrawNo = <?php $last = mod_kino::getLastDrawNum(); echo $last; ?>;
				}

			}
		});
	}
	
</script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::root().'modules/mod_kino/assests/'.$params->get( 'kino_size', 'small' ); ?>.css">
</head>

<div id="mod_kino">

	<?php
		$kino_nums = mod_kino::getSelectedNums();
		$kino_last_draw = mod_kino::getLastDrawNum();
		
		$img_left_arrow = JURI::root().'modules/mod_kino/images/left_arrow_small.jpg';
		$img_right_arrow = JURI::root().'modules/mod_kino/images/right_arrow_small.jpg';
		$img_end_arrow = JURI::root().'modules/mod_kino/images/end_arrow_small.jpg';
		$img_search_icon = JURI::root().'modules/mod_kino/images/search_icon_small.jpg';
		
		
		$img_kino_logo = JURI::root().'modules/mod_kino/images/kino_logo.jpg';
		$img_opap_logo = JURI::root().'modules/mod_kino/images/opap_logo.jpg';
		echo '<img src="'.$img_kino_logo.'" />';
		echo '<img src="'.$img_opap_logo.'" /> <br />';
		
		echo '<div class="mod_kino_board">';
		echo '<div class="mod_kino_div">';
		echo '<img id="prev" class="navig" src="'.$img_left_arrow.'" />';
		echo '<img id="next" class="navig" src="'.$img_right_arrow.'" />';
		echo '<img id="last" class="navig" src="'.$img_end_arrow.'" />';
		echo '<input id="search_draw_txt" type="text" />';
		echo '<img id="search_kino" src="'.$img_search_icon.'" />';
		echo '</div>';
		
		echo '<div class="mod_kino_playground">';
		echo '<div id="curr" class="mod_kino_div">No. &nbsp;&nbsp;&nbsp;<b>'.$kino_last_draw.'</b></div>';
			
		echo '<table class="mod_kino_table">';
		for ($i=1; $i<81; $i++)
		{
			if ( $i % 10 == 1 ){
				echo '<tr>';	
			}

			if ( in_array( $i, $kino_nums) ) {
				echo '<td class="selected">'. $i .'</td>';
			}else{
				echo '<td class="not_selected">'. $i .'</td>';
			}
			
			if ($i % 10 == 0 ){
				echo '</tr>';	
			}
			
		}
		echo '</table>';
		echo '<br /><br />';
		
	?>
			</div>
		</div>
</div>
