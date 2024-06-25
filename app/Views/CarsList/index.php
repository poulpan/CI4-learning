<!--
    Instead of including multiple views like in Home Controller, we can include the header file like so.
    Still not a great method though, as we'll need to remember to include repeated files in every page we make.
    (&gt-&lt added to make it a comment)
-->
<!-- &gt;?= // $this->include('header') ?&lt; -->
<!--
    It's better to use View Layouts (ci4 documentation)
-->

<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Cars List<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Cars List</h1>

<p><a href="<?= url_to('CarsList::new') ?>">Add a new Car Record</a></p>
<!-- we can't use the renamed route anymore cause of the use of resource method in the routes -->
<!-- <p><a href="&gt?= url_to('new_carslist') ?>">Add a new Car Record</a></p> -->

<table>
    <thead><tr><th>#</th><th>Brand</th><th>Model</th><th>Color</th><th>Year</th></tr></thead>
    <?php foreach ($carslist as $cars): ?>

        <!--
        Instead of hardcoding the href link like href="/carslist/&gt?= $cars['cl_id'] ?>", we can use URL Helper documentation to be more portable between enviroments.
        Note: when we use the URL Helper method, the link in the browser will still work but it will also display the index.php/carslist/cl_id, so if we want the index.php not to beshown (as we are using pretty URLs) we need to change in the app/App.php file, the $indexPage property to an empty string.
        -->
        <tbody><th><a href="<?= site_url('carslist/' . $cars->cl_id) ?>"><?= $cars->cl_id ?></a></th><td><?= esc($cars->cl_brand) ?></td><td><?= esc($cars->cl_model) ?></td><td><?= esc($cars->cl_color) ?></td><td><?= esc($cars->cl_year) ?></td></tbody>

    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>


<!-- </body>
</html> -->