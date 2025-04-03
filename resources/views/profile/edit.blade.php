<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-white ">
            {{ __('Perfil') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-orange-600 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-orange-600 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-orange-600 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- Add this after the user's recipes section -->
    <div class="mt-8">
        <h3 class="mb-4 text-lg font-bold text-orange-600">Receitas Favoritas de {{ $user->name }}</h3>

        @if ($user->favoriteReceitas->count() > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($user->favoriteReceitas()->latest()->take(6)->get() as $receita)
                    <div class="overflow-hidden transition-shadow bg-white border rounded-lg shadow-md hover:shadow-lg">
                        @if ($receita->receita_foto)
                            <img src="{{ asset('storage/' . $receita->receita_foto) }}"
                                alt="{{ $receita->receita_titulo }}" class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                                <span class="text-gray-400"><i class="bi bi-image"></i> Sem imagem</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h4 class="mb-1 text-lg font-semibold">{{ $receita->receita_titulo }}</h4>
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

            @if ($user->favoriteReceitas->count() > 6)
                <div class="mt-4 text-center">
                    <a href="{{ route('profile.favorites', $user->id) }}"
                        class="inline-block px-4 py-2 text-sm bg-gray-200 rounded hover:bg-gray-300">
                        Ver todas as receitas favoritas
                    </a>
                </div>
            @endif
        @else
            <div class="p-6 text-center bg-gray-100 rounded-lg">
                <p class="text-gray-600">Este usuário ainda não tem receitas favoritas.</p>
            </div>
        @endif
    </div>

</x-app-layout>
