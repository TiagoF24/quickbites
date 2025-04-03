<x-quickbites-layout>
    <!-- Menu Section -->
    <section id="menu" class="menu section py-5">
        <!-- Section Title -->
        <div class="container section-title text-center mb-4" data-aos="fade-up">
            <h2 class="display-4 fw-bold">Receitas</h2>
            <p class="lead text-muted">Descubra sabores incríveis para todas as ocasiões</p>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="bi bi-egg-fried"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>

        <!-- Expanded Filter Section -->
        <div class="container mt-4">
            <form method="GET" action="{{ route('receitas.index') }}" class="p-4 bg-light rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0 text-primary"><i class="bi bi-funnel-fill me-2"></i>Filtros</h4>
                    @if(request()->anyFilled(['search', 'category', 'duracao', 'dificuldade', 'calorias']))
                    <a href="{{ route('receitas.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>Limpar filtros
                    </a>
                    @endif
                </div>

                <div class="row g-3">
                    <!-- Pesquisar -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-search me-1"></i>Pesquisar</label>
                        <input type="text" name="search" class="form-control border-warning"
                            placeholder="Nome da receita" value="{{ request()->get('search') }}">
                    </div>

                    <!-- Categoria -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-bookmark-fill me-1"></i>Categoria</label>
                        <select name="category" class="form-select border-warning">
                            <option value="">Todas as categorias</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->nome }}"
                                {{ request()->get('category') == $categoria->nome ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Duração -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-alarm-fill me-1"></i>Duração</label>
                        <select name="duracao" class="form-select border-warning">
                            <option value="">Qualquer duração</option>
                            <option value="<30" {{ request()->get('duracao') == '<30' ? 'selected' : '' }}>Menos de 30
                                min
                            </option>
                            <option value="<60" {{ request()->get('duracao') == '<60' ? 'selected' : '' }}>Menos de 60
                                min
                            </option>
                            <option value=">60" {{ request()->get('duracao') == '>60' ? 'selected' : '' }}>Mais de 60
                                min
                            </option>
                            <option value=">90" {{ request()->get('duracao') == '>90' ? 'selected' : '' }}>Mais de 90
                                min
                            </option>
                            <option value=">120" {{ request()->get('duracao') == '>120' ? 'selected' : '' }}>Mais de 120
                                min</option>
                        </select>
                    </div>

                    <!-- Dificuldade -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i
                                class="bi bi-bar-chart-fill me-1"></i>Dificuldade</label>
                        <select name="dificuldade" class="form-select border-warning">
                            <option value="">Todas as dificuldades</option>
                            @foreach($dificuldades as $dificuldade)
                            <option value="{{ $dificuldade }}"
                                {{ request()->get('dificuldade') == $dificuldade ? 'selected' : '' }}>
                                {{ ucfirst($dificuldade) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Calorias -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold"><i class="bi bi-fire me-1"></i>Calorias</label>
                        <select name="calorias" class="form-select border-warning">
                            <option value="">Qualquer valor calórico</option>
                            <option value="<100" {{ request()->get('calorias') == '<100' ? 'selected' : '' }}>Menos de
                                100
                                kcal</option>
                            <option value="<150" {{ request()->get('calorias') == '<150' ? 'selected' : '' }}>Menos de
                                150
                                kcal</option>
                            <option value=">100" {{ request()->get('calorias') == '>100' ? 'selected' : '' }}>Mais de
                                100
                                kcal</option>
                            <option value=">200" {{ request()->get('calorias') == '>200' ? 'selected' : '' }}>Mais de
                                200
                                kcal</option>
                            <option value=">300" {{ request()->get('calorias') == '>300' ? 'selected' : '' }}>Mais de
                                300
                                kcal</option>
                        </select>
                    </div>

                    <!-- Botão Aplicar -->
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-warning w-100 fw-semibold">
                            <i class="bi bi-funnel me-2"></i>Aplicar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- End Filter Section -->

        <!-- Results Summary -->
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    @if(request()->anyFilled(['search', 'category', 'duracao', 'dificuldade', 'calorias']))
                    <h5 class="text-muted">
                        <i class="bi bi-list-ul me-2"></i>Resultados da pesquisa:
                        <span class="text-primary fw-bold">{{ $receitas->count() }} receitas encontradas</span>
                    </h5>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if(request('search'))
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-search me-1"></i>Pesquisa: {{ request('search') }}
                        </span>
                        @endif
                        @if(request('category'))
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-bookmark-fill me-1"></i>Categoria: {{ request('category') }}
                        </span>
                        @endif
                        @if(request('duracao'))
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-alarm-fill me-1"></i>Duração: {{ request('duracao') }}
                        </span>
                        @endif
                        @if(request('dificuldade'))
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-bar-chart-fill me-1"></i>Dificuldade: {{ request('dificuldade') }}
                        </span>
                        @endif
                        @if(request('calorias'))
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-fire me-1"></i>Calorias: {{ request('calorias') }}
                        </span>
                        @endif
                    </div>
                    @else
                    <h5 class="text-muted">
                        <i class="bi bi-list-ul me-2"></i>Mostrando todas as receitas:
                        <span class="text-primary fw-bold">{{ $receitas->count() }} receitas</span>
                    </h5>
                    @endif
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary active" id="grid-view">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="list-view">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipes List Section -->
        <div class="container mt-3">
            <div class="row g-4" id="recipes-container">
                @forelse ($receitas as $receita)
                <div class="col-md-6 col-lg-4 recipe-item">
                    <div class="card h-100 shadow-sm recipe-card">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="card-img-top"
                                alt="{{ $receita->receita_titulo }}" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning">
                                    <i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min
                                </span>
                            </div>
                            @if($receita->nivel_dificuldade)
                            <div class="position-absolute bottom-0 start-0 m-2">
                                <span
                                    class="badge bg-{{ $receita->nivel_dificuldade == 'Fácil' ? 'success' : ($receita->nivel_dificuldade == 'Médio' ? 'warning' : 'danger') }}">
                                    {{ $receita->nivel_dificuldade }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-bookmark-fill"></i> {{ $receita->categoria }}
                                </span>

                                @php
                                // Obter classificação média
                                $ratings = $receita->ratings ?? collect();
                                $avgRating = $ratings->avg('rating') ?? 0;
                                $ratingCount = $ratings->count() ?? 0;
                                @endphp

                                <div class="d-flex align-items-center">
                                    <div class="me-1">
                                        @for ($i = 1; $i <= 5; $i++) @if ($i <=round($avgRating)) <i
                                            class="bi bi-star-fill text-warning small"></i>
                                            @else
                                            <i class="bi bi-star text-warning small"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <small class="text-muted">({{ $ratingCount }})</small>
                                </div>
                            </div>

                            <h5 class="card-title fw-bold">{{ $receita->receita_titulo }}</h5>

                            <div class="mb-3">
                                <span class="text-muted small">
                                    <i class="bi bi-person-fill me-2"></i> por <strong>{{ $receita->autor }}</strong>
                                </span>
                            </div>


                            <p class="card-text flex-grow-1">{{ Str::limit($receita->receita_descricao, 100) }}</p>

                            <div class="d-flex justify-content-between align-items-center mb-2 recipe-details">
                                @if($receita->porcoes)
                                <span class="text-muted small">
                                    <i class="bi bi-people-fill"></i> {{ $receita->porcoes }} porções
                                </span>
                                @endif

                                @if($receita->calorias)
                                <span class="text-muted small">
                                    <i class="bi bi-fire"></i> {{ $receita->calorias }} kcal
                                </span>
                                @endif
                            </div>

                            <a href="{{ route('receitas.show', $receita->id) }}" class="btn btn-warning w-100 mt-auto">
                                Ver Receita <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center p-5">
                        <i class="bi bi-info-circle fs-1 mb-3"></i>
                        <h4>Nenhuma receita encontrada</h4>
                        <p class="mb-0">Tente ajustar os filtros ou pesquise por outro termo.</p>
                        <div class="mt-4">
                            <a href="{{ route('receitas.index') }}" class="btn btn-outline-warning">
                                <i class="bi bi-arrow-repeat me-2"></i>Ver todas as receitas
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($receitas instanceof \Illuminate\Pagination\LengthAwarePaginator && $receitas->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $receitas->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

        <!-- JavaScript para alternar entre visualizações de grade e lista -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gridViewBtn = document.getElementById('grid-view');
            const listViewBtn = document.getElementById('list-view');
            const recipesContainer = document.getElementById('recipes-container');
            const recipeItems = document.querySelectorAll('.recipe-item');

            // Função para visualização em grade
            gridViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');

                recipesContainer.classList.remove('list-view');

                recipeItems.forEach(item => {
                    item.classList.remove('col-12');
                    item.classList.add('col-md-6', 'col-lg-4');
                });
            });

            // Função para visualização em lista
            listViewBtn.addEventListener('click', function() {
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');

                recipesContainer.classList.add('list-view');

                recipeItems.forEach(item => {
                    item.classList.remove('col-md-6', 'col-lg-4');
                    item.classList.add('col-12');
                });
            });
        });
        </script>

        <!-- CSS para estilização adicional -->
        <style>
        /* Estilo para os cartões de receitas */
        .recipe-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        /* Estilo para visualização em lista */
        #recipes-container.list-view .recipe-card {
            flex-direction: row;
            height: auto !important;
        }

        #recipes-container.list-view .card-img-top {
            width: 30%;
            height: 100% !important;
            border-radius: 10px 0 0 10px;
        }

        #recipes-container.list-view .card-body {
            width: 70%;
        }

        /* Estilo para o divisor personalizado */
        .divider-custom {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider-custom-line {
            width: 100%;
            max-width: 7rem;
            height: 0.25rem;
            background-color: #ffc107;
            border-radius: 1rem;
            border-color: #ffc107;
        }

        .divider-custom-icon {
            font-size: 1.5rem;
            color: #ffc107;
            margin: 0 1rem;
        }

        /* Estilo para os filtros */
        .form-select:focus,
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }

        /* Estilo para a paginação */
        .pagination .page-item.active .page-link {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .pagination .page-link {
            color: #ffc107;
        }

        .pagination .page-link:hover {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            #recipes-container.list-view .recipe-card {
                flex-direction: column;
            }

            #recipes-container.list-view .card-img-top {
                width: 100%;
                border-radius: 10px 10px 0 0;
            }

            #recipes-container.list-view .card-body {
                width: 100%;
            }

            .recipe-details {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .recipe-details span {
                margin-bottom: 0.5rem;
            }
        }
        </style>
    </section><!-- /Menu Section -->
</x-quickbites-layout>