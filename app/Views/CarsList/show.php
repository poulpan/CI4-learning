<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Car Record<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Car Record</h1>

<table>
    <thead><tr><th>Brand</th><th>Model</th><th>Color</th><th>Year</th></tr></thead>
    <tbody><td><?= esc($record->cl_brand) ?></td><td><?= esc($record->cl_model) ?></td><td><?= esc($record->cl_color) ?></td><td><?= esc($record->cl_year) ?></td></tbody>
</table>
<p><a href="<?= url_to('CarsList::edit', $record->cl_id) ?>"><button style="background-color: blue; color: whitesmoke;">Edit</button></a>&emsp;<a href="<?= url_to('CarsList::confirmDelete', $record->cl_id) ?>"><button style="background-color: red; color: whitesmoke;">Delete</button></a></p>

<p><a href="<?= url_to('CarsList::index') ?>"><button>Go Back</button></a></p>

<?= $this->endSection() ?>