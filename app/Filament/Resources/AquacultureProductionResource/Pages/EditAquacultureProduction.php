<?php

namespace App\Filament\Resources\AquacultureProductionResource\Pages;

use App\Filament\Resources\AquacultureProductionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAquacultureProduction extends EditRecord
{
    protected static string $resource = AquacultureProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
