<?php

namespace App\Orchid\Screens\Product;

use App\Enum\ProducerEnum;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Orchid\Alert\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * @var Product
     */
    public $product;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Edit product' : 'Creating a new product';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('createOrUpdate')
                ->canSee(!$this->product->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $configs = array_filter(Product::distinct()->pluck('config', 'config')->toArray(), function ($value) {
            return !is_null($value);
        });

        array_unshift($configs, $this->product->config);

        $clrs = Color::distinct()->pluck( 'id', 'color')->toArray();
        $colors = [];
        foreach ($clrs as $key => $color){
            $colors[$color] = $key;
        }


        return [
            Layout::rows([
                Group::make([
                    Input::make('product.name')
                        ->title('Name')->required(),
                    Input::make('product.thumb')
                        ->title('Thumb')->required()
                        ->placeholder("Ex: thumb_url, thumb_url, thumb_url")
                ]),

                Group::make([
                    Input::make('product.price')
                        ->title('Price')
                        ->type('number')->required(),
                    Select::make('product.config')
                        ->title('Config')
                        ->options($configs)->required(),
                    Select::make('product.producer')
                        ->title('Producer')->required()
                        ->options(ProducerEnum::values()),
                    Select::make('color.color')
                        ->title('Color')
                        ->options($colors)->required()
                ]),

                Group::make([
                    Input::make('description.ram')
                        ->title('Ram')
                        ->type('text'),
                    Input::make('description.sim')
                        ->title('Khe sim')
                        ->type('text'),
                    Input::make('description.pin')
                        ->title('Dung lượng pin')
                        ->type('text'),
                    Input::make('description.hdh')
                        ->title('Hệ điều hành')
                        ->type('text'),
                    Input::make('description.rom')
                        ->title('Rom')
                        ->type('text'),
                    Input::make('description.chip')
                        ->title('Chip')
                        ->type('text'),
                ]),

                Quill::make('product.detail')->height('1000px')->title('Detail')->required(),
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $product_attr = $request->get('product');
        $color_id = $request->get('color')['color'];
        $description_attr = $request->get('description');
        $description = [
            'RAM' => $description_attr['ram'],
            'Sim' => $description_attr['sim'],
            'Hệ điều hành' => $description_attr['hdh'],
            'Rom' => $description_attr['rom'],
            'Chip' => $description_attr['chip']
        ];
        $name = $product_attr['name'];
        $slug = Str::slug($name);
        $thumb_attr = explode(',', $product_attr['thumb']);
        $thumb = [];
        foreach ($thumb_attr as $val){
            array_push($thumb, trim($val, " "));
        }
        $price = $product_attr['price'];
        $config = $product_attr['config'];
        $producer = $product_attr['producer'];
        $detail = $product_attr['detail'];

        $product = Product::updateOrCreate(
            ['slug' => $slug],
            [
                'name' => $name,
                'slug' => $slug,
                'thumb' => $thumb,
                'price' => $price,
                'config' => $config,
                'description' => $description,
                'detail' => $detail,
                'producer' => $producer,
            ]
        );
        $color = Color::create([
            'product_id' => $product->id,
            'color' => DB::table('colors')->select('color')->where('id', $color_id)->first()->color,
            'price' => $price,
        ]);

        Artisan::call('data:reindex');

        return redirect()->route('platform.shop.products.list');
    }
}
