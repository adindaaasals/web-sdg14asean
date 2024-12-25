<?php

namespace App\Filament\Resources\TotalFisheriesProductionResource\Pages;

use App\Filament\Resources\TotalFisheriesProductionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTotalFisheriesProduction extends EditRecord
{
    protected static string $resource = TotalFisheriesProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
