<?= $this->extend("Layouts/default") ?>

<?= $this->section("title") ?>Home<?= $this->endSection() ?>

<?= $this->section("content") ?>

    <h1>Welcome</h1>

    <a href="<?= site_url("/signup")?>">Sign up</a>
    <a href="<?= site_url("/signup")?>">Login</a>

<?= $this->endSection() ?>