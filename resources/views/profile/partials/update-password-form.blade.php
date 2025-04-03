<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Atualizar Palavra-passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-900 ext-white">
            {{ __('Certifique-se de que a sua conta está a utilizar uma palavra-passe longa e aleatória para permanecer segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 ">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" class="text-gray-900" :value="__('Palavra-passe Atual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full mt-1" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" class="text-gray-900" :value="__('Nova Palavra-passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" class="text-gray-900" :value="__('Confirmar Palavra-passe')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="font-bold text-gray-900 bg-orange-400 hover:bg-yellow-500">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-900"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
