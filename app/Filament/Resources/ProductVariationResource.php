<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ProductVariationResource\Pages;
use App\Filament\Resources\ProductVariationResource\RelationManagers;
use App\Models\ProductVariation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductVariationResource extends Resource
{
  protected static ?string $model = ProductVariation::class;

  protected static bool $shouldRegisterNavigation = false;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form->schema([
    ]);
  }

  public static function table(Table $table): Table
  {
    return $table
        ->columns([
        ])
        ->filters([
        ])
        ->actions([
          Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
          Tables\Actions\BulkActionGroup::make([
            Tables\Actions\DeleteBulkAction::make(),
          ]),
        ]);
  }

  public static function getRelations(): array
  {
    return [
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListProductVariations::route('/'),
      'create' => Pages\CreateProductVariation::route('/create'),
      'edit' => Pages\EditProductVariation::route('/{record}/edit'),
    ];
  }
}
