<x-quickbites-layout>
    <section id="menu" class="menu">
        <div class="container">
            <div class="section-title">
                <h2>Minhas Receitas <span>Favoritas</span></h2>
            </div>

            <div class="row">
                @forelse ($favorites as $receita)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" class="card-img-top" alt="{{ $receita->receita_titulo }}">
                            <h3 class="card-title">{{ $receita->receita_titulo }}</h3>
                            <p class="card-text"><b>{{ $receita->autor }}</b></p>
                            <p class="card-text">{{ $receita->receita_descricao }}</p>
                            <p><strong><i class="bi bi-alarm-fill"></i> Duração:</strong> {{ $receita->receita_duracao }} min</p>
                            <p><strong><i class="bi bi-bookmark-fill"></i> Categoria:</strong> {{ $receita->categoria }}</p>

                            <!-- Rating Display -->
                            <p>
                                <strong><i class="bi bi-star-fill"></i> Avaliação:</strong>
                                <span class="text-warning">
                                    {{ number_format($receita->getAverageRatingAttribute(), 1) }}/5
                                </span>
                            </p>

                            <a href="{{ route('receitas.show', $receita->id) }}" class="btn btn-warning">Ver Receita</a>

                            <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-heart-fill"></i> Remover dos Favoritos
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <p>Você ainda não tem receitas favoritas.</p>
                        <a href="{{ route('receitas.index') }}" class="btn btn-primary">Explorar Receitas</a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $favorites->links() }}
                </div>
            </div>
        </section>
    </x-quickbites-layout>
