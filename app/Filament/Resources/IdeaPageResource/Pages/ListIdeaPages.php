<?php

namespace App\Filament\Resources\IdeaPageResource\Pages;

use App\Filament\Resources\IdeaPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIdeaPages extends ListRecords
{
    protected static string $resource = IdeaPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
