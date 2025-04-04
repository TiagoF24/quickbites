<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h1 class="text-2xl font-bold leading-tight text-white mb-2 md:mb-0">
                <i class="bi bi-journal-plus me-2"></i>{{ __('Criar uma Nova Receita') }}
            </h1>
            <a href="/"
                class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="bi bi-house-door me-2"></i>Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Mensagens de Feedback -->
            @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-md" role="alert"
                id="successAlert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="pl-3 ml-auto">
                        <button type="button" class="inline-flex text-green-700"
                            onclick="document.getElementById('successAlert').remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-md" role="alert"
                id="errorAlert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <div class="pl-3 ml-auto">
                        <button type="button" class="inline-flex text-red-700"
                            onclick="document.getElementById('errorAlert').remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6 text-gray-900">
                    <!-- Progresso do Formulário -->
                    <div class="mb-8">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Progresso do formulário</span>
                            <span class="text-sm font-medium text-gray-700" id="formProgress">0%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-orange-500 rounded-full transition-all duration-300" id="progressBar" style="width: 0%"></div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('receita.store') }}" enctype="multipart/form-data"
                        id="recipeForm" class="recipe-form">
                        @csrf
                        <div class="space-y-12">
                            <!-- Seção 1: Informações Básicas -->
                            <div class="pb-12 border-b border-gray-900/10" id="section1">
                                <h2 class="text-xl font-bold text-orange-600 flex items-center">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 mr-2 text-white bg-orange-600 rounded-full flex-shrink-0">1</span>
                                    Informações Básicas
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">Vamos começar com as informações essenciais da sua
                                    receita.</p>

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="receita_titulo" class="block text-sm font-medium text-gray-900">
                                            Título da Receita <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-600">
                                                <input type="text" name="receita_titulo" id="receita_titulo" required
                                                    class="block w-full border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Ex: Bolo de Chocolate Especial"
                                                    value="{{ old('receita_titulo') }}">
                                            </div>
                                            @error('receita_titulo')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-xs text-gray-500">Escolha um título descritivo e
                                                atraente para sua receita.</p>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="receita_descricao" class="block text-sm font-medium text-gray-900">
                                            Descrição <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <textarea name="receita_descricao" id="receita_descricao" rows="3" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                                                placeholder="Descreva brevemente sua receita, conte sua história ou inspiração...">{{ old('receita_descricao') }}</textarea>
                                            @error('receita_descricao')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Uma boa descrição ajuda a despertar o
                                            interesse de quem vai preparar sua receita.</p>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="receita_foto" class="block text-sm font-medium text-gray-900">
                                            Foto da Receita <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-1 text-sm text-gray-500">
                                            Recomendamos o uso de uma imagem com resolução de <strong>1280x720</strong>
                                            pixels para melhor visualização.
                                        </div>

                                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                                            id="dropzone">
                                            <div class="text-center">
                                                <i class="bi bi-image text-gray-300 text-5xl"></i>
                                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                    <label for="receita_foto"
                                                        class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 hover:text-orange-500">
                                                        <span>Carregar imagem</span>
                                                        <input id="receita_foto" name="receita_foto" type="file"
                                                            class="sr-only" accept="image/*" onchange="previewImage(event)">
                                                    </label>
                                                    <p class="pl-1">ou arraste e solte</p>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF até 10MB</p>

                                                <div id="imagePreviewContainer" class="mt-4 hidden">
                                                    <img id="imagePreview"
                                                        class="mx-auto max-h-64 rounded-md object-cover shadow-md"
                                                        src="" alt="Preview da Imagem">
                                                    <button type="button"
                                                        class="mt-2 text-sm text-red-600 hover:text-red-800"
                                                        onclick="removeImage()">
                                                        <i class="bi bi-trash me-1"></i>Remover imagem
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @error('receita_foto')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end mt-8">
                                    <button type="button"
                                        class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-colors"
                                        onclick="nextSection(1)">
                                        Próximo <i class="bi bi-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Seção 2: Detalhes da Receita -->
                            <div class="pb-12 border-b border-gray-900/10 hidden" id="section2">
                                <h2 class="text-xl font-bold text-orange-600 flex items-center">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 mr-2 text-white bg-orange-600 rounded-full flex-shrink-0">2</span>
                                    Detalhes da Receita
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">Informe os detalhes técnicos da sua receita.</p>

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="receita_duracao" class="block text-sm font-medium text-gray-900">
                                            Tempo de Preparo <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-600">
                                                <input type="number" name="receita_duracao" id="receita_duracao" min="1"
                                                    required
                                                    class="block w-full border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="30" value="{{ old('receita_duracao') }}">
                                                <span
                                                    class="flex items-center pr-3 text-gray-500 sm:text-sm">minutos</span>
                                            </div>
                                            @error('receita_duracao')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="porcoes" class="block text-sm font-medium text-gray-900">
                                            Porções <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-600">
                                                <input type="number" name="porcoes" id="porcoes" min="1" required
                                                    class="block w-full border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="4" value="{{ old('porcoes') }}">
                                                <span
                                                    class="flex items-center pr-3 text-gray-500 sm:text-sm">porções</span>
                                            </div>
                                            @error('porcoes')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="nivel_dificuldade" class="block text-sm font-medium text-gray-900">
                                            Nível de Dificuldade <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <select id="nivel_dificuldade" name="nivel_dificuldade" required
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6">
                                                <option value="" disabled {{ old('nivel_dificuldade') ? '' : 'selected' }}>Selecione a dificuldade</option>
                                                <option value="Fácil" {{ old('nivel_dificuldade') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                                                <option value="Médio" {{ old('nivel_dificuldade') == 'Médio' ? 'selected' : '' }}>Médio</option>
                                                <option value="Difícil" {{ old('nivel_dificuldade') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                                            </select>
                                            @error('nivel_dificuldade')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="calorias" class="block text-sm font-medium text-gray-900">
                                            Calorias (opcional)
                                        </label>
                                        <div class="mt-2">
                                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-600">
                                                <input type="number" name="calorias" id="calorias" min="0"
                                                    class="block w-full border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="350" value="{{ old('calorias') }}">
                                                <span class="flex items-center pr-3 text-gray-500 sm:text-sm">calorias</span>
                                            </div>
                                            @error('calorias')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="categoria" class="block text-sm font-medium text-gray-900">
                                            Categoria <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-2">
                                            <div class="flex items-center">
                                                <select id="categoria" name="categoria" required
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6">
                                                    <option value="" disabled selected>Selecione uma categoria</option>
                                                    <?php
                                                    // Conexão simplificada
                                                    $conexao = mysqli_connect('localhost', 'root', '', 'quickbites');

                                                    // Buscar as categorias
                                                    $sql = 'SELECT nome FROM categorias';
                                                    $resultado = mysqli_query($conexao, $sql);
                                                    
                                                    while($categoria = mysqli_fetch_assoc($resultado)): ?>
                                                        <option value="<?php echo $categoria['nome']; ?>" {{ old('categoria') == $categoria['nome'] ? 'selected' : '' }}>
                                                            <?php echo $categoria['nome']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                                
                                                <a href="{{ route('categorias.create') }}" class="ml-3 inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-colors" target="_blank">
                                                    <i class="bi bi-plus-lg mr-1"></i> Nova Categoria
                                                </a>
                                            </div>
                                            @error('categoria')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-8">
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="prevSection(2)">
                                        <i class="bi bi-arrow-left mr-1"></i> Anterior
                                    </button>
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-colors" onclick="nextSection(2)">
                                        Próximo <i class="bi bi-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Seção 3: Ingredientes e Modo de Preparo -->
                            <div class="pb-12 border-b border-gray-900/10 hidden" id="section3">
                                <h2 class="text-xl font-bold text-orange-600 flex items-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 mr-2 text-white bg-orange-600 rounded-full flex-shrink-0">3</span>
                                    Ingredientes e Modo de Preparo
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">Detalhe os ingredientes e o passo a passo da sua receita.</p>

                                <div class="mt-10 space-y-8">
                                    <div>
                                        <label for="ingredientes" class="block text-sm font-medium text-gray-900">
                                            Ingredientes <span class="text-red-500">*</span>
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500">Liste todos os ingredientes necessários, um por linha.</p>
                                        
                                        <div class="mt-2">
                                            <div class="flex justify-end mb-2">
                                                <button type="button" class="text-sm text-orange-600 hover:text-orange-500 flex items-center" id="addIngredientBtn">
                                                    <i class="bi bi-plus-circle mr-1"></i> Adicionar ingrediente
                                                </button>
                                            </div>
                                            
                                            <div class="rounded-md border border-gray-300 overflow-hidden">
                                                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300">
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-sm font-medium text-gray-700">Lista de Ingredientes</span>
                                                        <div class="flex space-x-2">
                                                            <button type="button" class="text-xs text-gray-600 hover:text-gray-900 flex items-center" id="sortIngredientsBtn">
                                                                <i class="bi bi-sort-alpha-down mr-1"></i> Ordenar
                                                            </button>
                                                            <button type="button" class="text-xs text-gray-600 hover:text-gray-900 flex items-center" id="clearIngredientsBtn">
                                                                <i class="bi bi-trash mr-1"></i> Limpar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <textarea name="ingredientes" id="ingredientes" rows="8" required
                                                    class="block w-full border-0 py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="2 colheres de sopa de azeite&#10;1 cebola média picada&#10;2 dentes de alho picados&#10;500g de carne moída">{{ old('ingredientes') }}</textarea>
                                            </div>
                                            @error('ingredientes')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            
                                            <!-- Modal para adicionar ingrediente -->
                                            <div class="fixed inset-0 z-10 hidden overflow-y-auto" id="ingredientModal">
                                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                    </div>
                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <h3 class="text-lg font-medium text-gray-900">Adicionar Ingrediente</h3>
                                                            <div class="mt-4 space-y-4">
                                                                <div>
                                                                    <label for="ingredientQuantity" class="block text-sm font-medium text-gray-700">Quantidade</label>
                                                                    <input type="text" id="ingredientQuantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="2 colheres de sopa">
                                                                </div>
                                                                <div>
                                                                    <label for="ingredientName" class="block text-sm font-medium text-gray-700">Ingrediente</label>
                                                                    <input type="text" id="ingredientName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="azeite de oliva">
                                                                </div>
                                                                <div>
                                                                    <label for="ingredientPrep" class="block text-sm font-medium text-gray-700">Preparo (opcional)</label>
                                                                    <input type="text" id="ingredientPrep" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="extra virgem">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm" id="addIngredientConfirm">
                                                                Adicionar
                                                            </button>
                                                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="closeIngredientModal">
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="modo_preparo" class="block text-sm font-medium text-gray-900">
                                            Modo de Preparo <span class="text-red-500">*</span>
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500">Descreva cada passo do preparo, um por linha.</p>
                                        
                                        <div class="mt-2">
                                            <div class="rounded-md border border-gray-300 overflow-hidden">
                                                <div class="bg-gray-50 px-4 py-2 border-b border-gray-300">
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-sm font-medium text-gray-700">Passos do Preparo</span>
                                                        <button type="button" class="text-xs text-gray-600 hover:text-gray-900 flex items-center" id="clearStepsBtn">
                                                            <i class="bi bi-trash mr-1"></i> Limpar
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <textarea name="modo_preparo" id="modo_preparo" rows="10" required
                                                    class="block w-full border-0 py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="1. Aqueça o azeite em uma panela grande em fogo médio.&#10;2. Adicione a cebola e refogue até ficar transparente.&#10;3. Adicione o alho e refogue por mais 1 minuto
                                                    placeholder="1. Aqueça o azeite em uma panela grande em fogo médio.&#10;2. Adicione a cebola e refogue até ficar transparente.&#10;3. Adicione o alho e refogue por mais 1 minuto.&#10;4. Adicione a carne moída e cozinhe até dourar.">{{ old('modo_preparo') }}</textarea>
                                            </div>
                                            @error('modo_preparo')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-xs text-gray-500">Dica: Numere os passos para facilitar o entendimento (1, 2, 3...).</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="dicas" class="block text-sm font-medium text-gray-900">
                                            Dicas (opcional)
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500">Compartilhe dicas especiais para melhorar a receita.</p>
                                        
                                        <div class="mt-2">
                                            <textarea name="dicas" id="dicas" rows="4"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                                                placeholder="Para um sabor mais intenso, deixe a carne marinando na geladeira por pelo menos 2 horas antes de cozinhar.">{{ old('dicas') }}</textarea>
                                            @error('dicas')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-8">
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="prevSection(3)">
                                        <i class="bi bi-arrow-left mr-1"></i> Anterior
                                    </button>
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-colors" onclick="nextSection(3)">
                                        Revisar <i class="bi bi-check2-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Seção 4: Revisão e Envio -->
                            <div class="pb-12 hidden" id="section4">
                                <h2 class="text-xl font-bold text-orange-600 flex items-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 mr-2 text-white bg-orange-600 rounded-full flex-shrink-0">4</span>
                                    Revisar e Publicar
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">Revise todas as informações antes de publicar sua receita.</p>

                                <div class="mt-8 bg-gray-50 rounded-lg p-6">
                                    <div class="space-y-6">
                                        <!-- Prévia da Receita -->
                                        <div class="border-b border-gray-200 pb-4">
                                            <h3 class="text-lg font-medium text-gray-900" id="preview-title">Título da Receita</h3>
                                            <p class="mt-1 text-sm text-gray-500" id="preview-description">Descrição da receita...</p>
                                            
                                            <div class="mt-4 flex flex-wrap items-center gap-4">
                                                <div class="flex items-center">
                                                    <i class="bi bi-alarm text-orange-500 mr-1"></i>
                                                    <span class="text-sm text-gray-700" id="preview-duration">30 min</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="bi bi-people text-orange-500 mr-1"></i>
                                                    <span class="text-sm text-gray-700" id="preview-portions">4 porções</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="bi bi-bar-chart text-orange-500 mr-1"></i>
                                                    <span class="text-sm text-gray-700" id="preview-difficulty">Médio</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="bi bi-bookmark text-orange-500 mr-1"></i>
                                                    <span class="text-sm text-gray-700" id="preview-category">Categoria</span>
                                                </div>
                                                <div class="flex items-center" id="preview-calories-container">
                                                    <i class="bi bi-fire text-orange-500 mr-1"></i>
                                                    <span class="text-sm text-gray-700" id="preview-calories">350 calorias</span>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-4" id="preview-image-container">
                                                <img id="preview-image" class="h-48 w-full object-cover rounded-md" src="" alt="Preview da Receita">
                                            </div>
                                        </div>
                                        
                                        <!-- Ingredientes e Modo de Preparo -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <h4 class="text-md font-medium text-gray-900 mb-2">Ingredientes</h4>
                                                <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700" id="preview-ingredients">
                                                    <!-- Ingredientes serão inseridos aqui -->
                                                </ul>
                                            </div>
                                            
                                            <div>
                                                <h4 class="text-md font-medium text-gray-900 mb-2">Modo de Preparo</h4>
                                                <ol class="list-decimal pl-5 space-y-2 text-sm text-gray-700" id="preview-steps">
                                                    <!-- Passos serão inseridos aqui -->
                                                </ol>
                                            </div>
                                        </div>
                                        
                                        <!-- Dicas (se houver) -->
                                        <div id="preview-tips-container" class="hidden">
                                            <h4 class="text-md font-medium text-gray-900 mb-2">Dicas</h4>
                                            <div class="bg-yellow-50 p-3 rounded-md text-sm text-gray-700" id="preview-tips">
                                                <!-- Dicas serão inseridas aqui -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-exclamation-triangle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                Ao publicar, você confirma que esta receita é de sua autoria ou que você tem permissão para compartilhá-la.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-8">
                                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="prevSection(4)">
                                        <i class="bi bi-arrow-left mr-1"></i> Anterior
                                    </button>
                                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-colors">
                                        <i class="bi bi-send mr-1"></i> Publicar Receita
                                    </button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="autor" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="autor_id" value="{{ Auth::id() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para funcionalidade do formulário -->
    <script>
        // Funções de manipulação de imagem
        function previewImage(event) {
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.classList.add('hidden');
            }
        }
        
        function removeImage() {
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const fileInput = document.getElementById('receita_foto');
            
            imagePreview.src = '';
            imagePreviewContainer.classList.add('hidden');
            fileInput.value = '';
        }
        
        // Variáveis globais
        let currentSection = 1;
        const totalSections = 4;
        
        // Funções de navegação entre seções
        function nextSection(currentSectionNum) {
            // Validar a seção atual antes de avançar
            if (!validateSection(currentSectionNum)) {
                return;
            }
            
            // Esconder a seção atual
            document.getElementById(`section${currentSectionNum}`).classList.add('hidden');
            
            // Mostrar a próxima seção
            const nextSectionNum = currentSectionNum + 1;
            document.getElementById(`section${nextSectionNum}`).classList.remove('hidden');
            
            // Atualizar a seção atual
            currentSection = nextSectionNum;
            
            // Se for a última seção, gerar a prévia
            if (currentSection === 4) {
                generatePreview();
            }
            
            // Atualizar a barra de progresso
            updateProgressBar();
            
            // Rolar para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        function prevSection(currentSectionNum) {
            // Esconder a seção atual
            document.getElementById(`section${currentSectionNum}`).classList.add('hidden');
            
            // Mostrar a seção anterior
            const prevSectionNum = currentSectionNum - 1;
            document.getElementById(`section${prevSectionNum}`).classList.remove('hidden');
            
            // Atualizar a seção atual
            currentSection = prevSectionNum;
            
            // Atualizar a barra de progresso
            updateProgressBar();
            
            // Rolar para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Função de validação
        function validateSection(sectionNum) {
            let isValid = true;
            
            // Remover mensagens de erro anteriores
            const errorMessages = document.querySelectorAll('.validation-error');
            errorMessages.forEach(el => el.remove());
            
            // Remover classes de erro anteriores
            const errorFields = document.querySelectorAll('.border-red-500, .ring-red-500');
            errorFields.forEach(el => {
                el.classList.remove('border-red-500', 'ring-red-500');
            });
            
            switch(sectionNum) {
                case 1:
                    // Validar título, descrição e imagem
                    const titulo = document.getElementById('receita_titulo').value.trim();
                    const descricao = document.getElementById('receita_descricao').value.trim();
                    const foto = document.getElementById('receita_foto').files.length;
                    
                    if (!titulo) {
                        showError('receita_titulo', 'O título da receita é obrigatório');
                        isValid = false;
                    }
                    
                    if (!descricao) {
                        showError('receita_descricao', 'A descrição da receita é obrigatória');
                        isValid = false;
                    }
                    
                    if (foto === 0) {
                        showError('dropzone', 'Uma foto da receita é obrigatória');
                        isValid = false;
                    }
                    break;
                    
                case 2:
                    // Validar duração, porções, dificuldade e categoria
                    const duracao = document.getElementById('receita_duracao').value.trim();
                    const porcoes = document.getElementById('porcoes').value.trim();
                    const dificuldade = document.getElementById('nivel_dificuldade').value;
                    const categoria = document.getElementById('categoria').value;
                    
                    if (!duracao || duracao <= 0) {
                        showError('receita_duracao', 'Informe um tempo de preparo válido');
                        isValid = false;
                    }
                    
                    if (!porcoes || porcoes <= 0) {
                        showError('porcoes', 'Informe um número válido de porções');
                        isValid = false;
                    }
                    
                    if (!dificuldade) {
                        showError('nivel_dificuldade', 'Selecione o nível de dificuldade');
                        isValid = false;
                    }
                    
                    if (!categoria) {
                        showError('categoria', 'Selecione uma categoria');
                        isValid = false;
                    }
                    break;
                    
                case 3:
                    // Validar ingredientes e modo de preparo
                    const ingredientes = document.getElementById('ingredientes').value.trim();
                    const modoPreparo = document.getElementById('modo_preparo').value.trim();
                    
                    if (!ingredientes) {
                        showError('ingredientes', 'Liste os ingredientes da receita');
                        isValid = false;
                    }
                    
                    if (!modoPreparo) {
                        showError('modo_preparo', 'Descreva o modo de preparo da receita');
                        isValid = false;
                    }
                    break;
            }
            
            return isValid;
        }
        
        // Função para mostrar erros de validação
        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.createElement('p');
            errorDiv.className = 'mt-1 text-sm text-red-600 validation-error';
            errorDiv.textContent = message;
            
            // Adicionar a mensagem de erro após o campo
            field.parentElement.appendChild(errorDiv);
            
            // Destacar o campo com erro
            if (fieldId === 'dropzone') {
                field.classList.add('border-red-500');
            } else {
                field.classList.add('ring-red-500', 'border-red-500');
            }
            
            // Rolar até o campo com erro
            field.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        // Atualizar a barra de progresso
        function updateProgressBar() {
            const progress = Math.min(((currentSection - 1) / (totalSections - 1)) * 100, 100);
            document.getElementById('progressBar').style.width = `${progress}%`;
            document.getElementById('formProgress').textContent = `${Math.round(progress)}%`;
        }
        
        // Configurar o drag and drop para upload de imagem
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('receita_foto');
            
            if (!dropzone || !fileInput) return;
            
            // Prevenir comportamento padrão
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });
            
            // Destacar área
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, function() {
                    dropzone.classList.add('bg-orange-50', 'border-orange-300');
                }, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, function() {
                    dropzone.classList.remove('bg-orange-50', 'border-orange-300');
                }, false);
            });
            
            // Processar arquivo
            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length) {
                    fileInput.files = files;
                    previewImage({ target: fileInput });
                }
            }, false);
            
            // Configurar modal de ingredientes
            setupIngredientModal();
            
            // Configurar botões de ingredientes e passos
            setupIngredientButtons();
            setupStepButtons();
        });
        
        // Configurar modal de ingredientes
        function setupIngredientModal() {
            const addIngredientBtn = document.getElementById('addIngredientBtn');
            const ingredientModal = document.getElementById('ingredientModal');
            const closeIngredientModal = document.getElementById('closeIngredientModal');
            const addIngredientConfirm = document.getElementById('addIngredientConfirm');
            
            if (!addIngredientBtn || !ingredientModal || !closeIngredientModal || !addIngredientConfirm) return;
            
            // Abrir modal
            addIngredientBtn.addEventListener('click', function() {
                ingredientModal.classList.remove('hidden');
                document.getElementById('ingredientQuantity').focus();
            });
            
            // Fechar modal
            closeIngredientModal.addEventListener('click', function() {
                ingredientModal.classList.add('hidden');
                clearIngredientForm();
            });
            
            // Adicionar ingrediente ao textarea
            addIngredientConfirm.addEventListener('click', function() {
                const quantity = document.getElementById('ingredientQuantity').value.trim();
                const name = document.getElementById('ingredientName').value.trim();
                const prep = document.getElementById('ingredientPrep').value.trim();
                
                if (quantity && name) {
                    const ingredientText = prep 
                        ? `${quantity} de ${name} ${prep}` 
                        : `${quantity} de ${name}`;
                    
                    const ingredientesTextarea = document.getElementById('ingredientes');
                    const currentText = ingredientesTextarea.value;
                    
                    ingredientesTextarea.value = currentText 
                        ? `${currentText}\n${ingredientText}` 
                        : ingredientText;
                    
                    ingredientModal.classList.add('hidden');
                    clearIngredientForm();
                } else {
                    // Mostrar erro se quantidade ou nome estiverem vazios
                    if (!quantity) {
                        document.getElementById('ingredientQuantity').classList.add('border-red-500');
                    }
                    if (!name) {
                        document.getElementById('ingredientName').classList.add('border-red-500');
                    }
                }
            });
            
            // Limpar formulário de ingrediente
            function clearIngredientForm() {
                document.getElementById('ingredientQuantity').value = '';
                document.getElementById('ingredientName').value = '';
                document.getElementById('ingredientPrep').value = '';
                
                document.getElementById('ingredientQuantity').classList.remove('border-red-500');
                document.getElementById('ingredientName').classList.remove('border-red-500');
            }
        }
        
        // Configurar botões de ingredientes
        function setupIngredientButtons() {
            // Ordenar ingredientes alfabeticamente
            const sortIngredientsBtn = document.getElementById('sortIngredientsBtn');
            if (sortIngredientsBtn) {
                sortIngredientsBtn.addEventListener('click', function() {
                    const ingredientesTextarea = document.getElementById('ingredientes');
                    const ingredientes = ingredientesTextarea.value.split('\n').filter(i => i.trim());
                    
                    if (ingredientes.length > 1) {
                        ingredientes.sort();
                        ingredientesTextarea.value = ingredientes.join('\n');
                    }
                });
            }
            
            // Limpar todos os ingredientes
            const clearIngredientsBtn = document.getElementById('clearIngredientsBtn');
            if (clearIngredientsBtn) {
                clearIngredientsBtn.addEventListener('click', function() {
                    if (confirm('Tem certeza que deseja limpar todos os ingredientes?')) {
                        document.getElementById('ingredientes').value = '';
                    }
                });
            }
        }
        
        // Configurar botões de passos
        function setupStepButtons() {
            // Limpar todos os passos
            const clearStepsBtn = document.getElementById('clearStepsBtn');
            if (clearStepsBtn) {
                clearStepsBtn.addEventListener('click', function() {
                    if (confirm('Tem certeza que deseja limpar todos os passos?')) {
                        document.getElementById('modo_preparo').value = '';
                    }
                });
            }
        }
        
        // Gerar prévia da receita
        function generatePreview() {
            // Informações básicas
            document.getElementById('preview-title').textContent = document.getElementById('receita_titulo').value || 'Título da Receita';
            document.getElementById('preview-description').textContent = document.getElementById('receita_descricao').value || 'Descrição da receita...';
            
            // Detalhes
            document.getElementById('preview-duration').textContent = `${document.getElementById('receita_duracao').value || '0'} min`;
            document.getElementById('preview-portions').textContent = `${document.getElementById('porcoes').value || '0'} porções`;
            
            const dificuldadeSelect = document.getElementById('nivel_dificuldade');
            document.getElementById('preview-difficulty').textContent = dificuldadeSelect.options[dificuldadeSelect.selectedIndex]?.text || 'Não informado';
            
            const categoriaSelect = document.getElementById('categoria');
            document.getElementById('preview-category').textContent = categoriaSelect.options[categoriaSelect.selectedIndex]?.text || 'Não informada';
            
            // Calorias (opcional)
            const calorias = document.getElementById('calorias').value;
            if (calorias) {
                document.getElementById('preview-calories').textContent = `${calorias} calorias`;
                document.getElementById('preview-calories-container').classList.remove('hidden');
            } else {
                document.getElementById('preview-calories-container').classList.add('hidden');
            }
            
            // Imagem
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview.src) {
                document.getElementById('preview-image').src = imagePreview.src;
                document.getElementById('preview-image-container').classList.remove('hidden');
            } else {
                document.getElementById('preview-image-container').classList.add('hidden');
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
            passos.forEach((passo, index) => {
                const li = document.createElement('li');
                // Remove numeração existente se houver
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
    </script>
</x-app-layout>

