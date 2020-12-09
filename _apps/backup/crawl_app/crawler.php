<?php

	include('simple_html_dom.php'); 
	$context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 OPR/57.0.3098.106')));
	$html    = file_get_html('https://www.wego.co.id/jadwal/search?departure_code=BPN&arrival_code=CGK', false, $context);

	foreach($html->find('div[class=schedules-body]') as $e)
    echo $e->innertext . '<br>';
	

?>