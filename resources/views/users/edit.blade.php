<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.edit',[$user->id]) }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="photo" class="inline-flex items-center"/>
            <input id="photo" type="file" name="photo"/>
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="birth_date" class="block mt-1 w-full" />
            <input id="birth_date" type="date" name="birth_date"/>
        </div>

        <!-- Document CPF -->
        <div>
            <x-input-label for="document_cpf" :value="__('CPF')" />
            <x-text-input id="document_cpf" class="block mt-1 w-full" type="text" name="document_cpf" :value="old('CPF')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('document_cpf')" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-3">
            <x-input-label for="gender" :value="__('Gênero')" />
            <select id="gender" placeholder="Choose Gender" name="gender">
            <option value="" disabled>Choose Status</option>
            @foreach(\App\Enums\Gender::cases() as $gender)
            <option value="{{ $gender->value }}">{{ $gender->name }}</option>
            @endforeach
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="cellphone" :value="__('Telefone')" />
            <x-text-input id="cellphone" class="block mt-1 w-full" type="text" name="cellphone" :value="old('cellphone')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('cellphone')" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-3">
            <x-input-label for="role" :value="__('Tipo')" />
            <select id="role" placeholder="Choose role" name="role">
            <option value="" disabled>Choose Status</option>
            @foreach(\App\Enums\Role::cases() as $role)
            <option value="{{ $role->value }}">{{ $role->name }}</option>
            @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="emergency_name" :value="__('Contato de Emergência')" />
            <x-text-input id="emergency_name" class="block mt-1 w-full" type="text" name="emergency_name" :value="old('emergency_name')"
            autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('emergency_name')" class="mt-2" />
        </div>


        <div>
            <x-input-label for="emergency_cellphone" :value="__('Telefone de Emergência')" />
            <x-text-input id="emergency_cellphone" class="block mt-1 w-full" type="text" name="emergency_cellphone" :value="old('emergency_cellphone')"
            autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('emergency_cellphone')" class="mt-2" />
        </div>




<br>
        <x-primary-button style="background-color:#ff6b8a; ;color:#ffffff;" class="w-full text-center">
            {{ __('Register') }}
        </x-primary-button>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
