<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Delete Car Record<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Delete Car Record</h1>

<p>Are you sure?</p>

<!-- &gt?= form_open('carslist/delete/' . $record->cl_id) ?> -->
<!-- removed /delete above, cause of the change as a restfull route -->
<?= form_open('carslist/' . $record->cl_id) ?>
    <!-- also need to spoof the Http method patch -->
    <input type="hidden" name="_method" value="DELETE">
    <button style="background-color: red; color: whitesmoke;">Yes</button>
</form>

<p><a href="<?= url_to('CarsList::index') ?>"><button>Go Back</button></a></p>

<?= $this->endSection() ?>