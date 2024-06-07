<?php
namespace App\Filament\Resources\ProductVariationResource\Pages;
use App\Filament\Resources\ProductVariationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductVariation extends EditRecord
{
  protected static string $resource = ProductVariationResource::class;

  protected function mutateFormDataBeforeSave(array $data): array
  {
    $data['uuid'] = \Str::uuid();
    return $data;
  }

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }
}
