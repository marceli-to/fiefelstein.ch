<?php
namespace App\Filament\Resources;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\OrderProduct;
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

class OrderResource extends Resource
{
  protected static ?string $model = Order::class;

  protected static ?string $navigationIcon = 'heroicon-o-newspaper';

  protected static ?string $navigationLabel = 'Bestellungen';

  protected static ?string $modelLabel = 'Bestellung';

  protected static ?string $pluralModelLabel = 'Bestellungen';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Grid::make()->schema([
          Section::make('Bestellung')
            ->schema([
              TextInput::make('order_number')
                ->label('Bestellnummer')
                ->disabled()
                ->columnSpan('full'),

              TextInput::make('total')
                ->label('Total')
                ->disabled()
                ->columnSpan('full'),

              TextInput::make('payment_method')
                ->label('Zahlungsmethode')
                ->disabled()
                ->columnSpan('full'),
              DatePicker::make('payed_at')
                ->label('Bezahlt am')
                ->displayFormat('d.m.Y')
                ->disabled()
                ->columnSpan('full'),
            ])->columnSpan([
              'default' => 12,
              'lg' => 6,
          ]),
          Section::make('Adresse')
          ->schema([
            TextInput::make('salutation')
              ->label('Anrede')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('firstname')
              ->label('Vorname')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('name')
              ->label('Name')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('company')
              ->label('Firma')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('street')
              ->label('Straße')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('zip')
              ->label('PLZ')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('city')
              ->label('Ort')
              ->disabled()
              ->columnSpan('full'),
            TextInput::make('country')
              ->label('Land')
              ->disabled()
              ->columnSpan('full'),             

              // this should only be visible if the order has a shipping address (use_invoice_address = false)


              Section::make('Lieferadresse')
                ->visible(fn ($record) => $record->use_invoice_address === false)
                ->collapsible()
                ->collapsed()
                ->schema([
                  TextInput::make('shipping_firstname')
                    ->label('Vorname')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_name')
                    ->label('Name')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_company')
                    ->label('Firma')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_street')
                    ->label('Straße')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_zip')
                    ->label('PLZ')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_city')
                    ->label('Ort')
                    ->disabled()
                    ->columnSpan('full'),
                  TextInput::make('shipping_country')
                  ->label('Land')
                  ->disabled()
                  ->columnSpan('full'),             
              ]),
          ])->columnSpan([
            'default' => 12,
            'lg' => 6,
          ]),
          
        ])->columns(12),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->striped()
      ->defaultSort('id', 'DESC')
      ->columns([
        TextColumn::make('order_number')
          ->label('Bestellnummer')
          ->searchable()
          ->sortable(),

        TextColumn::make('invoice_name')
          ->label('Kunde')
          ->searchable()
          ->sortable(),

        TextColumn::make('total')
          ->label('Total')
          ->searchable()
          ->sortable(),

        TextColumn::make('payment_method')
          ->label('Zahlungsmethode')
          ->searchable()
          ->sortable(),

        // add payed_at column
        TextColumn::make('payed_at')
          ->label('Bezahlt am')
          ->date('d.m.Y')
          ->searchable()
          ->sortable(),
      ])
      ->filters([
        Tables\Filters\TrashedFilter::make(),
      ])
      ->actions([
        ActionGroup::make([
          Action::make('view_invoice')
          ->label('Download Rechnung')
          ->icon('heroicon-o-document-arrow-down')
          ->url(fn ($record) => asset('storage/files/' . config('invoice.invoice_prefix') . $record->uuid . '.pdf'), true)
          ->openUrlInNewTab(),
          EditAction::make(),
          DeleteAction::make()->label('Stornieren'),
        ]),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make()->label('Stornieren'),
          Tables\Actions\ForceDeleteBulkAction::make(),
          Tables\Actions\RestoreBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      RelationManagers\ProductsRelationManager::class,
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListOrders::route('/'),
      'create' => Pages\CreateOrder::route('/create'),
      'edit' => Pages\EditOrder::route('/{record}/edit'),
    ];
  }
}
