<?php 

if(!function_exists('tx_view')){
	function tx_view($file, $data=[]){
		// print_r($data); die();	
		extract($data);

		ob_start();
			require $file;
			$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}