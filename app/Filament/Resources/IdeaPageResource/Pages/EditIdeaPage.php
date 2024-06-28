<?php

namespace App\Filament\Resources\IdeaPageResource\Pages;

use App\Filament\Resources\IdeaPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIdeaPage extends EditRecord
{
    protected static string $resource = IdeaPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
           //  Actions\DeleteAction::make(),
        ];
    }
}
