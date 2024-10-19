<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{--            {{ __('Write message') }}--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Provide Recipient Email to send message.') }}
                            </p>
                        </header>

                        @if (session('status') === 'ok')
                            <div class="ms-1 bg-primary text-center p-3 border-radius-10">
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 9987000)"
                                    class="text-lg text-white dark:text-gray-400"
                                > Decryption key was sent to recipient. </p>
                            </div>
                        @endif

                        <form method="post" action="{{ route('message.send') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="recipient" :value="__('Recipient')" />
                                <x-text-input id="recipient" name="recipient" type="text" class="mt-1 block w-full" value="{{old('recipient')}}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('recipient')" />
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Message')" />
                                <x-text-input id="message" name="message" type="text" class="mt-1 block w-full" value="{{old('message')}}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('message')" />
                            </div>

                            <div>
                                <x-input-label :value="__('Expiry option')" />
                                <label class="mt-1 block w-full block font-medium text-gray-700 dark:text-gray-300">
                                    <input type="radio" id="once" name="expiry_option" class="border-gray-300 rounded-md" value="once">
                                    <span class="ml-3">Expire after read</span>
                                </label>

                                <label class="mt-1 block w-full block font-medium text-gray-700 dark:text-gray-300">
                                    <input type="radio" id="day" name="expiry_option" class="border-gray-300 rounded-md" value="day">
                                    <span class="ml-3">Expire after day</span>
                                </label>
                                <x-input-error class="mt-2" :messages="$errors->get('expiry_option')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Send') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
