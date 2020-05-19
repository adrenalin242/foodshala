<?php

class Auth extends CI_Controller {
  /*
  this function will show register page
  */
  public function register()
  {
    $this->load->view('register');
  }
  public function register_customer()
  {
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == true)
    {
      $this->session->set_flashdata('msg2','you are already logged in');
      redirect(base_url().'index.php/auth/dashboard');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_message('is_unique','Email address already exist');
    $this->form_validation->set_rules('name','Full name','required');
    $this->form_validation->set_rules('email_id','Email','required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('c_password','Password Confirmation','required|matches[password]');
    $this->form_validation->set_rules('addr','Address','required');
    $this->form_validation->set_rules('pno','Phone','required');
    $this->form_validation->set_rules('user_pref','Pref','required');

    if($this->form_validation->run() == FALSE)
    {
      $this->load->view('customer');
    }
    else {

      //here we will save user data in db
      $formArray = array();
      $formArray['name'] = $this->input->post('name');
      $formArray['email'] = $this->input->post('email_id');
      $formArray['password'] = md5($this->input->post('password'));
      $formArray['address'] = $this->input->post('addr');
      $formArray['phone'] = $this->input->post('pno');
      $formArray['type'] = 'customer';
      $formArray['pref'] = $this->input->post('user_pref');

      $this->Auth_model->create($formArray);

      $this->session->set_flashdata('msg','Account created successfully');
      redirect(base_url().'index.php/Auth/register_customer');
    }
  }
  public function register_restaurant(){

    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == true)
    {
      $this->session->set_flashdata('msg2','you are already logged in');
      redirect(base_url().'index.php/auth/dashboard');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_message('is_unique','Email address already exist');
    $this->form_validation->set_rules('name','Full name','required');
    $this->form_validation->set_rules('email_id','Email','required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('c_password','Password Confirmation','required|matches[password]');
    $this->form_validation->set_rules('addr','Address','required');
    $this->form_validation->set_rules('pno','Phone','required');

    if($this->form_validation->run() == FALSE)
    {
      $this->load->view('restaurant');
    }
    else {

      //here we will save user data in db
      $formArray = array();
      $formArray['name'] = $this->input->post('name');
      $formArray['email'] = $this->input->post('email_id');
      $formArray['password'] = md5($this->input->post('password'));
      $formArray['address'] = $this->input->post('addr');
      $formArray['phone'] = $this->input->post('pno');
      $formArray['type'] = 'restaurant';
      $formArray['pref'] = 'NA';

      $this->Auth_model->create($formArray);

      $this->session->set_flashdata('msg','Account created successfully');
      redirect(base_url().'index.php/Auth/register_restaurant');
    }
  }

  public function login(){
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == true)
    {
      $this->session->set_flashdata('msg2','you are already logged in');
      redirect(base_url().'index.php/auth/dashboard');
    }

    $this->load->model('Auth_model');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email_id','Email','required|valid_email');
    $this->form_validation->set_rules('password','Password','required');

    if($this->form_validation->run() == FALSE){
        $this->load->view('login');
    }
    else {
      $email = $this->input->post('email_id');
      $password = md5($this->input->post('password'));
      $user = $this->Auth_model->checkuser($email);

      if(!empty($user)){
        if($password == $user['password'])
        {
          $sessArray['id']=$user['id'];
          $sessArray['name']=$user['name'];
          $sessArray['email']=$user['email'];
          $sessArray['address']=$user['address'];
          $sessArray['phone']=$user['phone'];
          $sessArray['type']=$user['type'];
          $sessArray['pref']=$user['pref'];
          $sessArray['op1']='orders';
          $sessArray['op2']='menu';
          if($user['type']=='customer')
          {
            $sessArray['op3']='cart';
          }
          else {
            $sessArray['op3']='add';
          }
          $this->session->set_userdata('user',$sessArray);
          redirect(base_url().'index.php/auth/dashboard');
        }
        else{
          $this->session->set_flashdata('msg1','Either email or password is incorrect');
          $this->load->view('login');
        }
      }
      else {
        $this->session->set_flashdata('msg1','Either email or password is incorrect');
        $this->load->view('login');
      }
    }
  }


  public function dashboard()
  {
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    $data = $this->session->userdata('user');
    $user['user'] = $data;
    $this->load->view('dashboard',$user);
  }


  public function logout()
  {
    $this->session->unset_userdata('user');
    redirect(base_url().'index.php/auth/login');
  }

  public function add()
  {
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    $data = $this->session->userdata('user');
    $user['user'] = $data;
    if($data['op3'] == 'cart')
    {
      $this->session->set_flashdata('msg2','you are not authorized to access this');
      redirect(base_url().'index.php/auth/dashboard');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name','Dish Name','required');
    $this->form_validation->set_rules('price','Price of Dish','required');
    $this->form_validation->set_rules('dish_type','Type of dish','required');


    if($this->form_validation->run() == FALSE)
    {
      $this->load->view('add.php',$user);
    }
    else
    {
      $temp_name  = $_FILES['img']['tmp_name'];
      $image_type = $_FILES['img']['type'];
      if (substr($image_type,0,5) != 'image') {
        $this->session->set_flashdata('msg','please enter a valid image');
        redirect(base_url().'index.php/Auth/add');
      }
      else {
        $image_data = file_get_contents($temp_name);
        $formArray = array();
        $formArray['name'] = $this->input->post('name');
        $formArray['price'] = $this->input->post('price');
        $formArray['type'] = $this->input->post('dish_type');
        $formArray['img'] = $image_data;
        $formArray['restaurant_id'] = $data['id'];
        $formArray['restaurant_name'] = $data['name'];
        $formArray['restaurant_address'] = $data['address'];

        $this->Auth_model->add($formArray);

        $this->session->set_flashdata('msg','dish added successfully');
        redirect(base_url().'index.php/Auth/add');
      }
    }
  }


  public function menu()
  {
    $data = $this->session->userdata('user');
    $this->load->model('Auth_model');
    $result=$this->Auth_model->display();
    $user['menu']=$result;
    $user['user'] = $data;
    $this->load->view('menu.php',$user);
  }


  public function cart($id = NULL)
  {
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    $data = $this->session->userdata('user');
    $user['user'] = $data;
    $result=$this->Auth_model->display();
    if($data['op3'] == 'add')
    {
      $this->session->set_flashdata('msg2','you are not authorized to access this');
      redirect(base_url().'index.php/auth/dashboard');
    }
    $top = 0;
    if( $id != NULL)
    {
      $AddCart = array();
      $AddCart['customer_name'] = $data['name'];
      $AddCart['customer_id'] = $data['id'];
      $AddCart['customer_address'] = $data['address'];
      foreach ($result as $item):
        if($item->id == $id)
        {
          $AddCart['restaurant_name'] = $item->restaurant_name;
          $AddCart['restaurant_id'] = $item->restaurant_id;
          $AddCart['restaurant_address'] = $item->restaurant_address;
          $AddCart['dish_name'] = $item->name;
          $AddCart['dish_price'] = $item->price;
          $AddCart['dish_type'] = $item->type;
          $AddCart['dish_img'] = $item->img;
          $top = 1;
          break;
        }
      endforeach;
      if($top == 1)
      {
        $this->Auth_model->addCart($AddCart);
        $this->session->set_flashdata('msg2','item added to cart');
      }
    }
    $cart = $this->Auth_model->view_cart();
    $user['cart'] = $cart;
    if($id != NULL && $top == 1 )
    {
      redirect(base_url().'index.php/auth/menu');
    }
    else {
      $this->load->view('cart.php',$user);
    }
  }


  public function order($id = NULL)
  {
    $this->load->model('Auth_model');
    $result=$this->Auth_model->display();
    $data = $this->session->userdata('user');
    $user['user'] = $data;
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    if ($data['op3'] == 'add')
    {
      $id = NULL;
    }
    $top = 0;
    if($id != NULL)
    {
      $AddOrder = array();
      $AddOrder['customer_name'] = $data['name'];
      $AddOrder['customer_id'] = $data['id'];
      $AddOrder['customer_address'] = $data['address'];
      foreach ($result as $item):
        if($item->id == $id)
        {
          $AddOrder['restaurant_name'] = $item->restaurant_name;
          $AddOrder['restaurant_id'] = $item->restaurant_id;
          $AddOrder['restaurant_address'] = $item->restaurant_address;
          $AddOrder['dish_name'] = $item->name;
          $AddOrder['dish_price'] = $item->price;
          $AddOrder['dish_type'] = $item->type;
          $AddOrder['dish_img'] = $item->img;
          $top = 1;
          break;
        }
      endforeach;
      if($top == 1)
      {
        $this->Auth_model->addOrder($AddOrder);
        $this->session->set_flashdata('msg2','order placed');
      }
    }
    $orders = $this->Auth_model->view_orders();
    $user['orders'] = $orders;
    if($id != NULL && $top == 1 )
    {
      redirect(base_url().'index.php/auth/menu');
    }
    else {
      $this->load->view('order.php',$user);
    }
  }

  public function remove_order($id = NULL)
  {
    $this->load->model('Auth_model');
    $result=$this->Auth_model->view_orders();
    $data = $this->session->userdata('user');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    if(id == NULL)
    {
      redirect(base_url().'index.php/auth/order');
    }
    else {
      foreach ($result as $item):
        if($item->id == $id)
        {
          if($item->customer_id == $data['id'] || $item->restaurant_id == $data['id'] )
          {
            $this->Auth_model->delete_order($id);
            $this->session->set_flashdata('msg2','order removed successfully');
            redirect(base_url().'index.php/auth/order');
          }
          break;
        }
      endforeach;
    }
    redirect(base_url().'index.php/auth/order');
  }

  public function remove_cart_item($id = NULL)
  {
    $this->load->model('Auth_model');
    $result=$this->Auth_model->view_cart();
    $data = $this->session->userdata('user');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    if ($data['op3'] == 'add')
    {
      $this->session->set_flashdata('msg2','you are not authorized to access this');
      redirect(base_url().'index.php/auth/dashboard');
    }
    if(id == NULL)
    {
      redirect(base_url().'index.php/auth/cart');
    }
    else {
      foreach ($result as $item):
        if($item->id == $id)
        {
          if($item->customer_id == $data['id'] )
          {
            $this->Auth_model->delete_cart_item($id);
            $this->session->set_flashdata('msg2','cart item removed successfully');
            redirect(base_url().'index.php/auth/cart');
          }
          break;
        }
      endforeach;
    }
    redirect(base_url().'index.php/auth/cart');
  }

  public function ordercart()
  {
    $data = $this->session->userdata('user');
    $this->load->model('Auth_model');
    if($this->Auth_model->authorization() == false)
    {
      $this->session->set_flashdata('msg1','you are not authorized to access this');
      redirect(base_url().'index.php/auth/login');
    }
    if ($data['op3'] == 'add')
    {
      $this->session->set_flashdata('msg2','you are not authorized to access this');
      redirect(base_url().'index.php/auth/dashboard');
    }
    $this->load->model('Auth_model');
    $result=$this->Auth_model->view_cart();
    foreach ($result as $item):
      if($item->customer_id == $data['id'] )
      {
        $this->Auth_model->delete_cart_item($item->id);
        $item->id = NULL;
        $this->Auth_model->addOrder($item);
      }
    endforeach;
    $this->session->set_flashdata('msg2','order placed successfully');
    redirect(base_url().'index.php/auth/cart');
  }

}



 ?>
