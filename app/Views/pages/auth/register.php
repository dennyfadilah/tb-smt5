<?= $this->extend('layouts/main') ?>

<?= $this->section('auth') ?>
<div class="card mt-5">
  <div class="card-body">
    <a href="#" class="d-flex justify-content-center mt-3">
      <img src="../assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo">
    </a>
    <div class="row">
      <div class="d-flex justify-content-center">
        <div class="auth-header">
          <h2 class="text-secondary mt-3"><b>Register</b></h2>
          <p class="f-16 mt-2">Enter your credentials to continue</p>
        </div>
      </div>
    </div>
    <h5 class="my-3 d-flex justify-content-center">Register with Email address</h5>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" placeholder="Fullname">
      <label for="floatingInput">Fullname</label>
    </div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" id="floatingInput2" placeholder="Email Address">
      <label for="floatingInput2">Email Address</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingInput3" placeholder="Password">
      <label for="floatingInput3">Password</label>
    </div>

    <div class="d-grid mt-4">
      <button type="button" class="btn btn-secondary p-2">Register</button>
    </div>
    <hr>
    <h5 class="d-flex gap-1 justify-content-center">
      Already have an account?
      <a href="<?= site_url('auth/login') ?>">Login</a>
    </h5>
  </div>
</div>
<?= $this->endSection() ?>