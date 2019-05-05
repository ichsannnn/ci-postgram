<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $this->load->view('_partials/header') ?>
    <style media="screen">
      *:focus {
        outline: none;
        box-shadow: none !important;
        -webkit-appearance: none;
      }
    </style>
  </head>
  <body>
    <?php $this->load->view('_partials/navbar') ?>

    <div class="mt-5"></div>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm">
          <div class="card mb-3" style="width: 40rem;">
            <img class="card-img-top" src="<?php echo base_url('assets/images/' . $post->username . '/posts/' . $post->foto) ?>" alt="Card image cap">
          </div>
        </div>
        <div class="col-sm">
          <div class="card" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; margin-bottom:-1px">
            <div class="card-body">
              <h5 class="card-title">@<?php echo $post->username ?></h5>
              <p class="card-text"><?php echo $post->caption ?></p>
              <?php $datetime = new DateTime("@$post->timestamps"); ?>
              <p class="card-text"><small class="text-muted"><?php echo $datetime->format('d F Y H:i'); ?></small></p>
            </div>
          </div>
          <div class="card" style="border-top-left-radius: 0;border-top-right-radius: 0; border-bottom-left-radius: 0;border-bottom-right-radius: 0; margin-bottom:-1px">
            <ul class="list-group list-group-flush">
              <?php foreach ($comments as $comment): ?>
                <li class="list-group-item"><b><?php echo $comment->username ?></b> <?php echo $comment->comment ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <form action="<?php echo base_url('comment') ?>" method="post" id="commentForm">
            <input type="hidden" name="post_id" value="<?php echo $post->id ?>">
            <input type="text" id="commentBox" class="form-control" style="border-top-left-radius: 0; border-top-right-radius: 0;" placeholder="Add a comment.." name="comment">
          </form>
        </div>
      </div>
    </div>

    <?php $this->load->view('_partials/footer') ?>
    <script>
      $('#commentBox').on('keypress', function (e) {
        if (e.which == 13) {
          $('#commentForm').submit();
        }
      })
    </script>
  </body>
</html>
