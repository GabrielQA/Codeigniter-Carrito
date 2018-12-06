<html>
<head>
<!--Vista del carro de compras  -->
    <title>Carrito Compras CDIGN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
 <br /><br />
 
 <div class="col-lg-6 col-md-6">
  <div class="table-responsive">
   <h3 align="center">Carrito de compras</h3><br/>
   <?php
   //En esta seccion de php se muetra el carrito con el producto seleccionado anteriormente
   foreach($product as $row)
   {
    echo '
    <div class="col-md-4" style="padding:16px; background-color:#f1f1f1; border:1px solid #ccc; margin-bottom:16px; height:300px" align="center">
     <img src="'.base_url().'images/'.$row->product_image.'" class="img-thumbnail" /><br/>
     <h4>'.$row->product_name.'</h4>
     <h3 class="text-danger">$'.$row->product_price.'</h3>
     <input type="text" name="quantity" class="form-control quantity" id="'.$row->product_id.'" /><br/>
     <button type="button" name="agregar_carro" class="btn btn-success agregar_carro" data-productname="'.$row->product_name.'" data-price="'.$row->product_price.'" data-productid="'.$row->product_id.'" />Agregar al carrito</button>
    </div>
    ';
   }
   ?>
      
  </div>
 </div>
 <div class="col-lg-6 col-md-6">
  <div id="cart_details">
   <h3 align="center">Carro vacío</h3>
  </div>
 </div>
 
</div>
</body>
</html>
<script>
//Aqui se agregan los productos al carrito de compras
$(document).ready(function(){
 
 $('.agregar_carro').click(function(){
  var product_id = $(this).data("productid");
  var product_name = $(this).data("productname");
  var product_price = $(this).data("price");
  var quantity = $('#' + product_id).val();
  if(quantity != '' && quantity > 0)
  {
   $.ajax({
    url:"<?php echo base_url(); ?>carro_compra/add",
    method:"POST",
    data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity},
    success:function(data)
    {
     $('#cart_details').html(data);
     $('#' + product_id).val('');
    }
   });
  }
  else
  {
   alert("Campo vacio");
  }
 });

 $('#cart_details').load("<?php echo base_url(); ?>carro_compra/load");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Esta seguro de que quiere remover este carro de compras?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>carro_compra/remove",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     alert("Remover el producto del carrito");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });
//En esta seccion se valida que se limpie el carrito de compras si es que tiene algun producto añadido
 $(document).on('click', '#clear_cart', function(){
  if(confirm("Seguro que desea eliminar este producto?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>carro_compra/clear",
    success:function(data)
    {
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

});
</script>