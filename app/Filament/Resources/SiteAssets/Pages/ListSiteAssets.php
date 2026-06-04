<?php

namespace App\Filament\Resources\SiteAssets\Pages;

use App\Filament\Resources\SiteAssets\SiteAssetResource;
use Filament\Resources\Pages\ListRecords;

class ListSiteAssets extends ListRecords
{
    protected static string $resource = SiteAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
