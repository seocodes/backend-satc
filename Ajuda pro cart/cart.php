<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove")
{
  if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["codigo"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
         Produto foi removido do carrinho !</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
         unset($_SESSION["shopping_cart"]);
    }
  }
}

if (isset($_POST['action']) && $_POST['action']=="change")
{
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['codigo'] === $_POST["codigo"]){
        $value['quantity'] = $_POST["quantity"];
        break;
    }
}

}
?>
<HTML>
<HEAD>
 <TITLE>Carrinho Compras </TITLE>
  <link rel="stylesheet" href="estilo.css">
</HEAD>
<BODY>


<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>
<table class="table">
<tbody>
<tr>
<td></td>
<td>Descricao</td>
<td>Quantidade</td>
<td>Preço</td>
<td>Total</td>
</tr>
<?php
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><?php echo $product["foto1"].$product["descricao"]; ?><br>
<form method='post' action=''>
<input type='hidden' name='codigo' value="<?php echo $product["codigo"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='codigo' value="<?php echo $product["codigo"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "R$".$product["preco"]; ?></td>
<td><?php echo "R$".$product["preco"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["preco"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "R$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>
  <?php
}else{
	echo "<h3>Seu carrinho está vazio !</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


</BODY>
</HTML>
