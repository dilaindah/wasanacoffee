<nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-amber-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-amber-900 tracking-tighter">
                    WASANA<span class="text-amber-600">COFFEE</span>
                </a>
            </div>
            
            <div class="hidden md:flex space-x-6 items-center text-sm font-semibold text-amber-900">
                <a href="{{ route('home') }}" class="hover:text-amber-600 transition {{ Request::is('home') ? 'text-amber-600 font-bold' : '' }}">Home</a>
                <a href="#" class="hover:text-amber-600 transition">Riwayat</a>
                <a href="#" class="hover:text-amber-600 transition">Cek Status</a>
                <a href="#" class="hover:text-amber-600 transition">Profil</a>
                <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-amber-600 transition">WhatsApp</a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition text-xs shadow-md font-bold">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="h-20"></div>