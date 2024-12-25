<?php

namespace App\Filament\Resources\CaptureFisheriesProductionResource\Pages;

use App\Filament\Resources\CaptureFisheriesProductionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaptureFisheriesProductions extends ListRecords
{
    protected static string $resource = CaptureFisheriesProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
