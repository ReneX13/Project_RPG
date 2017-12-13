<!DOCTYPE html>
<?php
	include "Display_Functions.php";
?>
<html>
	<script>
	</script>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Database Project</title>
		<link rel="stylesheet" href="search_page_style.css">
	</head>
		<body>
			<header>
					Project_RPG
			</header>
			<div class="page-wrap">
				<nav id = 'nav1'>
					<div id='div1' ><?php echo Display($_GET['List'], $_GET['Search']); ?></div>
				</nav>
			</div>
			<footer class="site-footer">
				Project_RPG
			</footer>
		</body>
</html>