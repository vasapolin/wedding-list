<?php

namespace App\Filament\Resources\SiteAssets;

use App\Filament\Resources\SiteAssets\Pages\EditSiteAsset;
use App\Filament\Resources\SiteAssets\Pages\ListSiteAssets;
use App\Filament\Resources\SiteAssets\Schemas\SiteAssetForm;
use App\Filament\Resources\SiteAssets\Tables\SiteAssetsTable;
use App\Models\SiteAsset;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteAssetResource extends Resource
{
    protected static ?string $model = SiteAsset::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $modelLabel = 'Imagem do site';

    protected static ?string $pluralModelLabel = 'Imagens do site';

    protected static ?string $navigationLabel = 'Imagens do site';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema
    {
        return SiteAssetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteAssetsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteAssets::route('/'),
            'edit' => EditSiteAsset::route('/{record}/edit'),
        ];
    }
}
