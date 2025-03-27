<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold leading-tight text-white" style="font-size: 30px">
                {{ __('Criar uma Receita') }}
            </h1>
            <a href="/" class="flex items-center text-xl font-semibold leading-tight text-white">
                <span style="font-size: 24px; margin-right: 8px;">←</span>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('receita.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-12">
                            <div class="pb-12 border-b border-gray-900/10">
                                <h1 class="font-bold text-gray-900 text-base/7">Vamos criar a sua receita? 👨‍🍳</h1>

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="receita_titulo"
                                            class="block font-bold text-orange-600 text-sm/1">Título da Receita</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex items-center pl-3 bg-white rounded-md outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                                <input type="text" name="receita_titulo" id="receita_titulo"
                                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                                    placeholder="A Minha Receita">
                                                @error('receita_titulo')
                                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="receita_descricao"
                                            class="block font-bold text-orange-600 text-sm/1">Descrição</label>
                                        <div class="mt-2">
                                            <textarea name="receita_descricao" id="receita_descricao" rows="3"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                placeholder="Escreve uma breve descrição sobre a tua receita! 😋"> </textarea>
                                            @error('receita_descricao')
                                                <p class="text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <p class="mt-3 text-gray-600 text-sm/6">Escreve uma breve descrição sobre a tua
                                            receita! 😋
                                        </p>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="receita_foto" class="block font-bold text-orange-600 text-sm/1">Capa
                                            da Receita</label>
                                        <label for="receita_foto">Recomendamos o uso de uma imagem com uma resolução de
                                            <strong><u>1280x720</u></strong> para melhor visibilidade</label>

                                        <div
                                            class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25">
                                            <div class="text-center">
                                                <svg class="mx-auto text-gray-300 size-12" viewBox="0 0 24 24"
                                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path fill-rule="evenodd"
                                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <div class="flex mt-4 text-gray-600 text-sm/1">
                                                    <label for="receita_foto"
                                                        class="relative font-semibold text-orange-600 bg-white rounded-md cursor-pointer">
                                                        <span>Carregar Ficheiro</span>
                                                        <input id="receita_foto" name="receita_foto" type="file"
                                                            class="sr-only" a               ccept="image/*"
                                                            onchange="previewImage(event)">
                                                    </label>
                                                </div>

                                                <p class="text-gray-600 text-xs/5">PNG, JPG, GIF até 10MB</p>
                                                <p class="text-gray-600 text-xs/5">Resolução recomendada:
                                                    <strong><u>1280x720</u></strong>
                                                </p>

                                                <div id="imagePreviewContainer" class="mt-4 hidden">
                                                    <img id="imagePreview" class="rounded-md" src=""
                                                        alt="Image Preview" style="max-width: 500px; height: auto;">
                                                    <button type="button" class="mt-2 text-red-600"
                                                        onclick="removeImage()">Remover Imagem</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
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
                                            fileInput.value = ''; // Limpa o input do ficheiro
                                        }
                                    </script>
                                </div>
                            </div>

                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="font-bold text-orange-600 text-base/1">Detalhes da Receita</h2>

                                <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="receita_duracao" class="block font-medium text-gray-900 text-sm/6">
                                            Duração da Receita
                                        </label>
                                        <p class="mt-1 text-gray-600 text-sm/6">
                                            Quanto tempo demora para preparar esta receita? 🤔 (Em Minutos)
                                        </p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <input type="number" name="receita_duracao" id="receita_duracao"
                                                class="block w-20 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                placeholder="30">
                                            <span class="text-gray-900">minutos</span>
                                            @error('receita_duracao')
                                                <p class="text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Novo campo para porções -->
                                    <div class="sm:col-span-3">
                                        <label for="porcoes" class="block font-medium text-gray-900 text-sm/6">
                                            Porções
                                        </label>
                                        <p class="mt-1 text-gray-600 text-sm/6">
                                            Quantas porções a receita rende? 🍽️
                                        </p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <input type="number" name="porcoes" id="porcoes"
                                                class="block w-20 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                placeholder="4">
                                            <span class="text-gray-900">porções</span>
                                            @error('porcoes')
                                                <p class="text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Nível de dificuldade e calorias -->
                                <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="nivel_dificuldade"
                                            class="block font-medium text-gray-900 text-sm/6">
                                            Nível de Dificuldade
                                        </label>
                                        <div class="mt-2">
                                            <select id="nivel_dificuldade" name="nivel_dificuldade"
                                                class="block w-full rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                <option value="Fácil">Fácil</option>
                                                <option value="Médio">Médio</option>
                                                <option value="Difícil">Difícil</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="calorias" class="block font-medium text-gray-900 text-sm/6">
                                            Calorias (opcional)
                                        </label>
                                        <div class="flex items-center gap-2 mt-2">
                                            <input type="number" name="calorias" id="calorias"
                                                class="block w-28 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                placeholder="350">
                                            <span class="text-gray-900">calorias</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <label for="categoria"
                                        class="block font-medium text-gray-900 text-sm/6">Categorias</label>
                                    <p class="mt-1 text-gray-600 text-sm/6">Seleciona as categorias que se encaixam
                                        na tua receita</p>

                                    <?php
                                    // Conexão simplificada
                                    $conexao = mysqli_connect('localhost', 'root', '', 'quickbites');

                                    // Buscar as categorias
                                    $sql = 'SELECT nome FROM categorias';
                                    $resultado = mysqli_query($conexao, $sql);
                                    ?>

                                    <div class="grid grid-cols-1 mt-2" style="padding-bottom: 12px">
                                        <select id="categoria" name="categoria" autocomplete="categoria"
                                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option disabled selected>Categoria</option>
                                            <?php while($categoria = mysqli_fetch_assoc($resultado)): ?>
                                            <option><?php echo $categoria['nome']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <svg class="self-center col-start-1 row-start-1 mr-2 text-gray-500 pointer-events-none size-5 justify-self-end sm:size-4"
                                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"
                                            data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    <style>
                                        .btnCriarCategoria {
                                            background-color: #ff6b00 !important;
                                            color: white !important;
                                            padding: 3px !important;
                                            border-radius: 4px !important;
                                            display: inline-flex !important;
                                            align-items: center !important;
                                            /* gap: 6px !important; */
                                            text-decoration: none;
                                        }

                                        .btnCriarCategoria:hover {
                                            background-color: #e69600 !important;
                                            /* Cor mais escura ao passar o mouse */
                                        }
                                    </style>
                                    <a href="{{ route('categorias.create') }}" class="btnCriarCategoria"
                                        target="_blank">
                                        <span style="font-size: 24px;">+</span> Criar Categoria
                                    </a>
                                </div>
                            </div>

                            <!-- Seção de Ingredientes e Modo de Preparo -->
                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="font-bold text-orange-600 text-base/1">Ingredientes e Modo de Preparo</h2>

                                <!-- Ingredientes -->
                                <div class="mt-6">
                                    <label for="ingredientes" class="block font-medium text-gray-900 text-sm/6">
                                        Ingredientes
                                    </label>
                                    <p class="mt-1 text-gray-600 text-sm/6">
                                        Liste todos os ingredientes necessários, um por linha 📝
                                    </p>
                                    <div class="mt-2">
                                        <textarea name="ingredientes" id="ingredientes" rows="8"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            placeholder="2 colheres de sopa de azeite&#10;1 cebola média picada&#10;2 dentes de alho picados&#10;500g de carne moída"></textarea>
                                        @error('ingredientes')
                                            <p class="text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Modo de Preparo -->
                                <div class="mt-6">
                                    <label for="modo_preparo" class="block font-medium text-gray-900 text-sm/6">
                                        Modo de Preparo
                                    </label>
                                    <p class="mt-1 text-gray-600 text-sm/6">
                                        Descreva cada passo do preparo, um por linha 👨‍🍳
                                    </p>
                                    <div class="mt-2">
                                        <textarea name="modo_preparo" id="modo_preparo" rows="10"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            placeholder="Aqueça o azeite em uma panela grande em fogo médio.&#10;Adicione a cebola e refogue até ficar transparente.&#10;Adicione o alho e refogue por mais 1 minuto.&#10;Adicione a carne moída e cozinhe até dourar."></textarea>
                                        @error('modo_preparo')
                                            <p class="text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dicas -->
                                <div class="mt-6">
                                    <label for="dicas" class="block font-medium text-gray-900 text-sm/6">
                                        Dicas (opcional)
                                    </label>
                                    <p class="mt-1 text-gray-600 text-sm/6">
                                        Compartilhe dicas especiais para melhorar a receita 💡
                                    </p>
                                    <div class="mt-2">
                                        <textarea name="dicas" id="dicas" rows="4"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            placeholder="Para um sabor mais intenso, deixe a carne marinando na geladeira por pelo menos 2 horas antes de cozinhar."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-x-6">
                            <button type="button" class="font-semibold text-gray-900 text-sm/6">Cancelar</button>
                            <button type="submit"
                                class="px-3 py-2 mb-2 mr-2 text-sm font-semibold text-white bg-orange-600 rounded-md shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Criar!</button>
                        </div>

                        <input type="hidden" name="autor" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="autor_id" value="{{ Auth::id() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
