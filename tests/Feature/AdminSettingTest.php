<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminSettingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_hero_card_image_upload_stores_file(): void
    {
        $user = User::where('username', 'admin')->firstOrFail();

        $files = [
            'hero_card_image' => UploadedFile::fake()->image('hero1.png', 320, 240),
            'hero_card_image2' => UploadedFile::fake()->image('hero2.png', 320, 240),
            'hero_card_image3' => UploadedFile::fake()->image('hero3.png', 320, 240),
        ];

        $response = $this->actingAs($user)
            ->from('/admin/settings')
            ->put('/admin/settings', $files);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHasNoErrors();

        foreach (array_keys($files) as $key) {
            $path = Setting::get($key);
            $this->assertNotNull($path);
            $this->assertStringStartsWith('settings/', $path);
            $this->assertTrue(\Illuminate\Support\Facades\Storage::disk('public')->exists($path));
        }
    }

    public function test_kendaraan_panel_image_upload_stores_files(): void
    {
        $user = User::where('username', 'admin')->firstOrFail();

        $file1 = UploadedFile::fake()->image('calya.png', 640, 400);
        $file2 = UploadedFile::fake()->image('sigra.png', 640, 400);

        $response = $this->actingAs($user)
            ->from('/admin/settings')
            ->put('/admin/settings', [
                'kendaraan_panel_image' => $file1,
                'kendaraan_panel_image2' => $file2,
            ]);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHasNoErrors();

        foreach (['kendaraan_panel_image', 'kendaraan_panel_image2'] as $key) {
            $path = Setting::get($key);
            $this->assertNotNull($path);
            $this->assertStringStartsWith('settings/', $path);
            $this->assertTrue(\Illuminate\Support\Facades\Storage::disk('public')->exists($path));
        }
    }

    public function test_hero_card_image_kept_when_not_reuploaded(): void
    {
        $user = User::where('username', 'admin')->firstOrFail();
        $file = UploadedFile::fake()->image('hero.png');
        $this->actingAs($user)->from('/admin/settings')->put('/admin/settings', ['hero_card_image' => $file]);

        $saved = Setting::get('hero_card_image');

        $this->actingAs($user)
            ->from('/admin/settings')
            ->put('/admin/settings', ['hero_card_subtitle' => 'Test Subtitle']);

        $this->assertSame($saved, Setting::get('hero_card_image'));
        $this->assertSame('Test Subtitle', Setting::get('hero_card_subtitle'));
    }
}