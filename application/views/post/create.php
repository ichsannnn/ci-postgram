<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php $this->load->view('_partials/header') ?>
</head>
<body>
    <?php $this->load->view('_partials/navbar') ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <h1 class="mt-4">Add New Post!</h1>
        </div>
        <div class="row justify-content-md-center">
            <form action="<?php echo site_url('post/create') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Photo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?php echo $error != "" ? 'is-invalid' : '' ?>" id="customFile" name="foto"  accept="image/*">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <div class="invalid-feedback">
                            <?php echo $error; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <textarea class="form-control <?php echo form_error('caption') != "" ? 'is-invalid' : '' ?>" id="caption" rows="4" cols="40" name="caption"><?php echo set_value('caption') ?></textarea>
                    <div class="invalid-feedback">
                        <?php echo form_error('caption') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Post!</button>
            </form>
        </div>
    </div>

    <?php $this->load->view('_partials/footer') ?>
</body>
</html>
