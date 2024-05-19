<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification; 

class ProductResource extends Resource
{
  protected static ?string $model = Product::class;
  
  protected static ?string $navigationIcon = 'heroicon-o-photo';

  protected static ?string $navigationLabel = 'Produkte';

  protected static ?string $modelLabel = 'Produkt';

  protected static ?string $pluralModelLabel = 'Produkte';

  public static function form(Form $form): Form
  {
    return $form->schema([
      Grid::make()->schema([
        Section::make('Produkt')
        ->schema([

          TextInput::make('title')
            ->label('Titel')
            ->required()
            ->columnSpan('full'),

          TextInput::make('description')
            ->label('Beschreibung')
            ->required()
            ->columnSpan('full'),

            Repeater::make('attributes')
            ->simple(
              TextInput::make('description')
              ->label('Beschreibung')
              ->required(),
            )
            ->label('Attribute')
            ->addActionLabel('Attribut hinzufügen')
            ->columnSpan('full'),

          Select::make('product_category_id')
            ->label('Kategorie')
            ->default(ProductCategory::first()->id)
            ->options(ProductCategory::all()->sortBy('name')->pluck('name', 'id'))
            ->columnSpan('full')
            ->selectablePlaceholder(false),

          TextInput::make('price')
            ->label('Preis')
            ->numeric()
            ->required()
            ->columnSpan('full'),

          TextInput::make('quantity')
            ->label('Anzahl verfügbar')
            ->integer()
            ->required()
            ->columnSpan('full'),

          Toggle::make('publish')
            ->label('Publizieren')
            ->inline(false),

        ])->columnSpan([
          'default' => 12,
          'lg' => 7,
        ]),
        Section::make('Bilder')
        ->collapsible()
        ->collapsed()
        ->schema([

          SpatieMediaLibraryFileUpload::make('image')
            ->label('Bilder')
            ->collection('product_images')
            ->image()
            ->imageEditor()
            ->downloadable()
            ->multiple()
            ->reorderable()
            ->helperText('Erlaubte Dateitypen: JPG, PNG')
            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, $get): string {
              $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
              $name = $fileName . '-' . uniqid() . '.' . $file->extension();
              return (string) str($name);
            }),
        ])->columnSpan([
          'default' => 12,
          'lg' => 5,
        ]),
      ])->columns(12)
    ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->striped()
      ->defaultSort('title', 'ASC')
      ->columns([
        
        SpatieMediaLibraryImageColumn::make('image')
          ->label('Bild')
          ->height(40)
          ->stacked()
          ->circular()
          ->limit(1)
          ->limitedRemainingText()
          ->collection('product_images')
          ->conversion('preview'),

          TextColumn::make('title')
            ->label('Titel')
            ->searchable()
            ->sortable(),

          TextColumn::make('description')
            ->label('Beschreibung')
            ->searchable()
            ->sortable(),

          TextColumn::make('price')
            ->label('Preis')
            ->searchable()
            ->sortable(),

          TextColumn::make('quantity')
            ->label('Verfügbar')
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
      'index' => Pages\ListProducts::route('/'),
      'create' => Pages\CreateProduct::route('/create'),
      'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
  }

  public static function getEloquentQuery(): Builder
  {
    return parent::getEloquentQuery()
      ->withoutGlobalScopes([
        SoftDeletingScope::class,
      ]);
  }
}
