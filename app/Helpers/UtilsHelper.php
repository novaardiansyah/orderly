<?php

use App\Models\ActivityLog;
use App\Models\Generate;
use App\Models\User;
use Illuminate\Support\Carbon;

function carbonTranslatedFormat(string $date, string $format = 'd/m/Y H:i', ?string $locale = null): string
{
  if ($locale)
    Carbon::setLocale($locale);
  return Carbon::parse($date)->translatedFormat($format);
}

function toIndonesianCurrency(float $number = 0, int $precision = 0, string $currency = 'Rp', bool $showCurrency = true)
{
  $result = 0;

  if ($number < 0) {
    $result = '-' . $currency . number_format(abs($number), $precision, ',', '.');
  } else {
    $result = $currency . number_format($number, $precision, ',', '.');
  }

  if ($showCurrency)
    return $result;

  $replace = str_replace(range(0, 9), '-', $result);
  return $replace;
}

function formatQuantity(float $number = 0, int $precision = 0, string $unit = 'Pcs', bool $showUnit = true)
{
  $result = 0;

  if ($number < 0) {
    $result = '-' . $unit . number_format(abs($number), $precision, ',', '.');
  } else {
    $result = $unit . number_format($number, $precision, ',', '.');
  }

  if ($showUnit)
    return $result;

  $replace = str_replace(range(0, 9), '-', $result);
  return $replace;
}

function getCode(string $alias, bool $isNotPreview = true)
{
  $genn = Generate::withTrashed()->where('alias', $alias)->first();
  $date = now()->translatedFormat('ymd');

  if (!$genn) {
    $queue = substr($date, 0, 4) . substr(time(), -4) . substr($date, 4, 2);
    return 'ER-' . $queue;
  }

  $separator = Carbon::createFromFormat('ymd', $genn->separator)->translatedFormat('ymd');

  $diffMonthAndYear = substr($date, 0, 4) != substr($separator, 0, 4);
  $maxLimitQueue = 9999;

  if ((int) $genn->queue >= $maxLimitQueue || $diffMonthAndYear) {
    $genn->queue = 1;
    $genn->separator = $date;
  }

  $queue = substr($date, 0, 4) . str_pad($genn->queue, 4, '0', STR_PAD_LEFT) . substr($date, 4, 2);

  if ($genn->prefix)
    $queue = $genn->prefix . $queue;
  if ($genn->suffix)
    $queue .= $genn->suffix;

  if ($isNotPreview) {
    $genn->queue += 1;
    $genn->save();
  }

  return $queue;
}

function getOptionMonths($short = false): array
{
  if ($short) {
    return [
      '01' => 'Jan',
      '02' => 'Feb',
      '03' => 'Mar',
      '04' => 'Apr',
      '05' => 'Mei',
      '06' => 'Jun',
      '07' => 'Jul',
      '08' => 'Agu',
      '09' => 'Sep',
      '10' => 'Okt',
      '11' => 'Nov',
      '12' => 'Des',
    ];
  }

  return [
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];
}

function textCapitalize($text)
{
  return trim(ucwords(strtolower($text)));
}

function textUpper($text)
{
  return trim(strtoupper($text));
}

function textLower($text)
{
  return trim(strtolower($text));
}

function saveActivityLog(array $data = [], $modelMorp = null): ActivityLog
{
  $causer = auth()->user() ?? User::where('email', 'system@novaardiansyah.id')->first();

  $model    = $data['model'] ?? '';
  $event    = $data['event'] ?? '';
  $changes  = [];
  $oldValue = [];

  if ($modelMorp) {
    $changes = collect($modelMorp->getAttributes())
      ->except($modelMorp->getHidden());

    if ($event == 'Updated') {
      $changes = collect($modelMorp->getDirty())
        ->except($modelMorp->getHidden());

      $oldValue = $changes->mapWithKeys(fn($value, $key) => [$key => $modelMorp->getOriginal($key)])->toArray();
    }

    $changes = is_array($changes) ? $changes : $changes->toArray();
  }

  unset($data['model']);

  return ActivityLog::create(array_merge([
    'log_name'        => 'Resource',
    'description'     => "{$model} {$event} by {$causer->name}",
    'event'           => $event,
    'causer_type'     => User::class,
    'causer_id'       => $causer->id,
    'prev_properties' => $oldValue,
    'properties'      => $changes,
  ], $data));
}

function normalizeValidationErrors(array $errors): array
{
  $normalizedErrors = [];

  foreach ($errors as $key => $messages) {
    $newKey = str_starts_with($key, 'data.')
      ? substr($key, 5)
      : $key;

    $normalizedErrors[$newKey] = $messages;
  }

  return $normalizedErrors;
}

function sizeFormat(float $size): string
{
  $units = ['B', 'KB', 'MB', 'GB', 'TB'];
  $i = floor(log($size, 1024));
  return round($size / pow(1024, $i), 2) . ' ' . $units[$i];
}
