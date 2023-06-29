<?php
/*
Block Name: Responsive Tables
Block Description: Tables
Post Types: post, page, custom-type
Block SVG: alien-solid.svg
Block Category: ********
*/
$blockclass = 'tableblock';
/* --------------------------------------------------------------------------- */


$className = ! empty( $block['className'] ) ? $block['className'].' ' : '';
$anchor = '';

echo '<section '.$anchor.' class="'.$blockclass .'">	



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
			$rowclass = $row = $hod = $hom = $extrarowclass ='';
			$hidcheck = 0;
			$prevcol = 0;
			
		if (strlen(get_sub_field('row_class') )) { $extrarowclass = get_sub_field('row_class'); $hidcheck++; };
			
		if ( !get_sub_field('hide_on_desktop') ) {  $hod = ''; } else {  $hod = 'hideondesktop'; $hidcheck++; };	
			
		if ( !get_sub_field('hide_on_mobile') ) {  $hom = ''; } else {  $hom = 'hideonmobile'; $hidcheck++; };		
		
		$classescreated = trim($extrarowclass.' '.$hod.' '.$hom);
		
		
		if  ($hidcheck > 0) {
			$rowclass = ' class="'.$classescreated.'"';
		}
			
		if ( !get_sub_field('header_row') ) { 
			$tarea = 'tbody';
			$tend = 'tbody';
			$cell = 'td'; 
			$int = 1;
		} else { 
				$tarea = 'thead class="desktop"';
				$tend =  'thead';
				$cellextra = ' scope="col"'; 
				$cell = 'th'; 
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
			
			
			
			
			if ( get_sub_field('mobile_title') ) {  $ac = 1; while($ac <= $colcount ) { $titlearray['col_'.$ac] = '<strong class="hidden">'.get_sub_field('col_'.$ac).'</strong> '; $ac++; }; };
			
			
			
			while($cc <= $colcount ) {
				
				$next = $cc+1;				
				
				//cell content
			
				
				if ($cell === 'th') {
					
					if (strlen(get_sub_field('col_'.$cc) > 0)) { $currentdata = get_sub_field('col_'.$cc); } else {  $currentdata ='&nbsp;';};
					
					
					if ($cc > 1) { // Not first Cell
						
						if (strlen( $currentdata > 0)) {
								if ($next <= $colcount) {
									
									
									if (strlen(get_sub_field('col_'.$next) > 0)) { 
										$colspan='';
									} else {  
										$colspan=' colspan="2"';
									};
									
								
									
									
								} else { 
								
									$colspan=""; 
								};
								
								$celloutput =  '<th'.$colspan.'>'.$currentdata.'</th>';
						} else {
							$celloutput ='';
						}
					} else {
						
						// is the first cell
						$colspan = '';
						$celloutput =  '<th'.$colspan.'>'.$currentdata.'</th>';
					};
					
					
					
					
					
				} else {
					// Normal Cell
						if (strlen(get_sub_field('col_'.$cc) > 0)) { $currentdata = get_sub_field('col_'.$cc); } else {  $currentdata ='&nbsp;';};
						$celloutput =  '<td>'.$titlearray['col_'.$cc].$currentdata.'</td>';
					// Normal Cell
				};

				
				$row .= $celloutput;
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

</section>'; 

?>
