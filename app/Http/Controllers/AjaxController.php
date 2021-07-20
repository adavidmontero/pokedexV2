<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\ViewModels\PokemonViewModel;

class AjaxController extends Controller
{
    public function pokemon_info(Request $request)
    {
        if($request->ajax())
        {
            $client = new Client();

            $request = new \GuzzleHttp\Psr7\Request('GET', 'https://pokeapi.co/api/v2/pokemon/' . $request->pokemon_name);

            $promise = $client->sendAsync($request)->then(function ($response) {
                return $response->getBody()->getContents();
            });

            $pokemon = json_decode($promise->wait(), true);
            $viewModel = new PokemonViewModel($pokemon);

            return response()->json($viewModel);
        }
    }
}
