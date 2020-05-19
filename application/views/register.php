<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/login.css'; ?>">
    <title>register</title>
  </head>
  <body>
    <section class="loginbox">
      <div class="login_container">
        <h1><span style="color: #e8491d">Food</span>Shala</h1>
        <a href="<?php echo base_url().'index.php/Auth/register_customer'; ?>"><button>As Customer</button><br></a>
        <a href="<?php echo base_url().'index.php/Auth/register_restaurant'; ?>"><button>As Restaurant</button><br></a>
        <div id="bottom">
          <span>Already registered?</span><a href="<?php echo base_url().'index.php/Auth/login'; ?>">&nbspLogin In</a>
        </div>
      </div>
    </section>
  </body>
</html>
