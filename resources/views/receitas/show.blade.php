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

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- receita Details Section -->
    <section class="receita-details section">
        <div class="container">
            <div id="printTable">
                <div class="row">
                    <!-- receita Image -->
                    <div class="col-lg-6">
                        <div class="mb-4 receita-image">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="rounded img-fluid"
                                alt="{{ $receita->receita_titulo }}">
                        </div>
                    </div>

                    <!-- receita Info -->
                    <div class="col-lg-6">
                        <h1 class="receita-title">{{ $receita->receita_titulo }}</h1>
                        <p class="receita-author">por <strong>
                                <a href="{{ route('profile.show', $receita->autor_id) }}"
                                    class="text-orange-600 hover:underline">
                                    {{ App\Models\User::find($receita->autor_id)->name }}
                                </a>
                            </strong></p>

                        <div class="my-4 receita-meta">
                            <span class="meta-item" style="color: #ff6600"><i class="bi bi-alarm-fill"></i>
                                {{ $receita->receita_duracao }} min</span>
                            <br>
                            <span class="meta-item" style="color: #0300b8"><i class="bi bi-bookmark-fill"></i>
                                {{ $receita->categoria }}</span>
                            <br>
                            @if ($receita->porcoes)
                                <span class="meta-item" style="color: #1bc70c"><i class="bi bi-people-fill"></i>
                                    {{ $receita->porcoes }} porções</span>
                                <br>
                            @endif
                            @if ($receita->nivel_dificuldade)
                                <span class="meta-item" style="color: #1068ec"><i class="bi bi-bar-chart-fill"></i>
                                    {{ $receita->nivel_dificuldade }}</span>
                                <br>
                            @endif
                            @if ($receita->calorias)
                                <span class="meta-item" style="color: #ff3b3b"><i class="bi bi-fire"></i>
                                    {{ $receita->calorias }} cal</span>
                                <br>
                            @endif

                            <div class="mt-3 rating-display">
                                <span class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($receita->getAverageRatingAttribute()))
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                    ({{ number_format($receita->getAverageRatingAttribute(), 1) }}/5)
                                </span>
                                <small>({{ $receita->ratings->count() }} avaliações)</small>
                                </p>
                            </div>
                        </div>

                        <div class="mb-4 receita-description">
                            <p>{{ $receita->receita_descricao }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="receita-actions">
                            @auth
                                <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $receita->isFavoritedByUser(Auth::id()) ? 'btn-danger' : 'btn-outline-danger' }}">
                                        <i
                                            class="bi {{ $receita->isFavoritedByUser(Auth::id()) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                        {{ $receita->isFavoritedByUser(Auth::id()) ? 'Favoritado' : 'Favoritar' }}
                                    </button>
                                </form>
                            @endauth

                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-share"></i> Partilhar
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            target="_blank">
                                            <i class="bi bi-facebook"></i> Partilha no Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode('🍽️ Descobre esta receita deliciosa! ' . $receita->receita_titulo . ' 😍 Vê aqui:') }}"
                                            target="_blank">
                                            <i class="bi bi-twitter-x"></i> Partilha no X
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="https://api.whatsapp.com/send?text={{ urlencode('😋 Tens de experimentar esta receita! ' . $receita->receita_titulo . ' 👉 ' . url()->current()) }}"
                                            target="_blank">
                                            <i class="bi bi-whatsapp"></i> Envia no WhatsApp
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- receita Content -->
                <div class="mt-5 row">
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
                    <div class="mt-5 row">
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
                <div class="mt-5 row">
                    <div class="col-12">
                        <h3 style="color: #ffb03b">Receitas Relacionadas</h3>
                    </div>
                    @foreach ($receitasRelacionadas as $related)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $related->receita_foto) }}" class="card-img-top"
                                    alt="{{ $related->receita_titulo }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $related->receita_titulo }}</h5>
                                    <a href="{{ route('receitas.show', $related->id) }}"
                                        class="btn btn-sm btn-warning">Ver Receita</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="my-4 recipe-actions">


                <!-- Add this section for ratings and rating comments -->
                <div class="my-5 recipe-ratings">
                    <h4 class="mb-3">Avaliações dos Usuários</h4>

                    @if ($receita->ratings->count() > 0)
                        <div class="ratings-list">
                            @foreach ($receita->ratings as $rating)
                                <div class="p-3 mb-3 border rounded rating-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ \App\Models\User::find($rating->user_id)->name }}</strong>
                                            <div class="text-warning">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating->rating)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                                <span
                                                    class="text-muted ms-2">{{ $rating->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($rating->comment)
                                        <div class="mt-2">
                                            {{ $rating->comment }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Esta receita ainda não possui avaliações.</p>
                    @endif

                    <!-- Rating Form -->
                    @auth
                        <div class="p-3 mt-4 border rounded rating-form">
                            <h5>Avalie esta receita</h5>
                            <form action="{{ route('receitas.rate', $receita->id) }}" method="POST">
                                @csrf
                                <!-- Formulário de Avaliação -->
                                <div class="p-3 mt-4 border rounded rating-form">
                                    <h5>Avalie esta receita</h5>
                                    <form action="{{ route('receitas.rate', $receita->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3 rating-stars">
                                            <div class="gap-2 d-flex">
                                                @for ($i = 5; $i >= 0; $i--)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rating"
                                                            id="rating{{ $i }}" value="{{ $i }}"
                                                            {{ isset($userRating) && $userRating && $userRating->rating == $i ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="rating{{ $i }}">{{ $i }}
                                                            {{ $i == 1 ? 'estrela' : 'estrelas' }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Comentário sobre a receita
                                                (opcional)</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="3">{{ isset($userRating) && $userRating ? $userRating->comment : '' }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                                    </form>
                                </div>
                            @else
                                <p class="mt-3"><a href="{{ route('login') }}">Faça login</a> para avaliar esta
                                    receita.</p>
                            @endauth
                    </div>

                    <!-- Regular comments section (if you have one) should be separate -->
                    <div class="my-5 recipe-comments">
                        <h4 class="mb-3">Comentários</h4>
                        <!-- Your existing comments code here, but make sure it doesn't include rating comments -->
                    </div>

                </div>
    </section>

    <script>
        // Add this to your JavaScript files or include in a script tag

        document.addEventListener('DOMContentLoaded', function() {
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
                    const receitaId = this.dataset.receitaId;
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
                        <p><strong>Avaliação média:</strong>
                            <span class="text-warning">
                                ${starsHtml}
                                (${data.average.toFixed(1)}/5)
                            </span>
                            <small>(${data.count} avaliações)</small>
                        </p>
                    `;
                            }

                            // Show success message
                            const successMessage = document.createElement('div');
                            successMessage.className = 'alert alert-success mt-3';
                            successMessage.textContent = 'Avaliação salva com sucesso!';

                            const formContainer = document.querySelector('.rating-form');
                            formContainer.insertBefore(successMessage, ratingForm);

                            // Remove message after 3 seconds
                            setTimeout(() => {
                                successMessage.remove();
                            }, 3000);
                        })
                        .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
</x-quickbites-layout>
