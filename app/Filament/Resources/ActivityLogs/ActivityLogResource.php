<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogForm;
use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogInfolist;
use App\Filament\Resources\ActivityLogs\Tables\ActivityLogsTable;
use App\Models\ActivityLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityLogResource extends Resource
{
  protected static ?string $model = ActivityLog::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

  protected static ?int $navigationSort = 10;

  protected static ?string $recordTitleAttribute = 'description';

  public static function getNavigationGroup(): ?string
  {
    return __('general.navigation_groups.logs');
  }

  public static function getModelLabel(): string
  {
    return __('general.resources.activity_log.label');
  }

  public static function getPluralModelLabel(): string
  {
    return __('general.resources.activity_log.plural_label');
  }

  public static function form(Schema $schema): Schema
  {
    return ActivityLogForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return ActivityLogInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return ActivityLogsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListActivityLogs::route('/'),
    ];
  }

  public static function getRecordRouteBindingEloquentQuery(): Builder
  {
    return parent::getRecordRouteBindingEloquentQuery()
      ->withoutGlobalScopes([
        SoftDeletingScope::class,
      ]);
  }
}
