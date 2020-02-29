<?php
require('vendor/autoload.php');
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://localhost/estore',
    'ck_3423fc86a9f5d87a3a6b7497ffbabf19874bed26',
    'cs_99d395dcf77339c27cd92c97f04fca804c525fa8',
    [
        'version' => 'wc/v3',
    ]
);
echo '<pre>';
print_r($woocommerce->get('products'));

function getCategories()
{
  $data = $woocommerce->get('products/categories');
print_r($data);
}

?>
