<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cake;
use App\Models\User;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users
        $admin = User::where('email', 'admin@cakeshop.com')->first();
        $user = User::where('email', 'user@cakeshop.com')->first();

        if (!$admin || !$user) {
            $this->command->error('Please run AdminUserSeeder first!');
            return;
        }

        // Sample cakes data
        $cakes = [
            [
                'title' => 'Classic Chocolate Cake',
                'description' => 'Rich and decadent chocolate cake made with premium cocoa powder. Smooth and velvety texture with beautiful chocolate cream decorations on top. Perfect choice for chocolate lovers, ideal for any celebration, making every bite full of happiness.',
                'image_path' => 'cakes/placeholder-cake-1.svg',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Strawberry Cream Cake',
                'description' => 'Perfect combination of fresh strawberries and light cream. Soft and sweet cake layers filled with fresh strawberry slices and cream, topped with beautiful strawberries and mint leaves. Fresh taste, sweet enjoyment, the most popular dessert in summer.',
                'image_path' => 'cakes/placeholder-cake-2.svg',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Blueberry Cheesecake',
                'description' => 'Classic American-style cheesecake with rich creamy texture perfectly balanced with fresh blueberries. Crispy cookie base, smooth cheese layer, topped with homemade blueberry sauce. Rich layers, unforgettable taste. Best served chilled.',
                'image_path' => 'cakes/placeholder-cake-3.svg',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Matcha Red Bean Cake',
                'description' => 'Japanese-style matcha cake made with premium matcha powder. Subtle tea aroma perfectly blends with sweet red beans. Light and fluffy cake with fresh matcha cream that is not overly sweet. Every bite is filled with Eastern elegance and sophistication. Perfect for those who love Japanese desserts.',
                'image_path' => 'cakes/placeholder-cake-4.svg',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Vanilla Mille-feuille',
                'description' => 'Carefully crafted mille-feuille cake, each layer is a handmade thin cake slice with vanilla cream. Rich and layered texture with rich but not overwhelming milk flavor. Beautiful appearance with distinct layers when cut, perfect choice for birthdays and anniversaries.',
                'image_path' => 'cakes/placeholder-cake-5.svg',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Lemon Pound Cake',
                'description' => 'Fresh lemon pound cake, sweet and tangy with a solid texture. Made with fresh lemon juice and lemon zest, carrying a subtle lemon fragrance. Topped with lemon glaze, both beautiful and flavorful. Perfect for afternoon tea, enjoy leisurely moments.',
                'image_path' => 'cakes/placeholder-cake-6.svg',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Red Velvet Cake',
                'description' => 'Classic American red velvet cake with vibrant red appearance hiding soft and sweet cake inside. Paired with cream cheese frosting, sweet but not overly rich, rich in texture. Beautiful decorations make this cake the highlight of parties and celebrations, deeply loved by everyone.',
                'image_path' => 'cakes/placeholder-cake-7.svg',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Tiramisu Cake',
                'description' => 'Italian classic dessert tiramisu, rich coffee perfectly blends with sweet mascarpone. Ladyfinger cookies soaked in coffee, layered together, finally dusted with cocoa powder. Rich layers of texture, both coffee bitterness and milky sweetness.',
                'image_path' => 'cakes/placeholder-cake-8.svg',
                'user_id' => $user->id,
            ],
        ];

        // Create cakes
        foreach ($cakes as $cake) {
            Cake::firstOrCreate(
                ['title' => $cake['title']],
                $cake
            );
        }

        $this->command->info('Successfully created ' . count($cakes) . ' sample cakes!');
    }
}
