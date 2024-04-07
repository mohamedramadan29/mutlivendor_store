<?php

namespace Database\Factories\admin;

use App\Http\Traits\Slug_Trait;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Admin\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    use Slug_Trait;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        $images = [
            'public/admin/images/product_images/1.webp',
            'public/admin/images/product_images/2.webp',
            'public/admin/images/product_images/3.webp',
            'public/admin/images/product_images/4.webp',
            'public/admin/images/product_images/5.webp',
            'public/admin/images/product_images/6.webp',
            'public/admin/images/product_images/7.webp',
            'public/admin/images/product_images/8.webp',
            'public/admin/images/product_images/9.webp',
            'public/admin/images/product_images/10.webp',
            'public/admin/images/product_images/11.webp',
            'public/admin/images/product_images/12.webp',

        ];
        $names = [
            "   عطور ديور سوفاج أو دو تواليت",

            "عطر كريد جرين أيرش تويد",

            "عطر كريد باي افينتوس",

            "عطر كريد الأبيض سلفر ماونتن ووتر",

            "عطر وان مليون باكو رابان",

            "عطر شانيل بور مسيو",

            "عطور بلو دو شانيل أو دو برفيوم",

            "عطر جيفنشي جنتلمان",

            "عطور دولتشي اند غابانا",

            "عطر انفيكتوس إنتنس باكو رابان",

            "عطر ايروس فرزاتشي",

            "عطر اجمل مخلط الشمس",

            "عطور هوجو بوس",

            "عطور فلانتينو الرجالي",

            "جورجيو آرماني كود آيس",

            "عطر هيرميس تيري دي هيرميس",

            "عطر باشا كارتير",

            "عطر بور هوم من جورجيو ارماني",

            "عطر توم فورد عود وود",

            "عطور كوتش بلاتينيوم",

            "عطور دانهيل سينشري",

        ];
        $discounts = [0,10,30,40,50,0,0,60,70,80,90,100];
        return [
            'section_id' => Section::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => 0,
            'admin_id' => 1,
            'vendor_id' => 0,
            'admin_type' => 'Super Admin',
            'name' => $names[array_rand($names)],
            'slug' => $this->CustomeSlug($this->faker->word()),
            'code' => $this->faker->unique()->randomNumber(6),
            'discount' => $discounts[array_rand($discounts)],
            'short_description' => "لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية",
            'description' => "لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.",
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'weight' => 1,
            'image' => $images[array_rand($images)], // Generate a random image URL
            'meta_title' => $this->faker->unique()->word(),
            'meta_description' => 'meta_description',
            'meta_keywords' => 'tag1, tag2',
            'is_feature' => '0',
            'status' => 1
        ];
    }
}
