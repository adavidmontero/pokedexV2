@extends('layouts.app')

@section('content')
    <div class="text-center" id="spinner">
        <div class="spinner-border spinner-red" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="d-none" id="main-content">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <form action="{{ route('page.search') }}">
                    <h1 class="display-4">Bienvenido(a) a la Laravel Pokédex</h1>
                    <p class="lead">En esta aplicación podrás visualizar la información de cualquier pokémon. Lets do it!</p>
                    <input type="search" name="name" id="name" placeholder="Nombre del Pokémon. Ej: bulbasaur"
                        class="form-control w-50 mx-auto @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>

        <div id="accordion" role="tablist" aria-multiselectable="true" class="accordion mb-4">
            @foreach ($pokemons as $pokemon)
                <x-pokemon-card :pokemon="$pokemon" />
            @endforeach
        </div>

        <div class="page-load-status my-8">
            <div class="d-flex justify-content-center">
                <div class="infinite-scroll-request spinner-border text-pokemon-red" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="infinite-scroll-last">
                    <img src="{{ asset('images/pikachu.jpg') }}" class="d-block mx-auto rounded rounded-3 shadow border border-light"
                        width="200" height="200" alt="pikachu llorando">
                    <div class="alert alert-dark shadow mt-4" role="alert">
                        ¡Ooops...! Parece que Nintendo no ha sacado más generaciones.
                    </div>
                </div>
                <div class="infinite-scroll-error">
                    <img src="{{ asset('images/rocket.png') }}" class="d-block mx-auto rounded rounded-3 shadow border border-light"
                        width="200" height="200" alt="equipo rocket">
                    <div class="infinite-scroll-error alert alert-danger mt-4" role="alert">
                        ¡Houston tenemos un problema!
                    </div>
                </div>
            </div>
        </div>
        <!-- Paginación -->
        {{-- <div class="d-flex justify-content-between">
            <a href="/offset/{{ $previous }}" class="p-2 border text-decoration-none bg-light">Anterior</a>
            <a href="/offset/{{ $next }}" class="py-2 px-4 border text-decoration-none bg-light">Siguiente</a>
        </div> --}}
    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });

        window.addEventListener('load', () => {

            //setTimeout(loading, 1000);

            loading();

            function loading() {
                document.querySelector('#spinner').className = 'd-none';
                document.querySelector('#main-content').className = 'd-block';
            }
        });

        let elem = document.querySelector('.accordion');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/page/@{{#}}',
            append: '.pokemon-cards',
            status: '.page-load-status'
            //history: false,
        });

        function show_pokemon(e){
            var pokemon_name = $(e).data('pokemon');
            $.ajax({
                url: "{{ route('ajax.pokemon_info') }}",
                method: 'GET',
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
