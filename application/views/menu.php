<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/menu.css'; ?>">
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
          <li style = "<?php echo (empty($user) == 1) ? 'display:none;' : '' ?> "><a class = "item" href="<?php echo base_url().'index.php/auth/logout'; ?>">logout</a></li>
          <li style = "<?php echo (empty($user) == 1) ? '' : 'display:none;' ?> "><a class = "item" href="<?php echo base_url().'index.php/auth/login'; ?>">login</a></li>
          <li><a class = "item" style = "background:#b35900;" href="<?php echo base_url().'index.php/auth/menu'; ?>">Menu</a></li>
          <li style = "<?php echo (empty($user) == 1) ? 'display:none;' : '' ?> "><a class = "item" href="<?php echo (empty($user) == 1) ? '' : (($user['op3'] == 'cart') ? base_url().'index.php/auth/cart' : base_url().'index.php/auth/add'); ?>"><?php echo (empty($user)==1) ? "" : $user['op3'] ?></a></li>
          <li style = "<?php echo (empty($user) == 1) ? 'display:none;' : '' ?> "><a class = "item" href="<?php echo base_url().'index.php/auth/order'; ?>">Orders</a></li>
          <li style="float:left;" class="heading" ><span style="color: #e8491d">Food</span>Shala</li>
        </ul>
      </nav>
    <div class="middle">
      <table>
        <?php foreach ($menu as $item):?>
          <?php
            if( !empty($user) && $user['type'] == 'customer' && $user['pref'] != $item->type)
            {
              continue;
            }
          ?>
          <tr>
            <td class="item_img"><?php $image_data = $item->img; echo '<img src="data:image/jpeg;base64,'.base64_encode($image_data) .'" />'; ?></td>
            <td><?php echo $item->name; ?></td>
            <td>By <?php echo $item->restaurant_name; ?></td>
            <td>₹<?php echo $item->price; ?></td>
            <td><img src = "<?php echo ($item->type == 'veg') ? base_url().'css/veg.jpg' : base_url().'css/nonveg.jpg' ?>" class = "food_type"></td>
            <td style = "<?php echo ( empty($user) != 1 && $user['type'] == 'restaurant' ) ? 'display:none;' : '' ?> " ><a href="<?php echo (empty($user) == 1) ? base_url().'index.php/auth/login' : base_url().'index.php/auth/order'.'/'.$item->id; ?>" >Order</a></td>
            <td style = "<?php echo ( empty($user) != 1 && $user['type'] == 'restaurant' ) ? 'display:none;' : '' ?> " ><a href="<?php echo (empty($user) == 1) ? base_url().'index.php/auth/login' : base_url().'index.php/auth/cart'.'/'.$item->id;  ?>" >Add to cart</a></td>
          </tr>
        <?php endforeach;?>
        </table>
    </div>
    <footer class="foot">
        <p>Made By Sourabh Nagar</p>
    </footer>
  </body>
</html>
