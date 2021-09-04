@extends('layouts.app')

@section('content')
    <div class="text-center" id="spinner">
        <div class="spinner-border spinner-red" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="d-none" id="main-content">
        <div class="row pt-4">
            <div class="col-md-4">
                <a class="btn btn-sm bg-pokemon-blue text-white d-inline-flex align-items-center"
                    href="/" role="button">
                    <img src="https://img.icons8.com/office/30/000000/pokeball.png" class="mr-2"/>
                    Volver
                </a>
                <hr class="d-md-none">
            </div>
            <div class="col-md-8">
                <form action="{{ route('page.search') }}">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png"/>
                          </span>
                        </div>
                        <input type="search" name="name" id="name" placeholder="Buscar pokémon. Ej: bulbasaur"
                            class="form-control shadow-sm @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>

        <hr>

        <h3>{{ $pokemons->count() }} resultados de la palabra
            <span class="text-pokemon-red">{{ $name }}</span>:
        </h3>

        <hr>

        <div id="accordion" role="tablist" aria-multiselectable="true" class="accordion mb-4">
            @foreach ($pokemons as $pokemon)
                <x-pokemon-card :pokemon="$pokemon" />
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        window.addEventListener('load', () => {

            //setTimeout(loading, 2000);

            loading();

            function loading() {
                document.querySelector('#spinner').className = 'd-none';
                document.querySelector('#main-content').className = 'd-block';
            }
        });

        function show_pokemon(e){
            var pokemon_name = $(e).data('pokemon');
            $.ajax({
                url: "https://whispering-sierra-34881.herokuapp.com/pokemon_info",
                type: 'GET',
                data:
                {
                    pokemon_name: pokemon_name,
                },
                success: function(data)
                {
                    let { image, sprites, types, height, weight, base_experience, abilities, items, stats } = data.pokemon;
                    const mainImage = document.querySelector(`#image-${pokemon_name}`);
                    const spriteB = document.querySelector(`#sprite-b-${pokemon_name}`);
                    const spriteBS = document.querySelector(`#sprite-bs-${pokemon_name}`);
                    const spriteF = document.querySelector(`#sprite-f-${pokemon_name}`);
                    const spriteFS = document.querySelector(`#sprite-fs-${pokemon_name}`);
                    const typesPokemon = document.querySelector(`#types-${pokemon_name}`);
                    const abilitiesPokemon = document.querySelector(`#abilities-${pokemon_name}`);
                    const itemsPokemon = document.querySelector(`#items-${pokemon_name}`);
                    const heightPokemon = document.querySelector(`#height-${pokemon_name}`);
                    const weightPokemon = document.querySelector(`#weight-${pokemon_name}`);
                    const experiencePokemon = document.querySelector(`#experience-${pokemon_name}`);
                    const statsPokemon = document.querySelector(`#stats-${pokemon_name}`);
                    //Imagenes
                    mainImage.setAttribute('src', image);
                    spriteB.setAttribute('src', sprites.back_default);
                    spriteBS.setAttribute('src', sprites.back_shiny);
                    spriteF.setAttribute('src', sprites.front_default);
                    spriteFS.setAttribute('src', sprites.front_shiny);
                    //Datos generales
                    if (typesPokemon.innerHTML.trim() === '') {
                        typesPokemon.innerHTML += types.map(type =>
                            `<span class="badge ${type['type']['name']} px-2 py-1 text-capitalize">
                                ${type['type']['name']}
                            </span>`
                        ).join(' ');
                    }
                    if (abilitiesPokemon.innerHTML.trim() === '') {
                        abilitiesPokemon.innerHTML += abilities.map(ability =>
                            ability
                        ).join(' | ');
                    }
                    if (itemsPokemon.innerHTML.trim() === '') {
                        if (items.length === 0) {
                            itemsPokemon.innerText = 'Sin items';
                        } else {
                            itemsPokemon.innerHTML += items.map(item =>
                                item
                            ).join(' | ');
                        }
                    }
                    heightPokemon.innerText = height;
                    weightPokemon.innerText = weight;
                    experiencePokemon.innerText = base_experience;
                    //Estadísticas
                    if (statsPokemon.innerHTML.trim() === '') {
                        for (stat in stats) {
                            statsPokemon.innerHTML += `
                                <div class="d-flex">
                                    <p class="text-dark text-capitalize font-weight-bold" style="width: 200px;">${stats[stat].name}</p>
                                    <div class="progress font-weight-bold text-capitalize" style="height: 20px; width:100%;">
                                        <div class="progress-bar bg-pokemon-red" role="progressbar" style="width: ${stats[stat].percentage}%"
                                            aria-valuenow="${stats[stat].percentage}" aria-valuemin="0" aria-valuemax="100">
                                            ${stats[stat].value}
                                        </div>
                                    </div>
                                </div>`;
                        }
                    }
                    document.querySelector(`#spinner-info-${pokemon_name}`).className = 'd-none';
                    document.querySelector(`#pokemon-info-${pokemon_name}`).className = 'd-block';
                }
            });
        }
    </script>
@endsection
