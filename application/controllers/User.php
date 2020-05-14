<?php

class User extends CI_Controller {
  
  public function get_products() {
    $products = $this->db->get('products');
    for ($i=0; $i<sizeof($products); $i++) {
      $product = $products[$i];
      $ratings = $this->db->get_where('product_ratings', array(
          'product_id' => intval($product['id'])
        ))->result_array();
      $totalRatings = 0;
      for ($j=0; $j<sizeof($ratings); $j++) {
        $totalRatings += intval($ratings[$j]['rating']);
      }
      $product['total_ratings'] = $totalRatings;
      $product['total_raters'] = sizeof($ratings);
    }
    echo json_encode($products);
  }
}