    <div class="container">
      <header>
        <?php echo validation_errors() ?>
      </header>
      <div class="welcome">
        <h3>Welcome to the Queens Head Pub Quiz</h3>
        <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" class="logo-login">
      </div>
      <div class="vertical-line"></div>
      <div class="form">
        <?php echo form_open('users/login'); ?>
        <div class="email">
          <label for="email">email</label>
          <input type="text" name="email" id="email" placeholder="Enter email">
        </div>
        <div class="password">
          <label for="password">password</label>
          <input type="password" name="password" id="password" placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>

        <?php echo form_close(); ?>
        <button class="w3-circle" onclick="location.href = href='<?php echo site_url('users/register'); ?>'">Register</button>
      </div>
    </div>