<?php
$url = "https://example.com/products/1234";
$path = parse_url($url, PHP_URL_PATH); // $path will be "/products/1234"
$product_id = substr($path, strrpos($path, "/") + 1); // $product_id will be "1234"
echo $product_id;