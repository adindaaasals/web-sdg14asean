<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountriesResource\Pages;
use App\Filament\Resources\CountriesResource\RelationManagers;
use App\Models\Countries;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\NumberInput;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;


class CountriesResource extends Resource
{
    protected static ?string $model = Countries::class;

    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';
    protected static ?string $navigationLabel = 'Countries Data'; // Nama menu
    protected static ?int $navigationSort = 1; // Urutan menu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('country_name')->required(),
                Forms\Components\TextInput::make('country_code')->required(),
                Forms\Components\TextInput::make('geojson')->required(),
                
                //Upload Image country_flag
                Forms\Components\FileUpload::make('country_flag')
                    ->label('Upload Country Flag')
                    ->directory('country_flags') // Tempat penyimpanan file
                    ->acceptedFileTypes(['image/*']) // Hanya izinkan file gambar
                    ->rules(['max:2048'])
                    ->maxSize(2048), // Ukuran file maksimum (2 MB)
         ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name')->label('Country Name'),
                Tables\Columns\TextColumn::make('country_code')->label('Country Code'),

                // Menampilkan url data gambar bendera negara
                Tables\Columns\ImageColumn::make('country_flag')
                    ->label('Country Flag')
                    ->url(fn ($record) => Storage::url($record->country_flag))
                    ->width('50px')
                    ->height('50px'),

                // Menampilkan data indikator (misalnya aquaculture production) di tabel
                Tables\Columns\TextColumn::make('aquacultureProductions.aquaculture_production_2020')->label('AP-2020'),
                Tables\Columns\TextColumn::make('aquacultureProductions.aquaculture_production_2021')->label('AP-2021'),
                Tables\Columns\TextColumn::make('aquacultureProductions.aquaculture_production_2022')->label('AP-2022'),

                Tables\Columns\TextColumn::make('totalFisheriesProductions.total_fisheries_production_2020')->label('TFP-2020'),
                Tables\Columns\TextColumn::make('totalFisheriesProductions.total_fisheries_production_2021')->label('TFP-2021'),
                Tables\Columns\TextColumn::make('totalFisheriesProductions.total_fisheries_production_2022')->label('TFP-2022'),

                Tables\Columns\TextColumn::make('captureFisheriesProductions.capture_fisheries_production_2020')->label('CFP-2020'),
                Tables\Columns\TextColumn::make('captureFisheriesProductions.capture_fisheries_production_2021')->label('CFP-2021'),
                Tables\Columns\TextColumn::make('captureFisheriesProductions.capture_fisheries_production_2022')->label('CFP-2022'),

                Tables\Columns\TextColumn::make('marineProtectedAreas.marine_protected_areas_2020')->label('MPA-2020'),
                Tables\Columns\TextColumn::make('marineProtectedAreas.marine_protected_areas_2021')->label('MPA-2021'),
                Tables\Columns\TextColumn::make('marineProtectedAreas.marine_protected_areas_2022')->label('MPA-2022'),
                
                Tables\Columns\TextColumn::make('geojson')->label('Data Spasial Negara'),
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountries::route('/create'),
            'edit' => Pages\EditCountries::route('/{record}/edit'),
        ];
    }
}
