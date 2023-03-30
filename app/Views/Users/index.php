<?= $this->extend('Layouts/baseLayout') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/b-2.3.6/r-2.4.1/datatables.min.css" rel="stylesheet" />

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <div class="title"><strong>Compact Table</strong></div>
            <div class="table-responsive">
                <table id='ajaxTable' class="table table-striped table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/b-2.3.6/r-2.4.1/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#ajaxTable').DataTable({
            ajax: '<?php echo site_url('users/getusers'); ?>',
            columns: [{
                    data: 'img'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'active'
                },
            ],
        });
    });
</script>

<?= $this->endSection('') ?>