<?php

namespace Drupal\accenture_song\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\accenture_song\Controller\ProductsController;

/**
 * Configure example settings for this site.
 */
class UpdateProductForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'updateproduct';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'update_products';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $prod_id = basename($current_uri = \Drupal::request()->getRequestUri());

    $obj = new ProductsController();
    $product = $obj->getProduct($prod_id);

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#value' => $product->attributes->title,
    ];
    $form['sku'] = [
      '#type' => 'textfield',
      '#title' => $this->t('SKU'),
      '#value' => $product->attributes->field_sku,
    ];
    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#value' => $product->attributes->field_description->value,
    ];
    $form['price'] = [
      '#type' => 'number',
      '#min' => 0,
      '#step' => 0.01,
      '#value' => $product->attributes->field_price,
    ];
    return parent::buildForm($form, $form_state);
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $prod_id = basename($current_uri = \Drupal::request()->getRequestUri());

    $data = [
      "type" =>  "node--product",
      "attributes" => [
        "title" => $form_state->getValue('title'),
        "field_description" => [
          "value" => $form_state->getValue('description'),
        ],
        "field_price" => $form_state->getValue('price'),
        "field_sku" => $form_state->getValue('sku'),
      ]
    ];
    $postdata = json_encode( array( "data"=> $data ));

    $ch = curl_init(\Drupal::request()->getSchemeAndHttpHost() . '/jsonapi/node/product/' . $prod_id);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/vnd.api+json',
        'Accept: application/vnd.api+json'
      )
    );
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

    $result = curl_exec($ch);
    \Drupal::messenger()->addMessage('Product Successfully Updated');
    header("Location: /admin/content/all-products", true, 301);
    exit();

    return $result;
  }
}
