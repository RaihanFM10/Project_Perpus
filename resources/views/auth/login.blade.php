<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Header merah --}}
    <div style="background: #c0121a; padding: 2.25rem 2.5rem 2rem; text-align: center; margin: -1.5rem -1.5rem 2rem; border-radius: 4px 4px 0 0;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="20" height="26" rx="2" fill="white" opacity="0.95"/>
                <rect x="4" y="6" width="14" height="2" rx="1" fill="#c0121a"/>
                <rect x="4" y="10.5" width="14" height="2" rx="1" fill="#c0121a"/>
                <rect x="4" y="15" width="10" height="2" rx="1" fill="#c0121a"/>
                <rect x="0" y="2" width="3" height="24" rx="1.5" fill="white" opacity="0.5"/>
                <rect x="21" y="1" width="4" height="26" rx="2" fill="white" opacity="0.3"/>
            </svg>
            <span style="color: #fff; font-size: 24px; font-weight: 600; letter-spacing: 0.5px; font-family: Georgia, serif;">PerpusInd</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="px-2">
        @csrf

        {{-- Email --}}
        <div class="mb-5">
            <label for="email" class="block text-xs uppercase tracking-widest text-gray-400 mb-1.5">
                {{ __('Email') }}
            </label>
            <x-text-input
                id="email"
                class="block w-full bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-red-600 focus:ring-red-600"
                type="email" name="email"
                :value="old('email')"
                required autofocus autocomplete="username"
                placeholder="nama@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Password --}}
        <div class="mb-5">
            <label for="password" class="block text-xs uppercase tracking-widest text-gray-400 mb-1.5">
                {{ __('Password') }}
            </label>
            <x-text-input
                id="password"
                class="block w-full bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-red-600 focus:ring-red-600"
                type="password" name="password"
                required autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        {{-- Remember Me + Forgot Password --}}
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded-sm border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                    name="remember"
                    style="accent-color: #c0121a;"
                />
                {{ __('Ingat saya') }}
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs text-red-700 hover:text-red-900 underline-offset-2 hover:underline transition-colors">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full py-3 text-sm font-medium tracking-wide text-white rounded-sm transition-colors"
            style="background: #c0121a;"
            onmouseover="this.style.background='#a00f16'"
            onmouseout="this.style.background='#c0121a'">
            {{ __('Masuk') }}
        </button>

        <p class="text-center text-xs text-gray-300 mt-5 pt-4 border-t border-gray-100"></p>
    </form>
</x-guest-layout>
