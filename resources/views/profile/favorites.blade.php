<x-quickbites-layout>
    <section class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-orange-600 hover:underline">
                            <i class="bi bi-arrow-left"></i> Voltar ao perfil
                        </a>
                        <h2 class="mt-2 text-2xl font-bold">Receitas Favoritas de {{ $user->name }}</h2>
                    </div>

                    @if($favorites->count() > 0)
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            @foreach($favorites as $receita)
                                <div class="overflow-hidden transition-shadow bg-white border rounded-lg shadow-md hover:shadow-lg">
                                    @if($receita->receita_foto)
                                        <img src="{{ asset('storage/' . $receita->receita_foto) }}"
                                             alt="{{ $receita->receita_titulo }}"
                                             class="object-cover w-full h-48">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                                            <span class="text-gray-400"><i class="bi bi-image"></i> Sem imagem</span>
                                        </div>
                                    @endif

                                    <div class="p-4">
                                        <h4 class="mb-1 text-lg font-semibold">{{ $receita->receita_titulo }}</h4>
                                        <p class="mb-1 text-sm text-gray-600">por <strong>{{ $receita->autor }}</strong></p>
                                        <p class="mb-2 text-sm text-gray-600">
                                            <i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min
                                            <span class="mx-1">•</span>
                                            <i class="bi bi-bookmark-fill"></i> {{ $receita->categoria }}
                                        </p>

                                        <!-- Rating Display -->
                                        <div class="flex items-center mb-3">
                                            <span class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($receita->getAverageRatingAttribute()))
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                            <span class="ml-1 text-xs text-gray-500">
                                                ({{ $receita->ratings->count() }})
                                            </span>
                                        </div>

                                        <a href="{{ route('receitas.show', $receita->id) }}"
                                           class="inline-block px-3 py-1 text-xs text-white bg-orange-500 rounded hover:bg-orange-600">
                                            Ver Receita
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $favorites->links() }}
                        </div>
                    @else
                        <div class="p-6 text-center bg-gray-100 rounded-lg">
                            <p class="text-gray-600">Este utilizador ainda não tem receitas favoritas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-quickbites-layout>
