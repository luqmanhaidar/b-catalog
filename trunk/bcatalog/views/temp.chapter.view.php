<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/chapters.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/js-dvd.css" />
	<title><?php echo $title?> | курс по jQuery</title>
	</head>

	<!--[if gt IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/ie.css" />
	<![endif]-->

	<body>
		<br /><br /><br /><br />
		<div id="wrapper-div">

	    	<p class="chapter"><?php echo "Глава ".$index.": ".$title?></p>
	        <img style="margin-left:100px; margin-bottom:45px;" alt="<?php echo $title; ?>" src="<?php echo $thumbnail_url; ?>" />

	        <div class="chapter-descr">
				<?php 
					if($parts){
						foreach($parts as $part){
							renderView("lessons.view.php",array("lessons_title" => "Часть ".$part["index"].": ".$part["title"], "chapter_index" => $index, "lessons" => array_slice($lessons, $part["start_index"]-1, $part["length"])),true);
						}
					}
					else{
						renderView("lessons.view.php",array("lessons_title" => "Список уроков: ", "chapter_index" => $index, "lessons" => $lessons));
					}
				?>

	            <div class="chapter-descr" style="margin-left: 100px; text-align:left;">
	            	&larr;&nbsp;<a href="<?php echo BASE_URL.'contents/'; ?>">Вернуться к описанию разделов</a>
	                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                <a href="<?php echo $source_files_url; ?>">Скачать файлы упражнений</a> 
	                <br />
	                <br />
	            </div>
	        </div>   
	 
	        <?php require_once(VIEW_PATH.'/adv-block.view.php'); ?>   
		</div>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/rows.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/analytics.js"></script>
	</body>
	</html>