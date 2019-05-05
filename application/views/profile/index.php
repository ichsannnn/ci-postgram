<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $this->load->view('_partials/header') ?>
  </head>
  <body>
    <?php $this->load->view('_partials/navbar') ?>

    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Hello, <?php echo $user->nama ?>!</h1>
        <p>
          <?php if ($user->foto == 'avatar.png'): ?>
            <img src="<?php echo base_url('assets/images/avatar.png') ?>" alt="<?php echo $this->session->user_username ?>'s profile" class="img-thumbnail rounded-circle">
          <?php else: ?>
            <img src="<?php echo base_url('assets/images/'. $user->username .'/'. $user->foto) ?>" alt="<?php echo $this->session->user_username ?>'s profile" class="img-thumbnail rounded-circle">
          <?php endif; ?>
        </p>
        <!-- <p>
          Proactively simplify clicks-and-mortar bandwidth after principle-centered scenarios. Continually deliver leading-edge applications vis-a-vis next-generation networks.
        </p> -->
        <!-- <p>
          <a href="<?php echo site_url('profile/edit') ?>" class="btn btn-outline-primary my-2">Edit Profile</a>
        </p> -->
      </div>
    </section>

    <div class="container">
      <div class="row">
        <?php if (sizeof($posts) > 0): ?>
          <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img src="<?php echo base_url('assets/images/' . $post->username . '/posts/' . $post->foto) ?>" class="bd-placeholder-img card-img-top custom-card-image" width="100%" height="225">
                <div class="card-body">
                  <p class="card-text"><?php echo $post->caption ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <p>
                        <a href="<?php echo site_url('post/' . $post->id) ?>" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="<?php echo site_url('post/edit/' . $post->id) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                      </p>
                    </div>
                    <?php $datetime = new DateTime("@$post->timestamps"); ?>
                    <p class="card-text"><small class="text-muted"><?php echo $datetime->format('d F Y'); ?></small></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <h1>No post yet!</h1>
        <?php endif; ?>

      </div>
    </div>

    <?php $this->load->view('_partials/footer') ?>
  </body>
</html>
