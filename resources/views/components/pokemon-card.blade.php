<div class="pokemon-cards">
    <div class="card">
        <h5 class="card-header" role="tab" id="heading{{ $pokemon['name'] }}">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $pokemon['name'] }}" aria-expanded="true" aria-controls="collapse{{ $pokemon['name'] }}"
                class="d-flex justify-content-between align-items-center text-decoration-none text-capitalize a-pokemon-red" data-pokemon="{{ $pokemon['name'] }}" onclick="show_pokemon(this)">
                <span>{{ $pokemon['name_f'] }}</span>
                <i class="fa fa-plus text-right"></i>
            </a>
        </h5>

        <div id="collapse{{ $pokemon['name'] }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $pokemon['name'] }}">
            <div class="text-center my-4" id="spinner-info-{{$pokemon['name']}}">
                <div class="spinner-border spinner-red" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="card-body d-none" id="pokemon-info-{{$pokemon['name']}}">
                <div class="row pt-2">
                    <div class="col-md-4">
                        <h5 class="text-capitalize text-center text-white bg-dark border-pokemon-blue py-2 mx-2">
                            {{ $pokemon['name_f'] }}
                        </h5>
                        <div class="card border-0">
                            <img src="" id="image-{{ $pokemon['name'] }}"
                                class="card-img-top px-4" alt="{{ $pokemon['name'] }} image">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h5 class="text-capitalize text-center text-white bg-dark border-pokemon-blue py-2 mx-2">
                            datos generales
                        </h5>

                        <div class="card border-0 pt-2">
                            <div class="card-body">
                                <div class="d-flex mb-3 pt-1">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Tipo(s)
                                    </span>
                                    <span id="types-{{ $pokemon['name'] }}"></span>
                                </div>

                                <div class="d-flex mb-3">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Altura
                                    </span>
                                    <span class="card-text" id="height-{{ $pokemon['name'] }}"></span>
                                </div>

                                <div class="d-flex mb-3">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Peso
                                    </span>
                                    <span class="card-text" id="weight-{{ $pokemon['name'] }}"></span>
                                </div>

                                <div class="d-flex mb-3">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Experiencia Base
                                    </span>
                                    <span class="card-text"  id="experience-{{ $pokemon['name'] }}"></span>
                                </div>

                                <div class="d-flex mb-3">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Habilidad(es)
                                    </span>
                                    <span class="card-text text-capitalize" id="abilities-{{ $pokemon['name'] }}"></span>
                                </div>
                                <div class="d-flex mb-3">
                                    <span class="text-dark font-weight-bold" style="width: 200px;">
                                        Item(s)
                                    </span>
                                    <span class="card-text text-capitalize" id="items-{{ $pokemon['name'] }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-4">
                        <h5 class="text-capitalize text-center text-white bg-dark border-pokemon-blue py-2 mx-2">
                            sprites
                        </h5>

                        <div class="card border-0 rounded font-weight-bold py-1">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <img src="" alt="{{ $pokemon['name']  }}'s sprite"
                                        class="d-block mx-auto" id="sprite-b-{{ $pokemon['name'] }}">
                                    <p class="text-center">Back</p>
                                </div>
                                <div>
                                    <img src="" alt="{{ $pokemon['name']  }}'s sprite"
                                        class="d-block mx-auto" id="sprite-bs-{{ $pokemon['name'] }}">
                                    <p class="text-center">Back Shiny</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <img src="" alt="{{ $pokemon['name']  }}'s sprite"
                                        class="d-block mx-auto" id="sprite-f-{{ $pokemon['name'] }}">
                                    <p class="text-center">Front</p>
                                </div>
                                <div>
                                    <img src="" alt="{{ $pokemon['name']  }}'s sprite"
                                        class="d-block mx-auto"  id="sprite-fs-{{ $pokemon['name'] }}">
                                    <p class="text-center">Front Shiny</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h5 class="text-capitalize text-center text-white bg-dark border-pokemon-blue py-2 mx-2">
                            estadísticas
                        </h5>

                        <div class="card border-0">
                            <div class="card-body" id="stats-{{ $pokemon['name'] }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
