<!DOCTYPE html>
<html>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
	<meta charset="utf-8">
	<title> Error </title>
  <link rel="icon" type="image/png" href="<?php echo base_url('./assets/image/undip-original.png'); ?>">
  <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('./assets/template/AtlantisLite/assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/404/'); ?>css/style.css"/>

</head>
<body>
	<div id="container" class="container">
		<ul id="scene" class="scene">
			<li class="layer" data-depth="1.00"><img src="<?php echo base_url('./assets/template/404/'); ?>images/404-01.png"></li>
			<li class="layer" data-depth="0.60"><img src="<?php echo base_url('./assets/template/404/'); ?>images/shadows-01.png"></li>
			<li class="layer" data-depth="0.20"><img src="<?php echo base_url('./assets/template/404/'); ?>images/monster-01.png"></li>
			<li class="layer" data-depth="0.40"><img src="<?php echo base_url('./assets/template/404/'); ?>images/text-01.png"></li>
			<li class="layer" data-depth="0.10"><img src="<?php echo base_url('./assets/template/404/'); ?>images/monster-eyes-01.png"></li>
		</ul>
		<h1>Halaman yang anda masukan tidak tersedia atau dalam sedang tahap pengembangan</h1>
    <button type="button" class="btn btn-purple" onclick="back()"> Kembali </button>
	</div>

</body>
<!-- Scripts -->
<script src="<?php echo base_url('./assets/template/404/'); ?>js/parallax.js"></script>
<script>
var scene = document.getElementById('scene');
var parallax = new Parallax(scene);
</script>
<script type="text/javascript">
  function back(){
    window.history.back();
  }
</script>

</html>
