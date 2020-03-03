<?php
require('vendor/autoload.php');
require_once("Rest.inc.php");
use Automattic\WooCommerce\Client;


//echo '<pre>';
//print_r($woocommerce->get('products'));

error_reporting(0);
class API extends REST {
//public $woocommerce;

  public function processApi(){
  			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
  			if((int)method_exists($this,$func) > 0)
  				$this->$func();
  			else
  				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
  		}

public function getCategories()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v3',
      ]
  );
 $categories = $woocommerce->get('products/categories');
$data = array('response_code' => "Success",'response_data' => $categories);
$this->response($this->json($data), 200);

}
public function getProducts()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v3',
      ]
  );
   $category_id = $_REQUEST['category_id'];
 $products = $woocommerce->get('products');
$data = array('response_code' => "Success",'response_data' => $products);
$this->response($this->json($data), 200);
}

public function getSingleproduct()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v3',
      ]
  );
   $product_id = $_REQUEST['product_id'];
 $product = $woocommerce->get('products/'.$product_id);
$data = array('response_code' => "Success",'response_data' => $product);
$this->response($this->json($data), 200);
}

public function getCurrency()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v3',
      ]
  );
 $currency = $woocommerce->get('data/currencies/current');
$data = array('response_code' => "Success",'response_data' => $currency);
$this->response($this->json($data), 200);
}
public function addtoCart()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $product_id = $_REQUEST['product_id'];
  $qty = $_REQUEST['quantity'];
  $args = array(
    'product_id' => $product_id,
    'quantity' => $qty
  );
  $response = $woocommerce->post('cart/add', $args );
  //$response = $woocommerce->( 'http://localhost/estore/wp-json/cocart/v1/add-item', $args );
  $data = array('response_code' => "Success",'response_data' => $response);
  $this->response($this->json($data), 200);
}

public function getcartTotal()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
 $total = $woocommerce->get('cart/totals');
$data = array('response_code' => "Success",'response_data' => $total);
$this->response($this->json($data), 200);
}

public function getcartCalculate()
{
  //https://docs.cocart.xyz/wc-api-v2.html#update-item-in-cart
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $args = array();
 $response = $woocommerce->post('cart/calculate',$args);
$data = array('response_code' => "Success",'response_data' => $response);
$this->response($this->json($data), 200);
}

public function getcartcountitem()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
 $total = $woocommerce->get('cart/count-items');
$data = array('response_code' => "Success",'response_data' => $total);
$this->response($this->json($data), 200);
}

public function getcartdetails()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $response = $woocommerce->get('cart');
 $data = array('response_code' => "Success",'response_data' => $response);
 $this->response($this->json($data), 200);
}

public function updateCart()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $cart_item_key = $_REQUEST['cart_item_key'];
  $qty = $_REQUEST['quantity'];
  $args = array(
    'cart_item_key' => $cart_item_key,
    'quantity' => $qty
  );
  $response = $woocommerce->post('cart/cart-item', $args );
  $data = array('response_code' => "Success",'response_data' => $response);
  $this->response($this->json($data), 200);
}

public function removeCartitem()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $cart_item_key = $_REQUEST['cart_item_key'];
  $args = array(
    'cart_item_key' => $cart_item_key
  );
  $response = $woocommerce->delete('cart/cart-item', $args );
  $data = array('response_code' => "Success",'response_data' => $response);
  $this->response($this->json($data), 200);
}

public function clearCart()
{
  header('Access-Control-Allow-Origin: *');
  $woocommerce = new Client(
      'http://localhost/estore',
      'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
      'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
      [
          'version' => 'wc/v2',
      ]
  );
  $args = array();
  $response = $woocommerce->post('cart/clear',$args);
  $data = array('response_code' => "Success",'response_data' => $response);
  $this->response($this->json($data), 200);
}

/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}

}
$api = new API;
	$api->processApi();

?>
