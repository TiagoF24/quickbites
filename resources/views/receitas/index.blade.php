<x-quickbites-layout>

    <!-- Menu Section -->
    <section id="menu" class="menu section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Receitas</h2>
            <div><span class="description-title">Últimas </span> receitas</span></div>
        </div><!-- End Section Title -->

        <!-- Expanded Filter Section -->
        <div class="container mt-4">
            <form method="GET" action="{{ route('receitas.index') }}" class="p-3 bg-light rounded shadow-sm">
                <h4 class="mb-3">Filtros</h4>

                <div class="row g-3">

                    <!-- Pesquisar -->
                    <div class="col-md-4">
                        <label class="form-label">Pesquisar</label>
                        <input type="text" name="search" class="form-control" placeholder="Nome da receita" value="{{ request()->get('search') }}">
                    </div>

                    <!-- Categoria -->
                    <div class="col-md-4">
                        <label class="form-label">Categoria</label>
                        <select name="category" class="form-control">
                            <option value="">Todas</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->nome }}" {{ request()->get('category') == $categoria->nome ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Duração -->
                    <div class="col-md-4">
                        <label class="form-label">Duração</label>
                        <select name="duracao" class="form-control">
                            <option value="">Qualquer</option>
                            <option value=">90" {{ request()->get('duracao') == '>90' ? 'selected' : '' }}>Mais de 90 min</option>
                            <option value=">120" {{ request()->get('duracao') == '>120' ? 'selected' : '' }}>Mais de 120 min</option>
                            <option value="<60" {{ request()->get('duracao') == '<60' ? 'selected' : '' }}>Menos de 60 min</option>
                        </select>
                    </div>

                    <!-- Dificuldade -->
                    <div class="col-md-4">
                        <label class="form-label">Dificuldade</label>
                        <select name="dificuldade" class="form-control">
                            <option value="">Todas</option>
                            @foreach($dificuldades as $dificuldade)
                                <option value="{{ $dificuldade }}" {{ request()->get('dificuldade') == $dificuldade ? 'selected' : '' }}>
                                    {{ ucfirst($dificuldade) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Calorias -->
                    <div class="col-md-4">
                        <label class="form-label">Calorias</label>
                        <select name="calorias" class="form-control">
                            <option value="">Qualquer</option>
                            <option value=">100" {{ request()->get('calorias') == '>100' ? 'selected' : '' }}>Mais de 100 kcal</option>
                            <option value=">200" {{ request()->get('calorias') == '>200' ? 'selected' : '' }}>Mais de 200 kcal</option>
                            <option value="<150" {{ request()->get('calorias') == '<150' ? 'selected' : '' }}>Menos de 150 kcal</option>
                        </select>
                    </div>

                    <!-- Botão Aplicar -->
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-warning w-100">Aplicar Filtros</button>
                    </div>

                </div>
            </form>
        </div><!-- End Filter Section -->

        <!-- Recipes List Section -->
        <div class="container mt-4">
            <div class="row">
                @forelse ($receitas as $receita)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="card-img-top" alt="{{ $receita->receita_titulo }}">
                            <h3 class="card-title">{{ $receita->receita_titulo }}</h3>
                            
                            <div class="d-flex align-items-center mb-2">
                                @php
                                    // Tente obter o usuário pelo ID se disponível, ou pelo nome como fallback
                                    $autorUser = null;
                                    if (isset($receita->user_id)) {
                                        $autorUser = \App\Models\User::find($receita->user_id);
                                    }
                                @endphp
                                
                                @if($autorUser && $autorUser->profile_photo)
                                    <img src="{{ asset('storage/' . $autorUser->profile_photo) }}" 
                                         alt="{{ $receita->autor }}" 
                                         class="rounded-circle me-2" 
                                         style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle me-2 d-flex align-items-center justify-content-center bg-orange-500 text-white" 
                                         style="width: 30px; height: 30px; font-size: 14px;">
                                        {{ strtoupper(substr($receita->autor, 0, 1)) }}
                                    </div>
                                @endif
                                <p class="card-text mb-0"><b>{{ $receita->autor }}</b></p>
                            </div>
                            
                            <p class="card-text">{{ $receita->receita_descricao }}</p>
                            <p><strong><i class="bi bi-alarm-fill"></i> Duração:</strong> {{ $receita->receita_duracao }} min</p>
                            <p><strong><i class="bi bi-bookmark-fill"></i> Categoria:</strong> {{ $receita->categoria }}</p>
                            <a href="{{ route('receitas.show', $receita->id) }}" class="btn btn-warning">Ver Receita</a>
                        </div>
                    </div>
                @empty
                    <p class='text-center'>Nenhuma receita encontrada.</p>
                @endforelse
            </div>
        </div>

    </section><!-- /Menu Section -->

</x-quickbites-layout>
