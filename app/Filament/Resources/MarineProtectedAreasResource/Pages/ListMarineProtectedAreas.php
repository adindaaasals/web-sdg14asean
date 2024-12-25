<?php

namespace App\Filament\Resources\MarineProtectedAreasResource\Pages;

use App\Filament\Resources\MarineProtectedAreasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarineProtectedAreas extends ListRecords
{
    protected static string $resource = MarineProtectedAreasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
