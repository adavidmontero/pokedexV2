<?php

namespace App\ViewModels;

use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class PokemonsViewModel extends ViewModel
{
    public function __construct($page, $pokemons, $type)
    {
        $this->page = $page;
        $this->pokemons = $pokemons;
        $this->type = $type;
    }

    public function previous()
    {
        return $this->page > 0 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 139 ? $this->page + 1 : null;
    }

    public function pokemons()
    {
        return collect($this->pokemons)->map(function($pokemon) {
            return collect($pokemon)->merge([
                'name_f' => Str::replace('-', ' ', $pokemon['name']),
            ]);
        });
    }
}
