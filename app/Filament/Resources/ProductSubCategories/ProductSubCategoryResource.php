<?php

/*
 * Project Name: orderly
 * File: ProductSubCategoryResource.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Filament\Resources\ProductSubCategories;

use App\Filament\Resources\ProductSubCategories\Pages\CreateProductSubCategory;
use App\Filament\Resources\ProductSubCategories\Pages\EditProductSubCategory;
use App\Filament\Resources\ProductSubCategories\Pages\ListProductSubCategories;
use App\Filament\Resources\ProductSubCategories\Pages\ViewProductSubCategory;
use App\Filament\Resources\ProductSubCategories\Schemas\ProductSubCategoryForm;
use App\Filament\Resources\ProductSubCategories\Schemas\ProductSubCategoryInfolist;
use App\Filament\Resources\ProductSubCategories\Tables\ProductSubCategoriesTable;
use App\Models\ProductSubCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductSubCategoryResource extends Resource
{
  protected static ?string $model = ProductSubCategory::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

  protected static ?int $navigationSort = 30;

  protected static ?string $recordTitleAttribute = 'name';

  public static function getNavigationGroup(): ?string
  {
    return __('general.navigation_groups.operations');
  }

  public static function getNavigationParentItem(): ?string
  {
    return __('resources/products.resource.plural_label');
  }

  public static function getModelLabel(): string
  {
    return __('resources/product_sub_categories.resource.label');
  }

  public static function getPluralModelLabel(): string
  {
    return __('resources/product_sub_categories.resource.plural_label');
  }

  public static function form(Schema $schema): Schema
  {
    return ProductSubCategoryForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return ProductSubCategoryInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return ProductSubCategoriesTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index'  => ListProductSubCategories::route('/'),
      'create' => CreateProductSubCategory::route('/create'),
      'view'   => ViewProductSubCategory::route('/{record}'),
      'edit'   => EditProductSubCategory::route('/{record}/edit'),
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
