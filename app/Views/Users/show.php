<?= $this->extend('Layouts/baseLayout') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-4">
        <div class="block">
            <div class="text-center">
                <?php if ($user->img_user == null) : ?>

                    <img src="<?php echo site_url('resources/img/user_without_img.png') ?>" class="card-img-top" style="width: 90% ;" alt=" user without image"></img>

                <?php else :  ?>

                    <img src="<?php echo site_url("users/img/$user->img_user") ?>" class="card-img-top" style="width: 90% ;" alt="<?php echo esc($user->name); ?>"></img>

                <?php endif; ?>
                <a href="<?php echo site_url("users/editimg/$user->id") ?>" class="btn btn-outline-primary btn-sm mt-3">Change Image</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $title; ?>
<?= $this->endSection('') ?>