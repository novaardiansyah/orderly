<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use App\Models\ActivityLog;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ActivityLogInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make([
          TextEntry::make('causer.name')
            ->label(__('resources/activity_logs.columns.causer')),

          TextEntry::make('subject_type')
            ->label(__('resources/activity_logs.columns.subject'))
            ->formatStateUsing(function ($state, ActivityLog $record) {
              if (!$state) return '-';
              return Str::of($state)->afterLast('\\')->headline() . ' # ' . $record->subject_id;
            }),

          TextEntry::make('created_at')
            ->label(__('resources/activity_logs.columns.created_at'))
            ->dateTime()
            ->sinceTooltip(),

          TextEntry::make('log_name')
            ->label(__('resources/activity_logs.columns.log_name'))
            ->badge()
            ->formatStateUsing(fn($state) => ucwords($state)),

          TextEntry::make('event')
            ->label(__('resources/activity_logs.columns.event'))
            ->badge()
            ->color(fn($state) => ActivityLog::getEventColor($state)),

          TextEntry::make('description')
            ->label(__('resources/activity_logs.columns.description'))
            ->wrap()
            ->limit(300)
            ->columnSpanFull(),
        ])
          ->description(__('resources/activity_logs.sections.general_description'))
          ->collapsible()
          ->columns(3),

        Section::make([
          TextEntry::make('ip_address')
            ->label(__('resources/activity_logs.columns.ip_address')),

          TextEntry::make('timezone')
            ->label(__('resources/activity_logs.columns.timezone')),

          TextEntry::make('geolocation')
            ->label(__('resources/activity_logs.columns.geolocation')),

          TextEntry::make('country')
            ->label(__('resources/activity_logs.columns.country')),

          TextEntry::make('city')
            ->label(__('resources/activity_logs.columns.city')),

          TextEntry::make('region')
            ->label(__('resources/activity_logs.columns.region')),

          TextEntry::make('postal')
            ->label(__('resources/activity_logs.columns.postal')),

          TextEntry::make('user_agent')
            ->label(__('resources/activity_logs.columns.user_agent'))
            ->columnSpan(2),
        ])
          ->description(__('resources/activity_logs.sections.location_description'))
          ->collapsible()
          ->visible(
            fn(ActivityLog $record): bool =>
            !!$record->ip_address
          )
          ->columns(3),

        Section::make([
          KeyValueEntry::make('properties_str')
            ->label(__('resources/activity_logs.columns.properties'))
            ->hidden(fn($state) => !$state),

          KeyValueEntry::make('prev_properties_str')
            ->label(__('resources/activity_logs.columns.prev_properties'))
            ->hidden(fn($state) => !$state),
        ])
          ->description(__('resources/activity_logs.sections.properties_description'))
          ->collapsible()
          ->visible(
            fn(ActivityLog $record): bool =>
            !empty($record->properties_str) ||
              !empty($record->prev_properties_str)
          )
      ])
      ->columns(1);
  }
}
