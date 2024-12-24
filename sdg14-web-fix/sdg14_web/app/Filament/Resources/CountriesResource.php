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

                // Bagian untuk meng-upload atau mengedit data GeoJSON
                // Forms\Components\FileUpload::make('geojson')
                //     ->directory('geojsons') // Tempat penyimpanan file GeoJSON
                //     ->label('Upload GeoJSON')
                //     ->afterStateUpdated(function (callable $set, $state) {
                //         if ($state) {
                //             $geojson = file_get_contents($state);
                //             // Simpan atau perbarui data GeoJSON di tabel maps
                //             $country = Countries::find($set('country_id'));  // Get the country by ID
                //             $country->map()->updateOrCreate(
                //                 ['country_id' => $country->id],
                //                 ['geojson' => $geojson]
                //             );
                //         }
                //     }),

                // Menambahkan indikator yang terkait (contoh untuk aquaculture production)
                Forms\Components\Repeater::make('aquacultureProductions')
                    ->relationship('aquacultureProductions') // Relasi dengan model AquacultureProduction
                    ->schema([
                        Forms\Components\TextInput::make('aquaculture_production_2020')->label('Aquaculture Production in 2020')->numeric(),
                        Forms\Components\TextInput::make('aquaculture_production_2021')->label('Aquaculture Production in 2021')->numeric(),
                        Forms\Components\TextInput::make('aquaculture_production_2022')->label('Aquaculture Production in 2022')->numeric(),
                    ])
                    ->columns(3)
                    ->defaultItems(1),                    

                // Menambahkan indikator yang terkait (contoh untuk aquaculture production)
                Forms\Components\Repeater::make('captureFisheriesProductions')
                    ->relationship('captureFisheriesProductions') // Relasi dengan model AquacultureProduction
                    ->schema([
                        Forms\Components\TextInput::make('capture_fisheries_production_2020')->label('Capture Fisheries Production in 2020')->numeric(),
                        Forms\Components\TextInput::make('capture_fisheries_production_2021')->label('Capture Fisheries Production in 2021')->numeric(),
                        Forms\Components\TextInput::make('capture_fisheries_production_2022')->label('Capture Fisheries Production in 2022')->numeric(),
                    ])
                    ->columns(3)
                    ->defaultItems(1),

                Forms\Components\Repeater::make('totalFisheriesProductions')
                ->relationship('totalFisheriesProductions') // Relasi dengan model AquacultureProduction
                ->schema([
                    Forms\Components\TextInput::make('total_fisheries_production_2020')->label('Total Fisheries Production in 2020')->numeric(),
                    Forms\Components\TextInput::make('total_fisheries_production_2021')->label('Total Fisheries Production in 2021')->numeric(),
                    Forms\Components\TextInput::make('total_fisheries_production_2022')->label('Total Fisheries Production in 2022')->numeric(),
                ])
                ->columns(3)
                ->defaultItems(1),

                Forms\Components\Repeater::make('marineProtectedAreas')
                ->relationship('marineProtectedAreas') // Relasi dengan model AquacultureProduction
                ->schema([
                    Forms\Components\TextInput::make('marine_protected_areas_2020')->label('Marine Protected Areas in 2020')->numeric(),
                    Forms\Components\TextInput::make('marine_protected_areas_2021')->label('Marine Protected Areas in 2021')->numeric(),
                    Forms\Components\TextInput::make('marine_protected_areas_2022')->label('Marine Protected Areas in 2022')->numeric(),
                ])
                ->columns(3)
                ->defaultItems(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name'),
                Tables\Columns\TextColumn::make('country_code'),

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

    public static function saveCountryWithIndicators($data)
    {
        // Menyimpan data negara
        $country = Countries::create([
            'country_name' => $data['country_name'],
            'country_code' => $data['country_code'],
        ]);

        // Menyimpan indikator terkait (contoh aquaculture production)
        foreach ($data['aquacultureProductions'] as $production) {
            $country->aquacultureProductions()->create([
                'aquaculture_production_2020' => $production['aquaculture_production_2020'],
                'yaquaculture_production_2021' => $production['aquaculture_production_2021'],
                'aquaculture_production_2022' => $production['aquaculture_production_2022'],
            ]);
        }

        foreach ($data['totalFisheriesProductions'] as $production) {
            $country->totalFisheriesProductions()->create([
                'total_fisheries_production_2020' => $production['total_fisheries_production_2020'],
                'total_fisheries_production_2021' => $production['total_fisheries_production_2021'],
                'total_fisheries_production_2022' => $production['total_fisheries_production_2022'],
            ]);
        }

        foreach ($data['captureFisheriesProductions'] as $production) {
            $country->captureFisheriesProductions()->create([
                'capture_fisheries_production_2020' => $production['capture_fisheries_production_2020'],
                'capture_fisheries_production_2021' => $production['capture_fisheries_production_2021'],
                'capture_fisheries_production_2022' => $production['capture_fisheries_production_2022'],
            ]);
        }

        foreach ($data['marineProtectedAreas'] as $production) {
            $country->marineProtectedAreas()->create([
                'marine_protected_areas_2020' => $production['marine_protected_areas_2020'],
                'marine_protected_areas_2021' => $production['marine_protected_areas_2021'],
                'marine_protected_areas_2022' => $production['marine_protected_areas_2022'],
            ]);
        }
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
