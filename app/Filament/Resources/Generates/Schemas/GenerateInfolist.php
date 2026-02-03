<?php

namespace App\Filament\Resources\Generates\Schemas;

use App\Models\Generate;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GenerateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('alias')
                    ->placeholder('-'),
                TextEntry::make('prefix')
                    ->placeholder('-'),
                TextEntry::make('suffix')
                    ->placeholder('-'),
                TextEntry::make('separator'),
                TextEntry::make('queue')
                    ->numeric(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Generate $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
