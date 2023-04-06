<?= $this->extend('Layouts/baseLayout') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <div class="block">
            <div class="form-group mt-t mb-4">
                <input type="submit" id="btnsave" value="save" class="btn btn-danger mr-2">
                <a href="<?php echo site_url("users/show/$user->id") ?>" class="btn btn-outline-secondary ml-2">Previous</a>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection('') ?>