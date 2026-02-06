<?php

return [
  'resource' => [
    'label'        => 'Order',
    'plural_label' => 'Orders',
  ],
  'sections' => [
    'detail_description'    => 'Detail order information',
    'timestamp_description' => 'Timestamp information',
    'payment_description'   => 'Payment information',
  ],
  'columns' => [
    'code'           => 'Order ID',
    'notes'          => 'Notes',
    'status'         => 'Status',
    'payment_method' => 'Payment Method',
    'payment_status' => 'Payment Status',
  ],
  'labels' => [
    'customer_name'  => 'Customer Name',
    'customer_phone' => 'Customer Phone',
  ],
  'enums' => [
    'order_status' => [
      'pending'        => 'Pending',
      'cooking'        => 'Cooking',
      'delivering'     => 'Delivering',
      'completed'      => 'Completed',
    ],
    'payment_method' => [
      'qris'     => 'QRIS',
      'cash'     => 'Cash',
      'transfer' => 'Transfer',
    ],
    'payment_status' => [
      'pending'   => 'Pending',
      'paid'      => 'Paid',
      'cancelled' => 'Cancelled',
    ],
  ],
];
