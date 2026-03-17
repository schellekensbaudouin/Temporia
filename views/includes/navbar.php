<nav>
<header class="bg-white border-b border-[#E5E1D8] sticky top-0 z-50 w-full">
    <div class="max-w-[1440px] mx-auto px-6 h-20 flex justify-between items-center">
        
        <div class="flex items-center space-x-6">
            <a href="contact.php" class="hidden md:block text-[10px] tracking-[0.3em] uppercase font-bold text-[#1A1A1A] hover:text-[#A39274] transition-colors">
                Contact
            </a>
            
            <label for="menu-toggle" class="cursor-pointer text-[#1A1A1A] hover:text-[#A39274] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </label>
        </div>
        
        <a href="index.php" class="font-serif text-3xl tracking-[0.2em] uppercase text-[#1A1A1A]">
            Temporia
        </a>
        
        <div class="flex items-center space-x-6">
            <?php if(isset($_SESSION['user']['id'])): ?>
                <a href="index.php?action=dashboard" class="text-[#1A1A1A] hover:text-[#A39274]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
            <?php else: ?>
                <a href=".php?action=login" class="text-[10px] tracking-[0.3em] uppercase font-bold text-[#1A1A1A] hover:text-[#A39274]">Login</a>
            <?php endif; ?>

            <a href="panier.php" class="text-[#1A1A1A] hover:text-[#A39274]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </a>
        </div>
    </div>
</header>

<input type="checkbox" id="menu-toggle" class="hidden peer">

<div class="fixed inset-0 bg-black/40 z-[60] hidden peer-checked:block transition-all">
    <div class="absolute top-0 left-0 w-80 h-full bg-[#F9F7F2] shadow-2xl p-10 flex flex-col">
        
        <div class="flex justify-end mb-10">
            <label for="menu-toggle" class="cursor-pointer text-gray-400 hover:text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </label>
        </div>

        <nav class="flex-grow space-y-10">
            <div>
                <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Explorer</p>
                <ul class="space-y-4 text-sm tracking-widest uppercase">
                    <li><a href="#" class="hover:text-[#A39274]">Boutique</a></li>
                    <li><a href="#" class="hover:text-[#A39274]">Vendre une montre</a></li>
                </ul>
            </div>
            
            <div>
                <p class="text-[10px] tracking-[0.4em] uppercase text-[#A39274] mb-6 font-bold">Communauté</p>
                <ul class="space-y-4 text-sm tracking-widest uppercase">
                    <li><a href="#" class="hover:text-[#A39274]">Messagerie</a></li>
                    <li><a href="#" class="hover:text-[#A39274]">Assistance</a></li>
                </ul>
            </div>
        </nav>

        <div class="mt-auto border-t border-[#E5E1D8] pt-8">
            <?php if(isset($_SESSION['user']['id'])): ?>
                <a href="index.php?action=logout" class="flex items-center text-[10px] tracking-[0.3em] uppercase font-bold text-red-800 hover:text-red-600">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Se déconnecter
                </a>
            <?php else: ?>
                <a href="index.php?action=register" class="text-[10px] tracking-[0.3em] uppercase font-bold text-[#1A1A1A]">Créer un compte</a>
            <?php endif; ?>
        </div>
    </div>
</div>
</nav>