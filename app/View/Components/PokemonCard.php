<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PokemonCard extends Component
{
    public $pokemon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pokemon)
    {
        $this->pokemon = $pokemon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pokemon-card');
    }
}
