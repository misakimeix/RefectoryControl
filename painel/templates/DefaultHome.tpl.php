<?php
	$this->assign('title','REFECONTROL | Home');
	$this->assign('nav','home');

	$this->display('_Header.tpl.php');
?>

<div class="container">
	<img src="images/ifpilogo.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
</div>


<?php
	$this->display('_Footer.tpl.php');
?>
