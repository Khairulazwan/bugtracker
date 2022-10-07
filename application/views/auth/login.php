<?php $this->load->view('partials/_body_style'); ?>
<section class="sign-in-page">
	<div class="container p-0">
		<div class="row no-gutters">
			<div class="col-sm-12 align-self-center">
				<div class="sign-in-from bg-white">
					<div class="text-center">
						<img src="<?= base_url('assets/') ?>images/logo-full.png" alt="SS-Logo" width="250">
						<h3 class="mt-4"><strong>Bug Tracking System</strong></h3>
					</div>
					<hr>
					<?= $this->session->flashdata('message') ?>
					<form class="user" method="POST" action="<?= base_url('auth') ?>">
						<div class="form-group">
							<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Staff ID" value="<?= set_value('username') ?>">
							<?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" autocomplete="on">
							<?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<button type="submit" class="btn btn-primary btn-user btn-block">
							Sign In
						</button>
					</form>
					<hr>
					<a class="text-decoration-none guideButton" href="#" role="button">Click here for guide</a>
					<div style="margin-top:15px;"></div>
					<div class="text-center">
						<div class="small text-decoration-none">If you have any problems, fill free to contact me at 013-2309005 (Khairulazwan)</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('partials/_body_scripts'); ?>