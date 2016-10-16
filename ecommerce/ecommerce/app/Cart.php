<?php
/**
 * Created by PhpStorm.
 * User: kejsi
 * Date: 16-09-18
 * Time: 3.08.MD
 */

namespace App;

class Cart
{
    public $images = null, $totQuantity=0, $totPrice=0;

    public function __construct($c)
    {
        if($c)
        {
            $this->images = $c->images;
            $this->totQuantity = $c->totQuantity;
            $this->totPrice = $c->totPrice;
        }
    }
      public function addImage($image)
      {
          $cartImage  = ['qty' => 0, 'price'=>$image->price, 'image'=>$image];
          if($this->images)
          {
              if(array_key_exists($image->id, $this->images))
              {
                  $cartImage = $this->images[$image->id];
              }
          }
          $cartImage['qty']++;
          $cartImage['price'] = $image->price * $cartImage['qty'];
          $this->images[$image->id] = $cartImage;
          $this->totQuantity++;
          $this->totPrice += $image->price;

      }

}