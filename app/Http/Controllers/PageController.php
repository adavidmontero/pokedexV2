<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\ViewModels\PokemonViewModel;
use App\ViewModels\PokemonsViewModel;

class PageController extends Controller
{
    public function index($page = 1)
    {
        //Establecemos el número de pokemons por página, por ahora de manera estática
        //Se podría pedir al usuario el número de pokemons por página
        $limit = 20;

        //Controlamos las páginas de acuerdo a como esta compuesta la API
        if ($page === 1) {
            $page = 0;
        } else {
            $page -= 1;
            $page *= $limit;
        }

        $client = new Client(['base_uri' => 'https://pokeapi.co/']);

        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://pokeapi.co/api/v2/pokemon/?offset=' . $page . '&limit=' . $limit);

        $promise = $client->sendAsync($request)->then(function ($response) {
            return $response->getBody()->getContents();
        });

        $pokemons = json_decode($promise->wait(), true)['results'];

        //Mandamos al viewmodel la variable para la paginación, el array general de pokemons,
        //la respuesta con los pokemons individualizados y el nombre del metodo para diferenciarlo
        $viewModel = new PokemonsViewModel($page, $pokemons, 'index');

        //Enviamos a la vista todo lo que se retorne en el viewModel
        return view('Pages.index', $viewModel);
    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = Str::lower($request->get('name'));

        $client = new Client(['base_uri' => 'https://pokeapi.co/']);

        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=1118');

        $promise = $client->sendAsync($request)->then(function ($response) {
            return $response->getBody()->getContents();
        });

        $pokemons = json_decode($promise->wait(), true)['results'];

        $results = collect($pokemons)->filter(function ($pokemon) use ($name) {
            return Str::contains($pokemon['name'], $name);
        });

        $viewModel = new PokemonsViewModel(1, $results, 'search');

        return view('Pages.search', $viewModel, compact('name'));
    }
}
