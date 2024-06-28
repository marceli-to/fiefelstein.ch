<?php
namespace App\Filament\Resources;
use App\Filament\Resources\IdeaPageResource\Pages;
use App\Filament\Resources\IdeaPageResource\RelationManagers;
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
use Filament\Forms\Components\RichEditor;
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
use App\Models\IdeaPage;

class IdeaPageResource extends Resource
{
  protected static ?string $model = IdeaPage::class;

  protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

  protected static ?string $navigationLabel = 'Idee';

  protected static ?string $modelLabel = 'Idee';

  protected static ?string $pluralModelLabel = 'Idee';

  protected static ?string $navigationGroup = 'Seiteninhalt';

  protected static ?int $navigationSort = 3;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Grid::make()->schema([
          Section::make('Zitat/Text')
            ->schema([
              TextInput::make('quote_text')
                ->label('Zitat')
                ->placeholder('Zitat'),
              TextInput::make('quote_author')
                ->label('Autor')
                ->placeholder('Autor'),
              RichEditor::make('text')
                ->label('Text')
                ->toolbarButtons([
                  'bold',
                  'orderedList',
                  'bulletList',
                  'link',
                  'image',
                  'video',
                  'code',
                  'quote',
                  'horizontalRule',
                  'removeFormat',
                ]),
            ])->columnSpan([
              'default' => 12,
              'lg' => 6,
            ]),
          Section::make('Partner/innen')
            ->schema([
              Repeater::make('partner')
                ->label('Partner/innen')
                ->addActionLabel('Partner/in hinzufügen')
                ->collapsible()
                ->collapsed()
                // add title as itemLabel
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                ->schema([
                  TextInput::make('title')
                    ->label('Titel')
                    ->placeholder('Titel'),
                    // add toggle for title 'isLink'
                  TextInput::make('website')
                    ->label('Webseite')
                    ->placeholder('Webseite'),
                  
                  Textarea::make('description')
                    ->label('Beschreibung')
                    ->placeholder('Beschreibung'),
     
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
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListIdeaPages::route('/'),
      // 'create' => Pages\CreateIdeaPage::route('/create'),
      'edit' => Pages\EditIdeaPage::route('/{record}/edit'),
    ];
  }
}
