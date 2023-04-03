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
            <hr class="border-secondary">
            <h5 class="card-title mt-2"><?php echo esc($user->name); ?></h5>
            <p class="card-text">Email : <?php echo esc($user->email); ?></p>
            <p class="card-text">Add in : <?php echo esc($user->created_at); ?></p>
            <p class="card-text">Updated in :<?php echo esc($user->updated_at); ?></p>
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo site_url("users/edituser/$user->id") ?>">Edit user</a></li>
                    <!-- <li><a class="dropdown-item" href="<?php echo site_url("users/deletuser/$user->id") ?>">Delete user</a></li> -->
                </ul>
            </div>

            <a href="<?php echo site_url("users") ?>" class="btn btn-outline-secondary ml-2">Previous</a>


        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $title; ?>
<?= $this->endSection('') ?>