<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Bug Reporting Form</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <form action="" method="POST" autocomplete="off">
                        <div class="form-card text-left">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="reporter">Reporter:</label>
                                    <input type="text" class="form-control" name="reporter" value="<?= $userInfo['fullname'] ?>" readonly />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="designation">Designation:</label>
                                    <input type="text" class="form-control" name="designation" value="<?= $userInfo['designation'] ?>" readonly />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="rep_date">Report Date:</label>
                                    <input type="text" class="form-control" name="rep_date" value="<?= date('d/m/Y', time()) ?>" readonly />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="bug_desc">Bug Description:</label>
                                    <textarea type="text" class="form-control" name="bug_desc" maxlength="500"></textarea>
                                    <p><small>The description must not exceed more than 500 characters.</small></p>
                                    <?= form_error('bug_desc', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                            </div>
                            <div style="margin-top:30px;"></div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <span class="icon text-white-80">
                                        <i class="fa fa-save fa-lg"></i>
                                    </span>
                                    <span class="text">Submit</span>
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>