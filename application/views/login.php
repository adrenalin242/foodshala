<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/login.css'; ?>">
    <title>login</title>
  </head>
  <body>
    <?php
      $msg = $this->session->flashdata('msg1');
      if($msg != "")
      {
        echo "<div class='out_alert'>
          <div class='alert'>$msg</div>
        </div>";
      }
     ?>
    <section class="loginbox">
      <div class="login_container">
        <h1><span style="color: #e8491d">Food</span>Shala</h1>
        <form  action="<?php echo base_url().'index.php/Auth/login'; ?>" method="post" name="form">
          <input type="email" name="email_id" class="<?php echo (form_error('email_id') != "") ? 'invalid' : '' ?>" value="<?php echo  set_value('email_id') ?>" placeholder="<?php echo (form_error('email_id') != "") ? strip_tags(form_error('email_id')) : 'Email ID' ?>"><br>
          <input type="password" name="password" class="<?php echo (form_error('password') != "") ? 'invalid' : '' ?>" placeholder="<?php echo (form_error('password') != "") ? strip_tags(form_error('password')) : 'Password' ?>"><br>
          <button type="submit" name="submit">Login</button><br>
          <div id="bottom">
            <span>Not registered?</span><a href="<?php echo base_url().'index.php/Auth/register'; ?>">&nbspCreate An Account</a>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>
