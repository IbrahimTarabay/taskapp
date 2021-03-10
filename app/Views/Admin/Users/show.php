<?= $this->extend("Layouts/default") ?>

<?= $this->section("title") ?>User<?= $this->endSection() ?>

<?= $this->section("content") ?>

  <h1>User</h1>

  <a href="<?=site_url("/admin/users") ?>">&laquo; back to users</a>

   <dl>
     <dt>Name</dt>
     <dd><?= esc($user->name) ?></dd>

     <dt>email</dt>
     <dd><?= esc($user->email) ?></dd>

     <dt>Created at</dt>
     <dd><?= $user->created_at ?></dd>

     <dt>Updated at</dt>
     <dd><?= $user->updated_at ?></dd>
   </dl>

   <a href="<?= site_url('/admin/users/edit/'.$user->id) ?>">Edit</a>
   <a href="<?= site_url('/admin/users/delete/'.$user->id) ?>">Delete</a>

<?= $this->endSection() ?>