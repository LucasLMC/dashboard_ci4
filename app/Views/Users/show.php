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
            <p class="card-text">Add in : <?php echo esc($user->created_at->humanize()); ?></p>
            <p class="card-text">Updated in :<?php echo esc($user->updated_at->humanize()); ?></p>
            <!-- Example single danger button -->
            <button type="button" href="<?php echo site_url("users/edit/$user->id") ?>" class="btn btn-danger">
                Edit User
            </button>
            <button type="button" href="<?php echo site_url("users/deletuser/$user->id") ?>" class="btn btn-danger">
                Delete User
            </button>
            <a href="<?php echo site_url("users") ?>" class="btn btn-outline-secondary ml-2">Previous</a>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<?= $this->endSection('') ?>