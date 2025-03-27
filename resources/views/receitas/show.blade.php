<x-quickbites-layout>
    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('receitas.index') }}">Receitas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $receita->receita_titulo }}</li>
            </ol>
        </nav>
    </div>

    <!-- receita Details Section -->
    <section class="receita-details section">
        <div class="container">
            <div id="printTable"> 
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
                    <p class="receita-author">por <strong> 
                        <a href="{{ route('profile.show', $receita->autor_id) }}" class="text-orange-600 hover:underline">
                            {{ App\Models\User::find($receita->autor_id)->name }}
                        </a>
                    </strong></p>
                    
                    <div class="receita-meta my-4">
                        <span class="meta-item" style="color: #ff6600"><i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min</span>
                        <br>
                        <span class="meta-item" style="color: #0300b8"><i class="bi bi-bookmark-fill"></i> {{ $receita->categoria }}</span>
                        <br>
                        @if ($receita->porcoes)
                            <span class="meta-item" style="color: #1bc70c"><i class="bi bi-people-fill"></i> {{ $receita->porcoes }} porções</span>
                            <br>
                        @endif
                        @if ($receita->nivel_dificuldade)
                            <span class="meta-item" style="color: #1068ec"><i class="bi bi-bar-chart-fill"></i> {{ $receita->nivel_dificuldade }}</span>
                            <br>
                        @endif
                        @if ($receita->calorias)
                            <span class="meta-item" style="color: #ff3b3b"><i class="bi bi-fire"></i> {{ $receita->calorias }} cal</span>
                            <br>
                        @endif
                    </div>

                    <div class="receita-description mb-4">
                        <p>{{ $receita->receita_descricao }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="receita-actions">
                        <button class="btn btn-danger"><i class="bi bi-heart"></i> Favoritar</button>
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-share"></i> Partilhar
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="bi bi-facebook"></i> Partilha no Facebook 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode('🍽️ Descobre esta receita deliciosa! ' . $receita->receita_titulo . ' 😍 Vê aqui:') }}" target="_blank">
                                        <i class="bi bi-twitter-x"></i> Partilha no X 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://api.whatsapp.com/send?text={{ urlencode('😋 Tens de experimentar esta receita! ' . $receita->receita_titulo . ' 👉 ' . url()->current()) }}" target="_blank">
                                        <i class="bi bi-whatsapp"></i> Envia no WhatsApp 
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- receita Content -->
            <div class="row mt-5">
                <!-- Ingredients -->
                <div class="col-md-4">
                    <div class="ingredients-section">
                        <h3 style="color: #ffb03b"><i class="bi bi-cart3"></i> Ingredientes</h3>
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
                        <h3 style="color: #ffb03b"><i class="bi bi-list-ol"></i> Modo de Preparo</h3>
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
                            <h3 style="color: #ffb03b"><i class="bi bi-lightbulb"></i> Dicas</h3>
                            <div class="tips-content">
                                {!! nl2br(e($receita->dicas)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

            <!-- Related receitas -->
            @if ($receitasRelacionadas->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h3 style="color: #ffb03b">Receitas Relacionadas</h3>
                    </div>
                    @foreach ($receitasRelacionadas as $related)
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
                    <h3 style="color: #ffb03b">Comentários</h3>
                    <!-- Comments form and display would go here -->
                </div>
            </div>
        </div>
    </section>
</x-quickbites-layout>
