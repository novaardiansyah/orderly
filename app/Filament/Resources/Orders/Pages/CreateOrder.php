<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Customer;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
  protected static string $resource = OrderResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    if (!$data['customer_id']) {
      $customer = Customer::create([
        'name' => $data['name'],
        'phone' => $data['phone'],
      ]);
      $data['customer_id'] = $customer->id;
    }

    return $data;
  }

  protected function getRedirectUrl(): string
  {
    $resource = static::getResource();
    return $resource::getUrl('index');
  }
}
