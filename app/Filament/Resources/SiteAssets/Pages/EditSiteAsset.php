<?php

namespace App\Filament\Resources\SiteAssets\Pages;

use App\Filament\Resources\SiteAssets\SiteAssetResource;
use Filament\Resources\Pages\EditRecord;

class EditSiteAsset extends EditRecord
{
    protected static string $resource = SiteAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
