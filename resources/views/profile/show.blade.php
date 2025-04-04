<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cabeçalho do Perfil -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center space-x-5">
                            <!-- Avatar com efeito de borda -->
                            <div class="relative">
                                @if($user->profile_photo)
                                    <div class="w-24 h-24 rounded-full border-4 border-orange-100 shadow-md overflow-hidden">
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                             alt="{{ $user->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full border-4 border-orange-100 shadow-md flex items-center justify-center text-white text-3xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                
                                <!-- Badge para indicar status de membro -->
                                <div class="absolute -bottom-1 -right-1 bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow-md">
                                    <i class="bi bi-check-circle-fill mr-1"></i>Ativo
                                </div>
                            </div>
                            
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                                <div class="flex items-center text-gray-600 text-sm mt-1">
                                    <i class="bi bi-calendar3 mr-1"></i>
                                    <span>Membro desde {{ $user->created_at->format('d/m/Y') }}</span>
                                </div>
                                
                                <!-- Estatísticas do usuário -->
                                <div class="flex items-center space-x-4 mt-3">
                                    <div class="flex items-center text-gray-700">
                                        <i class="bi bi-journal-text text-orange-500 mr-1"></i>
                                        <span>{{ $user->receitas->count() }} receitas</span>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <i class="bi bi-heart-fill text-red-500 mr-1"></i>
                                        <span>{{ $user->favoriteReceitas ? $user->favoriteReceitas->count() : 0 }} favoritos</span>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <i class="bi bi-star-fill text-yellow-500 mr-1"></i>
                                        <span>{{ $user->ratings ? $user->ratings->count() : 0 }} avaliações</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botões de ação (apenas Editar Perfil e Nova Receita para o próprio usuário) -->
                        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="bi bi-pencil-square mr-2"></i>Editar Perfil
                                </a>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="bi bi-plus-lg mr-2"></i>Nova Receita
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bio do usuário (se existir) -->
                    @if(isset($user->bio) && !empty($user->bio))
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Sobre mim</h3>
                            <p class="text-gray-700">{{ $user->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navegação por abas com design melhorado -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px" aria-label="Tabs">
                        <button class="tab-button w-1/3 py-4 px-1 text-center border-b-2 border-orange-500 font-medium text-sm text-orange-600 active" data-target="recipes-tab">
                            <i class="bi bi-journal-text mr-2"></i>Receitas
                            <span class="bg-gray-100 text-gray-700 ml-2 py-0.5 px-2 rounded-full text-xs">{{ $user->receitas->count() }}</span>
                        </button>
                        <button class="tab-button w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="favorites-tab">
                            <i class="bi bi-heart mr-2"></i>Favoritos
                            <span class="bg-gray-100 text-gray-700 ml-2 py-0.5 px-2 rounded-full text-xs">{{ $user->favoriteReceitas ? $user->favoriteReceitas->count() : 0 }}</span>
                        </button>
                        <button class="tab-button w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="ratings-tab">
                            <i class="bi bi-star mr-2"></i>Avaliações
                            <span class="bg-gray-100 text-gray-700 ml-2 py-0.5 px-2 rounded-full text-xs">{{ $user->ratings ? $user->ratings->count() : 0 }}</span>
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Conteúdo das abas -->
            <div class="tab-content">
                <!-- Receitas Tab -->
                <div id="recipes-tab" class="tab-pane active">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-800">
                                    <i class="bi bi-journal-text text-orange-500 mr-2"></i>Receitas de {{ $user->name }}
                                </h2>
                                
                                <!-- Filtros e ordenação -->
                                <div class="flex items-center space-x-2">
                                    <select id="recipe-sort" class="rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 text-sm">
                                        <option value="newest">Mais recentes</option>
                                        <option value="oldest">Mais antigas</option>
                                        <option value="popular">Mais populares</option>
                                    </select>
                                </div>
                            </div>
                            
                            @if($user->receitas->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($user->receitas as $receita)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                                            <div class="relative">
                                                @if($receita->receita_foto)
                                                    <img src="{{ asset('storage/' . $receita->receita_foto) }}" 
                                                         alt="{{ $receita->receita_titulo }}" 
                                                         class="w-full h-48 object-cover">
                                                @else
                                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                
                                                <!-- Badge de categoria -->
                                                <div class="absolute top-2 right-2">
                                                    <span class="bg-white bg-opacity-90 text-gray-700 text-xs px-2 py-1 rounded-full shadow-sm">
                                                        {{ $receita->categoria }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="p-4">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">{{ $receita->receita_titulo }}</h3>
                                                
                                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                                    <div class="flex items-center mr-3">
                                                        <i class="bi bi-alarm mr-1"></i>
                                                        <span>{{ $receita->receita_duracao }} min</span>
                                                    </div>
                                                    <div class="flex items-center mr-3">
                                                        <i class="bi bi-bar-chart mr-1"></i>
                                                        <span>{{ $receita->nivel_dificuldade }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="bi bi-calendar3 mr-1"></i>
                                                        <span>{{ $receita->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                                
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $receita->receita_descricao }}</p>
                                                
                                                <!-- Avaliação e ações -->
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="flex text-yellow-400 mr-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= round($receita->getAverageRatingAttribute()))
                                                                    <i class="bi bi-star-fill text-xs"></i>
                                                                @else
                                                                    <i class="bi bi-star text-xs"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="text-xs text-gray-500">({{ $receita->ratings->count() }})</span>
                                                    </div>
                                                    
                                                    <a href="{{ route('receitas.show', $receita->id) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 bg-orange-500 text-white text-xs font-medium rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                                        Ver Receita
                                                        <i class="bi bi-arrow-right ml-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Paginação (se necessário) -->
                                @if($user->receitas->count() > 9)
                                    <div class="mt-6 flex justify-center">
                                        <button id="load-more-recipes" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="bi bi-plus-lg mr-2"></i>Carregar Mais
                                        </button>
                                    </div>
                                @endif
                            @else
                                <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-100">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                        <i class="bi bi-journal-x text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">Nenhuma receita encontrada</h3>
                                    <p class="text-gray-600 max-w-md mx-auto">Este utilizador ainda não publicou nenhuma receita.</p>
                                    
                                    @if(Auth::id() === $user->id)
                                        <div class="mt-4">
                                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <i class="bi bi-plus-lg mr-2"></i>Criar Primeira Receita
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Favoritos Tab -->
                <div id="favorites-tab" class="tab-pane hidden">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-800">
                                    <i class="bi bi-heart-fill text-red-500 mr-2"></i>Receitas Favoritas de {{ $user->name }}
                                </h2>
                                
                                <!-- Filtros e ordenação -->
                                <div class="flex items-center space-x-2">
                                    <select id="favorites-sort" class="rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 text-sm">
                                        <option value="newest">Mais recentes</option>
                                        <option value="oldest">Mais antigas</option>
                                        <option value="popular">Mais populares</option>
                                    </select>
                                </div>
                            </div>
                            
                            @if($user->favoriteReceitas && $user->favoriteReceitas->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($user->favoriteReceitas as $receita)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                                            <div class="relative">
                                                @if($receita->receita_foto)
                                                    <img src="{{ asset('storage/' . $receita->receita_foto) }}" 
                                                         alt="{{ $receita->receita_titulo }}" 
                                                         class="w-full h-48 object-cover">
                                                @else
                                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                
                                                <!-- Badge de categoria -->
                                                <div class="absolute top-2 right-2">
                                                    <span class="bg-white bg-opacity-90 text-gray-700 text-xs px-2 py-1 rounded-full shadow-sm">
                                                        {{ $receita->categoria }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Badge de autor -->
                                                <div class="absolute bottom-2 left-2 flex items-center">
                                                    <div class="flex-shrink-0">
                                                        @if($receita->autor && isset($receita->autor->profile_photo))
                                                            <img class="h-6 w-6 rounded-full border border-white" src="{{ asset('storage/' . $receita->autor->profile_photo) }}" alt="{{ $receita->autor }}">
                                                        @else
                                                            <div class="h-6 w-6 bg-gray-200 rounded-full border border-white flex items-center justify-center text-xs font-bold text-gray-500">
                                                                {{ strtoupper(substr($receita->autor ?? 'A', 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-1.5">
                                                        <p class="text-xs font-medium text-white bg-black bg-opacity-50 px-2 py-0.5 rounded-full">
                                                            {{ $receita->autor }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="p-4">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">{{ $receita->receita_titulo }}</h3>
                                                
                                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                                    <div class="flex items-center mr-3">
                                                        <i class="bi bi-alarm mr-1"></i>
                                                        <span>{{ $receita->receita_duracao }} min</span>
                                                    </div>
                                                    <div class="flex items-center mr-3">
                                                        <i class="bi bi-bar-chart mr-1"></i>
                                                        <span>{{ $receita->nivel_dificuldade }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="bi bi-people mr-1"></i>
                                                        <span>{{ $receita->porcoes }} porções</span>
                                                    </div>
                                                </div>
                                                
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $receita->receita_descricao }}</p>
                                                
                                                <!-- Avaliação e ações -->
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="flex text-yellow-400 mr-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= round($receita->getAverageRatingAttribute()))
                                                                    <i class="bi bi-star-fill text-xs"></i>
                                                                @else
                                                                    <i class="bi bi-star text-xs"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="text-xs text-gray-500">({{ $receita->ratings->count() }})</span>
                                                    </div>
                                                    
                                                    <div class="flex space-x-2">
                                                        @auth
                                                            <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit" class="inline-flex items-center p-1.5 text-red-500 bg-red-50 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                                    <i class="bi bi-heart-fill"></i>
                                                                </button>
                                                            </form>
                                                        @endauth
                                                        
                                                        <a href="{{ route('receitas.show', $receita->id) }}" 
                                                           class="inline-flex items-center px-3 py-1.5 bg-orange-500 text-white text-xs font-medium rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                                            Ver Receita
                                                            <i class="bi bi-arrow-right ml-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Paginação (se necessário) -->
                                @if($user->favoriteReceitas->count() > 9)
                                    <div class="mt-6 flex justify-center">
                                        <button id="load-more-favorites" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="bi bi-plus-lg mr-2"></i>Carregar Mais
                                        </button>
                                    </div>
                                @endif
                            @else
                                <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-100">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                        <i class="bi bi-heart text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">Nenhuma receita favorita</h3>
                                    <p class="text-gray-600 max-w-md mx-auto">Este utilizador ainda não adicionou nenhuma receita aos favoritos.</p>
                                    
                                    @if(Auth::id() === $user->id)
                                        <div class="mt-4">
                                            <a href="{{ route('receitas.index') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <i class="bi bi-search mr-2"></i>Explorar Receitas
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Avaliações Tab -->
                <div id="ratings-tab" class="tab-pane hidden">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-800">
                                    <i class="bi bi-star-fill text-yellow-500 mr-2"></i>Avaliações de {{ $user->name }}
                                </h2>
                            </div>
                            
                            @if(isset($user->ratings) && $user->ratings->count() > 0)
                                <div class="space-y-4">
                                    @foreach($user->ratings as $rating)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow duration-300">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mr-4">
                                                    @if($rating->receita && $rating->receita->receita_foto)
                                                        <img src="{{ asset('storage/' . $rating->receita->receita_foto) }}" 
                                                             alt="{{ $rating->receita->receita_titulo }}" 
                                                             class="w-16 h-16 object-cover rounded-md">
                                                    @else
                                                        <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md">
                                                            <i class="bi bi-image text-gray-400 text-xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <h3 class="text-base font-medium text-gray-800">
                                                            @if($rating->receita)
                                                                <a href="{{ route('receitas.show', $rating->receita->id) }}" class="hover:text-orange-500">
                                                                    {{ $rating->receita->receita_titulo }}
                                                                </a>
                                                            @else
                                                                <span class="text-gray-500">Receita não disponível</span>
                                                            @endif
                                                        </h3>
                                                        
                                                        <span class="text-xs text-gray-500">{{ $rating->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                    
                                                    <div class="flex text-yellow-400 my-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $rating->rating)
                                                                <i class="bi bi-star-fill"></i>
                                                            @else
                                                                <i class="bi bi-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    
                                                    @if($rating->comment)
                                                    <div class="mt-2 p-3 bg-gray-50 rounded-md text-gray-700 text-sm">
                                                            <p>{{ $rating->comment }}</p>
                                                        </div>
                                                    @endif
                                                    
                                                    @if(Auth::id() === $user->id)
                                                        <div class="mt-3 flex justify-end">
                                                            <form action="{{ route('receitas.delete-rating', ['receita' => $rating->receita_id, 'rating' => $rating->id]) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="inline-flex items-center px-2 py-1 text-xs text-red-600 bg-red-50 rounded hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200" onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')">
                                                                    <i class="bi bi-trash mr-1"></i>Excluir
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-100">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                        <i class="bi bi-star text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">Nenhuma avaliação encontrada</h3>
                                    <p class="text-gray-600 max-w-md mx-auto">Este utilizador ainda não avaliou nenhuma receita.</p>
                                    
                                    @if(Auth::id() === $user->id)
                                        <div class="mt-4">
                                            <a href="{{ route('receitas.index') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <i class="bi bi-search mr-2"></i>Explorar Receitas
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gerenciar abas
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remover classe active de todos os botões
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-orange-500', 'text-orange-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Adicionar classe active ao botão clicado
                    this.classList.add('active', 'border-orange-500', 'text-orange-600');
                    this.classList.remove('border-transparent', 'text-gray-500');
                    
                    // Esconder todos os painéis
                    tabPanes.forEach(pane => {
                        pane.classList.add('hidden');
                        pane.classList.remove('active');
                    });
                    
                    // Mostrar o painel correspondente
                    const targetId = this.getAttribute('data-target');
                    const targetPane = document.getElementById(targetId);
                    targetPane.classList.remove('hidden');
                    targetPane.classList.add('active');
                    
                    // Salvar a aba ativa no localStorage
                    localStorage.setItem('activeProfileTab', targetId);
                });
            });
            
            // Restaurar a aba ativa do localStorage
            const activeTab = localStorage.getItem('activeProfileTab');
            if (activeTab) {
                const tabToActivate = document.querySelector(`.tab-button[data-target="${activeTab}"]`);
                if (tabToActivate) {
                    tabToActivate.click();
                }
            }
            
            // Ordenação de receitas
            const recipeSortSelect = document.getElementById('recipe-sort');
            if (recipeSortSelect) {
                recipeSortSelect.addEventListener('change', function() {
                    sortRecipes('recipes-tab', this.value);
                });
            }
            
            // Ordenação de favoritos
            const favoritesSortSelect = document.getElementById('favorites-sort');
            if (favoritesSortSelect) {
                favoritesSortSelect.addEventListener('change', function() {
                    sortRecipes('favorites-tab', this.value);
                });
            }
            
            // Função para ordenar receitas
            function sortRecipes(tabId, sortBy) {
                const recipeContainer = document.querySelector(`#${tabId} .grid`);
                if (!recipeContainer) return;
                
                const recipes = Array.from(recipeContainer.children);
                
                recipes.sort((a, b) => {
                    if (sortBy === 'newest') {
                        // Ordenar por data (mais recentes primeiro)
                        const dateA = new Date(a.querySelector('.bi-calendar3').nextElementSibling.textContent);
                        const dateB = new Date(b.querySelector('.bi-calendar3').nextElementSibling.textContent);
                        return dateB - dateA;
                    } else if (sortBy === 'oldest') {
                        // Ordenar por data (mais antigas primeiro)
                        const dateA = new Date(a.querySelector('.bi-calendar3').nextElementSibling.textContent);
                        const dateB = new Date(b.querySelector('.bi-calendar3').nextElementSibling.textContent);
                        return dateA - dateB;
                    } else if (sortBy === 'popular') {
                        // Ordenar por avaliação
                        const ratingA = a.querySelectorAll('.bi-star-fill').length;
                        const ratingB = b.querySelectorAll('.bi-star-fill').length;
                        return ratingB - ratingA;
                    }
                    return 0;
                });
                
                // Limpar e readicionar os elementos ordenados
                recipeContainer.innerHTML = '';
                recipes.forEach(recipe => {
                    recipeContainer.appendChild(recipe);
                });
            }
            
            // Função para copiar link para a área de transferência
            window.copyToClipboard = function(text) {
                navigator.clipboard.writeText(text).then(() => {
                    // Mostrar notificação de sucesso
                    const notification = document.createElement('div');
                    notification.className = 'fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-4 py-2 rounded-md text-sm shadow-lg';
                    notification.textContent = 'Link copiado para a área de transferência!';
                    document.body.appendChild(notification);
                    
                    // Remover notificação após 2 segundos
                    setTimeout(() => {
                        notification.remove();
                    }, 2000);
                });
            };
            
            // Carregar mais receitas (simulação)
            const loadMoreRecipesBtn = document.getElementById('load-more-recipes');
            if (loadMoreRecipesBtn) {
                loadMoreRecipesBtn.addEventListener('click', function() {
                    this.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Carregando...';
                    this.disabled = true;
                    
                    // Simular carregamento
                    setTimeout(() => {
                        this.innerHTML = '<i class="bi bi-plus-lg mr-2"></i>Carregar Mais';
                        this.disabled = false;
                        
                        // Aqui você implementaria a lógica real de carregamento
                        // Por enquanto, apenas mostramos uma mensagem
                        const notification = document.createElement('div');
                        notification.className = 'fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-4 py-2 rounded-md text-sm shadow-lg';
                        notification.textContent = 'Não há mais receitas para carregar.';
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.remove();
                        }, 2000);
                    }, 1500);
                });
            }
            
            // Carregar mais favoritos (simulação)
            const loadMoreFavoritesBtn = document.getElementById('load-more-favorites');
            if (loadMoreFavoritesBtn) {
                loadMoreFavoritesBtn.addEventListener('click', function() {
                    // Implementação similar à função acima
                });
            }
            
            // Animação de entrada para os cards
            const animateCards = () => {
                const cards = document.querySelectorAll('.tab-pane.active .grid > div');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add('animate-fade-in');
                    }, index * 100);
                });
            };
            
            // Executar animação inicial
            animateCards();
            
            // Executar animação ao trocar de aba
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    setTimeout(animateCards, 100);
                });
            });
        });
    </script>
    
    <style>
        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        /* Utilitários adicionais */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>

