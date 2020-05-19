<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add a new dish</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/add.css'; ?>">
  </head>
  <body>
    <?php
      $msg = $this->session->flashdata('msg');
      if ($msg == "dish added successfully") {
        echo "<div class='out_alert'>
          <div class='alert1'>$msg</div>
        </div>";
      }
      else if($msg != "") {
        echo "<div class='out_alert'>
          <div class='alert2'>$msg</div>
        </div>";
      }
     ?>
      <nav class="container">
        <ul>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/logout'; ?>">logout</a></li>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/menu'; ?>">Menu</a></li>
          <li><a class = "item" style="background:#b35900;" href="<?php echo ($user['op3'] == 'cart') ? base_url().'index.php/auth/cart' : base_url().'index.php/auth/add'; ?>"><?php echo $user['op3'] ?></a></li>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/order'; ?>">Orders</a></li>
          <li style="float:left;" class="heading" ><span style="color: #e8491d">Food</span>Shala</li>
        </ul>
      </nav>
    <div class="middle">
      <div class="inner">
        <h1>Welcome <?php echo $user['name']; ?> Add a new dish here </h1><br>
        <form class="add_form" action="<?php echo base_url().'index.php/Auth/add'; ?>" method="post" enctype="multipart/form-data">
          <input type="text" name="name" class="<?php echo (form_error('name') != "") ? 'invalid' : '' ?>" value="<?php echo set_value('name') ?>" placeholder="<?php echo (form_error('name') != "") ? 'Invalid Dish name' : 'Name of dish' ?>" ><br>
          <input type="number" name="price" class="<?php echo (form_error('price') != "") ? 'invalid' : '' ?>" value="<?php echo set_value('price') ?>" placeholder="<?php echo (form_error('price') != "") ? 'Invalid Dish price' : 'Price of dish' ?>"><br>
          <input type="radio" name="dish_type" class="<?php echo (form_error('dish_type') != "") ? 'invalid' : '' ?>" value="veg">
          <label for="veg">Vegetarian</label>
          <input type="radio" name="dish_type" class="<?php echo (form_error('dish_type') != "") ? 'invalid' : '' ?>" value="nonveg">
          <label for="nonveg">Non-Vegetarian</label><br>
          <span><label for="img">Select image</label>
          <input type="file" name="img" accept="image/*" class="<?php echo (form_error('img') != "") ? 'invalid' : '' ?>" ><br></span>
          <button type="submit" name="submit">Submit</button><br>
        </form>
      </div>
    </div>
    <footer class="foot">
        <p>Made By Sourabh Nagar</p>
    </footer>
  </body>
</html>
