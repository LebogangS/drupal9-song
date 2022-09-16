<?php

namespace Drupal\accenture_song\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormState;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productscontroller.
 */
class ProductsController extends ControllerBase {

    /**
     * Returns a render-able array for a test page.
     */
    public function products() {
        $uri = $this->getBaseUrl() . '/jsonapi/node/product';
        $products = $this->getProducts($uri);

        $productsTable = "<a class='add-single-product' href='/admin/config/accenture_song/create-product'>Add Product</a>";

        $productsTable .= "<table class='products-table'>
            <tr>
                <th>Name</th>
                <th>SKU</th>
                <th>Decription</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>";

        foreach($products as $product) {
            $productsTable .= "<tr id=" . $product->id . ">
                <td>". $product->attributes->title ."</td>
                <td>". $product->attributes->field_sku ."</td>
                <td>". $product->attributes->field_description->value ."</td>
                <td><strong>R</strong>: ". $product->attributes->field_price ."</td>
                <td>
                    <a class='read-single-product' href='/admin/config/accenture_song/update-product/" . $product->id . "'>View</a>
                    <a class='delete-single-product' href='/admin/content/delete-product/" . $product->id . "'
                     id='delete-product' data='" . $product->id . "'>Delete</a>
                </td>
                </tr>";
        }

        $productsTable .= "</table>";
        
        $build = [
            '#markup' => $productsTable,
        ];
        return $build;
    }

    /**
     * Returns all products
     */
    private function getProducts($uri) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $uri);
            $result = curl_exec($ch);
        }
        catch(Exception $e){
            throw new Exception("Invalid URL: ",0,$e);
        }
        finally {
            curl_close($ch);
            $obj = json_decode($result);
            return $obj->data;
        }
    }

    /**
     * Returns single product
     */
    public function getProduct($pid) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $this->getBaseUrl() . '/jsonapi/node/product/' . $pid);
            $result = curl_exec($ch);
        }
        catch(Exception $e){
            throw new Exception("Invalid URL: ",0,$e);
        }
        finally {
            curl_close($ch);
            $obj = json_decode($result);
            return $obj->data;
        }
    }

    /**
     * Returns current base url
     */
    private function getBaseUrl() {
        return \Drupal::request()->getSchemeAndHttpHost();
    }

    /**
     * Deletes a product
     */
    public function deleteProduct($product_id) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_URL, $this->getBaseUrl() . '/jsonapi/node/product/' . $product_id);
            $result = curl_exec($ch);
        }
        catch(Exception $e){
            throw new Exception("Invalid URL: ",0,$e);
        }
        finally {
            curl_close($ch);
            $obj = json_decode($result);

            return new JsonResponse(
                [
                    'message' => 'Product deleted', 
                ]
           );
        }
    }
}
