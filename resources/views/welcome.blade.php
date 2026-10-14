        @auth
            <div class="flex items-center gap-3">
                @if(auth()->user()->user_role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="glow-btn px-6 py-2.5 rounded-xl transition duration-300">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('home') }}" class="glow-btn px-6 py-2.5 rounded-xl transition duration-300">
                        Go to Home
                    </a>
                @endif
            </div>
        @else
            <div class="flex items-center gap-4">
                <a href="{{ route('user.login') }}" class="text-gray-300 hover:text-[#00E5FF] font-semibold transition px-4 py-2">
                    Log In
                </a>
                <a href="{{ route('user.register') }}" class="glow-btn px-6 py-2.5 rounded-xl transition duration-300">
                    Register
                </a>
            </div>
        @endauth