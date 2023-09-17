<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class ProductFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'products';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['key', 'search_engine'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder;
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('key')
                ->type('text')
                ->value($this->request->get('key'))
                ->placeholder('Search...')
                ->title('Search products'),
            Select::make('search_engine')
                ->options([
                    'elastic' => 'Elastic',
                    'where' => 'Where',
                    'full_text' => 'Full-Text'
                ])
                ->value($this->request->get('search_engine'))
                ->title('Search Engine')
        ];
    }
}
