<?php

namespace App\Providers;

use Illuminate\
    {
        Support\Facades\DB,
        Support\Collection,
        Support\ServiceProvider,
        Pagination\LengthAwarePaginator
    };

use App\Models\Font;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Cache::flush('generalsettings');
        view()->composer('*',function($settings){

            $settings->with('gs', cache()->remember('generalsettings', now()->addDay(), function () {
                return DB::table('generalsettings')->first();
            }));

            $settings->with('ps', cache()->remember('pagesettings', now()->addDay(), function () {
                return DB::table('pagesettings')->first();
            }));

            $settings->with('seo', cache()->remember('seotools', now()->addDay(), function () {
                return DB::table('seotools')->first();
            }));

            $settings->with('default_font', cache()->remember('default_font', now()->addDay(), function () {
                return Font::whereIsDefault(1)->first();
            }));

        });
    }

    public function register()
    {
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
