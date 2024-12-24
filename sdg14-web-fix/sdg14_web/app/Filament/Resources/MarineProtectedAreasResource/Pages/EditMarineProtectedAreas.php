<?php

namespace App\Filament\Resources\MarineProtectedAreasResource\Pages;

use App\Filament\Resources\MarineProtectedAreasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarineProtectedAreas extends EditRecord
{
    protected static string $resource = MarineProtectedAreasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
