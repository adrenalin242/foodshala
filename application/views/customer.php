<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/signup.css'; ?>">
    <title>register</title>
  </head>
  <body>
    <?php
      $msg = $this->session->flashdata('msg');
      if($msg != "")
      {
        echo "<div class='out_alert'>
          <div class='alert'>$msg</div>
        </div>";
      }
     ?>
    <section class="signupbox">
      <div class="signup_container">
        <h1><span style="color: #e8491d">Food</span>Shala</h1>
        <form class="" action="<?php echo base_url().'index.php/Auth/register_customer'; ?>" method="post" name="signup_form">
          <input type="text" name="name" class="<?php echo (form_error('name') != "") ? 'invalid' : '' ?>" value="<?php echo set_value('name') ?>" placeholder="<?php echo (form_error('name') != "") ? strip_tags(form_error('name')) : 'Full Name' ?>"><br>
          <input type="email" name="email_id" class="<?php echo (form_error('email_id') != "") ? 'invalid' : '' ?>" value="<?php echo (form_error('email_id') != "") ? '' : set_value('email_id') ?>" placeholder="<?php echo (form_error('email_id') != "") ? strip_tags(form_error('email_id')) : 'Email ID' ?>"><br>
          <input type="password" name="password" class="<?php echo (form_error('password') != "") ? 'invalid' : '' ?>" placeholder="<?php echo (form_error('password') != "") ? strip_tags(form_error('password')) : 'Password' ?>" ><br>
          <input type="password" name="c_password" class="<?php echo (form_error('c_password') != "") ? 'invalid' : '' ?>" placeholder="<?php echo (form_error('c_password') != "") ? strip_tags(form_error('c_password')) : 'Confirm Password' ?>"><br>
          <input type="text" name="addr" class="<?php echo (form_error('addr') != "") ? 'invalid' : '' ?>" value="<?php echo set_value('addr') ?>" placeholder="<?php echo (form_error('addr') != "") ? strip_tags(form_error('addr')) : 'Address' ?>"><br>
          <input type="tel" name="pno" pattern="[0-9]{10}" class="<?php echo (form_error('pno') != "") ? 'invalid' : '' ?>" value="<?php echo set_value('pno') ?>" placeholder="<?php echo (form_error('pno') != "") ? strip_tags(form_error('pno')) : 'Phone Number' ?>"><br>
          <input type="radio" name="user_pref" value="veg" class="<?php echo (form_error('user_pref') != "") ? 'invalid' : '' ?>">
          <label for="veg">Vegetarian</label>
          <input type="radio" name="user_pref" value="nonveg" class="<?php echo (form_error('user_pref') != "") ? 'invalid' : '' ?>">
          <label for="nonveg">Non-Vegetarian</label><br>
          <button type="submit" name="submit">Sign Up</button><br>
          <div id="bottom">
            <span>Already registered?</span><a href="<?php echo base_url().'index.php/Auth/login'; ?>">&nbspLogin In</a><br><br>
            <a href="<?php echo base_url().'index.php/Auth/register_restaurant'; ?>">&nbspSignUp as Restaurant</a>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>
