<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategoryResource extends Resource
{
  protected static ?string $model = ProductCategory::class;

  protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

  protected static ?string $navigationLabel = 'Kategorien';

  protected static ?string $modelLabel = 'Kategorie';

  protected static ?string $pluralModelLabel = 'Kategorien';

  protected static ?string $navigationGroup = 'Einstellungen';

  public static function form(Form $form): Form
  {
    return $form->schema([
      Grid::make()->schema([
        Section::make('Kategorie')
        ->schema([
          TextInput::make('name')
            ->label('Bezeichnung')
            ->required()
            ->columnSpan('full'),
        ])->columnSpan([
          'default' => 12,
          'md' => 8,
          'xl' => 6
        ]),
      ])->columns(12)
    ]);
  }

  public static function table(Table $table): Table
  {
    return $table
    ->striped()
    ->defaultSort('name', 'ASC')
    ->columns([
        TextColumn::make('name')
          ->label('Bezeichnung')
          ->searchable()
          ->sortable(),
    ])
    ->filters([
      Tables\Filters\TrashedFilter::make(),
    ])
    ->actions([
      Tables\Actions\EditAction::make(),
    ])
    ->bulkActions([
      Tables\Actions\BulkActionGroup::make([
        Tables\Actions\DeleteBulkAction::make(),
        Tables\Actions\ForceDeleteBulkAction::make(),
        Tables\Actions\RestoreBulkAction::make(),
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
      'index' => Pages\ListProductCategories::route('/'),
      'create' => Pages\CreateProductCategory::route('/create'),
      'edit' => Pages\EditProductCategory::route('/{record}/edit'),
    ];
  }
}
