<?php
	$version  = 'v1.5.130425';
	$sitename = 'Traktorverseny Nagyszokoly 2014';
	$title    = 'Galéria';

	error_reporting(E_ERROR);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title><?php echo($sitename); ?> &bull; <?php echo($title); ?></title>
		<link rel="shortcut icon" href="bin/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="bin/style.css" />
		<link rel="stylesheet" type="text/css" href="bin/font/SegoeUI.css" />
		<link rel="stylesheet" type="text/css" href="bin/lightbox/lightbox.css" />
		<script src="bin/lightbox/jquery-1.7.2.min.js"></script>
		<script src="bin/lightbox/lightbox.js"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h2><?php echo($sitename); ?></h2>
				<h1><?php echo($title); ?></h1>
			</div>
			<?php
				$filetypes  = array(".png", ".PNG", ".jpg", ".JPG", ".jpeg", ".JPEG", ".gif", ".GIF");
				$basedir    = './galleries';
				$currentdir = '';
				if(isset($_GET['f']) ? $_GET['f'] : '')
					{
					$currentdir = '/'.$_GET['f'].'/';
					}

				function scandirSorted($path)
					{
					$sortedData  = array();
					$data1       = array();
					$data2       = array();
					foreach(scandir($path) as $file)
						{
						if(!strstr($path, '..'))
							{
							if(is_file($path.$file))
								{
								array_push($data2, $file);
								}
							else
								{
								array_push($data1, $file);
								}
							}
						}
					$sortedData = array_merge($data1, $data2);
					return $sortedData;
					}

				function strpos_arr($haystack, $needle)
					{
					if(!is_array($needle))
						{
						$needle = array($needle);
						}
					foreach($needle as $what)
						{
						if(($pos = strpos($haystack, $what)) !== false)
							{
							return $pos;
							}
						}
					return false;
					}

				function addThumb($filename)
					{
					$filename    = array_reverse(explode('.', $filename));
					$filename[0] = 'smpgthumb.'.$filename[0];
					$filename    = implode('.', array_reverse($filename));
					return $filename;
					}

				if(is_dir($basedir.$currentdir))
					{
					$folder = array_diff(scandirSorted($basedir.$currentdir), array('..', '.', 'Thumbs.db', 'thumbs.db', '.DS_Store'));
					}

				$navigation = explode('/', $currentdir);
				$navigation_elements = count($navigation);
				if(isset($_GET['f']))
					{
					echo('<div id="navigation"><a href="./">Home</a>');
					}
				foreach($navigation as $element)
					{
					if($element)
						{
						echo(' / <a href="?f='.str_replace('//', '/', str_replace(' ', '%20', substr($currentdir, 0, strpos($currentdir, $element)+strlen($element)))).'">'.$element.'</a>');
						}
					}
				if(isset($_GET['f']))
					{
					echo('</div>');
					}

				echo('<div id="content">');
				foreach($folder as $item)
					{
					if(!strstr(isset($_GET['f']), '..'))
						{
						if(!strstr($item, 'smpgthumb'))
							{
							if(strpos_arr($item, $filetypes))
								{
								if(file_exists($basedir.$currentdir.'/'.addThumb($item)))
									{
									echo('<a href="'.str_replace('//', '/', str_replace(' ', '%20', $basedir.$currentdir.'/'.$item)).'" rel="friend"><img src="'.str_replace('//', '/', str_replace(' ', '%20', $basedir.$currentdir.'/'.addThumb($item))).'" class="img" alt="" /></a> ');
									}
								else
									{
									echo('<a href="'.str_replace('//', '/', str_replace(' ', '%20', $basedir.$currentdir.'/'.$item)).'" rel="friend"><img src="bin/thumb.php?file='.str_replace('//', '/', str_replace(' ', '%20', $basedir.$currentdir.'/'.$item)).'" class="img" alt="" /></a> ');
									}
								}
							else
								{
								echo('<a href="?f='.str_replace('//', '/', str_replace(' ', '%20', $currentdir.'/'.$item)).'">'.$item.'</a><br>');
								}
							}
						}
					}
				echo('</div>');
			?>
		</div>
		<span id="copy" title="Copyright &copy; 2012 WindowsWiki &bull; <?php echo($version); ?>">&copy;</span>
	</body>
</html>