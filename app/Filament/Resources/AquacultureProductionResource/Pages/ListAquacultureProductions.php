<?php

namespace App\Filament\Resources\AquacultureProductionResource\Pages;

use App\Filament\Resources\AquacultureProductionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAquacultureProductions extends ListRecords
{
    protected static string $resource = AquacultureProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
