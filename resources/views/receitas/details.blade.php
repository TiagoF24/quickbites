<x-quickbites-layout>
    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('receitas.index') }}">Receitas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $receita->receita_titulo }}</li>
            </ol>
        </nav>
    </div>

    <!-- receita Details Section -->
    <section class="receita-details section">
        <div class="container">
            <div class="row">
                <!-- receita Image -->
                <div class="col-lg-6">
                    <div class="receita-image mb-4">
                        <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="img-fluid rounded" alt="{{ $receita->receita_titulo }}">
                    </div>
                </div>

                <!-- receita Info -->
                <div class="col-lg-6">
                    <h1 class="receita-title">{{ $receita->receita_titulo }}</h1>
                    <p class="receita-author">por <strong>{{ $receita->autor }}</strong></p>
                    
                    <div class="receita-meta my-4">
                        <span class="meta-item"><i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min</span>
                        <span class="meta-item"><i class="bi bi-bookmark-fill"></i> {{ $receita->categoria }}</span>
                        @if ($receita->porcoes)
                            <span class="meta-item"><i class="bi bi-people-fill"></i> {{ $receita->porcoes }} porções</span>
                        @endif
                        @if ($receita->nivel_dificuldade)
                            <span class="meta-item"><i class="bi bi-bar-chart-fill"></i> {{ $receita->nivel_dificuldade }}</span>
                        @endif
                        @if ($receita->calorias)
                            <span class="meta-item"><i class="bi bi-fire"></i> {{ $receita->calorias }} cal</span>
                        @endif
                    </div>

                    <div class="receita-description mb-4">
                        <p>{{ $receita->receita_descricao }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="receita-actions">
                        <button class="btn btn-warning"><i class="bi bi-printer"></i> Imprimir</button>
                        <button class="btn btn-outline-warning"><i class="bi bi-bookmark-plus"></i> Salvar</button>
                        <button class="btn btn-outline-primary"><i class="bi bi-share"></i> Compartilhar</button>
                    </div>
                </div>
            </div>

            <!-- receita Content -->
            <div class="row mt-5">
                <!-- Ingredients -->
                <div class="col-md-4">
                    <div class="ingredients-section">
                        <h3><i class="bi bi-cart3"></i> Ingredientes</h3>
                        <ul class="ingredients-list">
                            @foreach (explode("\n", $receita->ingredientes) as $ingrediente)
                                @if (trim($ingrediente))
                                    <li>{{ trim($ingrediente) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="col-md-8">
                    <div class="instructions-section">
                        <h3><i class="bi bi-list-ol"></i> Modo de Preparação</h3>
                        <ol class="instructions-list">
                            @foreach (explode("\n", $receita->modo_preparo) as $passo)
                                @if (trim($passo))
                                    <li>{{ trim($passo) }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Tips Section (if available) -->
            @if ($receita->dicas)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="tips-section">
                            <h3><i class="bi bi-lightbulb"></i> Dicas</h3>
                            <div class="tips-content">
                                {!! nl2br(e($receita->dicas)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related receitas -->
            @if ($relatedreceitas->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h3>Receitas Relacionadas</h3>
                    </div>
                    @foreach ($relatedreceitas as $related)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $related->receita_foto) }}" class="card-img-top" alt="{{ $related->receita_titulo }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $related->receita_titulo }}</h5>
                                    <a href="{{ route('receitas.show', $related->id) }}" class="btn btn-sm btn-warning">Ver Receita</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Comments Section (Optional) -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3>Comentários</h3>
                    <!-- Comments form and display would go here -->
                </div>
            </div>
        </div>
    </section>
</x-quickbites-layout>
