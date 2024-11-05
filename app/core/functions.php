<?php 
defined('ROOTPATH') OR exit('Access Denied!');

/** check which php extensions are required **/
check_extensions();
function check_extensions()
{

	$required_extensions = [

		'gd',
		'mysqli',
		'pdo_mysql',
		'pdo_sqlite',
		'curl',
		'fileinfo',
		'intl',
		'exif',
		'mbstring',
	];

	$not_loaded = [];

	foreach ($required_extensions as $ext) {
		
		if(!extension_loaded($ext))
		{
			$not_loaded[] = $ext;
		}
	}

	if(!empty($not_loaded))
	{
		show("Please load the following extensions in your php.ini file: <br>".implode("<br>", $not_loaded));
		die;
	}
}


function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}

function redirect($path)
{
	header("Location: " . ROOT."/".$path);
	die;
}

/** load image. if not exist, load placeholder **/
function get_image(mixed $file = '',string $type = 'post'):string
{

	$file = $file ?? '';
	if(file_exists($file))
	{
		return ROOT . "/". $file;
	}

	if($type == 'user'){
		return ROOT."/assets/images/user.webp";
	}else{
		return ROOT."/assets/images/no_image.jpg";
	}

}


/** returns pagination links **/
function get_pagination_vars():array
{
	$vars = [];
	$vars['page'] 		= $_GET['page'] ?? 1;
	$vars['page'] 		= (int)$vars['page'];
	$vars['prev_page'] 	= $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
	$vars['next_page'] 	= $vars['page'] + 1;

	return $vars;
}
