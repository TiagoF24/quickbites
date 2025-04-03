<x-quickbites-layout>
    <!-- Breadcrumb com estilo melhorado -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="bi bi-house-door"></i>
                        Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('receitas.index') }}" class="text-decoration-none"><i
                            class="bi bi-journal-text"></i> Receitas</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">{{ $receita->receita_titulo }}</li>
            </ol>
        </nav>
    </div>

    <!-- Alertas com animação de fade -->
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-octagon-fill me-2"></i> Por favor, corrija os seguintes erros:
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <!-- Seção de Detalhes da Receita com Design Melhorado -->
    <section class="receita-details section py-5">
        <div class="container">
            <div id="printTable" class="bg-white rounded-3 shadow-sm p-4">
                <div class="row g-4">
                    <!-- Imagem da Receita com Efeitos -->
                    <div class="col-lg-6">
                        <div class="receita-image position-relative overflow-hidden rounded-3 shadow">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}"
                                class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $receita->receita_titulo }}"
                                style="max-height: 500px;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                style="background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);">
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-bookmark-fill"></i> {{ $receita->categoria }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Informações da Receita com Layout Melhorado -->
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold mb-3 text-primary">{{ $receita->receita_titulo }}</h1>

                        <!-- Autor com Layout Melhorado -->
                        <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                            @php
                            $autor = App\Models\User::find($receita->autor_id);
                            @endphp

                            @if($autor && $autor->profile_photo)
                            <img src="{{ asset('storage/' . $autor->profile_photo) }}" alt="{{ $autor->name }}"
                                class="rounded-circle border border-3 border-white shadow-sm"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 50px; height: 50px; font-size: 20px;">
                                {{ strtoupper(substr($autor->name ?? 'A', 0, 1)) }}
                            </div>
                            @endif

                            <div class="ms-3">
                                <p class="mb-0 text-muted">Criado por</p>
                                <a href="{{ route('profile.show', ['user' => $receita->autor_id]) }}"
                                    class="fw-bold text-decoration-none">
                                    {{ $autor->name ?? 'Autor Desconhecido' }}
                                </a>
                            </div>
                        </div>

                        <!-- Descrição com Estilo -->
                        <div class="mb-4 receita-description">
                            <p class="lead">{{ $receita->receita_descricao }}</p>
                        </div>

                        <!-- Metadados com Ícones Coloridos -->
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-4">
                                <div class="p-3 rounded-3 h-100 bg-light text-center">
                                    <i class="bi bi-alarm-fill fs-3" style="color: #ff6600"></i>
                                    <p class="mb-0 mt-2"><strong>Tempo</strong></p>
                                    <p class="mb-0">{{ $receita->receita_duracao }} min</p>
                                </div>
                            </div>

                            @if ($receita->porcoes)
                            <div class="col-6 col-md-4">
                                <div class="p-3 rounded-3 h-100 bg-light text-center">
                                    <i class="bi bi-people-fill fs-3" style="color: #1bc70c"></i>
                                    <p class="mb-0 mt-2"><strong>Porções</strong></p>
                                    <p class="mb-0">{{ $receita->porcoes }}</p>
                                </div>
                            </div>
                            @endif

                            @if ($receita->nivel_dificuldade)
                            <div class="col-6 col-md-4">
                                <div class="p-3 rounded-3 h-100 bg-light text-center">
                                    <i class="bi bi-bar-chart-fill fs-3" style="color: #1068ec"></i>
                                    <p class="mb-0 mt-2"><strong>Dificuldade</strong></p>
                                    <p class="mb-0">{{ $receita->nivel_dificuldade }}</p>
                                </div>
                            </div>
                            @endif

                            @if ($receita->calorias)
                            <div class="col-6 col-md-4">
                                <div class="p-3 rounded-3 h-100 bg-light text-center">
                                    <i class="bi bi-fire fs-3" style="color: #ff3b3b"></i>
                                    <p class="mb-0 mt-2"><strong>Calorias</strong></p>
                                    <p class="mb-0">{{ $receita->calorias }} cal</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Avaliação com Estrelas Animadas -->
                        <div class="mb-4 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="d-block fw-bold text-center" style="font-size: 24px;">
                                        {{ number_format($receita->getAverageRatingAttribute(), 1) }}
                                    </span>
                                    <span class="text-muted small">de 5</span>
                                </div>
                                <div>
                                    <div class="text-warning mb-1">
                                        @for ($i = 1; $i <= 5; $i++) @if ($i <=round($receita->
                                            getAverageRatingAttribute()))
                                            <i class="bi bi-star-fill"></i>
                                            @else
                                            <i class="bi bi-star"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <span class="text-muted small">{{ $receita->ratings->count() }} avaliações</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação com Estilo Melhorado -->
                        <div class="d-flex flex-wrap gap-2">
                            @auth
                            <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="btn {{ $receita->isFavoritedByUser(Auth::id()) ? 'btn-danger' : 'btn-outline-danger' }} btn-lg">
                                    <i
                                        class="bi {{ $receita->isFavoritedByUser(Auth::id()) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                    {{ $receita->isFavoritedByUser(Auth::id()) ? 'Favoritado' : 'Favoritar' }}
                                </button>
                            </form>
                            @endauth

                            <div class="btn-group">
                                <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-share"></i> Partilhar
                                </button>
                                <ul class="dropdown-menu shadow">
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            target="_blank">
                                            <i class="bi bi-facebook text-primary"></i> Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode('🍽️ Descobre esta receita deliciosa! ' . $receita->receita_titulo . ' 😍 Vê aqui:') }}"
                                            target="_blank">
                                            <i class="bi bi-twitter-x text-dark"></i> X
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://api.whatsapp.com/send?text={{ urlencode('😋 Tens de experimentar esta receita! ' . $receita->receita_titulo . ' 👉 ' . url()->current()) }}"
                                            target="_blank">
                                            <i class="bi bi-whatsapp text-success"></i> WhatsApp
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn btn-outline-secondary btn-lg" onclick="window.print()">
                                <i class="bi bi-printer"></i> Imprimir
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Conteúdo da Receita com Tabs -->
                <div class="mt-5">
                    <ul class="nav nav-tabs" id="receitaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold" id="ingredientes-tab" data-bs-toggle="tab"
                                data-bs-target="#ingredientes-tab-pane" type="button" role="tab"
                                aria-controls="ingredientes-tab-pane" aria-selected="true">
                                <i class="bi bi-cart3"></i> Ingredientes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="preparo-tab" data-bs-toggle="tab"
                                data-bs-target="#preparo-tab-pane" type="button" role="tab"
                                aria-controls="preparo-tab-pane" aria-selected="false">
                                <i class="bi bi-list-ol"></i> Modo de Preparo
                            </button>
                        </li>
                        @if ($receita->dicas)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="dicas-tab" data-bs-toggle="tab"
                                data-bs-target="#dicas-tab-pane" type="button" role="tab" aria-controls="dicas-tab-pane"
                                aria-selected="false">
                                <i class="bi bi-lightbulb"></i> Dicas
                            </button>
                        </li>
                        @endif
                    </ul>

                    <div class="tab-content p-4 border border-top-0 rounded-bottom" id="receitaTabsContent">
                        <!-- Ingredientes -->
                        <div class="tab-pane fade show active" id="ingredientes-tab-pane" role="tabpanel"
                            aria-labelledby="ingredientes-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <ul class="list-group list-group-flush">
                                        @foreach (explode("\n", $receita->ingredientes) as $ingrediente)
                                        @if (trim($ingrediente))
                                        <li class="list-group-item d-flex align-items-center py-3">
                                            <i class="bi bi-check2-circle text-success me-3 fs-5"></i>
                                            <span>{{ trim($ingrediente) }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Modo de Preparo -->
                        <div class="tab-pane fade" id="preparo-tab-pane" role="tabpanel" aria-labelledby="preparo-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <ol class="list-group list-group-numbered">
                                        @foreach (explode("\n", $receita->modo_preparo) as $index => $passo)
                                        @if (trim($passo))
                                        <li class="list-group-item d-flex py-3 border-0 border-bottom">
                                            <div>
                                                <h6 class="fw-bold mb-2">Passo {{ $index + 1 }}</h6>
                                                <p class="mb-0">{{ trim($passo) }}</p>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- Dicas -->
                        @if ($receita->dicas)
                        <div class="tab-pane fade" id="dicas-tab-pane" role="tabpanel" aria-labelledby="dicas-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-lightbulb-fill text-warning fs-1 me-3"></i>
                                                <h5 class="card-title mb-0 fw-bold">Dicas do Chef</h5>
                                            </div>
                                            <div class="card-text">
                                                {!! nl2br(e($receita->dicas)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Receitas Relacionadas com Cards Modernos -->
            @if ($receitasRelacionadas->count() > 0)
            <div class="mt-5">
                <h3 class="display-6 mb-4 text-center position-relative">
                    <span class="position-relative px-4 bg-white">
                        Receitas Relacionadas
                        <span class="position-absolute start-50 translate-middle-x bottom-0"
                            style="width: 80px; height: 3px; background-color: #ffb03b;"></span>
                    </span>
                </h3>

                <div class="row g-4">
                    @foreach ($receitasRelacionadas as $related)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $related->receita_foto) }}" class="card-img-top"
                                    alt="{{ $related->receita_titulo }}" style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary">{{ $related->categoria }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $related->receita_titulo }}</h5>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small">
                                        <i class="bi bi-alarm"></i> {{ $related->receita_duracao }} min
                                    </span>
                                    <span class="text-muted small">
                                        <i class="bi bi-bar-chart"></i> {{ $related->nivel_dificuldade }}
                                    </span>
                                </div>
                                <p class="card-text text-truncate">{{ $related->receita_descricao }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="{{ route('receitas.show', $related->id) }}" class="btn btn-warning w-100">
                                    <i class="bi bi-eye"></i> Ver Receita
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Seção de Avaliações com Design Moderno -->
            <div class="my-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pt-4">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-star-half text-warning me-2"></i>
                            Avaliações dos Usuários
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($receita->ratings->count() > 0)
                        <div class="ratings-list">
                            @foreach ($receita->ratings as $rating)
                            <div class="p-3 mb-3 border-bottom rating-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        @php
                                        $ratingUser = \App\Models\User::find($rating->user_id);
                                        @endphp

                                        @if($ratingUser && $ratingUser->profile_photo)
                                        <img src="{{ asset('storage/' . $ratingUser->profile_photo) }}"
                                            alt="{{ $ratingUser->name }}" class="rounded-circle me-3"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($ratingUser->name ?? 'U', 0, 1)) }}
                                        </div>
                                        @endif

                                        <div>
                                            <strong>{{ $ratingUser->name }}</strong>
                                            <div class="d-flex align-items-center">
                                                <div class="text-warning me-2">
                                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating->rating)
                                                        <i class="bi bi-star-fill"></i>
                                                        @else
                                                        <i class="bi bi-star"></i>
                                                        @endif
                                                        @endfor
                                                </div>
                                                <span
                                                    class="text-muted small">{{ $rating->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botão de exclusão para o próprio usuário -->
                                    @if(auth()->check() && auth()->id() == $rating->user_id)
                                    <div>
                                        <form
                                            action="{{ route('receitas.delete-rating', ['receita' => $receita->id, 'rating' => $rating->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')"
                                                data-bs-toggle="tooltip" data-bs-title="Excluir avaliação">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>

                                @if ($rating->comment)
                                <div class="mt-3 p-3 bg-light rounded">
                                    <p class="mb-0">{{ $rating->comment }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-square-text text-muted display-1"></i>
                            <p class="mt-3 text-muted">Esta receita ainda não possui avaliações.</p>
                            @auth
                            <p>Seja o primeiro a avaliar!</p>
                            @endauth
                        </div>
                        @endif

                        <!-- Formulário de Avaliação com Design Moderno -->
                        @auth
                        <div class="mt-4 rating-form">
                            <div class="card border bg-light">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Avalie esta receita
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('receitas.rate', $receita->id) }}" method="POST"
                                        data-receita-id="{{ $receita->id }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Sua avaliação:</label>
                                            <div class="rating-stars d-flex flex-wrap gap-3">
                                                @php
                                                $userRating = $receita->ratings->where('user_id',
                                                auth()->id())->first();
                                                $currentRating = $userRating ? $userRating->rating : 0;
                                                @endphp

                                                @for ($i = 1; $i <= 5; $i++) <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating{{ $i }}" value="{{ $i }}"
                                                        {{ $currentRating == $i ? 'checked' : '' }}>
                                                    <label class="form-check-label d-flex align-items-center"
                                                        for="rating{{ $i }}">
                                                        <span class="text-warning me-1">
                                                            @for ($j = 1; $j <= 5; $j++) @if ($j <=$i) <i
                                                                class="bi bi-star-fill"></i>
                                                                @else
                                                                <i class="bi bi-star"></i>
                                                                @endif
                                                                @endfor
                                                        </span>
                                                        <span class="ms-2">{{ $i }}
                                                            {{ $i == 1 ? 'estrela' : 'estrelas' }}</span>
                                                    </label>
                                            </div>
                                            @endfor
                                        </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label fw-bold">Comentário sobre a receita
                                        (opcional)</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"
                                        placeholder="Compartilhe sua experiência com esta receita...">{{ $userRating ? $userRating->comment : '' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i>
                                    {{ $userRating ? 'Atualizar' : 'Enviar' }} Avaliação
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                            <p class="mb-0">
                                <a href="{{ route('login') }}" class="alert-link">Faça login</a> para avaliar esta
                                receita.
                            </p>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Scripts específicos para esta página -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips do Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
            tooltipTriggerEl));

        // Favorite button functionality
        const favoriteButtons = document.querySelectorAll('.favorite-button');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const receitaId = this.dataset.receitaId;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')
                    .getAttribute('content');

                fetch(`/receitas/${receitaId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update button appearance
                        if (data.favorited) {
                            this.innerHTML = '<i class="bi bi-heart-fill"></i> Favoritado';
                            this.classList.remove('btn-outline-danger');
                            this.classList.add('btn-danger');
                        } else {
                            this.innerHTML = '<i class="bi bi-heart"></i> Favoritar';
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-outline-danger');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Rating form functionality
        const ratingForm = document.querySelector('.rating-form form');
        if (ratingForm) {
            ratingForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Verificar se o atributo data-receita-id existe
                const receitaId = this.dataset.receitaId || this.action.split('/').filter(Boolean)
            .pop();

                const formData = new FormData(this);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                fetch(`/receitas/${receitaId}/rate`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update average rating display
                        const ratingDisplay = document.querySelector('.rating-display');
                        if (ratingDisplay) {
                            // Update stars and average rating
                            const starsHtml = Array(5).fill(0).map((_, i) =>
                                i < Math.round(data.average) ?
                                '<i class="bi bi-star-fill"></i>' :
                                '<i class="bi bi-star"></i>'
                            ).join('');

                            ratingDisplay.innerHTML = `
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="d-block fw-bold text-center" style="font-size: 24px;">
                                        ${data.average.toFixed(1)}
                                    </span>
                                    <span class="text-muted small">de 5</span>
                                </div>
                                <div>
                                    <div class="text-warning mb-1">
                                        ${starsHtml}
                                    </div>
                                    <span class="text-muted small">${data.count} avaliações</span>
                                </div>
                            </div>
                        `;
                        }

                        // Mostrar mensagem de sucesso com animação
                        const successMessage = document.createElement('div');
                        successMessage.className =
                            'alert alert-success alert-dismissible fade show mt-3';
                        successMessage.innerHTML = `
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Avaliação salva com sucesso!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                        const formContainer = document.querySelector('.rating-form');
                        formContainer.insertBefore(successMessage, ratingForm);

                        // Atualizar a lista de avaliações sem recarregar a página
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Mostrar mensagem de erro
                        const errorMessage = document.createElement('div');
                        errorMessage.className =
                            'alert alert-danger alert-dismissible fade show mt-3';
                        errorMessage.innerHTML = `
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Ocorreu um erro ao salvar sua avaliação. Por favor, tente novamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                        const formContainer = document.querySelector('.rating-form');
                        formContainer.insertBefore(errorMessage, ratingForm);
                    });
            });
        }

        // Animação suave para os tabs
        const tabLinks = document.querySelectorAll('.nav-link');
        tabLinks.forEach(tabLink => {
            tabLink.addEventListener('click', function() {
                const targetId = this.getAttribute('data-bs-target');
                const targetPane = document.querySelector(targetId);

                if (targetPane) {
                    targetPane.style.opacity = '0';
                    setTimeout(() => {
                        targetPane.style.transition = 'opacity 0.3s ease-in-out';
                        targetPane.style.opacity = '1';
                    }, 150);
                }
            });
        });

        // Efeito hover para os cards de receitas relacionadas
        const receitaCards = document.querySelectorAll('.hover-shadow');
        receitaCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow');
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow');
                this.style.transform = 'translateY(0)';
            });
        });
    });

    // Adicionar estilos CSS personalizados
    const customStyles = document.createElement('style');
    customStyles.textContent = `
        .transition-all {
            transition: all 0.3s ease;
        }
        
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .receita-image img {
            transition: transform 0.5s ease;
        }
        
        .receita-image:hover img {
            transform: scale(1.03);
        }
        
        .rating-stars .form-check:hover {
            cursor: pointer;
            transform: scale(1.05);
        }
        
        .tab-pane {
            transition: opacity 0.3s ease-in-out;
        }
        
        /* Estilo para impressão */
        @media print {
            .breadcrumb, .receita-actions, .nav-tabs, #receitaTabsContent, .recipe-ratings, footer, header {
                display: none !important;
            }
            
            .receita-title {
                font-size: 24pt;
                margin-bottom: 10pt;
            }
            
            .receita-meta {
                margin-bottom: 15pt;
            }
            
            .ingredients-section, .instructions-section {
                page-break-inside: avoid;
                margin-top: 15pt;
            }
            
            .ingredients-section h3, .instructions-section h3 {
                font-size: 16pt;
                margin-bottom: 10pt;
            }
            
            .ingredients-list li, .instructions-list li {
                font-size: 12pt;
                margin-bottom: 5pt;
            }
        }
    `;
    document.head.appendChild(customStyles);
    </script>
</x-quickbites-layout>