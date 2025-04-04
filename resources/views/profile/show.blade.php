<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Perfil do Utilizador -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <div class="flex items-center space-x-4">
                            <!-- Avatar - Ensuring it's perfectly round -->
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-16 h-16 rounded-full object-cover">
                            @else
                                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white text-xl">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            
                            <div>
                                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                                <p class="text-gray-600 text-sm"><i class="bi bi-bookmark-fill"></i>Membro desde {{ $user->created_at->format('d/m/Y') }}</p>
                                <p class="text-gray-800 text-sm">{{ $user->receitas->count() }} receitas publicadas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Receitas do Utilizador -->
                    <div>
                        <h3 class="text-lg font-bold text-orange-600 mb-4">Receitas de {{ $user->name }}</h3>
                        
                        @if($user->receitas->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($user->receitas as $receita)
                                    <div class="bg-white border rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                        @if($receita->receita_foto)
                                            <img src="{{ asset('storage/' . $receita->receita_foto) }}" 
                                                 alt="{{ $receita->receita_titulo }}" 
                                                 class="w-full h-32 object-cover">
                                        @else
                                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <div class="p-3">
                                            <h4 class="text-base font-semibold mb-1">{{ $receita->receita_titulo }}</h4>
                                            <div class="flex items-center text-xs text-gray-600 mb-1">
                                                <span class="mr-2">{{ $receita->nivel_dificuldade }} |</span>
                                                <span class="mr-2">{{ $receita->receita_duracao }} min |</span>
                                                <span>{{ $receita->categoria }}</span>
                                            </div>
                                            <p class="text-gray-700 text-sm mb-2 line-clamp-2">{{ $receita->receita_descricao }}</p>
                                            <a href="{{ route('receita.show', $receita->id) }}" 
                                               class="inline-block px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-600 text-xs">
                                                Ver Receita
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-lg p-6 text-center">
                                <p class="text-gray-600">Este utilizador ainda não publicou nenhuma receita.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>