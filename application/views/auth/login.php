<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $this->load->view('_partials/header') ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/signin.css') ?>">
  </head>
  <body class="text-center">
    <form class="form-signin" action="<?php echo site_url('login') ?>" method="post">
      <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
      <h1 class="h3 mb-3 font-weight-normal">Login to PostGram!</h1>
      <?php if ($this->session->error): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->error ?>
        </div>
      <?php endif; ?>
      <label for="username" class="sr-only">Username</label>
      <input type="text" id="username" class="form-control" placeholder="Username" name="username" required>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <a class="btn btn-lg btn-link btn-block" href="<?php echo site_url('register') ?>">Register</a>
      <p class="mt-5 mb-3 text-muted">© <?php echo date('Y') ?></p>
    </form>

    <?php $this->load->view('_partials/footer') ?>
  </body>
</html>
