<x-app-layout>
<x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h1 class="text-2xl font-bold leading-tight text-white mb-2 md:mb-0">
                <i class="bi bi-journal-plus me-2"></i>{{ __('Meu Perfil') }}
            </h1>
            <a href="/"
                class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="bi bi-house-door me-2"></i>Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Alerts Section -->
            @if(session('status'))
            <div class="mb-6 overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Profile Overview Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center space-x-5">
                            <!-- Avatar with Upload Option -->
                            <div class="relative group">
                                <div class="flex items-center justify-center w-24 h-24 text-2xl text-white bg-orange-500 rounded-full overflow-hidden border-4 border-white shadow-md">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile"
                                            class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    @endif
                                </div>
                                <label for="profile_photo_upload" class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 bg-orange-600 rounded-full cursor-pointer shadow-md hover:bg-orange-700 transition-colors">
                                    <i class="bi bi-camera text-white"></i>
                                    <input id="profile_photo_upload" type="file" class="hidden" form="update-profile-form" name="profile_photo">
                                </label>
                            </div>

                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                                <div class="flex flex-col sm:flex-row sm:items-center text-sm text-gray-600 mt-1 space-y-1 sm:space-y-0 sm:space-x-4">
                                    <p><i class="bi bi-envelope-fill mr-1"></i> {{ Auth::user()->email }}</p>
                                    <p><i class="bi bi-calendar3 mr-1"></i> Membro desde {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="mt-2 flex items-center space-x-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <i class="bi bi-journal-richtext mr-1"></i> {{ Auth::user()->receitas->count() }} receitas
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="bi bi-heart-fill mr-1"></i> {{ Auth::user()->favoriteReceitas->count() }} favoritos
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="bi bi-star-fill mr-1"></i> {{ Auth::user()->ratings->count() }} avaliações
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                            <a href="{{ route('receitas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                                <i class="bi bi-plus-lg mr-2"></i> Nova Receita
                            </a>
                            <a href="{{ route('profile.show', Auth::id()) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                                <i class="bi bi-person-badge mr-2"></i> Ver Perfil Público
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="mt-6 bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px" aria-label="Tabs">
                        <button class="tab-button active w-1/3 py-4 px-1 text-center border-b-2 border-orange-500 font-medium text-sm text-orange-600" data-target="profile-info">
                            <i class="bi bi-person-fill mr-2"></i>Informações do Perfil
                        </button>
                        <button class="tab-button w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="security">
                            <i class="bi bi-shield-lock-fill mr-2"></i>Segurança
                        </button>
                        <button class="tab-button w-1/3 py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-target="danger-zone">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i>Zona de Perigo
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Profile Information Tab -->
                    <div id="profile-info" class="tab-content">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-orange-600 mb-4">
                                <i class="bi bi-person-fill mr-2"></i>Informações do Perfil
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                Atualize as informações do seu perfil e endereço de e-mail.
                            </p>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div id="security" class="tab-content hidden">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-orange-600 mb-4">
                                <i class="bi bi-shield-lock-fill mr-2"></i>Segurança
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                Atualize sua senha para manter sua conta segura.
                            </p>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Danger Zone Tab -->
                    <div id="danger-zone" class="tab-content hidden">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-red-600 mb-4">
                                <i class="bi bi-exclamation-triangle-fill mr-2"></i>Zona de Perigo
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                Uma vez que sua conta é excluída, todos os seus recursos e dados serão permanentemente apagados.
                            </p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>


            
            <!-- Receitas Favoritas -->
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-orange-600">
                        <i class="bi bi-heart-fill mr-2"></i>Receitas Favoritas
                    </h3>
                    @if ($user->favoriteReceitas->count() > 6)
                    <a href="{{ route('profile.favorites', $user->id) }}" class="text-sm text-orange-600 hover:text-orange-500">
                        Ver todas <i class="bi bi-arrow-right ml-1"></i>
                    </a>
                    @endif
                </div>

                @if ($user->favoriteReceitas->count() > 0)
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        @foreach ($user->favoriteReceitas()->latest()->take(6)->get() as $receita)
                            <div class="overflow-hidden transition-all duration-300 bg-white border rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-1">
                                <div class="relative">
                                    @if ($receita->receita_foto)
                                        <img src="{{ asset('storage/' . $receita->receita_foto) }}" alt="{{ $receita->receita_titulo }}"
                                            class="object-cover w-full h-48">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                                            <span class="text-gray-400"><i class="bi bi-image"></i> Sem imagem</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-orange-500 bg-opacity-90 rounded">
                                            <i class="bi bi-bookmark-fill mr-1"></i> {{ $receita->categoria }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="mb-1 text-lg font-semibold text-gray-900 line-clamp-1">{{ $receita->receita_titulo }}</h4>
                                    <p class="mb-2 text-sm text-gray-600">
                                        <i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min
                                        <span class="mx-1">•</span>
                                        <i class="bi bi-bar-chart-fill"></i> {{ $receita->nivel_dificuldade }}
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

                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('receitas.show', $receita->id) }}"
                                            class="inline-flex items-center px-3 py-1 text-xs text-white bg-orange-500 rounded hover:bg-orange-600 transition-colors">
                                            <i class="bi bi-eye mr-1"></i> Ver Receita
                                        </a>
                                        
                                        <form action="{{ route('receitas.favorite', $receita->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center text-red-500 hover:text-red-700">
                                                <i class="bi bi-heart-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($user->favoriteReceitas->count() > 6)
                        <div class="mt-4 text-center">
                            <a href="{{ route('profile.favorites', $user->id) }}"
                                class="inline-block px-4 py-2 text-sm bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition-colors">
                                Ver todas as receitas favoritas
                            </a>
                        </div>
                    @endif
                @else
                    <div class="p-8 text-center bg-gray-50 rounded-lg border border-gray-100">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 text-orange-500 mb-4">
                            <i class="bi bi-heart text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Nenhuma receita favorita</h4>
                        <p class="text-gray-600 mb-4">Tu ainda não adicionaste nenhuma receita aos seus favoritos.</p>

    <a href="{{ route('receitas.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 transition-colors">
                            <i class="bi bi-search mr-2"></i> Explorar Receitas
                        </a>
                    </div>
                @endif
            </div>

            <!-- Minhas Receitas -->
            <div class="mt-8 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-orange-600">
                        <i class="bi bi-journal-richtext mr-2"></i>Minhas Receitas
                    </h3>
                    @if (Auth::user()->receitas->count() > 3)
                    <a href="{{ route('profile.recipes', Auth::id()) }}" class="text-sm text-orange-600 hover:text-orange-500">
                        Ver todas <i class="bi bi-arrow-right ml-1"></i>
                    </a>
                    @endif
                </div>

                @if (Auth::user()->receitas->count() > 0)
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        @foreach (Auth::user()->receitas()->latest()->take(3)->get() as $receita)
                            <div class="overflow-hidden transition-all duration-300 bg-white border rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-1">
                                <div class="relative">
                                    @if ($receita->receita_foto)
                                        <img src="{{ asset('storage/' . $receita->receita_foto) }}" alt="{{ $receita->receita_titulo }}"
                                            class="object-cover w-full h-48">
                                    @else
                                        <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                                            <span class="text-gray-400"><i class="bi bi-image"></i> Sem imagem</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-orange-500 bg-opacity-90 rounded">
                                            <i class="bi bi-bookmark-fill mr-1"></i> {{ $receita->categoria }}
                                        </span>
                                    </div>
                                    <div class="absolute top-2 left-2">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-blue-500 bg-opacity-90 rounded">
                                            <i class="bi bi-eye-fill mr-1"></i> {{ $receita->views }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="mb-1 text-lg font-semibold text-gray-900 line-clamp-1">{{ $receita->receita_titulo }}</h4>
                                    <p class="mb-2 text-sm text-gray-600">
                                        <i class="bi bi-alarm-fill"></i> {{ $receita->receita_duracao }} min
                                        <span class="mx-1">•</span>
                                        <i class="bi bi-bar-chart-fill"></i> {{ $receita->nivel_dificuldade }}
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

                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('receitas.show', $receita->id) }}"
                                            class="inline-flex items-center px-3 py-1 text-xs text-white bg-orange-500 rounded hover:bg-orange-600 transition-colors">
                                            <i class="bi bi-eye mr-1"></i> Ver Receita
                                        </a>
                                        
                                        <div class="flex space-x-2">
                                            <a href="{{ route('receitas.edit', $receita->id) }}" class="text-blue-500 hover:text-blue-700">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            
                                            <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta receita?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (Auth::user()->receitas->count() > 3)
                        <div class="mt-4 text-center">
                            <a href="{{ route('profile.recipes', Auth::id()) }}"
                                class="inline-block px-4 py-2 text-sm bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition-colors">
                                Ver todas as minhas receitas
                            </a>
                        </div>
                    @endif
                @else
                    <div class="p-8 text-center bg-gray-50 rounded-lg border border-gray-100">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 text-orange-500 mb-4">
                            <i class="bi bi-journal-plus text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Nenhuma receita publicada</h4>
                        <p class="text-gray-600 mb-4">Tu ainda não publicaste nenhuma receita no QuickBites.</p>
                        <a href="{{ route('receitas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 transition-colors">
                            <i class="bi bi-plus-lg mr-2"></i> Criar Nova Receita
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-orange-500', 'text-orange-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Add active class to clicked button
                    this.classList.add('active', 'border-orange-500', 'text-orange-600');
                    this.classList.remove('border-transparent', 'text-gray-500');
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Show the selected tab content
                    const targetId = this.getAttribute('data-target');
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });
            
            // Profile photo preview
            const photoInput = document.getElementById('profile_photo_upload');
            if (photoInput) {
                photoInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const avatarContainer = photoInput.closest('.relative').querySelector('div');
                            
                            // If there's already an image, update it, otherwise create one
                            let avatarImg = avatarContainer.querySelector('img');
                            if (!avatarImg) {
                                avatarImg = document.createElement('img');
                                avatarImg.className = 'h-full w-full object-cover';
                                avatarContainer.innerHTML = '';
                                avatarContainer.appendChild(avatarImg);
                            }
                            
                            avatarImg.src = e.target.result;
                            
                            // Add a hidden input to the form to indicate that the photo has been changed
                            const form = document.getElementById('update-profile-form');
                            let photoChangedInput = form.querySelector('input[name="photo_changed"]');
                            if (!photoChangedInput) {
                                photoChangedInput = document.createElement('input');
                                photoChangedInput.type = 'hidden';
                                photoChangedInput.name = 'photo_changed';
                                photoChangedInput.value = '1';
                                form.appendChild(photoChangedInput);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            
            // Animation for cards
            const cards = document.querySelectorAll('.transition-all');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('shadow-md', '-translate-y-1');
                });
                
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow-md', '-translate-y-1');
                });
            });
        });
    </script>
</x-app-layout>
