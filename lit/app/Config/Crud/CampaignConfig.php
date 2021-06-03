<?php

namespace Lit\Config\Crud;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\Config\CrudConfig;
use Illuminate\Support\Str;

use App\Models\Campaign;
use Lit\Http\Controllers\Crud\CampaignController;

class CampaignConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Campaign::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = CampaignController::class;

    /**
     * Model singular and plural name.
     *
     * @param Campaign|null campaign
     * @return array
     */
    public function names(Campaign $campaign = null)
    {
        return [
            'singular' => 'Campaign',
            'plural'   => 'Campaigns',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'campaigns';
    }

    /**
     * Build index page.
     *
     * @param \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->table(function ($table) {

            $table->col('Title')->value('{title}')->sortBy('title');

        })->search('title');
    }

    /**
     * Setup show page.
     *
     * @param \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->group(function($page) {
            $page->card(function($form) use ($page) {
                $page->info('General')->text('General Campaign Info');

                $form->input('title')
                    ->title('Title')
                    ->placeholder('Title')
                    ->hint('The Title is shown at the top of the page.')
                    ->rules('required', 'min:10', 'max:150');

                $form->wysiwyg('description')
                    ->title('Description')
                    ->hint('Campaign description for product');

                $form->input('link')
                    ->title('Link')
                    ->type('url')
                    ->placeholder('link')
                    ->hint('The product link')
                    ->rules('required', 'url');

                $form->wysiwyg('terms')
                    ->title('Terms')
                    ->hint('Campaign terms');
            });


            $page->card(function($form) use($page) {
                $page->info('Rebate Settings')->text('General rebate settings are found here');

                $form->group(function($form) use ($page) {
                    $page->info('Set Prices')->text('set price and rebated prices');
                    $form->input('price')->type('number')->width(6)->creationRules('required');
                    $form->input('rebated_price')->type('number')->width(6)->creationRules('required');
                });

                $form->group(function($form) use ($page) {
                    $page->info('Rebate execution')->text('Set duration and other settings');
                    $form->input('rebates_per_interval')->type('number')->width(6)->creationRules('required');
                    $form->input('rebates_count')->type('number')->width(6)->creationRules('required');
                    $form->select('rebate_interval')->title('Rebate Intervals')->options([
                        'hour' => 'Hourly',
                        'quarter day' => 'Quaterly a day',
                        'half day' => 'Half a day',
                        'full day' => 'Daily',
                    ]);
                });

            });
        })->width(8);

        $page->group(function ($page) {

            $page->card(function ($form) {
                $form->datetime('starts_at')
                    ->title('Starts At')
                    ->onlyDate(false)
                    ->hint('When campaign starts');

                $form->datetime('ends_at')
                    ->title('Ends At')
                    ->onlyDate(false)
                    ->hint('When campaign ends');
            });

            $page->card(function ($form) {
                $form->image('images') // images is the corresponding media collection.
                    ->title('Images')
                    ->hint('Image Collection.')
                    ->maxFiles(5);
            });

        })->width(4);


    }
}





// rebates_per_interval
// rebates_count
// rebate_interval

// starts_at
// ends_at

// images
