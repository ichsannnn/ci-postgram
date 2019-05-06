<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php $this->load->view('_partials/header') ?>
</head>
<body>
    <?php $this->load->view('_partials/navbar') ?>

    <div class="mt-5"></div>
    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="row justify-content-md-center">
                <div class="card mb-3" style="width: 40rem;">
                    <img class="card-img-top" src="<?php echo base_url('assets/images/' . $post->username . '/posts/' . $post->foto) ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo site_url('post/' . $post->id) ?>" class="btn btn-sm btn-outline-secondary">View</a> @<?php echo $post->username ?></h5>
                        <p class="card-text"><?php echo $post->caption ?></p>
                        <?php $datetime = new DateTime("@$post->timestamps"); ?>
                        <p class="card-text"><small class="text-muted"><?php echo $datetime->format('d F Y H:i'); ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php $this->load->view('_partials/footer') ?>
</body>
</html>
