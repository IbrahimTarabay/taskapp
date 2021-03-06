<?= $this->extend("Layouts/default") ?>

<?= $this->section("title") ?>Edit Task<?= $this->endSection() ?>

<?= $this->section("content") ?>
  <h1 class="title">Edit Task</h1>

  <?php if(session()->has('errors')): ?>
    <ul>
      <?php foreach(session('errors') as $error): ?>
         <li><?= $error ?></li>
         <?php endforeach; ?>
    </ul>
   <?php endif ?>
<?= form_open("/tasks/update/".$task->id) ?>

  <?= $this->include('Tasks/form') ?>

 <button class="button is-primary">Save</button>
 <a class="button" href="<?= site_url("/tasks/show/".$task->id) ?>">Cancel</a>
</form>

<?= $this->endSection() ?>