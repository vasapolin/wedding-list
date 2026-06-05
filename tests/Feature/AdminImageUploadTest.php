<?php

namespace Tests\Feature;

use App\Filament\Resources\Gifts\Pages\CreateGift;
use App\Filament\Resources\SiteAssets\Pages\EditSiteAsset;
use App\Models\Gift;
use App\Models\SiteAsset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AdminImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_site_asset_image_upload_is_stored_on_the_public_disk(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();

        $asset = SiteAsset::query()->create([
            'key' => 'home.hero',
            'label' => 'Home — Hero (fundo)',
            'fallback_url' => '/images/site/home-hero.jpg',
        ]);

        Livewire::test(EditSiteAsset::class, ['record' => $asset->getRouteKey()])
            ->fillForm(['image_path' => UploadedFile::fake()->createWithContent('hero.jpg', file_get_contents(base_path('tests/Fixtures/tiny.jpg')))])
            ->call('save')
            ->assertHasNoFormErrors();

        $asset->refresh();

        $this->assertNotNull($asset->image_path);
        Storage::disk('public')->assertExists($asset->image_path);
    }

    public function test_gift_image_upload_is_stored_on_the_public_disk(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();

        Livewire::test(CreateGift::class)
            ->fillForm([
                'name' => 'Jogo de panelas',
                'slug' => 'jogo-de-panelas',
                'price_cents' => 25000,
                'image_path' => UploadedFile::fake()->createWithContent('panelas.jpg', file_get_contents(base_path('tests/Fixtures/tiny.jpg'))),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $gift = Gift::query()->firstOrFail();

        $this->assertNotNull($gift->image_path);
        Storage::disk('public')->assertExists($gift->image_path);
    }
}
