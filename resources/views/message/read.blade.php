<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Read message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Provide your identifier with decryption key to read specific message.') }}
                            </p>
                        </header>

                        @if(session('error') || $errors->get('error'))
                            <div class="ms-1 bg-danger text-center p-3 border-radius-10">
                                <x-input-error :messages="session('error')" class="mt-2 text-white" />
                                <x-input-error :messages="$errors->get('error')" class="mt-2 text-white" />
                            </div>
                        @endif

                        <form method="post" action="{{ route('message.read') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="decryption-key" :value="__('Decryption key')" />
                                <x-text-input id="decryption-key" name="decryption_key" type="text" class="mt-1 block w-full" value="{{old('decryption_key') ?? $decryptKey}}"/>
                            </div>

                            @if (session('message'))
                                <div class="ms-1 bg-primary text-center p-3 border-radius-10">
                                    <p class="text-lg text-gray-800 dark:text-gray-800">{{ session('message') }}</p>
                                </div>
                            @endif

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Read') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
