<?php

namespace App\Orchid\Screens\Product;

use App\Enum\ProducerEnum;
use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
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
            Button::make('Create post')
                ->icon('pencil')
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
        $configs = array_filter(Product::distinct()->pluck('config')->toArray(), function ($value) {
            return !is_null($value);
        });

        array_unshift($configs, $this->product->config);


        return [
            Layout::rows([
                Group::make([
                    Input::make('product.name')
                        ->title('Name'),
                    Input::make('product.slug')
                        ->title('Slug')
                ]),

                Group::make([
                    Input::make('product.price')
                        ->title('Price')
                        ->type('number'),
                    Select::make('product.config')
                        ->title('Config')
                        ->options($configs),
                    Select::make('product.producer')
                        ->title('Producer')
                        ->options(ProducerEnum::values())
                ]),
            ])
        ];
    }
}
