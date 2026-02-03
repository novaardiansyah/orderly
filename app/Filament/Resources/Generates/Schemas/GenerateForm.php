<?php

namespace App\Filament\Resources\Generates\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GenerateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('alias'),
                TextInput::make('prefix'),
                TextInput::make('suffix'),
                TextInput::make('separator')
                    ->required()
                    ->default('260203'),
                TextInput::make('queue')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
