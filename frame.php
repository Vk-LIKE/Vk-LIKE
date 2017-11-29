<?
	$list = array(
		array(
			"#",
			"Рекламное место свободно (100р. месяц)",
			"Понравилось 4 345 людям"
		),
		array(
			"#",
			"Рекламное место свободно (100р. месяц)",
			"Понравилось 5 765 людям"
                ),
		array(
			"#",
			"Рекламное место свободно (100р. месяц)",
			"Понравилось 1 337 людям"
                ),
	);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link rel="shortcut icon" href="//vk.com/images/icons/favicons/fav_logo.ico?5" />
		<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="robots" content="noindex, nofollow" />
		<title>ВКонтакте | Recommended Widget</title>
		<link rel="stylesheet" type="text/css" href="//vk.com/css/al/fonts_cnt.css?2696088870" />
		<link rel="stylesheet" type="text/css" href="//vk.com/css/al/lite.css?1272757916" />
		<link rel="stylesheet" type="text/css" href="//vk.com/css/al/widget_recommended.css?1638826962"></link>
		<base target="_blank"/>
	</head>
	<body class="is_rtl VK1 font_medium widget_body">
		<div id="system_msg" class="fixed"></div>
		<div id="utils"></div>
		<div id="box_layer_bg" class="fixed"></div>
		<div id="box_layer_wrap" class="scroll_fix_wrap fixed">
			<div id="box_layer">
				<div id="box_loader">
					<div class="pr pr_baw pr_medium" id="box_loader_pr">
						<div class="pr_bt"></div>
						<div class="pr_bt"></div>
						<div class="pr_bt"></div>
					</div>
					<div class="back"></div>
				</div>
			</div>
		</div>
		<div id="stl_left"></div>
		<div id="stl_side"></div>
	</div>
	<a id="widget_focus_link" href="javascript: return;"></a>
	<div id="page_wrap">
		<div id="wrecommended_page" class="wrecommended_page">
			<div class="wrecommended_head clear_fix">
				<a class="wrecommended_logo" href="//vk.com"></a>
				Рекомендации VK LIKE
			</div>
			<div class="wrecommended_wrap">
				<div class="_wrecommended_content">
<?
	for($i=0;$i<count($list);$i++){
?>
					<div class="wrecommended_item">
						<div class="wrecommended_title">
							<a href="<?=$list[$i][0];?>" target="_parent"><?=$list[$i][1];?></a>
						</div>
						<div class="wrecommended_stats"><?=$list[$i][2];?></div>
					</div>
<?
	}
?>
				</div>
			</div>
		</div>
	</div>
	<div class="progress" id="global_prg"></div>
</body>
</html>