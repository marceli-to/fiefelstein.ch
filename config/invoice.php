<?php
return [

  /**
   * The tax rate
   */

  'tax_rate' => 8.1,

  /**
   * Payment methods
   */

  'payment_methods' => [
    'twint' => [
      'name' => 'Twint',
      'key' => 'twint',
    ],
    'mastercard' => [
      'name' => 'Mastercard',
      'key' => 'mastercard',
    ],
    'visa' => [
      'name' => 'Visa',
      'key' => 'visa',
    ],
    'postfinance' => [
      'name' => 'Postfinance',
      'key' => 'postfinance',
    ],
  ]

];