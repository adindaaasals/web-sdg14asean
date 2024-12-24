<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarineProtectedAreasResource\Pages;
use App\Models\MarineProtectedAreas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;


class MarineProtectedAreasResource extends Resource
{
    protected static ?string $model = MarineProtectedAreas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Key Focus Area of SDG 14';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('country_code')->label('Country Code')->required(),
                Forms\Components\TextInput::make('country_name')->label('Country Name')->required(),
                Forms\Components\TextInput::make('marine_protected_areas_2020')->label('Marine Protected Areas in 2020')->numeric(),
                Forms\Components\TextInput::make('marine_protected_areas_2021')->label('Marine Protected Areas in 2020')->numeric(),
                Forms\Components\TextInput::make('marine_protected_areas_2022')->label('Marine Protected Areas in 2020')->numeric(),
                
                FileUpload::make('polygon_file')
                    ->label('Upload Polygon File (GeoJSON)')
                    ->directory('mpa_data') // Folder penyimpanan file
                    ->disk('public') // Gunakan disk 'public'
                    ->acceptedFileTypes(['application/json']) // Hanya izinkan file JSON
                    ->rules(['max:204800'])
                    ->maxSize(204800) // Ukuran file maksimum (160 MB)
                    ->saveUploadedFileUsing(function ($file, $record, callable $set) {
                        $path = FileUploadService::uploadPolygonFile($file);
                        $set('polygon_data', $path);
                    
                        if ($record) {
                            $record->polygon_data = $path;
                            $record->save();
                        }
                    
                        return $path;
                    })
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name')->label('Country Name'),
                Tables\Columns\TextColumn::make('marine_protected_areas_2020')->label('MPA-2020'),
                Tables\Columns\TextColumn::make('marine_protected_areas_2021')->label('MPA-2021'),
                Tables\Columns\TextColumn::make('marine_protected_areas_2022')->label('MPA-2022'),
                Tables\Columns\TextColumn::make('polygon_data')
                    ->label('Polygon File Path')
                    ->url(fn ($record) => Storage::url($record->polygon_data)) // Tautan untuk melihat file
                    ->openUrlInNewTab(), // Buka tautan di tab baru
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarineProtectedAreas::route('/'),
            'create' => Pages\CreateMarineProtectedAreas::route('/create'),
            'edit' => Pages\EditMarineProtectedAreas::route('/{record}/edit'),
        ];
    }
}
