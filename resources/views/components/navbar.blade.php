<!-- /public/partials/navbar.php -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-[#B9C240]">WeihMaggot</a>
            <div class="hidden md:flex space-x-8">
                <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'nav-active' : '' ?>">Beranda</a>
                <a href="produk.php" class="<?= basename($_SERVER['PHP_SELF']) == 'produk.php' ? 'nav-active' : '' ?>">Produk</a>
            </div>
        </div>
    </div>
</nav>
