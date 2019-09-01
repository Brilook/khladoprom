<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once($_SERVER['DOCUMENT_ROOT']."/php/dBug.php"); 

	function loaddb($filename, $category) {
		if(!file_exists($filename)) {
			if(!touch($filename))
				die('error create data file');
		}
		$_SESSION['c'.$category] = array();
		switch($category) {
			case '10': // load about page content
				$fh = fopen($filename, 'r');
				$d = fread($fh, filesize($filename));
				fclose($fh);
				$_SESSION['c'.$category][] = stripslashes($d);
				break;
			case '-1': // load global settings
				$lines = file($filename);
				$_SESSION['global'] = array();
				for($i = 0; $i < count($lines); $i++) {
					$linefields = explode("=",$lines[$i]);
					$_SESSION['global'][$linefields[0]] = $linefields[1];
				}
				break;
		default:	
			$lines = file($filename);
			for($i = 0; $i < count($lines); $i++) {
				$linefields = explode("|",$lines[$i]);
				$l = array();
				$l['a1'] = $linefields[0];
				$l['a2'] = $linefields[1];
				$l['title'] = $linefields[2];
				$l['price'] = $linefields[3];
				$l['text'] = $linefields[4];
				$l['photos'] = array();
				for($j = 5; isset($linefields[$j]); $j++)
					$l['photos'][] = $linefields[$j];
				if(!isset($l['photos'][0])) $l['photos'][0] = "nofoto.gif";
				$_SESSION['c'.$category][] = $l;
			}
		}
	}
	
	function savedb($filename, $category) {
		if(!file_exists($filename)) {
			if(!touch($filename))
				die('error create data file');
		}
		if((!(isset($_SESSION['c'.$category])) || (!(isset($_SESSION['global']))))) die('save db error!');
		switch($category) {
			case '10': // load about page content
				$fp = fopen($filename, "a");
				ftruncate($fp, 0);
				$test = fwrite($fp, $_SESSION['c'.$category][0]); // Запись в файл
				if(!$test) die('error write 10.db file');
				fclose($fp);
				break;
			case '-1': // save global settings
				$fp = fopen($filename, 'a');
				ftruncate($fp, 0);
				foreach($_SESSION['global'] as $key => $val) {
					$par = array();
					$par[] = $key;
					$par[] = $val;
					$l = implode("=", $par);
					$l = $l."\n";
					fputs($fp, $l);
					unset($par);
				}
				fclose($fp);
				break;
		default:	
				$fp = fopen($filename, 'a');
				ftruncate($fp, 0);
				foreach($_SESSION['c'.$category] as $rec) {
					$photo = array();
					$photo = $rec['photos'];
					unset($rec['photos']);
					if(count($photo) > 0 && $photo[0] != "nofoto.gif") {
						$ph = '|'.implode("|", mb_trim($photo));
						$line = implode("|", $rec).$ph;
					} else {
						$line = implode("|", $rec);
					}
					$line = mb_trim($line)."\n";
					fputs($fp, $line);
					unset($photo);
				}
				fclose($fp);
		}
	}
	
	function setposdb($filename, $category, $oldpos, $newpos)
	{
		if($category == '10' || $category == '-1') return;
		$rec = $_SESSION['c'.$category][$oldpos];
		$newarr = array();
		for($i = 0; $i < count($_SESSION['c'.$category]); $i++) {
			if($i == $newpos)
				$newarr[] = $rec;
			if($i == $oldpos)
				continue;
			$newarr[] = $_SESSION['c'.$category][$i];
		}
		$_SESSION['c'.$category] = $newarr;
		savedb($filename, $category);
	}

	function delrecdb($filename, $category, $pos)
	{
		if($category == '10' || $category == '-1') return;
		$rec = $_SESSION['c'.$category][$pos];
		$newarr = array();
		$photos = array();
		for($i = 0; $i < count($_SESSION['c'.$category]); $i++) {
			if($i == $pos) {
				$photos = $_SESSION['c'.$category][$i]['photos'];
				continue;
			}
			$newarr[] = $_SESSION['c'.$category][$i];
		}
		$_SESSION['c'.$category] = $newarr;
		savedb($filename, $category);
		// return photo array for delete
		return $photos;
	}

	function getPagerData($numHits, $limit, $page) {
		$numHits = (int) $numHits;
		$limit = max((int) $limit, 1);
		$page = (int) $page;
		$numPages = ceil($numHits / $limit);
		
		$page = max($page, 1);
		$page = min($page, $numPages);
		
		$offset = ($page - 1) * $limit;
		
		$ret = array();
			
		$ret['offset'] = $offset;
		$ret['limit'] = $limit;
		$ret['numPages'] = $numPages;
		$ret['page'] = $page;
		return $ret;
	}
	
	function getCatName($category)
	{
		$ret = "";
		switch($category) {
			case 0:
				$ret = "Акции";
				break;
			case 1:
				$ret = "Мягкая мебель";
				break;
			case 2:
				$ret = "Спальни";
				break;
			case 3:
				$ret = "Мебель из кожи";
				break;
			case 4:
				$ret = "Детская мебель";
				break;
			case 5:
				$ret = "Матрасы";
				break;
			case 6:
				$ret = "Корпусная мебель";
				break;
			case 7:
				$ret = "Аксессуары";
				break;
			case 8:
				$ret = "Столы";
				break;
			case 9:
				$ret = "Новинки";
				break;
			case 10:
				$ret = "О компании";
				break;
			case 11:
				$ret = "Контакты";
				break;
		}
		return $ret;
	}
?>