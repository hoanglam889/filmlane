<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Chào mừng trở lại!</h2>
        <p class="text-sm text-gray-500">Vui lòng đăng nhập để tiếp tục xem phim.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ghi nhớ</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-500 font-medium" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-lg">
                Đăng nhập
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">Chưa có tài khoản?</span>
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-bold ml-1">
                Đăng ký ngay
            </a>
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase tracking-wider">Hoặc dùng</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ url('auth/google') }}" class="flex items-center justify-center gap-2 border border-gray-300 bg-white py-2 px-4 rounded-md hover:bg-gray-50 transition">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    <span class="text-sm font-semibold text-gray-700">Google</span>
                </a>
                <a href="{{ url('auth/facebook') }}" class="flex items-center justify-center gap-2 bg-[#1877F2] py-2 px-4 rounded-md hover:bg-[#166fe5] transition text-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-5 h-5" alt="Facebook">
                    <span>Facebook</span>
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>