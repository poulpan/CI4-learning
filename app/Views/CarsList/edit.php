<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Car Record<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit Car Record</h1>

<!-- presenting the error messages we might get and are temporarily stored in the session -->
<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- <form action="" method="post"> -->
<!--
Instead of hardcoding the opening form tag and for the same reason we've used URL Helpers, we could also use ci4 Form Helpers for the action to be dynamic in case we change enviroment or folders. In contrast to the URL Helpers that load automatically, for the Form Helpers we need to load them explicity and to be able to use it for all Controllers that extend of BaseController, we need to add it in the $helpers array inside the BaseController.
-->

<!-- &gt?= form_open('carslist/update/' . $record->cl_id) ?> -->
<!-- removed /update above, cause of the change as a restfull route -->
<?= form_open('carslist/' . $record->cl_id) ?>
    <!-- also need to spoof the Http method patch -->
    <input type="hidden" name="_method" value="PATCH">

    <!-- we made another file to contain our form (form.php) so we can use it in both here (edit.php) and in new.php files. -->
    <?= $this->include('CarsList/form') ?>
</form>

<p><a href="<?= url_to('CarsList::index') ?>"><button>Go Back</button></a></p>

<?= $this->endSection() ?>