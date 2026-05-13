<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImage::query()->delete();
        Product::query()->delete();
        Category::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            ['name' => 'African Necklaces', 'slug' => 'african-necklaces', 'description' => 'Handcrafted African beaded necklaces with traditional fringe and pendant designs'],
            ['name' => 'African Skirts', 'slug' => 'african-skirts', 'description' => 'Vibrant Ankara print skirts with bold geometric patterns'],
            ['name' => 'African Dresses', 'slug' => 'african-dresses', 'description' => 'Elegant African print dresses for women'],
            ['name' => 'African Collar Necklaces', 'slug' => 'african-collar-necklaces', 'description' => 'Statement beaded collar and cape necklaces inspired by African tradition'],
            ['name' => 'African Bracelets', 'slug' => 'african-bracelets', 'description' => 'Handcrafted African beaded bracelets with traditional patterns'],
            ['name' => 'African Cuff Bracelets', 'slug' => 'african-cuff-bracelets', 'description' => 'Rigid beaded cuff bracelets with vibrant African patterns'],
            ['name' => 'African Earrings', 'slug' => 'african-earrings', 'description' => 'Handmade African beaded earrings with fringe details'],
            ['name' => 'African Hats', 'slug' => 'african-hats', 'description' => 'Traditional African beaded hats and headwear'],
            ['name' => 'African Knot Necklaces', 'slug' => 'african-knot-necklaces', 'description' => 'Beaded rope necklaces with decorative knot pendant'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[$cat['slug']] = Category::create($cat);
        }

        $products = [
            // AFRICAN NECKLACES (fringe/tassel style)
            [
                'name' => 'Yellow Beaded Tassel Necklace',
                'description' => 'Stunning handcrafted African beaded necklace in vibrant yellow with double disc medallion and long beaded fringe. Features multicolored traditional patterns at the center with gold-tone clasp.',
                'price' => 65.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['1.jpg', '14.jpg'],
            ],
            [
                'name' => 'Navy Blue Beaded Tassel Necklace',
                'description' => 'Elegant navy blue beaded necklace featuring double disc medallion with multicolored center patterns and long beaded fringe. Gold-tone accents throughout.',
                'price' => 65.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['11.jpg'],
            ],
            [
                'name' => 'Green Beaded Tassel Necklace',
                'description' => 'Beautiful green beaded necklace with double disc medallion and cascading fringe. Handcrafted with multicolored traditional African patterns and gold-tone clasp.',
                'price' => 65.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['12.jpg'],
            ],
            [
                'name' => 'Black & White Beaded Tassel Necklace',
                'description' => 'Striking black beaded necklace with white spiral pattern disc medallions and long black and white fringe. Gold-tone accents add elegance to this classic piece.',
                'price' => 65.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['13.jpg'],
            ],
            [
                'name' => 'Orange Beaded Tassel Necklace',
                'description' => 'Vibrant orange beaded necklace featuring double disc medallion with multicolored center and long beaded fringe. Bold African statement piece.',
                'price' => 65.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['15.jpg'],
            ],

            // AFRICAN SKIRTS
            [
                'name' => 'Geometric Ankara High-Low Skirt - Women',
                'description' => 'Stunning high-low maxi skirt in vibrant geometric Ankara print. Bold colors of green, blue, orange and yellow on black background. Paired with black ruffled top and statement belt.',
                'price' => 59.99,
                'stock' => 20,
                'category' => 'african-skirts',
                'images' => ['2.jpg', '3.jpg'],
            ],
            [
                'name' => 'Geometric Ankara Skirt Set - Mother & Daughter',
                'description' => 'Matching mother and daughter Ankara print skirt set. High-low maxi skirt for women and knee-length version for girls. Vibrant geometric pattern in green, blue, orange and yellow.',
                'price' => 89.99,
                'stock' => 15,
                'category' => 'african-skirts',
                'images' => ['6.jpg', '7.jpg'],
            ],

            // AFRICAN DRESSES
            [
                'name' => 'Gold Embroidered Lace Dress',
                'description' => 'Elegant gold/beige dress with intricate floral lace overlay and embroidery. Features puffed sleeves, V-neckline with lattice detail, and black striped trim at hem and sleeves. Perfect for special occasions.',
                'price' => 129.99,
                'stock' => 10,
                'category' => 'african-dresses',
                'images' => ['4.jpg', '5.jpg'],
            ],
            [
                'name' => 'Sunflower Ankara Maxi Dress',
                'description' => 'Beautiful African print maxi dress featuring bold sunflower pattern in yellow and blue on black background. Shirt collar, short sleeves, belted waist, and flowing full skirt with pockets.',
                'price' => 89.99,
                'stock' => 15,
                'category' => 'african-dresses',
                'images' => ['30.jpg', '31.jpg'],
            ],

            // AFRICAN COLLAR NECKLACES (cape style)
            [
                'name' => 'Black & Gold Beaded Collar Necklace',
                'description' => 'Exquisite handcrafted beaded collar necklace in black with elegant gold diamond-pattern beadwork. Drapes beautifully over the shoulders creating a regal cape effect.',
                'price' => 79.99,
                'stock' => 12,
                'category' => 'african-collar-necklaces',
                'images' => ['8.jpg', '19.jpg'],
            ],
            [
                'name' => 'Black & White Beaded Collar Necklace - Rays',
                'description' => 'Stunning black collar necklace with white beaded ray pattern radiating outward. Traditional African craftsmanship with a modern geometric design.',
                'price' => 79.99,
                'stock' => 12,
                'category' => 'african-collar-necklaces',
                'images' => ['9.jpg'],
            ],
            [
                'name' => 'Black & White Beaded Collar Necklace - Concentric',
                'description' => 'Bold black and white beaded collar with concentric circle pattern at the neckline and cascading diamond beadwork. A statement piece for special occasions.',
                'price' => 85.99,
                'stock' => 10,
                'category' => 'african-collar-necklaces',
                'images' => ['10.jpg'],
            ],
            [
                'name' => 'Multicolor Rainbow Beaded Cape Necklace',
                'description' => 'Spectacular full-coverage beaded cape necklace in vibrant rainbow colors. Features diamond-pattern beadwork at shoulders with flowing beaded strands in red, orange, yellow, green, blue and white.',
                'price' => 129.99,
                'stock' => 8,
                'category' => 'african-collar-necklaces',
                'images' => ['16.jpg'],
            ],
            [
                'name' => 'White Beaded Collar Necklace',
                'description' => 'Elegant pure white beaded collar necklace with delicate diamond-pattern openwork design. Lightweight and graceful, perfect for bridal or formal occasions.',
                'price' => 75.99,
                'stock' => 12,
                'category' => 'african-collar-necklaces',
                'images' => ['18.jpg'],
            ],
            [
                'name' => 'Black & White Beaded Full Cape Necklace',
                'description' => 'Dramatic full-body beaded cape with white diamond lattice pattern at shoulders and cascading draped beaded strands in black and white. A show-stopping ceremonial piece.',
                'price' => 149.99,
                'stock' => 6,
                'category' => 'african-collar-necklaces',
                'images' => ['21.jpg'],
            ],
            [
                'name' => 'Multicolor Dark Beaded Collar Necklace',
                'description' => 'Bold beaded collar in dark tones featuring multicolor diamond-pattern beadwork in blue, green, orange, red and yellow on black background. Vibrant African artistry.',
                'price' => 85.99,
                'stock' => 10,
                'category' => 'african-collar-necklaces',
                'images' => ['52.jpg'],
            ],
            [
                'name' => 'Green & White Beaded Collar Necklace',
                'description' => 'Delicate green and white beaded collar with open diamond lattice design. Features gold-tone accents throughout. Light and airy traditional African neckpiece.',
                'price' => 75.99,
                'stock' => 12,
                'category' => 'african-collar-necklaces',
                'images' => ['59.jpg'],
            ],

            // BLACK PENDANT NECKLACE
            [
                'name' => 'Black & White Beaded Disc Pendant Necklace',
                'description' => 'Elegant black beaded rope necklace with large circular pendant featuring concentric black and white pattern with gold-tone center medallion. A bold statement accessory.',
                'price' => 55.99,
                'stock' => 15,
                'category' => 'african-necklaces',
                'images' => ['17.jpg'],
            ],

            // AFRICAN KNOT NECKLACES
            [
                'name' => 'Black & White Beaded Knot Necklace',
                'description' => 'Handcrafted black and white beaded rope necklace with decorative loop knot pendant. Classic two-tone design with elegant pearl-bead closure.',
                'price' => 49.99,
                'stock' => 18,
                'category' => 'african-knot-necklaces',
                'images' => ['20.jpg'],
            ],
            [
                'name' => 'Yellow Multicolor Beaded Knot Necklace',
                'description' => 'Vibrant yellow beaded rope necklace with multicolor accent bands in red, green, blue and white. Features decorative loop knot pendant. Cheerful African statement piece.',
                'price' => 49.99,
                'stock' => 18,
                'category' => 'african-knot-necklaces',
                'images' => ['22.jpg', '23.jpg'],
            ],
            [
                'name' => 'Red Multicolor Beaded Knot Necklace',
                'description' => 'Bold red beaded rope necklace with colorful accent bands in green, yellow, blue and white. Decorative loop knot pendant adds visual interest. Handcrafted African jewelry.',
                'price' => 49.99,
                'stock' => 18,
                'category' => 'african-knot-necklaces',
                'images' => ['32.jpg'],
            ],
            [
                'name' => 'Green Multicolor Beaded Knot Necklace',
                'description' => 'Fresh green beaded rope necklace with purple, red, yellow and white accent bands. Features signature loop knot pendant. Handmade with traditional African beading techniques.',
                'price' => 49.99,
                'stock' => 18,
                'category' => 'african-knot-necklaces',
                'images' => ['33.jpg'],
            ],
            [
                'name' => 'Blue Multicolor Beaded Knot Necklace',
                'description' => 'Deep navy blue beaded rope necklace with red, green, yellow and white accent bands. Loop knot pendant design. Traditional African handcrafted jewelry.',
                'price' => 49.99,
                'stock' => 18,
                'category' => 'african-knot-necklaces',
                'images' => ['58.jpg'],
            ],

            // AFRICAN BRACELETS (round/roll-on)
            [
                'name' => 'White Multicolor Beaded Bracelet',
                'description' => 'Handcrafted African roll-on bracelet in white with vibrant multicolored geometric tribal patterns in red, blue, green, yellow and gold.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['24.jpg'],
            ],
            [
                'name' => 'Yellow Multicolor Beaded Bracelet',
                'description' => 'Bright yellow African roll-on bracelet with traditional geometric patterns featuring multicolored accents in red, green, blue and gold.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['25.jpg'],
            ],
            [
                'name' => 'Red Multicolor Beaded Bracelet',
                'description' => 'Bold red African roll-on bracelet with vibrant multicolored tribal patterns in blue, green, yellow and gold. Handcrafted traditional beadwork.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['26.jpg'],
            ],
            [
                'name' => 'Green Multicolor Beaded Bracelet',
                'description' => 'Fresh green African roll-on bracelet with colorful accent bands in yellow, blue, red and white. Smooth round profile with traditional beading.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['27.jpg'],
            ],
            [
                'name' => 'Black & Gold Beaded Bracelet',
                'description' => 'Elegant black and gold African roll-on bracelet. Alternating bands of black and metallic gold beads create a sophisticated pattern. Perfect for stacking.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['28.jpg', '29.jpg'],
            ],
            [
                'name' => 'Orange Multicolor Beaded Bracelet',
                'description' => 'Vibrant orange African roll-on bracelet with traditional geometric patterns and multicolored accents in red, green, blue, yellow and gold.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['34.jpg'],
            ],
            [
                'name' => 'Black & Gold Large Beaded Bracelet',
                'description' => 'Chunky black and gold African beaded bracelet with bold alternating pattern. Larger profile for a statement look. Handcrafted with precision beadwork.',
                'price' => 18.99,
                'stock' => 25,
                'category' => 'african-bracelets',
                'images' => ['43.jpg'],
            ],
            [
                'name' => 'Black & White Spiral Beaded Bracelet',
                'description' => 'Striking black and white beaded bracelet with spiral pattern design. Opens with snap closure. Modern geometric African beadwork.',
                'price' => 16.99,
                'stock' => 25,
                'category' => 'african-bracelets',
                'images' => ['46.jpg'],
            ],
            [
                'name' => 'Red Multicolor Spiral Beaded Bracelet',
                'description' => 'Bold red beaded bracelet with multicolored spiral accents in green, yellow, white and blue. Traditional African roll-on style.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['48.jpg'],
            ],
            [
                'name' => 'Blue Multicolor Beaded Bracelet',
                'description' => 'Deep royal blue African roll-on bracelet with vibrant multicolored tribal patterns in red, green, yellow and gold. Traditional handcrafted beadwork.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['54.jpg'],
            ],
            [
                'name' => 'Black & White Geometric Beaded Bracelet',
                'description' => 'Classic black and white beaded roll-on bracelet featuring bold geometric patterns. Timeless African design that complements any outfit.',
                'price' => 14.99,
                'stock' => 30,
                'category' => 'african-bracelets',
                'images' => ['55.jpg'],
            ],
            [
                'name' => 'African Beaded Bracelets Set - Blue',
                'description' => 'Set of 3 handcrafted African beaded bracelets in vibrant royal blue with multicolored traditional geometric patterns. Each piece is unique and made by skilled artisans.',
                'price' => 35.99,
                'stock' => 20,
                'category' => 'african-bracelets',
                'images' => ['blue.jpg'],
            ],
            [
                'name' => 'African Beaded Bracelets Set - Orange',
                'description' => 'Set of 4 handcrafted African beaded bracelets in warm orange with multicolored tribal geometric patterns. Authentic artisan craftsmanship.',
                'price' => 35.99,
                'stock' => 20,
                'category' => 'african-bracelets',
                'images' => ['brown.jpg'],
            ],
            [
                'name' => 'African Beaded Bracelets Set - Green',
                'description' => 'Set of 4 handcrafted African beaded bracelets in vibrant green with multicolored traditional geometric patterns. Each piece is unique and made by skilled artisans.',
                'price' => 35.99,
                'stock' => 20,
                'category' => 'african-bracelets',
                'images' => ['green.jpg'],
            ],
            [
                'name' => 'African Beaded Bracelets Set - Yellow',
                'description' => 'Set of 3 handcrafted African beaded bracelets in vibrant yellow with multicolored tribal patterns. Bold statement accessories that celebrate African heritage.',
                'price' => 32.99,
                'stock' => 20,
                'category' => 'african-bracelets',
                'images' => ['purple.jpg'],
            ],

            // AFRICAN CUFF BRACELETS (rigid/wide)
            [
                'name' => 'Red Multicolor Beaded Cuff Bracelet',
                'description' => 'Wide rigid cuff bracelet covered in vibrant red beadwork with blue, yellow, white and turquoise chevron pattern. Handcrafted African tribal design on leather base.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['37.jpg', '38.jpg'],
            ],
            [
                'name' => 'Blue Multicolor Beaded Cuff Bracelet',
                'description' => 'Wide rigid cuff bracelet with royal blue beadwork featuring multicolored diamond and zigzag patterns in orange, green, yellow and red. Handcrafted on leather base.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['39.jpg', '40.jpg'],
            ],
            [
                'name' => 'Orange Beaded Cuff Bracelet',
                'description' => 'Bright orange beaded cuff bracelet with traditional African medallion pattern featuring blue, white, yellow and green accents. Intricate handcrafted beadwork on leather.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['41.jpg', '42.jpg'],
            ],
            [
                'name' => 'Black & Gold Beaded Cuff Bracelet',
                'description' => 'Sophisticated black and gold beaded cuff bracelet with horizontal stripe pattern. Elegant design perfect for formal occasions. Handcrafted on leather base.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['44.jpg', '45.jpg'],
            ],
            [
                'name' => 'Black & White Beaded Cuff Bracelet',
                'description' => 'Classic black and white beaded cuff bracelet with bold geometric crown/arrow pattern. Timeless design handcrafted on leather base.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['47.jpg'],
            ],
            [
                'name' => 'Red Multicolor Mosaic Beaded Cuff Bracelet',
                'description' => 'Colorful red cuff bracelet with multicolored mosaic-style beadwork in green, yellow, white, blue and orange. Vibrant handcrafted piece on leather base.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['49.jpg'],
            ],
            [
                'name' => 'Yellow Beaded Cuff Bracelet',
                'description' => 'Bright yellow beaded cuff bracelet with multicolor floral/geometric pattern in blue, red, green and gold accents. Cheerful handcrafted African design.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-cuff-bracelets',
                'images' => ['50.jpg', '51.jpg'],
            ],

            // AFRICAN EARRINGS
            [
                'name' => 'Yellow Beaded Dreamcatcher Earrings - Large',
                'description' => 'Large circular beaded earrings in vibrant yellow with multicolored center mandala pattern and long beaded fringe. Handcrafted African statement earrings.',
                'price' => 29.99,
                'stock' => 20,
                'category' => 'african-earrings',
                'images' => ['36.jpg'],
            ],
            [
                'name' => 'Yellow Beaded Dreamcatcher Earrings - Small',
                'description' => 'Circular beaded earrings in yellow with colorful center wheel pattern and shorter beaded fringe. Handmade African artisan earrings, lighter version.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'african-earrings',
                'images' => ['56.jpg'],
            ],
            [
                'name' => 'White & Black Beaded Dreamcatcher Earrings',
                'description' => 'Elegant white beaded circular earrings with black spiral center pattern and long white and black fringe. Classic monochrome African beaded design.',
                'price' => 27.99,
                'stock' => 20,
                'category' => 'african-earrings',
                'images' => ['57.jpg'],
            ],
            [
                'name' => 'Blue Beaded Loop Earrings',
                'description' => 'Bold navy blue beaded circular earrings with red, yellow and white center medallion design and flowing blue beaded loop fringe. Unique artisan craftsmanship.',
                'price' => 27.99,
                'stock' => 20,
                'category' => 'african-earrings',
                'images' => ['60.jpg'],
            ],

            // AFRICAN HATS
            [
                'name' => 'Black Beaded Traditional Hat with Silver Accents',
                'description' => 'Stunning black traditional African hat adorned with intricate white and silver beaded patterns. Comes with matching beaded drop earrings. A regal ceremonial headpiece.',
                'price' => 94.99,
                'stock' => 10,
                'category' => 'african-hats',
                'images' => ['0.png', '1.png'],
            ],
            [
                'name' => 'Yellow Beaded Traditional Hat with Earrings',
                'description' => 'Vibrant yellow woven traditional African hat with colorful beaded panel and matching beaded fringe earrings. A complete statement set for special occasions.',
                'price' => 99.99,
                'stock' => 8,
                'category' => 'african-hats',
                'images' => ['orange-1.jpg'],
            ],
            [
                'name' => 'White Beaded Traditional Hat with Gold Fringe',
                'description' => 'Elegant white woven traditional African hat adorned with gold beaded triangle patterns and delicate gold bead fringe. A stunning ceremonial headpiece.',
                'price' => 89.99,
                'stock' => 10,
                'category' => 'african-hats',
                'images' => ['white-1.jpg'],
            ],

            // BRACELET COLLECTIONS (display images)
            [
                'name' => 'African Beaded Bracelet Collection - Round',
                'description' => 'Curated collection of handcrafted African round roll-on beaded bracelets in assorted vibrant colors and traditional patterns. Mix and match to create your perfect stack.',
                'price' => 12.99,
                'stock' => 50,
                'category' => 'african-bracelets',
                'images' => ['35.jpg'],
            ],
            [
                'name' => 'African Beaded Bracelet Collection - Cuff',
                'description' => 'Curated collection of handcrafted African wide cuff beaded bracelets in assorted colors and patterns. Round roll-on and rigid cuff styles available.',
                'price' => 22.99,
                'stock' => 50,
                'category' => 'african-cuff-bracelets',
                'images' => ['53.jpg'],
            ],
        ];

        foreach ($products as $productData) {
            $images = $productData['images'];
            $categorySlug = $productData['category'];
            unset($productData['images'], $productData['category']);

            $productData['slug'] = Str::slug($productData['name']);
            $productData['category_id'] = $categoryModels[$categorySlug]->id;
            $productData['image'] = 'products/' . $images[0];

            $product = Product::create($productData);

            foreach ($images as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => 'products/' . $image,
                    'is_primary' => $index === 0,
                ]);
            }
        }
    }
}
