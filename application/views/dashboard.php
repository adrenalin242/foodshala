<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dashboard.css'; ?>">
  </head>
  <body>
    <?php
      $msg = $this->session->flashdata('msg2');
      if($msg == 'dish added successfully')
      {
        echo "<div class='out_alert'>
          <div class='alert1'>$msg</div>
        </div>";
      }
      else if ($msg != "") {
        echo "<div class='out_alert'>
          <div class='alert2'>$msg</div>
        </div>";
      }
     ?>
      <nav class="container">
        <ul>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/logout'; ?>">logout</a></li>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/menu'; ?>">Menu</a></li>
          <li><a class = "item" href="<?php echo ($user['op3'] == 'cart') ? base_url().'index.php/auth/cart' : base_url().'index.php/auth/add'; ?>"><?php echo $user['op3'] ?></a></li>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/order'; ?>">Orders</a></li>
          <li style="float:left;" class="heading" ><span style="color: #e8491d">Food</span>Shala</li>
        </ul>
      </nav>
    <div class="middle">
      <h1>Welcome <?php echo $user['name'] ?> </h1>
    </div>
    <footer class="foot">
        <p>Made By Sourabh Nagar</p>
    </footer>
  </body>
</html>
