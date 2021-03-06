<?php
if(!function_exists('l')){
	function l($text){
		return $text;
	}
}
?>
<!-- 破!"' --></a></li></ul></button></div></pre></code>
<html lang=cn>
	<div id="xiaolin_huaQ">
		<!--
		不要问我上面这个“huaQ”怎么这么怪。
		事实上，我也不想让她这么怪。
		但是 set_error_handler 扑捉到的错误信息，并不能屏蔽之前输出的东西。
		为了让页面不那么猎奇，我只好在这里“huaQ”一下了 _(:з」∠)_
		-->
		<head>
			<title><?=$title; ?></title>
			<META http-equiv="content-type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
			<!--<style><?php include(xiaolin . 'Template/style.css'); ?></style>-->
			<link href="/xiaolin/Template/style.css" rel="stylesheet" >
		</head>
		
		<body class="<?=isset($errorInfo) ? 'xiaolin_exception' : ''; ?>">
			<?php if(!isset($showTips) || $showTips){ ?>
			<div class="xiaolin_info">
				<div class="xiaolin_info_img xiaolin_info_img_<?=$type; ?>">
				</div>
				<div class="xiaolin_info_code">
					<p><span><?=$code; ?></span></p>
					<p style="color:<?=$color?>;"><?=$info; ?></p>
				</div>
				<div class="xiaolin_info_text">
					<p><?=$moreTitle; ?></p>
					<div class="xiaolin_info_text_list">
						<ul>
							<?php foreach($more as $row){ ?>
							<li><?=$row; ?></li>
							<?php } ?>
						</ul>
					</div>
					<?php foreach($buttons ?: [] as $index => $button){ ?>
					<a href="<?=$button['href'];?>" target="<?=isset($button['target']) ? $button['target'] : '_self';?>">
						<button class="<?=$button['type'];?>"><?=$button['title'];?></button>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			
			<?php if(isset($errorInfo)){ extract($errorInfo); include(xiaolin . 'Template/exception.php'); } ?>
			
			<?php if($autoJump && $autoJump['sec'] > 0){ ?>
			<div class="xiaolin_info xiaolin_powered">
				<?=l('%s 秒后将为您自动跳转...', '<span id="sec"></span>'); ?>
				<span id="xiaolin_nowJump"><?=l('[现在跳转]'); ?></span>
				<span id="xiaolin_noJump"><?=l('[雅蠛蝶！等等]'); ?></span>
			</div>
			<script>
			url = "<?=$autoJump['url']?>";
			sec = "<?=$autoJump['sec']?>";
			window.onload = function() {
				Jump = function() {
					if (sec <= 0) {
						if(url == '-1'){
							history.go(-1);
						}else{
							window.location.href = url;
						}
					}
					document.getElementById("sec").innerHTML = sec;
					sec--;
				};
				JumpInterval = setInterval(Jump, 1000);
				
				document.getElementById("xiaolin_noJump").onclick = function() {
					sec = "TheWorld!!! ";
					clearInterval(JumpInterval);
					Jump();
					document.getElementById("xiaolin_noJump").style.display = "none"
				};
				
				document.getElementById("xiaolin_nowJump").onclick = function() {
					document.getElementById("xiaolin_noJump").style.display = "none";
					sec = 0;
					Jump()
				};
				
				Jump()
			};
			</script>
			<?php } ?>
			<div class="xiaolin_info xiaolin_powered">
				Powered By <a target="_blank" href="https://blog.test404.club//">XiaoLin<sup><?=xiaolin_version_name; ?></sup></a>
			</div>
		</body>
	</div>
	<script>
	document.head.innerHTML = '';
	document.body.innerHTML = document.getElementById('xiaolin_huaQ').innerHTML;
	</script>
</html>