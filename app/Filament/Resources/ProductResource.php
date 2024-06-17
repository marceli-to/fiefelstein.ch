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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
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

          TextInput::make('group_title')
            ->label('Gruppen Titel')
            ->columnSpan('full'),

          TextInput::make('description')
            ->label('Beschreibung')
            ->required()
            ->columnSpan('full'),

          Repeater::make('attributes')
            ->simple(
              TextInput::make('description')
              ->label('Beschreibung')
            )
            ->label('Attribute')
            ->addActionLabel('Attribut hinzufügen')
            ->columnSpan('full'),

          Select::make('product_category_id')
            ->label('Kategorie')
            ->default(ProductCategory::first()->id)
            ->options(ProductCategory::all()->sortBy('name')->pluck('name', 'id'))
            ->columnSpan('full')
            ->selectablePlaceholder(false)
            ->createOptionForm([
              TextInput::make('name')
                ->required()
                ->label('Kategorie'),
            ])
            ->createOptionAction(fn ($action) => $action->modalWidth('md'))
            ->createOptionUsing(function (array $data): int {
              return ProductCategory::create($data)->getKey();
            }),

          TextInput::make('price')
            ->label('Preis')
            ->numeric()
            ->required()
            ->columnSpan('full'),

          TextInput::make('shipping')
            ->label('Verpackung und Versand')
            ->numeric()
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

        Section::make('Medien')
          ->collapsible()
          ->schema([

          FileUpload::make('image')
            ->image()
            ->imageEditor()
            ->required()
            ->label('Hauptbild')
            ->helperText('Erlaubte Dateitypen: JPG, PNG')
            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, $get): string {
              $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
              $name = $fileName . '-' . uniqid() . '.' . $file->extension();
              return (string) str($name);
            }),

            Repeater::make('cards')
              ->label('Weitere Bilder oder Texte')
              ->itemLabel(fn (array $state): ?string => $state['type'] ?? null)
              ->addActionLabel('Bild oder Text hinzufügen')
              ->columnSpan('full')
              ->collapsible()
              ->collapsed()
              ->schema([
                Select::make('type')
                  ->label('Typ')
                  ->options([
                      'Bild' => 'Bild',
                      'Text' => 'Text',
                  ])
                  ->live()
                  ->reactive(),
                FileUpload::make('image')
                  ->label('Bild')
                  ->image()
                  ->imageEditor()
                  ->visible(fn ($get) => $get('type') === 'Bild')
                  ->helperText('Erlaubte Dateitypen: JPG, PNG')
                  ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, $get): string {
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = $fileName . '-' . uniqid() . '.' . $file->extension();
                    return (string) str($name);
                  }),
                Textarea::make('text')
                  ->label('Text')
                  ->rows(6)
                  ->visible(fn ($get) => $get('type') === 'Text'),
            ])
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
      ->reorderable('sort')
      ->defaultSort('sort', 'ASC')
      ->columns([
        
        ImageColumn::make('image')
          ->label('Bild')
          ->circular()
          ->height(50),

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
        ActionGroup::make([
          EditAction::make(),
          DeleteAction::make(),
        ]),
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
      RelationManagers\VariationsRelationManager::class,
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
