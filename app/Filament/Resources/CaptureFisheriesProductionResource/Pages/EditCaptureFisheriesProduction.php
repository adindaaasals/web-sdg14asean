<?php

namespace App\Filament\Resources\CaptureFisheriesProductionResource\Pages;

use App\Filament\Resources\CaptureFisheriesProductionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaptureFisheriesProduction extends EditRecord
{
    protected static string $resource = CaptureFisheriesProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
