<?php

class Auth_model extends CI_Model{
  /*this function will save user record in database*/
  public function create($formArray) {
    $this->db->insert('users',$formArray);
  }
  /*THIS FUNCTION WILL RETURN ROW ARRAY BASED ON EMAIL ID*/
  public function checkUser($email) {
    $this->db->where('email',$email);
    return $row = $this->db->get('users')->row_array();
  }

  /*check user authorization*/
  function authorization(){
    $user = $this->session->userdata('user');
    if(!empty($user))
    {
      return true;
    }
    else {
      return false;
    }
  }

  /*this will add food items to menu*/
  public function add($formArray) {
    $this->db->insert('menu',$formArray);
  }

  /*to display records*/
  public function display()
  {
    $query=$this->db->get('menu');
    return $query->result();
  }

  /*this will add item to orders*/
  public function addOrder($orderArray){
    $this->db->insert('orders',$orderArray);
  }

  /*to display orders*/
  public function view_orders()
  {
    $query=$this->db->get('orders');
    return $query->result();
  }

  /*this will add item to cart*/
  public function addCart($cartArray){
    $this->db->insert('cart',$cartArray);
  }

  /*to display cart*/
  public function view_cart()
  {
    $query=$this->db->get('cart');
    return $query->result();
  }

  public function delete_order($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('orders');
  }

  public function delete_cart_item($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('cart'); 
  }

}


 ?>
