<?php

namespace App\Orchid\Screens\Banner;

use App\Models\Banner;
use Illuminate\Http\Request;
use Orchid\Alert\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BannerEditScreen extends Screen
{
    /**
     * @var Banner
     */
    public $banner;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Banner $banner): iterable
    {
        return [
            'banner' => $banner
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->banner->exists ? 'Edit banner' : 'Creating a new banner';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create banner')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->banner->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->banner->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->banner->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('banner.file_name')
                    ->type('text')
                    ->title('File name'),

                Upload::make('banner.thumb')
                    ->title('Thumbnail')
                    ->acceptedFiles('image/*')
                    ->maxFiles(1)
            ])
        ];
    }

    /**
     * @param Banner $banner
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Banner $banner, Request $request)
    {
        dd($request->get('banner'));
        $banner->fill($request->get('banner'))->save();

//        Alert::info('You have successfully created a banner.');

        return redirect()->route('platform.banner.list');
    }

    /**
     * @param Banner $banner
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Banner $banner)
    {
        $banner->delete();

        Alert::info('You have successfully deleted the banner.');

        return redirect()->route('platform.banner.list');
    }
}
