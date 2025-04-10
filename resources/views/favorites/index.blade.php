<x-quickbites-layout>
    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-dark mb-3">Minhas Receitas Favoritas</h1>
                    <p class="lead text-muted mb-4">Sua coleção pessoal de receitas que você salvou para preparar depois.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('receitas.index') }}" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-search me-2"></i>Explorar mais receitas
                        </a>
                        @if($favorites->count() > 0)
                        <button type="button" class="btn btn-outline-secondary px-4 py-2" id="printFavorites">
                            <i class="bi bi-printer me-2"></i>Imprimir lista
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Favorites Content -->
    <section class="py-5">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($favorites->count() > 0)
                <!-- Filtros e Ordenação -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchFavorites" placeholder="Buscar nas suas receitas favoritas...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">
                            <select class="form-select w-auto" id="sortFavorites">
                                <option value="recent">Mais recentes</option>
                                <option value="name">Nome (A-Z)</option>
                                <option value="rating">Melhor avaliadas</option>
                                <option value="duration">Menor tempo de preparo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Grid de Receitas Favoritas -->
                <div class="row g-4" id="favoritesGrid">
                    @foreach ($favorites as $receita)
                    <div class="col-md-6 col-lg-4 favorite-item" 
                         data-name="{{ strtolower($receita->receita_titulo) }}"
                         data-rating="{{ $receita->getAverageRatingAttribute() }}"
                         data-duration="{{ $receita->receita_duracao }}">
                        <div class="card h-100 shadow-sm hover-card">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $receita->receita_foto) }}" 
                                     class="card-img-top" alt="{{ $receita->receita_titulo }}"
                                     style="height: 200px; object-fit: cover;">
                                
                                <!-- Overlay com ações rápidas -->
                                <div class="card-img-overlay d-flex flex-column justify-content-between p-3" 
                                     style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-bookmark-fill me-1"></i> {{ $receita->categoria }}
                                        </span>
                                        <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST" class="favorite-form">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-circle" 
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Remover dos favoritos">
                                                <i class="bi bi-heart-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="text-white">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-alarm-fill me-1"></i>
                                            <small>{{ $receita->receita_duracao }} min</small>
                                            
                                            @if($receita->nivel_dificuldade)
                                            <span class="mx-2">•</span>
                                            <i class="bi bi-bar-chart-fill me-1"></i>
                                            <small>{{ $receita->nivel_dificuldade }}</small>
                                            @endif
                                            
                                            @if($receita->porcoes)
                                            <span class="mx-2">•</span>
                                            <i class="bi bi-people-fill me-1"></i>
                                            <small>{{ $receita->porcoes }} porções</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2">{{ $receita->receita_titulo }}</h5>
                                
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $autor = App\Models\User::find($receita->autor_id);
                                    @endphp
                                    
                                    @if($autor && $autor->profile_photo)
                                        <img src="{{ asset('storage/' . $autor->profile_photo) }}" 
                                             alt="{{ $autor->name }}" class="rounded-circle me-2"
                                             style="width: 24px; height: 24px; object-fit: cover;">
                                    @else
                                        <i class="bi bi-person-circle me-2"></i>
                                    @endif
                                    <small class="text-muted">{{ $autor ? $autor->name : $receita->autor }}</small>
                                </div>
                                
                                <p class="card-text flex-grow-1 text-muted">
                                    {{ Str::limit($receita->receita_descricao, 100) }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($receita->getAverageRatingAttribute()))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1 text-muted">
                                            ({{ number_format($receita->getAverageRatingAttribute(), 1) }})
                                        </span>
                                    </div>
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('receitas.show', $receita->id) }}">
                                                    <i class="bi bi-eye me-2"></i>Ver receita
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="shareRecipe('{{ $receita->receita_titulo }}', '{{ route('receitas.show', $receita->id) }}')">
                                                    <i class="bi bi-share me-2"></i>Compartilhar
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-heart-fill me-2"></i>Remover dos favoritos
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-white border-top-0 text-center">
                                <a href="{{ route('receitas.show', $receita->id) }}" class="btn btn-warning w-100">
                                    <i class="bi bi-journal-text me-2"></i>Ver Receita
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $favorites->links('pagination::bootstrap-5') }}
                </div>
            @else
                <!-- Estado vazio -->
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-heart text-danger" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="mb-3">Tu ainda não tens receitas favoritas</h2>
                        <p class="text-muted mb-4">
                            Explora nossa coleção de receitas e salva as tuas favoritas para acessá-las facilmente depois.
                        </p>
                        <a href="{{ route('receitas.index') }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-search me-2"></i>Explorar Receitas
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal de Compartilhamento -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Compartilhar Receita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-4" id="shareRecipeTitle"></p>
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <a href="#" id="shareFacebook" class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" id="shareTwitter" class="btn btn-outline-dark" target="_blank">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" id="shareWhatsapp" class="btn btn-outline-success" target="_blank">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <button id="copyLink" class="btn btn-outline-secondary">
                            <i class="bi bi-link-45deg"></i>
                        </button>
                    </div>
                    <div class="input-group">
                        <input type="text" id="recipeLink" class="form-control" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="copyLinkBtn">
                            Copiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        .card-img-overlay {
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }
        
        .hover-card:hover .card-img-overlay {
            opacity: 1;
        }
        
        .favorite-form button {
            transition: transform 0.2s ease;
        }
        
        .favorite-form button:hover {
            transform: scale(1.1);
        }
        
        /* Animação para remoção de favoritos */
        .favorite-removing {
            animation: fadeOutUp 0.5s ease forwards;
        }
        
        @keyframes fadeOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
        
        /* Estilos para impressão */
        @media print {
            header, footer, .btn, .dropdown, .pagination, #searchFavorites, #sortFavorites,
            .card-footer, .favorite-form, .card-img-overlay {
                display: none !important;
            }
            
            .card {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
            
            .container {
                width: 100%;
                max-width: 100%;
            }
            
            .col-md-6, .col-lg-4 {
                width: 50%;
                max-width: 50%;
                flex: 0 0 50%;
            }
            
            h1 {
                font-size: 24pt;
                text-align: center;
                margin-bottom: 20pt;
            }
            
            .card-title {
                font-size: 14pt;
            }
            
            .text-muted {
                color: #666 !important;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        
        // Busca em tempo real
        const searchInput = document.getElementById('searchFavorites');
        if (searchInput) {
            searchInput.addEventListener('input', filterFavorites);
        }
        
        // Ordenação de favoritos
        const sortSelect = document.getElementById('sortFavorites');
        if (sortSelect) {
            sortSelect.addEventListener('change', sortFavorites);
        }
        
        // Impressão da lista de favoritos
        const printBtn = document.getElementById('printFavorites');
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                window.print();
            });
        }
        
        // Animação de remoção de favoritos
        const favoriteForms = document.querySelectorAll('.favorite-form');
        favoriteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const favoriteItem = this.closest('.favorite-item');
                favoriteItem.classList.add('favorite-removing');
                
                // Enviar o formulário após a animação
                setTimeout(() => {
                    this.submit();
                }, 500);
            });
        });
        
        // Função para filtrar favoritos
        function filterFavorites() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const favoriteItems = document.querySelectorAll('.favorite-item');
            
            favoriteItems.forEach(item => {
                const recipeName = item.getAttribute('data-name');
                if (recipeName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Mostrar mensagem se nenhum resultado for encontrado
            const noResultsMsg = document.getElementById('noResultsMsg');
            const visibleItems = document.querySelectorAll('.favorite-item[style=""]').length;
            
            if (visibleItems === 0 && searchTerm !== '') {
                if (!noResultsMsg) {
                    const msg = document.createElement('div');
                    msg.id = 'noResultsMsg';
                    msg.className = 'col-12 text-center py-5';
                    msg.innerHTML = `
                        <p class="text-muted">Nenhuma receita encontrada para "${searchTerm}"</p>
                        <button class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('searchFavorites').value = ''; filterFavorites();">
                            <i class="bi bi-x-circle me-2"></i>Limpar busca
                        </button>
                    `;
                    document.getElementById('favoritesGrid').appendChild(msg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }
        
        // Função para ordenar favoritos
        function sortFavorites() {
            const sortBy = sortSelect.value;
            const favoritesGrid = document.getElementById('favoritesGrid');
            const favoriteItems = Array.from(document.querySelectorAll('.favorite-item'));
            
            favoriteItems.sort((a, b) => {
                switch (sortBy) {
                    case 'name':
                        return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                    case 'rating':
                        return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                    case 'duration':
                        return parseInt(a.getAttribute('data-duration')) - parseInt(b.getAttribute('data-duration'));
                    default: // recent - mantém a ordem original
                        return 0;
                }
            });
            
            // Reordenar os elementos no DOM
            favoriteItems.forEach(item => {
                favoritesGrid.appendChild(item);
            });
            
            // Adicionar animação de reordenação
            favoriteItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 50 * index);
            });
        }
        
        // Compartilhamento de receitas
        window.shareRecipe = function(title, url) {
            const modal = new bootstrap.Modal(document.getElementById('shareModal'));
            
            // Configurar links de compartilhamento
            document.getElementById('shareRecipeTitle').textContent = title;
            document.getElementById('recipeLink').value = url;
            
            document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent('🍽️ Descobre esta receita deliciosa! ' + title + ' 😍 Vê aqui:')}`;
            document.getElementById('shareWhatsapp').href = `https://api.whatsapp.com/send?text=${encodeURIComponent('😋 Tens de experimentar esta receita! ' + title + ' 👉 ' + url)}`;
            
            // Funcionalidade de copiar link
            const copyLinkBtn = document.getElementById('copyLinkBtn');
            const copyLink = document.getElementById('copyLink');
            
            const copyToClipboard = function(button) {
                const originalText = button.innerHTML;
                const linkInput = document.getElementById('recipeLink');
                
                linkInput.select();
                document.execCommand('copy');
                
                button.innerHTML = '<i class="bi bi-check-lg"></i> Copiado!';
                button.classList.add('btn-success');
                button.classList.remove('btn-outline-secondary');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-outline-secondary');
                }, 2000);
            };
            
            copyLinkBtn.addEventListener('click', function() {
                copyToClipboard(this);
            });
            
            copyLink.addEventListener('click', function() {
                copyToClipboard(this);
            });
            
            modal.show();
        };
        
        // Animação de entrada para os cards
        const favoriteItems = document.querySelectorAll('.favorite-item');
        favoriteItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
    </script>
    @endpush
</x-quickbites-layout>

