<footer class="bg-gradient-to-r from-gray-800 via-blue-900 to-gray-800 border-t border-gray-700 mt-12 shadow-2xl relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
    <div class="relative max-w-7xl mx-auto px-8 py-10">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">

            {{-- KIRI --}}
            <div class="text-white text-lg flex items-center animate-fade-in">
                © {{ date('Y') }} <span class="font-bold text-blue-300 hover:text-blue-200 transition-colors duration-300">E-Jurnal</span>.  
                All rights reserved.
            </div>

            {{-- TENGAH --}}
            <div class="flex items-center space-x-6 text-white">
                <div class="flex items-center space-x-2 hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-graduation-cap text-yellow-400 text-2xl"></i>
                    <span class="text-lg font-semibold">Platform PKL Digital</span>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="flex items-center space-x-4 text-white bg-white/10 backdrop-blur px-6 py-3 rounded-full shadow-lg hover:bg-white/20 transition-all duration-300 animate-bounce-in">
                <i class="fas fa-school text-blue-300 text-2xl animate-pulse"></i>
                <span class="text-lg font-bold">
                    SMK PGRI 3 Malang
                </span>
                <i class="fas fa-star text-yellow-400 text-lg"></i>
            </div>

        </div>

        {{-- GARIS PEMISAH --}}
        <div class="mt-8 border-t border-white/20 pt-6 text-center">
            <p class="text-white/80 text-sm">
                Dibuat untuk memudahkan bukan menyulitkan
            </p>
        </div>
    </div>

    {{-- EFEK DECORATIF --}}
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <div class="absolute top-4 left-10 w-2 h-2 bg-blue-400 rounded-full animate-ping"></div>
        <div class="absolute top-8 right-20 w-1 h-1 bg-purple-400 rounded-full animate-ping animation-delay-1000"></div>
        <div class="absolute bottom-6 left-1/4 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
    </div>
</footer>

<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    .animate-bounce-in {
        animation: bounceIn 1.5s ease-out;
    }

    .animation-delay-1000 {
        animation-delay: 1s;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
</style>