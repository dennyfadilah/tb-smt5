<?= $this->extend('layouts/main') ?>

<?= $this->section('auth') ?>
<div class="card my-5">
  <div class="card-body">
    <a href="#" class="d-flex justify-content-center">
      <img src="../assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo">
    </a>
    <div class="row">
      <div class="d-flex justify-content-center">
        <div class="auth-header">
          <h2 class="text-secondary mt-3"><b>Hi, Welcome Back</b></h2>
          <p class="f-16 mt-2">Enter your credentials to continue</p>
        </div>
      </div>
    </div>

    <h5 class="my-3 d-flex justify-content-center">Login with Email address</h5>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" id="floatingInput" placeholder="Email address">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingInput1" placeholder="Password">
      <label for="floatingInput1">Password</label>
    </div>
    <div class="d-flex mt-1 justify-content-between">
      <div class="form-check">
        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
        <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
      </div>
      <h5 class="text-secondary">Forgot Password?</h5>
    </div>
    <div class="d-grid mt-4">
      <button type="button" class="btn btn-secondary">Login</button>
    </div>
    <hr>
    <h5 class="d-flex gap-1 justify-content-center">
      Don't have an account?
      <a href="<?= site_url('auth/register') ?>">Register</a>
    </h5>
  </div>
</div>

<?= $this->endSection() ?>