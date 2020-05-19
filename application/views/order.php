<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My orders</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/order.css'; ?>">
  </head>
  <body>
    <?php
      $msg = $this->session->flashdata('msg2');
      if($msg != NULL)
      {
        echo "<div class='out_alert'>
          <div class='alert1'>$msg</div>
        </div>";
      }
     ?>
      <nav class="container">
        <ul>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/logout'; ?>">logout</a></li>
          <li><a class = "item" href="<?php echo base_url().'index.php/auth/menu'; ?>">Menu</a></li>
          <li><a class = "item" href="<?php echo ($user['op3'] == 'cart') ? base_url().'index.php/auth/cart' : base_url().'index.php/auth/add'; ?>"><?php echo $user['op3'] ?></a></li>
          <li><a class = "item" style = "background:#b35900;" href="<?php echo base_url().'index.php/auth/order'; ?>">Orders</a></li>
          <li style="float:left;" class="heading" ><span style="color: #e8491d">Food</span>Shala</li>
        </ul>
      </nav>
    <div class="middle">
      <h1 style="<?php echo (empty($orders) == 1) ? 'display:initial;' : '' ?>">There are no orders</h1>
      <table style="<?php echo (empty($orders) == 1) ? 'display:none;' : '' ?>">
        <?php foreach ($orders as $item):?>
          <?php
            if($item->restaurant_id != $user['id'] && $item->customer_id!=$user['id'])
            {
              continue;
            }
          ?>
          <tr>
            <td class="item_img"><?php $image_data = $item->dish_img; echo '<img src="data:image/jpeg;base64,'.base64_encode($image_data) .'" />'; ?></td>
            <td><?php echo $item->dish_name; ?></td>
            <td>By <?php echo ($user['type'] == 'customer') ? $item->restaurant_name : $item->customer_name ; ?></td>
            <td>₹<?php echo $item->dish_price; ?></td>
            <td><img src = "<?php echo ($item->dish_type == 'veg') ? base_url().'css/veg.jpg' : base_url().'css/nonveg.jpg' ?>" class = "food_type"></td>
            <td><?php echo ($user['type'] == 'customer') ? $item->restaurant_address : $item->customer_address ; ?></td>
            <td><a href="<?php echo base_url().'index.php/auth/remove_order/'.$item->id ?>">remove</a></td>
          </tr>
        <?php endforeach;?>
        </table>
    </div>
    <footer class="foot">
        <p>Made By Sourabh Nagar</p>
    </footer>
  </body>
</html>
