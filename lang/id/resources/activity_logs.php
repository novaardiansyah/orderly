<?php

return [
  'resource' => [
    'label'        => 'Log Aktivitas',
    'plural_label' => 'Log Aktivitas',
  ],
  'sections' => [
    'general_description' => 'Informasi umum',
    'location_description' => 'Informasi lokasi dan klien',
    'properties_description' => 'Informasi properti',
  ],
  'columns' => [
    'log_name' => 'Grup',
    'event' => 'Event',
    'description' => 'Deskripsi',
    'subject' => 'Subjek',
    'causer' => 'Causer',
    'batch_uuid' => 'Batch UUID',
    'created_at' => 'Dibuat Pada',
    'ip_address' => 'Alamat IP',
    'timezone' => 'Zona Waktu',
    'geolocation' => 'Geolokasi',
    'country' => 'Negara',
    'city' => 'Kota',
    'region' => 'Wilayah',
    'postal' => 'Kode Pos',
    'user_agent' => 'User Agent',
    'properties' => 'Properti',
    'prev_properties' => 'Properti Sebelumnya',
  ],
  'actions' => [
    'view_detail' => 'Lihat detail activity log',
    'preview_email' => 'Preview notifikasi email',
  ],
];
