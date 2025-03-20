<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold leading-tight text-white" style="font-size: 30px">
                {{ __('Criar uma Categoria') }}
            </h1>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('categorias.store') }}">
                        @csrf
                        <div class="space-y-12">
                            <div class="pb-12 border-b border-gray-900/10">
                                <h1 class="font-bold text-gray-900 text-base/7">Nova Categoria</h1>

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="nome"
                                            class="block font-bold text-orange-600 text-sm/1">Nome da Categoria</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex items-center pl-3 bg-white rounded-md outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                                <input type="text" name="nome" id="nome"
                                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                                    placeholder="Nome da Categoria">
                                            </div>
                                            @error('nome')
                                            <p class="text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-x-6">
                            <button type="button" onclick="window.close()" class="font-semibold text-gray-900 text-sm/6">Fechar</button>
                            <button type="submit"
                                class="px-3 py-2 text-sm font-semibold text-white bg-orange-600 rounded-md shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Criar Categoria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>