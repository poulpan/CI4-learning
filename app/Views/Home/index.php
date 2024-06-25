<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Home<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <h1>Welcome</h1>
    <p>View Car List <a href="<?= url_to('CarsList::index') ?>">here</a></p>
<?= $this->endSection() ?>

<!-- </body>
</html> -->