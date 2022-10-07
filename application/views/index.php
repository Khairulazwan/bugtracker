<?php include 'partials/_body_style.php'; ?>
<?php
$data['fullname'] = $this->session->userdata('fullname');
$data['designation'] = $this->session->userdata('designation');
$data['lvl_access'] = $this->session->userdata('lvl_access');
?>

<body class="header-top-bg">
	<div id="loading">
	</div>
	<div id="wrapper" class="wrapper">
		<?php if ($data['lvl_access'] == 'USER') : ?>
			<?php include 'partials/sidebar.php' ?>
		<?php elseif ($data['lvl_access'] == 'EXPERT') : ?>
			<?php include 'partials/sidebarExpert.php' ?>
		<?php elseif ($data['lvl_access'] == 'ADMIN') : ?>
			<?php include 'partials/sidebarAdmin.php' ?>
		<?php endif; ?>
		<?php include 'partials/header.php'; ?>
		<div class="content-page" id="content-page">
			<?php include $page_name . '.php' ?>
		</div>
	</div>
	<?php include 'partials/footer.php'; ?>
	<?php include 'partials/_body_scripts.php'; ?>
	<?php include 'partials/_dynamic_script.php'; ?>