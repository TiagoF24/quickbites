<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-white ">
            {{ __('Criar uma Receita') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- sadasdasd --}}
                    <form>
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
                                        </div>
                                        <p class="mt-3 text-gray-600 text-sm/6">Escreve uma breve descrição sobre a tua
                                            receita! 😋
                                        </p>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="capa_receita" class="block font-bold text-orange-600 text-sm/1">Capa
                                            da Receita</label>
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
                                                    <label for="file-upload"
                                                        class="relative font-semibold text-orange-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Carregar Ficheiro</span>
                                                        <input id="file-upload" name="file-upload" type="file"
                                                            class="sr-only">
                                                    </label>
                                                    <p class="pl-1">ou arrasta e solta</p>
                                                </div>
                                                <p class="text-gray-600 text-xs/5">PNG, JPG, GIF até 10MB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ingredientes --}}

                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="font-bold text-orange-600 text-base/1">Ingredientes</h2>
                                <p class="mt-1 text-gray-600 text-sm/6">Adiciona os ingredientes necessários para a
                                    receita</p>

                                <div id="ingredientes-container" class="mt-4 space-y-2">
                                    <div class="flex items-center gap-2 ingrediente">
                                        <input type="text" name="ingredientes[]"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm"
                                            placeholder="Ex: 2 xícaras de farinha">
                                        <button type="button"
                                            class="px-2 py-1 text-red-600 rounded remove-ingrediente">❌</button>
                                    </div>
                                </div>

                                <button type="button" id="adicionar-ingrediente"
                                    class="px-3 py-2 mt-2 text-sm font-semibold text-white bg-green-600 rounded-md hover:bg-green-500">+
                                    Adicionar Ingrediente</button>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const container = document.getElementById("ingredientes-container");
                                    const botaoAdicionar = document.getElementById("adicionar-ingrediente");

                                    botaoAdicionar.addEventListener("click", function() {
                                        let novoCampo = document.createElement("div");
                                        novoCampo.classList.add("flex", "items-center", "gap-2", "ingrediente");

                                        novoCampo.innerHTML = `
                                            <input type="text" name="ingredientes[]" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm" placeholder="Ex: 1 colher de açúcar">
                                            <button type="button" class="px-2 py-1 text-red-600 rounded remove-ingrediente">❌</button>
                                        `;

                                        container.appendChild(novoCampo);
                                    });

                                    container.addEventListener("click", function(e) {
                                        if (e.target.classList.contains("remove-ingrediente")) {
                                            let ingredientes = document.querySelectorAll(".ingrediente");
                                            if (ingredientes.length > 1) {
                                                e.target.parentElement.remove();
                                            }
                                        }
                                    });
                                });
                            </script>





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
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="country"
                                        class="block mt-6 font-medium text-gray-900 text-sm/6">Categorias</label>
                                    <p class="mt-1 text-gray-600 text-sm/6">Seleciona as categorias que se encaixam
                                        na tua receita</p>
                                    <div class="grid grid-cols-1 mt-2">
                                        <select id="country" name="country" autocomplete="country-name"
                                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option disabled selected>Categoria</option>
                                            <option>Categoria 1</option>
                                            <option>Categoria 2</option>
                                            <option>Categoria 3</option>
                                            <option>Categoria 4</option>
                                            <option>Categoria 5</option>
                                        </select>
                                        <svg class="self-center col-start-1 row-start-1 mr-2 text-gray-500 pointer-events-none size-5 justify-self-end sm:size-4"
                                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="flex items-center justify-end mt-6 gap-x-6">
                    <button type="button" class="font-semibold text-gray-900 text-sm/6">Cancel</button>
                    <button type="submit"
                        class="px-3 py-2 mb-2 mr-2 text-sm font-semibold text-white bg-orange-600 rounded-md shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Criar!</button>
                </div>
                </form>

                {{-- sadasdasd --}}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
