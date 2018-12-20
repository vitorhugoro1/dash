<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Busca os valores similares na coluna de acordo com o valor enviado
         *
         * @example collect([['name' => 'buscador']])->whereSimilar('name', 'busca', 70)
         *
         * @author Vitor Hugo <vmerencio@uplexis.com.br>
         */
        Collection::macro('whereSimilar', function (string $column, string $search, int $similarity = 100) {
            return $this->filter(function ($value) use ($column, $search, $similarity) {
                if (!array_has($value, $column)) {
                    return false;
                }
                $field = array_get($value, $column);
                similar_text(mb_strtoupper($field), mb_strtoupper($search), $similar);
                $similar = ceil($similar);
                return $similar >= intval($similarity);
            });
        });

        /**
         * Busca os valores que parecem a palavra buscada, usando str_is
         *
         * @example collect([['name' => 'buscador']])->whereLike('name', 'busc*')
         *
         * @author Vitor Hugo <vmerencio@uplexis.com.br>
         */
        Collection::macro('whereLike', function (string $column, string $search) {
            return $this->filter(function ($value) use ($column, $search) {
                if (!array_has($value, $column)) {
                    return false;
                }
                return str_is($search, array_get($value, $column));
            });
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
