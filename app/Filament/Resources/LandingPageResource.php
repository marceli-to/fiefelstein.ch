<?php
namespace App\Filament\Resources;
use App\Filament\Resources\LandingPageResource\Pages;
use App\Filament\Resources\LandingPageResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\LandingPage;
use App\Models\Product;

class LandingPageResource extends Resource
{
  protected static ?string $model = LandingPage::class;

  protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

  protected static ?string $navigationLabel = 'Startseite';

  protected static ?string $modelLabel = 'Startseite';

  protected static ?string $pluralModelLabel = 'Startseite';

  protected static ?string $navigationGroup = 'Seiteninhalt';

  protected static ?int $navigationSort = 1;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Slides')
        ->schema([
          Repeater::make('cards')
            ->label('Produkte oder Texte')
            // add product title to item label if product is selected
            ->itemLabel(function (array $state): ?string {
              if ($state['type'] === 'Produkt' && isset($state['product_id'])) {
                  $product = Product::find($state['product_id']);
                  return $product ? "Produkt: {$product->title}" : "Produkt: (nicht gefunden)";
              }
              return $state['type'] ?? 'Unbekannt';
          })
            ->addActionLabel('Produkt oder Text hinzufügen')
            ->columnSpan('full')
            ->collapsible()
            ->collapsed()
            ->schema([
              Select::make('type')
              ->label('Typ')
              ->options([
                  'Produkt' => 'Produkt',
                  'Text' => 'Text',
              ])
              ->live()
              ->reactive(),
              Select::make('product_id')
                ->label('Produkt')
                ->options(Product::all()->pluck('title', 'id'))
                ->searchable()
                ->visible(fn ($get) => $get('type') === 'Produkt')
                ->required(fn ($get) => $get('type') === 'Produkt'),
              Textarea::make('text')
                ->label('Text')
                ->rows(6)
                ->visible(fn ($get) => $get('type') === 'Text')
                ->required(fn ($get) => $get('type') === 'Text'),
            ])
        ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->label('Last Updated'),
      ])
      ->filters([
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        // Tables\Actions\BulkActionGroup::make([
        //   Tables\Actions\DeleteBulkAction::make(),
        // ]),
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
      'index' => Pages\ListLandingPages::route('/'),
      //'create' => Pages\CreateLandingPage::route('/create'),
      'edit' => Pages\EditLandingPage::route('/{record}/edit'),
    ];
  }
}
