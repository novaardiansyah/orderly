<?php

return [
  'resource' => [
    'label'        => 'Pesanan',
    'plural_label' => 'Pesanan',
  ],
  'sections' => [
    'detail_description'    => 'Detail pesanan',
    'timestamp_description' => 'Timestamp informasi',
    'payment_description'   => 'Informasi pembayaran',
  ],
  'columns' => [
    'code'           => 'ID Pesanan',
    'customer_name'  => 'Nama Pelanggan',
    'quantity'       => 'Kuantitas',
    'total_price'    => 'Total Harga',
    'notes'          => 'Catatan',
    'status'         => 'Status',
    'payment_method' => 'Metode Pembayaran',
    'payment_status' => 'Status Pembayaran',
  ],
  'labels' => [
    'customer_name'  => 'Nama Pelanggan',
    'customer_phone' => 'Nomor Telepon',
  ],
  'enums' => [
    'order_status' => [
      'pending'        => 'Pending',
      'cooking'        => 'Sedang Dimasak',
      'delivering'     => 'Diantar',
      'completed'      => 'Selesai',
    ],
    'payment_method' => [
      'qris'     => 'QRIS',
      'cash'     => 'Tunai',
      'transfer' => 'Transfer',
    ],
    'payment_status' => [
      'pending'   => 'Pending',
      'paid'      => 'Lunas',
      'cancelled' => 'Dibatalkan',
    ],
  ],
];
