<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\LicenseKey;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $video = Category::create([
            'name' => 'Video Tools',
            'slug' => 'video-tools',
            'tagline' => 'Recap, trim and repurpose long video',
            'icon' => 'video',
            'sort' => 1,
        ]);

        $pdf = Category::create([
            'name' => 'PDF Tools',
            'slug' => 'pdf-tools',
            'tagline' => 'Small utilities that save real hours',
            'icon' => 'pdf',
            'sort' => 2,
        ]);

        $audio = Category::create([
            'name' => 'Audio Tools',
            'slug' => 'audio-tools',
            'tagline' => 'Sound clean, everywhere you speak',
            'icon' => 'audio',
            'sort' => 3,
        ]);

        $camera = Category::create([
            'name' => 'Camera Tools',
            'slug' => 'camera-tools',
            'tagline' => 'Better cameras from the gear you own',
            'icon' => 'camera',
            'sort' => 4,
        ]);

        $products = [
            [
                'category_id' => $video->id,
                'name' => 'DramaRecap',
                'slug' => 'dramarecap',
                'tagline' => 'Skip the filler, keep the story',
                'description' => 'DramaRecap turns hours of drama episodes into tight recaps you can actually rewatch. It detects scene changes, follows the subtitles, and cuts a whole season down to the moments that matter — in one click per episode.',
                'price_cents' => 2400,
                'image' => 'dramarecap.svg',
                'badge' => 'Bestseller',
                'featured' => true,
                'version' => '2.1',
                'requirements' => 'Windows 10/11 · 64-bit · 4 GB RAM',
                'download_url' => '#',
                'features' => [
                    'Scene detection tuned for drama pacing',
                    'One-click 60-second recap export',
                    'Subtitle-aware trimming',
                    'Batch-process an entire series overnight',
                ],
                'key_prefix' => 'DRMR',
                'sort' => 1,
            ],
            [
                'category_id' => $pdf->id,
                'name' => 'PchapPDF',
                'slug' => 'pchappdf',
                'tagline' => 'Merge PDFs in two clicks',
                'description' => 'PchapPDF merges and combines PDFs the way it should work everywhere: right-click any selection of files in Explorer and merge them instantly — or open the drop window, drag files in, reorder pages, and combine into one clean PDF. Fully offline.',
                'price_cents' => 1200,
                'image' => 'pchappdf.svg',
                'badge' => null,
                'featured' => true,
                'version' => '1.8',
                'requirements' => 'Windows 10/11 · 64-bit',
                'download_url' => '#',
                'features' => [
                    'Right-click in Explorer → merge instantly',
                    'Drag-and-drop window with page reorder',
                    'Keeps bookmarks, links and quality',
                    '100% offline — files never leave your PC',
                ],
                'key_prefix' => 'PCPD',
                'sort' => 2,
            ],
            [
                'category_id' => $audio->id,
                'name' => 'Chbah Voice',
                'slug' => 'chbah-voice',
                'tagline' => 'Studio-clean voice, live',
                'description' => 'Chbah Voice cleans your voice in real time — fan noise, keyboard clatter, traffic, room echo — with under 20 ms of latency. It installs as a virtual microphone, so OBS, Discord, Zoom and every call app sounds like you bought a studio.',
                'price_cents' => 1800,
                'image' => 'chbah-voice.svg',
                'badge' => 'New',
                'featured' => true,
                'version' => '3.0',
                'requirements' => 'Windows 10/11 · 64-bit · any mic',
                'download_url' => '#',
                'features' => [
                    'Real-time noise & keyboard suppression',
                    'Virtual mic for OBS, Discord, Zoom',
                    'Under 20 ms latency',
                    'One knob: Clean → Podcast presets',
                ],
                'key_prefix' => 'CHVC',
                'sort' => 3,
            ],
            [
                'category_id' => $camera->id,
                'name' => 'Chbah Cam',
                'slug' => 'chbah-cam',
                'tagline' => 'Your phone is a pro webcam',
                'description' => 'Chbah Cam turns any smartphone into a proper Windows webcam — over USB or Wi-Fi, up to 4K. Auto light and color correction make a bedroom look like a studio, and it shows up as a native camera in OBS, Zoom and Teams.',
                'price_cents' => 1500,
                'image' => 'chbah-cam.svg',
                'badge' => null,
                'featured' => true,
                'version' => '1.4',
                'requirements' => 'Windows 10/11 · iOS 14+ / Android 9+',
                'download_url' => '#',
                'features' => [
                    '4K over USB-C, 1080p60 over Wi-Fi',
                    'Shows up as a native Windows camera',
                    'Auto light & color correction',
                    'OBS, Zoom, Teams, Streamlabs ready',
                ],
                'key_prefix' => 'CHCM',
                'sort' => 4,
            ],
        ];

        foreach ($products as $product) {
            $product = Product::create($product);

            // license key stock for the demo shop
            for ($i = 0; $i < 40; $i++) {
                LicenseKey::create([
                    'product_id' => $product->id,
                    'key' => sprintf(
                        '%s-%s-%s-%s',
                        $product->key_prefix,
                        Str::upper(Str::random(4)),
                        Str::upper(Str::random(4)),
                        Str::upper(Str::random(4)),
                    ),
                    'status' => 'available',
                ]);
            }
        }
    }
}
