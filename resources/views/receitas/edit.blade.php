<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h1 class="text-2xl font-bold leading-tight text-white mb-2 md:mb-0">
                <i class="bi bi-pencil-square me-2"></i>{{ __('Editar Receita') }}
            </h1>
            <div class="flex space-x-2">
                <a href="{{ route('receitas.show', $receita->id) }}"
                    class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="bi bi-eye me-2"></i>Ver Receita
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="bi bi-person me-2"></i>Meu Perfil
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Alerts Section -->
            @if(session('success'))
            <div class="mb-6 overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" onclick="this.parentElement.parentElement.remove()">
                            <span class="sr-only">Fechar</span>
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-4 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('error') }}</p>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" onclick="this.parentElement.parentElement.remove()">
                            <span class="sr-only">Fechar</span>
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-6 overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-4 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-octagon-fill text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Por favor, corrija os seguintes erros:</p>
                            <ul class="mt-1 ml-4 text-sm list-disc">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" onclick="this.parentElement.parentElement.remove()">
                            <span class="sr-only">Fechar</span>
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recipe Overview Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Recipe Image -->
                        <div class="md:w-1/3 mb-4 md:mb-0 md:pr-6">
                            <div class="relative rounded-lg overflow-hidden shadow-sm h-64 bg-gray-100">
                                <img src="{{ asset('storage/' . $receita->receita_foto) }}" alt="{{ $receita->receita_titulo }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-sm font-medium px-3 py-1 bg-orange-600 rounded-full">
                                        <i class="bi bi-camera me-1"></i>Alterar imagem
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recipe Info -->
                        <div class="md:w-2/3">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $receita->receita_titulo }}</h2>
                            <p class="text-gray-600 mb-4">{{ $receita->receita_descricao }}</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <i class="bi bi-alarm-fill text-orange-500 text-xl mb-1"></i>
                                    <p class="text-xs text-gray-500">Tempo</p>
                                    <p class="font-semibold">{{ $receita->receita_duracao }} min</p>
                                </div>
                                
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <i class="bi bi-people-fill text-blue-500 text-xl mb-1"></i>
                                    <p class="text-xs text-gray-500">Porções</p>
                                    <p class="font-semibold">{{ $receita->porcoes }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <i class="bi bi-bar-chart-fill text-green-500 text-xl mb-1"></i>
                                    <p class="text-xs text-gray-500">Dificuldade</p>
                                    <p class="font-semibold">{{ $receita->nivel_dificuldade }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <i class="bi bi-bookmark-fill text-purple-500 text-xl mb-1"></i>
                                    <p class="text-xs text-gray-500">Categoria</p>
                                    <p class="font-semibold">{{ $receita->categoria }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="bi bi-eye-fill me-1"></i> {{ $receita->views ?? 0 }} visualizações
                                <span class="mx-2">•</span>
                                <i class="bi bi-heart-fill me-1 text-red-500"></i> {{ $receita->favorites->count() }} favoritos
                                <span class="mx-2">•</span>
                                <i class="bi bi-star-fill me-1 text-yellow-400"></i> {{ number_format($receita->getAverageRatingAttribute(), 1) }} ({{ $receita->ratings->count() }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <form action="{{ route('receitas.update', $receita->id) }}" method="POST" enctype="multipart/form-data" id="edit-recipe-form">
                        @csrf
                        @method('PUT')

                        <!-- Form Progress -->
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700" id="progress-label">Informações Básicas</span>
                                <span class="text-sm font-medium text-gray-700" id="form-progress">1/3</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full">
                                <div class="h-2 bg-orange-500 rounded-full transition-all duration-300" id="progress-bar" style="width: 33.33%"></div>
                            </div>
                        </div>

                        <!-- Tabs Navigation -->
                        <div class="mb-6 border-b border-gray-200">
                            <nav class="flex -mb-px" aria-label="Tabs">
                                <button type="button" class="form-tab active w-1/3 py-4 px-1 text-center border-b-2 border-orange-500 font-medium text-sm text-orange-600" data-target="info-tab-pane" data-step="1">
                                    <i class="bi bi-info-circle me-1"></i> Informações Básicas
                                </button>
                                <button type="button" class="form-tab w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="detalhes-tab-pane" data-step="2">
                                    <i class="bi bi-card-list me-1"></i> Detalhes
                                </button>
                                <button type="button" class="form-tab w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="conteudo-tab-pane" data-step="3">
                                    <i class="bi bi-list-check me-1"></i> Ingredientes e Preparo
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Informações Básicas Tab -->
                            <div class="tab-pane active" id="info-tab-pane">
                                <div class="space-y-6">
                                    <div>
                                        <label for="receita_titulo" class="block text-sm font-medium text-gray-700">
                                            Título da Receita <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-1">
                                            <input type="text" name="receita_titulo" id="receita_titulo" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ old('receita_titulo', $receita->receita_titulo) }}" required>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Escolha um título descritivo e atraente para sua receita.</p>
                                    </div>

                                    <div>
                                        <label for="receita_descricao" class="block text-sm font-medium text-gray-700">
                                            Descrição <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-1">
                                            <textarea name="receita_descricao" id="receita_descricao" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>{{ old('receita_descricao', $receita->receita_descricao) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Uma breve descrição que desperte o interesse de quem vai preparar sua receita.</p>
                                    </div>

                                    <div>
                                        <label for="receita_foto" class="block text-sm font-medium text-gray-700">
                                            Foto da Receita
                                        </label>
                                        <div class="mt-1 flex items-center space-x-6">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/' . $receita->receita_foto) }}" alt="{{ $receita->receita_titulo }}" class="h-32 w-32 object-cover rounded-lg">
                                            </div>
                                            <div class="flex-grow">
                                            <div class="flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                                    <div class="space-y-1 text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <div class="flex text-sm text-gray-600">
                                                            <label for="receita_foto" class="relative cursor-pointer rounded-md bg-white font-medium text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-500 focus-within:ring-offset-2 hover:text-orange-500">
                                                                <span>Carregar nova imagem</span>
                                                                <input id="receita_foto" name="receita_foto" type="file" class="sr-only" accept="image/*">
                                                            </label>
                                                            <p class="pl-1">ou arraste e solte</p>
                                                        </div>
                                                        <p class="text-xs text-gray-500">PNG, JPG, GIF até 10MB</p>
                                                    </div>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a imagem atual. Recomendamos imagens com resolução de 1280x720 pixels.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end space-x-3">
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors" onclick="nextTab('detalhes-tab-pane', 2)">
                                            Próximo <i class="bi bi-arrow-right ml-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Detalhes Tab -->
                            <div class="tab-pane hidden" id="detalhes-tab-pane">
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                        <div>
                                            <label for="receita_duracao" class="block text-sm font-medium text-gray-700">
                                                Tempo de Preparo (minutos) <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input type="number" name="receita_duracao" id="receita_duracao" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ old('receita_duracao', $receita->receita_duracao) }}" min="1" required>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="porcoes" class="block text-sm font-medium text-gray-700">
                                                Porções <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input type="number" name="porcoes" id="porcoes" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ old('porcoes', $receita->porcoes) }}" min="1" required>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="nivel_dificuldade" class="block text-sm font-medium text-gray-700">
                                                Nível de Dificuldade <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <select id="nivel_dificuldade" name="nivel_dificuldade" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>
                                                    <option value="">Selecione...</option>
                                                    <option value="Fácil" {{ old('nivel_dificuldade', $receita->nivel_dificuldade) == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                                                    <option value="Médio" {{ old('nivel_dificuldade', $receita->nivel_dificuldade) == 'Médio' ? 'selected' : '' }}>Médio</option>
                                                    <option value="Difícil" {{ old('nivel_dificuldade', $receita->nivel_dificuldade) == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="categoria" class="block text-sm font-medium text-gray-700">
                                                Categoria <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <select id="categoria" name="categoria" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>
                                                    <option value="">Selecione...</option>
                                                    <?php
                                                    // Conexão simplificada
                                                    $conexao = mysqli_connect('localhost', 'root', '', 'quickbites');

                                                    // Buscar as categorias
                                                    $sql = 'SELECT nome FROM categorias';
                                                    $resultado = mysqli_query($conexao, $sql);
                                                    
                                                    while($categoria = mysqli_fetch_assoc($resultado)): ?>
                                                        <option value="<?php echo $categoria['nome']; ?>" {{ old('categoria', $receita->categoria) == $categoria['nome'] ? 'selected' : '' }}>
                                                            <?php echo $categoria['nome']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="calorias" class="block text-sm font-medium text-gray-700">
                                                Calorias (opcional)
                                            </label>
                                            <div class="mt-1">
                                                <input type="number" name="calorias" id="calorias" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ old('calorias', $receita->calorias) }}" min="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between space-x-3">
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="prevTab('info-tab-pane', 1)">
                                            <i class="bi bi-arrow-left mr-1"></i> Anterior
                                        </button>
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors" onclick="nextTab('conteudo-tab-pane', 3)">
                                            Próximo <i class="bi bi-arrow-right ml-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Ingredientes e Preparo Tab -->
                            <div class="tab-pane hidden" id="conteudo-tab-pane">
                                <div class="space-y-6">
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <label for="ingredientes" class="block text-sm font-medium text-gray-700">
                                                Ingredientes <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex space-x-2">
                                                <button type="button" id="add-ingredient-btn" class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                                                    <i class="bi bi-plus-circle mr-1"></i> Adicionar
                                                </button>
                                                <button type="button" id="sort-ingredients-btn" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                    <i class="bi bi-sort-alpha-down mr-1"></i> Ordenar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <textarea name="ingredientes" id="ingredientes" rows="8" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>{{ old('ingredientes', $receita->ingredientes) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Liste todos os ingredientes necessários, um por linha.</p>
                                        
                                        <!-- Sugestões de Ingredientes Comuns -->
                                        <div class="mt-2">
                                            <p class="text-xs font-medium text-gray-500 mb-1">Ingredientes comuns:</p>
                                            <div class="flex flex-wrap gap-1">
                                                <button type="button" class="ingredient-suggestion px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded text-gray-700">Sal a gosto</button>
                                                <button type="button" class="ingredient-suggestion px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded text-gray-700">Pimenta a gosto</button>
                                                <button type="button" class="ingredient-suggestion px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded text-gray-700">2 colheres de sopa de azeite</button>
                                                <button type="button" class="ingredient-suggestion px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded text-gray-700">1 dente de alho picado</button>
                                                <button type="button" class="ingredient-suggestion px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded text-gray-700">1 cebola média picada</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between">
                                            <label for="modo_preparo" class="block text-sm font-medium text-gray-700">
                                                Modo de Preparo <span class="text-red-500">*</span>
                                            </label>
                                            <button type="button" id="format-steps-btn" class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                <i class="bi bi-list-ol mr-1"></i> Formatar Passos
                                            </button>
                                        </div>
                                        <div class="mt-1">
                                            <textarea name="modo_preparo" id="modo_preparo" rows="10" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>{{ old('modo_preparo', $receita->modo_preparo) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Descreva cada passo do preparo, um por linha.</p>
                                    </div>

                                    <div>
                                        <label for="dicas" class="block text-sm font-medium text-gray-700">
                                            Dicas (opcional)
                                        </label>
                                        <div class="mt-1">
                                            <textarea name="dicas" id="dicas" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">{{ old('dicas', $receita->dicas) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Compartilhe dicas especiais para melhorar a receita.</p>
                                    </div>

                                    <div class="flex justify-between space-x-3">
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="prevTab('detalhes-tab-pane', 2)">
                                            <i class="bi bi-arrow-left mr-1"></i> Anterior
                                        </button>
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                            <i class="bi bi-check-circle mr-1"></i> Salvar Alterações
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campos ocultos para manter os dados originais -->
                        <input type="hidden" name="autor" value="{{ $receita->autor }}">
                        <input type="hidden" name="autor_id" value="{{ $receita->autor_id }}">
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex flex-col sm:flex-row sm:justify-between gap-4">
                <a href="{{ route('receitas.show', $receita->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                    <i class="bi bi-arrow-left mr-2"></i> Voltar para Receita
                </a>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="button" id="preview-btn" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="bi bi-eye mr-2"></i> Pré-visualizar
                    </button>
                    
                    <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta receita? Esta ação não pode ser desfeita.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="bi bi-trash mr-2"></i> Excluir Receita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Pré-visualização -->
    <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="preview-modal">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="preview-title">
                                Título da Receita
                            </h3>
                            <div class="mt-4">
                                <div class="flex flex-col md:flex-row md:space-x-6">
                                    <div class="md:w-1/3 mb-4 md:mb-0">
                                        <img id="preview-image" src="" alt="Preview" class="w-full h-64 object-cover rounded-lg">
                                        
                                        <div class="mt-4 grid grid-cols-2 gap-2">
                                            <div class="bg-gray-50 p-2 rounded text-center">
                                                <i class="bi bi-alarm-fill text-orange-500"></i>
                                                <p class="text-xs text-gray-500">Tempo</p>
                                                <p class="text-sm font-medium" id="preview-time">30 min</p>
                                            </div>
                                            <div class="bg-gray-50 p-2 rounded text-center">
                                                <i class="bi bi-people-fill text-blue-500"></i>
                                                <p class="text-xs text-gray-500">Porções</p>
                                                <p class="text-sm font-medium" id="preview-portions">4</p>
                                            </div>
                                            <div class="bg-gray-50 p-2 rounded text-center">
                                                <i class="bi bi-bar-chart-fill text-green-500"></i>
                                                <p class="text-xs text-gray-500">Dificuldade</p>
                                                <p class="text-sm font-medium" id="preview-difficulty">Médio</p>
                                            </div>
                                            <div class="bg-gray-50 p-2 rounded text-center">
                                                <i class="bi bi-bookmark-fill text-purple-500"></i>
                                                <p class="text-xs text-gray-500">Categoria</p>
                                                <p class="text-sm font-medium" id="preview-category">Categoria</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="md:w-2/3">
                                        <h4 class="text-sm font-medium text-gray-500 mb-1">Descrição</h4>
                                        <p class="text-gray-700 mb-4" id="preview-description">Descrição da receita...</p>
                                        
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-500 mb-1">Ingredientes</h4>
                                            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700" id="preview-ingredients">
                                                <!-- Ingredientes serão inseridos aqui -->
                                            </ul>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-500 mb-1">Modo de Preparo</h4>
                                            <ol class="list-decimal pl-5 space-y-2 text-sm text-gray-700" id="preview-steps">
                                                <!-- Passos serão inseridos aqui -->
                                            </ol>
                                        </div>
                                        
                                        <div id="preview-tips-container" class="mb-4 hidden">
                                            <h4 class="text-sm font-medium text-gray-500 mb-1">Dicas</h4>
                                            <div class="bg-yellow-50 p-3 rounded-md text-sm text-gray-700" id="preview-tips">
                                                <!-- Dicas serão inseridas aqui -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-preview-btn">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Adicionar Ingrediente -->
    <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="ingredient-modal">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Adicionar Ingrediente</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="ingredient-quantity" class="block text-sm font-medium text-gray-700">Quantidade</label>
                            <input type="text" id="ingredient-quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="2 colheres de sopa">
                        </div>
                        <div>
                            <label for="ingredient-name" class="block text-sm font-medium text-gray-700">Ingrediente</label>
                            <input type="text" id="ingredient-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="azeite de oliva">
                        </div>
                        <div>
                            <label for="ingredient-prep" class="block text-sm font-medium text-gray-700">Preparo (opcional)</label>
                            <input type="text" id="ingredient-prep" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="extra virgem">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm" id="add-ingredient-confirm">
                        Adicionar
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-ingredient-modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funções de navegação entre abas
        function nextTab(tabId, step) {
            // Validar a aba atual antes de avançar
            if (!validateCurrentTab()) {
                return;
            }
            
            // Atualizar abas
            document.querySelectorAll('.form-tab').forEach(tab => {
                tab.classList.remove('active', 'border-orange-500', 'text-orange-600');
                tab.classList.add('border-transparent', 'text-gray-500');
            });
            
            document.querySelector(`.form-tab[data-target="${tabId}"]`).classList.add('active', 'border-orange-500', 'text-orange-600');
            document.querySelector(`.form-tab[data-target="${tabId}"]`).classList.remove('border-transparent', 'text-gray-500');
            
            // Atualizar conteúdo das abas
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.add('hidden');
                pane.classList.remove('active');
            });
            
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('active');
            
            // Atualizar barra de progresso
            updateProgressBar(step);
        }
        
        function prevTab(tabId, step) {
            // Atualizar abas
            document.querySelectorAll('.form-tab').forEach(tab => {
                tab.classList.remove('active', 'border-orange-500', 'text-orange-600');
                tab.classList.add('border-transparent', 'text-gray-500');
            });
            
            document.querySelector(`.form-tab[data-target="${tabId}"]`).classList.add('active', 'border-orange-500', 'text-orange-600');
            document.querySelector(`.form-tab[data-target="${tabId}"]`).classList.remove('border-transparent', 'text-gray-500');
            
            // Atualizar conteúdo das abas
                   // Atualizar conteúdo das abas
                   document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.add('hidden');
                pane.classList.remove('active');
            });
            
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('active');
            
            // Atualizar barra de progresso
            updateProgressBar(step);
        }
        
        // Atualizar barra de progresso
        function updateProgressBar(step) {
            const progress = (step / 3) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
            document.getElementById('form-progress').textContent = `${step}/3`;
            
            // Atualizar label do progresso
            const labels = ['Informações Básicas', 'Detalhes', 'Ingredientes e Preparo'];
            document.getElementById('progress-label').textContent = labels[step - 1];
        }
        
        // Validar aba atual
        function validateCurrentTab() {
            const activeTab = document.querySelector('.tab-pane.active');
            const requiredFields = activeTab.querySelectorAll('[required]');
            let isValid = true;
            
            // Remover mensagens de erro anteriores
            activeTab.querySelectorAll('.error-message').forEach(el => el.remove());
            
            // Verificar campos obrigatórios
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    showError(field, 'Este campo é obrigatório');
                }
            });
            
            return isValid;
        }
        
        // Mostrar mensagem de erro
        function showError(field, message) {
            // Remover mensagem de erro anterior
            const existingError = field.parentElement.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            // Adicionar classe de erro ao campo
            field.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            
            // Criar mensagem de erro
            const errorElement = document.createElement('p');
            errorElement.className = 'mt-1 text-sm text-red-600 error-message';
            errorElement.textContent = message;
            
            // Inserir mensagem após o campo
            field.parentElement.appendChild(errorElement);
            
            // Focar no campo com erro
            field.focus();
        }
        
        // Configurar modal de ingredientes
        function setupIngredientModal() {
            const addIngredientBtn = document.getElementById('add-ingredient-btn');
            const ingredientModal = document.getElementById('ingredient-modal');
            const closeIngredientModal = document.getElementById('close-ingredient-modal');
            const addIngredientConfirm = document.getElementById('add-ingredient-confirm');
            
            // Abrir modal
            addIngredientBtn.addEventListener('click', () => {
                ingredientModal.classList.remove('hidden');
                document.getElementById('ingredient-quantity').focus();
            });
            
            // Fechar modal
            closeIngredientModal.addEventListener('click', () => {
                ingredientModal.classList.add('hidden');
                clearIngredientForm();
            });
            
            // Adicionar ingrediente
            addIngredientConfirm.addEventListener('click', () => {
                const quantity = document.getElementById('ingredient-quantity').value.trim();
                const name = document.getElementById('ingredient-name').value.trim();
                const prep = document.getElementById('ingredient-prep').value.trim();
                
                if (quantity && name) {
                    let ingredientText = '';
                    
                    if (prep) {
                        ingredientText = `${quantity} de ${name} ${prep}`;
                    } else {
                        ingredientText = `${quantity} de ${name}`;
                    }
                    
                    const ingredientesTextarea = document.getElementById('ingredientes');
                    const currentText = ingredientesTextarea.value;
                    
                    ingredientesTextarea.value = currentText 
                        ? `${currentText}\n${ingredientText}` 
                        : ingredientText;
                    
                    ingredientModal.classList.add('hidden');
                    clearIngredientForm();
                } else {
                    // Mostrar erro
                    if (!quantity) {
                        document.getElementById('ingredient-quantity').classList.add('border-red-500');
                    }
                    if (!name) {
                        document.getElementById('ingredient-name').classList.add('border-red-500');
                    }
                }
            });
            
            // Limpar formulário
            function clearIngredientForm() {
                document.getElementById('ingredient-quantity').value = '';
                document.getElementById('ingredient-name').value = '';
                document.getElementById('ingredient-prep').value = '';
                
                document.getElementById('ingredient-quantity').classList.remove('border-red-500');
                document.getElementById('ingredient-name').classList.remove('border-red-500');
            }
        }
        
        // Configurar sugestões de ingredientes
        function setupIngredientSuggestions() {
            const suggestions = document.querySelectorAll('.ingredient-suggestion');
            const ingredientesTextarea = document.getElementById('ingredientes');
            
            suggestions.forEach(suggestion => {
                suggestion.addEventListener('click', () => {
                    const currentText = ingredientesTextarea.value;
                    const suggestionText = suggestion.textContent;
                    
                    ingredientesTextarea.value = currentText 
                        ? `${currentText}\n${suggestionText}` 
                        : suggestionText;
                });
            });
        }
        
        // Ordenar ingredientes
        function setupSortIngredients() {
            const sortIngredientsBtn = document.getElementById('sort-ingredients-btn');
            const ingredientesTextarea = document.getElementById('ingredientes');
            
            sortIngredientsBtn.addEventListener('click', () => {
                const ingredientes = ingredientesTextarea.value.split('\n').filter(i => i.trim());
                
                if (ingredientes.length > 1) {
                    ingredientes.sort();
                    ingredientesTextarea.value = ingredientes.join('\n');
                }
            });
        }
        
        // Formatar passos
        function setupFormatSteps() {
            const formatStepsBtn = document.getElementById('format-steps-btn');
            const modoPreparoTextarea = document.getElementById('modo_preparo');
            
            formatStepsBtn.addEventListener('click', () => {
                const passos = modoPreparoTextarea.value.split('\n').filter(p => p.trim());
                const formattedPassos = passos.map((passo, index) => {
                    // Remover numeração existente
                    const cleanPasso = passo.replace(/^\d+[\.\)]\s*/, '');
                    // Adicionar nova numeração
                    return `${index + 1}. ${cleanPasso}`;
                });
                
                modoPreparoTextarea.value = formattedPassos.join('\n');
            });
        }
        
        // Configurar pré-visualização
        function setupPreview() {
            const previewBtn = document.getElementById('preview-btn');
            const previewModal = document.getElementById('preview-modal');
            const closePreviewBtn = document.getElementById('close-preview-btn');
            
            previewBtn.addEventListener('click', () => {
                generatePreview();
                previewModal.classList.remove('hidden');
            });
            
            closePreviewBtn.addEventListener('click', () => {
                previewModal.classList.add('hidden');
            });
        }
        
        // Gerar pré-visualização
        function generatePreview() {
            // Título e descrição
            document.getElementById('preview-title').textContent = document.getElementById('receita_titulo').value || 'Título da Receita';
            document.getElementById('preview-description').textContent = document.getElementById('receita_descricao').value || 'Descrição da receita...';
            
            // Detalhes
            document.getElementById('preview-time').textContent = `${document.getElementById('receita_duracao').value || '0'} min`;
            document.getElementById('preview-portions').textContent = document.getElementById('porcoes').value || '0';
            
            const dificuldadeSelect = document.getElementById('nivel_dificuldade');
            document.getElementById('preview-difficulty').textContent = dificuldadeSelect.options[dificuldadeSelect.selectedIndex]?.text || 'Não informado';
            
            const categoriaSelect = document.getElementById('categoria');
            document.getElementById('preview-category').textContent = categoriaSelect.options[categoriaSelect.selectedIndex]?.text || 'Não informada';
            
            // Imagem
            const receitaFoto = document.getElementById('receita_foto');
            if (receitaFoto.files && receitaFoto.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(receitaFoto.files[0]);
            } else {
                document.getElementById('preview-image').src = "{{ asset('storage/' . $receita->receita_foto) }}";
            }
            
            // Ingredientes
            const ingredientesTextarea = document.getElementById('ingredientes');
            const ingredientesList = document.getElementById('preview-ingredients');
            ingredientesList.innerHTML = '';
            
            const ingredientes = ingredientesTextarea.value.split('\n').filter(i => i.trim());
            ingredientes.forEach(ingrediente => {
                const li = document.createElement('li');
                li.textContent = ingrediente;
                ingredientesList.appendChild(li);
            });
            
            // Modo de preparo
            const modoPreparoTextarea = document.getElementById('modo_preparo');
            const stepsList = document.getElementById('preview-steps');
            stepsList.innerHTML = '';
            
            const passos = modoPreparoTextarea.value.split('\n').filter(p => p.trim());
            passos.forEach(passo => {
                const li = document.createElement('li');
                // Remover numeração existente se houver
                li.textContent = passo.replace(/^\d+[\.\)]\s*/, '');
                stepsList.appendChild(li);
            });
            
            // Dicas
            const dicasTextarea = document.getElementById('dicas');
            const dicasContainer = document.getElementById('preview-tips-container');
            const dicasContent = document.getElementById('preview-tips');
            
            if (dicasTextarea.value.trim()) {
                dicasContent.textContent = dicasTextarea.value;
                dicasContainer.classList.remove('hidden');
            } else {
                dicasContainer.classList.add('hidden');
            }
        }
        
        // Inicializar quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', () => {
            // Configurar navegação por abas
            document.querySelectorAll('.form-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetId = tab.getAttribute('data-target');
                    const step = parseInt(tab.getAttribute('data-step'));
                    
                    if (targetId === 'info-tab-pane') {
                        prevTab(targetId, step);
                    } else if (parseInt(document.getElementById('progress-label').getAttribute('data-current-step')) < step) {
                        nextTab(targetId, step);
                    } else {
                        prevTab(targetId, step);
                    }
                });
            });
            
            // Configurar upload de imagem com drag and drop
            const dropzone = document.querySelector('label[for="receita_foto"]').closest('div');
            const fileInput = document.getElementById('receita_foto');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropzone.classList.add('border-orange-300', 'bg-orange-50');
            }
            
            function unhighlight() {
                dropzone.classList.remove('border-orange-300', 'bg-orange-50');
            }
            
            dropzone.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                
                // Mostrar preview da imagem
                if (files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = dropzone.closest('div').previousElementSibling.querySelector('img');
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(files[0]);
                }
            }
            
            // Inicializar componentes
            setupIngredientModal();
            setupIngredientSuggestions();
            setupSortIngredients();
            setupFormatSteps();
            setupPreview();
            
            // Remover mensagens de erro ao digitar
            document.querySelectorAll('input, textarea, select').forEach(field => {
                field.addEventListener('input', () => {
                    field.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                });
            });
        });
    </script>
</x-app-layout>

