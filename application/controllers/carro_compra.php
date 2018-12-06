<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controlador carro de compras
class carro_compra extends CI_Controller {
 //Funcion principal
 function index()
 {
  $this->load->model("carro_modelo");
  $data["product"] = $this->carro_modelo->fetch_all();
  $this->load->view("carro_compra", $data);
 }
//Funciom que agrega al carrito el producto seleccionado
 function add()
 {
  $this->load->library("cart");
  $data = array(
   "id"  => $_POST["product_id"],
   "name"  => $_POST["product_name"],
   "qty"  => $_POST["quantity"],
   "price"  => $_POST["product_price"]
  );
  $this->cart->insert($data); //return rowid 
  echo $this->view();
 }
//Carga la vista del carro de compras
 function load()
 {
  echo $this->view();
 }
//Remueve el producto del carrito de compras
 function remove()
 {
  $this->load->library("cart");
  $row_id = $_POST["row_id"];
  $data = array(
   'rowid'  => $row_id,
   'qty'  => 0
  );
  $this->cart->update($data);
  echo $this->view();
 }
//Funcion que limpia el carro de compras
 function clear()
 {
  $this->load->library("cart");
  $this->cart->destroy();
  echo $this->view();
 }
 //Funcion que muestra vista del carro de compras...
 function view()
 {
  $this->load->library("cart");
  $output = '';
  $output .= '
  <h3>Carro de compras</h3><br />
  <div class="table-responsive">
   <div align="right">
    <button type="button" id="clear_cart" class="btn btn-warning">Eliminar Carrito</button>
   </div>
   <br />
   <table class="table table-bordered">
    <tr>
     <th width="40%">Nombre</th>
     <th width="15%">Cantidad</th>
     <th width="15%">Precio</th>
     <th width="15%">Total</th>
     <th width="15%">Accion</th>
    </tr>

  ';
  $count = 0;
  foreach($this->cart->contents() as $items)
  {
   $count++;
   $output .= '
   <tr> 
    <td>'.$items["name"].'</td>
    <td>'.$items["qty"].'</td>
    <td>'.$items["price"].'</td>
    <td>'.$items["subtotal"].'</td>
    <td><button type="button" name="remove" class="btn btn-danger
     btn-xs remove_inventory" id="'.$items["rowid"].'">Remover</button></td>
   </tr>
   ';
  }
  $output .= '
   <tr>
    <td colspan="4" align="right">Total</td>
    <td>'.$this->cart->total().'</td>
   </tr>
  </table>

  </div>
  ';

  if($count == 0)
  {
   $output = '<h3 align="center">Carrito vacio</h3>';
  }
  return $output;
 }
}
