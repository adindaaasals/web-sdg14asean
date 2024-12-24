<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TotalFisheriesProductionResource\Pages;
use App\Filament\Resources\TotalFisheriesProductionResource\RelationManagers;
use App\Models\TotalFisheriesProduction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TotalFisheriesProductionResource extends Resource
{
    protected static ?string $model = TotalFisheriesProduction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Key Focus Area of SDG 14';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('country_code')->label('Country Code')->required(),
                Forms\Components\TextInput::make('country_name')->label('Country Name')->required(),
                Forms\Components\TextInput::make('total_fisheries_production_2020')->label('Total Fisheries Production in 2020')->numeric(),
                Forms\Components\TextInput::make('total_fisheries_production_2021')->label('Total Fisheries Production in 2021')->numeric(),
                Forms\Components\TextInput::make('total_fisheries_production_2022')->label('Total Fisheries Production in 2022')->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name')->label('Country Name'),
                Tables\Columns\TextColumn::make('total_fisheries_production_2020')->label('TFP-2020'),
                Tables\Columns\TextColumn::make('total_fisheries_production_2021')->label('TFP-2021'),
                Tables\Columns\TextColumn::make('total_fisheries_production_2022')->label('TFP-2022'),
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
            'index' => Pages\ListTotalFisheriesProductions::route('/'),
            'create' => Pages\CreateTotalFisheriesProduction::route('/create'),
            'edit' => Pages\EditTotalFisheriesProduction::route('/{record}/edit'),
        ];
    }
}
