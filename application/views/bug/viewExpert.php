<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Bug Report List</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <div class="flashUpdate" data-fupd="<?= $this->session->flashdata('updateData'); ?>"></div>

                        <?php if ($bugExpert) { ?>
                            <table id="tablePagination" class="table table-bordered table-hover text-gray-800" style="width:100%; font-size:14px">
                                <thead>
                                    <tr>
                                        <th style="width:2%">No</th>
                                        <th>Bug ID</th>
                                        <th>Reporter</th>
                                        <th>Description</th>
                                        <th>Date Report</th>
                                        <th>Date Assign</th>
                                        <th>Status</th>
                                        <th>Severity</th>
                                        <th style="width:12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($bugExpert as $bug) :
                                        if ($bug['progress'] != '3') : ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?= $bug['bug_no'] ?></td>
                                                <td><?= $bug['fullname'] ?></td>
                                                <td><?= $bug['bug_description'] ?></td>
                                                <td><?= $bug['create_date'] ?></td>
                                                <td><?= $bug['date_assign'] ?></td>
                                                <td class="text-center">
                                                    <?php if ($bug['progress'] == '0') : ?>
                                                        <span class="badge badge-pill badge-success">Open</span>
                                                    <?php elseif ($bug['progress'] == '1') : ?>
                                                        <span class="badge badge-pill badge-warning">In Progress</span>
                                                    <?php elseif ($bug['progress'] == '2') : ?>
                                                        <span class="badge badge-pill badge-info">To be tested</span>
                                                    <?php elseif ($bug['progress'] == '3') : ?>
                                                        <span class="badge badge-pill badge-dark">Closed</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-pill badge-danger">Error</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($bug['bug_type'] == '0') : ?>
                                                        <span class="badge badge-pill badge-success">Low</span>
                                                    <?php elseif ($bug['bug_type'] == '1') : ?>
                                                        <span class="badge badge-pill badge-warning">Medium</span>
                                                    <?php elseif ($bug['bug_type'] == '2') : ?>
                                                        <span class="badge badge-pill badge-danger">High</span>
                                                    <?php elseif ($bug['bug_type'] == '3') : ?>
                                                        <span class="badge badge-pill badge-dark">Showstopper</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" title="Edit Status" id="btn-doneModal" class="btn btn-info mb-3" data-toggle="modal" data-target="#doneModal" data-id="<?= $bug['b_id']; ?>"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" title="View" id="btn-viewModal" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#viewModal" data-id="<?= $bug['b_id']; ?>" data-no="<?= $bug['bug_no']; ?>" data-name="<?= $bug['fullname']; ?>" data-desc="<?= $bug['bug_description']; ?>" data-expt="<?= $bug['expertist']; ?>" data-prog="<?= $bug['progress']; ?>" data-type="<?= $bug['bug_type']; ?>" data-dtcre="<?= $bug['create_date']; ?>" data-dtcom="<?= $bug['date_complete']; ?>"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach; ?>
                                <?php } else {
                                echo "No data was found. You have not submitted any applications.";
                            }
                                ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="doneModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Update Bug Status</h5>
                <span aria-hidden="true"></span>
            </div>
            <form action="<?= base_url('bugcontroller/updateStatus/') ?>" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id" id="id" readonly>
                        <input type="hidden" name="date" id="date" value="<?= date('d/m/Y', time()) ?>" readonly>
                        <div class="form-group col-md-12">
                            <label for="progress">Progress:</label>
                            <select id="progress" name="progress" class="js-example-basic-single form-control">
                                <option value="1" selected disabled>In Progress</option>
                                <option value="2">To be tested</option>
                                <option value="3">Closed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="assignModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Assign User</h5>
                <span aria-hidden="true"></span>
            </div>
            <form action="<?= base_url('bugcontroller/assignUser/') ?>" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id" id="id" readonly>
                        <input type="hidden" name="date" id="date" value="<?= date('d/m/Y', time()) ?>" readonly>
                        <div class="form-group col-md-12">
                            <label for="expertist">Expertise:</label>
                            <select id="expertist" name="expertist" class="js-example-basic-single form-control">
                                <option value="" selected disabled>Choose..</option>
                                <option value="TONY STARK">TONY STARK (Network Engineer)</option>
                                <option value="STEVE ROGERS">STEVE ROGERS (Back End Developer)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="severity">Severity:</label>
                            <select id="severity" name="severity" class="js-example-basic-single form-control">
                                <option value="" selected disabled>Choose..</option>
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">Major</option>
                                <option value="3">Showstopper</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Bug Details</h5>
                <span aria-hidden="true"></span>
            </div>
            <div class="modal-body">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-card text-left">
                        <div class="row">
                            <input type="hidden" class="form-control" name="id" id="id" />
                            <div class="form-group col-md-6">
                                <label for="name">Fullname</label>
                                <input type="text" class="form-control" name="name" id="name" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="desc">Bug Description</label>
                                <input type="text" class="form-control" name="desc" id="desc" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="no">Bug ID</label>
                                <input type="text" class="form-control" name="no" id="no" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="stat">Assign To</label>
                                <input type="text" class="form-control" name="expt" id="expt" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prog">Status</label>
                                <input type="text" class="form-control" name="prog" id="prog" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="type">Severity</label>
                                <input type="text" class="form-control" name="type" id="type" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dtcre">Date Created</label>
                                <input type="text" class="form-control" name="dtcre" id="dtcre" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dtcom">Date Complete</label>
                                <input type="text" class="form-control" name="dtcom" id="dtcom" readonly />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>