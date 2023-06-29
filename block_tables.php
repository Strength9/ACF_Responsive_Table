<?php
/*
Block Name: Tables
Block Description: Tables
Post Types: post, page, custom-type
Block SVG: block_template.svg
Block Category: *******
*/
$blockclass = 'tableblock';
/* --------------------------------------------------------------------------- */
if( !empty( $block['data']['_is_preview'] ) ) {
		echo' <img src="'.get_stylesheet_directory_uri().'/template-parts/previews/block_template.png" alt="Title Field">';
		return;
} 

include('______editor_set_id_and_classes.php');


echo '<section '.$anchor.' class="'.$blockclass .'">	

<!---  Start of Responsive Table -->

<div class="resp_table">';
$table = '';
if( have_rows('table_data') ):
	$colcount = get_field('number_of_columns');
	
	$table = '<table id="'.get_field('table_id').'" name="'.get_field('table_id').'">';
	$passedarea = '';
	$titlearray = array();
	$ac = 1;
	while($ac <= $colcount ) {
			$titlearray['col_'.$ac] = '';
			$ac++;
	};

	while( have_rows('table_data') ) : the_row();
			
			$cc = 1;
			$rowclass = '';
			$row = '';		
			$hod = '';
			$hom = '';
			$extrarowclass ='';
			$hidcheck = 0;
			
		if (strlen(get_sub_field('row_class') )) {
			$extrarowclass = get_sub_field('row_class');
			$hidcheck++;
		};
			
		if ( !get_sub_field('hide_on_desktop') ) { 
			$hod = '';
		} else { 
			$hod = 'hideondesktop';
			$hidcheck++;
		};	
			
		if ( !get_sub_field('hide_on_mobile') ) { 
			$hom = '';
		} else { 
			$hom = 'hideonmobile';
			$hidcheck++;
		};		
		
		$classescreated = trim($extrarowclass.' '.$hod.' '.$hom);
		
		
		if  ($hidcheck > 0) {
			$rowclass = ' class="'.$classescreated.'"';
		}
			
		if ( !get_sub_field('header_row') ) { 
			$tarea = 'tbody';
			$tend = 'tbody';
			$cellstart = 'td'; 
			$cellend = 'td'; 
			$int = 1;
		} else { 
				$tarea = 'thead class="desktop"';
				$tend =  'thead';
				$cellstart = 'th scope="col"'; 
				$cellend = 'td'; 
		};
			if ($passedarea != $tarea ) {
			if (strlen($passedarea > 4)) {
				$row .= '</'.$passedareaend.'>';
			};
			$row .= '<'.$tarea.'>';
			$passedarea = $tarea;
			$passedareaend = $tend;
		} else { $row = ''; };
		
			$row .= '<tr'.$rowclass.'>';
			if ( get_sub_field('mobile_title') ) { 
				$ac = 1;
				while($ac <= $colcount ) {
						$titlearray['col_'.$ac] = '<strong class="hidden">'.get_sub_field('col_'.$ac).'</strong> ';
						$ac++;
				};
		};
			while($cc <= $colcount ) {
				if (strlen(get_sub_field('col_'.$cc) > 0)) { $data = get_sub_field('col_'.$cc); } else {  $data ='&nbsp;';};
				$row .= '<'.$cellstart.'>'.$titlearray['col_'.$cc].$data.'</'.$cellend.'>';
				$cc++;
			};
		
			$row .= '</tr>';
		
			$table .= $row;
			
			
			
	endwhile;

		if (strlen($tarea > 4)) {
				$table .= '</'.$tarea.'>';
			};
		$table .= '</table>';	

endif;

echo $table.'






</div>
<!---  End of Responsive Table -->
</section>'; 

?>
