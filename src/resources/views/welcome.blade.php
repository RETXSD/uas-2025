@php
  use App\Models\Product;
  // Ambil semua produk dari database, diurutkan berdasarkan id
  $product = Product::orderBy('id')->get();
  

@endphp

@php
use App\Models\Logo;
$logo = Logo::first();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Navbar Styles */
        .navbar-brand img {
            transition: all 0.3s ease;
            filter: brightness(1);
        }

        .navbar-brand:hover img {
            filter: brightness(1.1);
            transform: scale(1.05);
        }

        nav {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        nav:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Logo Title Styles */
        .logo-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            text-align: center;
            background: linear-gradient(135deg, #ff6600, #ff8533);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }

        .logo-title:hover {
            transform: scale(1.05);
        }

        /* Auth Button Styles */
        .auth-btn {
            position: relative;
            overflow: hidden;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .auth-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .auth-btn:hover::before {
            left: 100%;
        }

        .login-btn {
            color: #1f2937;
            background: transparent;
            border: 2px solid transparent;
            position: relative;
        }

        .login-btn:hover {
            color: #ff6600;
            border-color: rgba(255, 102, 0, 0.3);
            background: rgba(255, 102, 0, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 102, 0, 0.2);
        }

        .register-btn, .dashboard-btn {
            background: linear-gradient(135deg, #ff6600, #ff8533);
            color: white;
            border: 2px solid transparent;
            box-shadow: 0 4px 15px rgba(255, 102, 0, 0.3);
        }

        .register-btn:hover, .dashboard-btn:hover {
            background: linear-gradient(135deg, #e55a00, #ff6600);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 102, 0, 0.4);
            color: white;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .logo-title {
                font-size: 1.2rem;
            }
            
            .auth-btn {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .auth-buttons {
                gap: 8px;
            }
        }

        @media (max-width: 640px) {
            .auth-buttons {
                flex-direction: column;
                gap: 6px;
            }
            
            .auth-btn {
                padding: 6px 12px;
                font-size: 12px;
                min-width: 80px;
                text-align: center;
            }
        }

        /* Custom CSS for design improvements */
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            max-width: 100%;
            min-height: 520px;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: #ff6600;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6600, #ff8533, #ff6600);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-image {
            object-fit: cover;
            height: 240px;
            width: 100%;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .section-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1f2937, #374151);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
        }

        .colored-box {
            background: linear-gradient(135deg, #ff6600, #ff8533);
            color: white;
            padding: 0;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            box-shadow: 0 8px 16px rgba(255, 102, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .colored-box::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.6s ease;
            transform: translate(-50%, -50%);
        }

        .product-card:hover .colored-box::before {
            width: 120px;
            height: 120px;
        }

        /* Flexbox untuk layout responsif */
        .product-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            justify-content: center;
            padding: 20px 0;
        }

        .product-card-wrapper {
            width: 100%;
            max-width: 100%;
            justify-self: center;
        }

        /* Menyesuaikan konten dalam card */
        .product-content {
            padding: 24px;
        }

        .product-title {
            font-size: 20px;
            margin-bottom: 16px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 600;
            color: #1f2937;
            transition: color 0.3s ease;
        }

        .product-description {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 12px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card:hover .product-title {
            color: #ff6600;
        }

        .product-price {
            font-size: 18px;
            color: #059669;
            font-weight: 700;
            margin-bottom: 12px;
            position: relative;
        }

        .product-price::before {
            content: '💰';
            margin-right: 8px;
        }

        /* Stock Badge Styles */
        .stock-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .stock-available {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .stock-low {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .stock-out {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .stock-count {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
        }

        .stock-count::before {
            content: '📦';
            margin-right: 6px;
        }

        /* Search Box Styles */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .search-box {
            width: 100%;
            max-width: 500px;
            padding: 16px 50px 16px 20px;
            font-size: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-box:focus {
            border-color: #ff6600;
            box-shadow: 0 8px 25px rgba(255, 102, 0, 0.15);
            transform: translateY(-2px);
        }

        .search-box::placeholder {
            color: #64748b;
            font-weight: 400;
        }

        .search-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 20px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .search-box:focus + .search-icon {
            color: #ff6600;
        }

        .search-results-info {
            text-align: center;
            margin-bottom: 2rem;
            color: #64748b;
            font-size: 16px;
            font-weight: 500;
        }

        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .no-results h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #374151;
        }

        .no-results p {
            font-size: 1rem;
            margin-bottom: 0;
        }

        /* Product card hidden state */
        .product-card-wrapper.hidden {
            display: none;
        }

        /* Clear search button */
        .clear-search {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: none;
        }

        .clear-search:hover {
            background: #f1f5f9;
            color: #ff6600;
        }

        .clear-search.show {
            display: block;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .product-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
        }

        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 10px;
            }
            
            .product-card {
                max-width: 100%;
                margin: 0 auto;
            }
            
            .section-title h1 {
                font-size: 2rem;
            }

            .search-box {
                max-width: 100%;
                margin: 0 10px;
            }

            .stock-info {
                flex-direction: column;
                gap: 8px;
                align-items: stretch;
            }

            .stock-badge {
                text-align: center;
            }
        }

        /* Loading animation */
        .product-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for cards */
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
        .product-card:nth-child(5) { animation-delay: 0.5s; }
        .product-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-start min-h-screen flex-col">

<!-- Navbar with Logo -->
<nav class="w-full max-w-6xl mx-auto mb-8">
    <div class="flex items-center justify-between py-4 px-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        <!-- Logo -->
        <div class="navbar-brand">
            <img loading="preload" decoding="async" class="img-fluid" width="160"
                src="{{ $logo->image ? asset('storage/' . $logo->image) : asset('front/images/default.png') }}"
                alt="Wallet">
        </div>
        
        <!-- Logo Title - Positioned in Center -->
        <div class="flex-1 text-center">
            <h1 class="logo-title">
                {{ $logo->title ?? 'Toko Barang' }}
            </h1>
        </div>
        
        <!-- Auth Links -->
        @if (Route::has('filament.admin.auth.login'))
            <div class="auth-buttons">
                @auth
                    <a href="{{ route('filament.store.pages.dashboard') }}" class="auth-btn dashboard-btn">
                        Beli Barang
                    </a>
                @else
                    <a href="{{ route('filament.store.auth.login') }}" class="auth-btn login-btn">
                        Log in
                    </a>

                    @if (Route::has('filament.admin.auth.register'))
                        <a href="{{ route('filament.admin.auth.register') }}" class="auth-btn register-btn">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<section class="section w-full px-4 md:px-8">
    <div class="container mx-auto">
        <div class="row mb-6">
            <div class="col-lg-4 col-md-6">
                <div class="section-title">
                    <h1>Data Barang</h1>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <input type="text" id="searchInput" class="search-box" placeholder="Cari nama barang atau deskripsi...">
            <button type="button" id="clearSearch" class="clear-search">×</button>
            <span class="search-icon">🔍</span>
        </div>

        <!-- Search Results Info -->
        <div id="searchInfo" class="search-results-info" style="display: none;">
            Menampilkan <span id="resultCount">0</span> dari {{ count($product) }} barang
        </div>

        <div class="product-container" id="productContainer">
            @foreach ($product as $index => $item)
                <div class="product-card-wrapper" data-name="{{ strtolower($item->name) }}" data-description="{{ strtolower($item->description ?? '') }}" data-price="{{ $item->price }}" data-stock="{{ $item->stock ?? 0 }}">
                    <a href="#" class="text-black no-underline">
                        <div class="product-card border rounded-2xl shadow-lg">
                            <div class="product-content">
                                <span class="colored-box">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>

                                @if ($item->image)
                                    <div class="overflow-hidden mb-4 rounded-xl">
                                        <img loading="lazy" decoding="async" src="{{ asset('storage/' . $item->image) }}" alt="product image" class="product-image">
                                    </div>
                                @endif

                                <h5 class="product-title">{{ $item->name }}</h5>
                                @if ($item->description)
                                    <p class="product-description">{{ $item->description }}</p>
                                @endif
                                <p class="product-price">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                
                                <!-- Stock Information -->
                                <div class="stock-info">
                                    @php
                                        $stock = $item->stock ?? 0;
                                        $stockClass = 'stock-out';
                                        $stockText = 'Habis';
                                        
                                        if ($stock > 0) {
                                            if ($stock <= 5) {
                                                $stockClass = 'stock-low';
                                                $stockText = 'Stok Terbatas';
                                            } else {
                                                $stockClass = 'stock-available';
                                                $stockText = 'Tersedia';
                                            }
                                        }
                                    @endphp
                                    
                                    <span class="stock-badge {{ $stockClass }}">{{ $stockText }}</span>
                                    <span class="stock-count">{{ $stock }} unit</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="no-results" style="display: none;">
            <h3>Tidak ada barang ditemukan</h3>
            <p>Coba gunakan kata kunci yang berbeda</p>
        </div>
    </div>
</section>

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const productContainer = document.getElementById('productContainer');
    const searchInfo = document.getElementById('searchInfo');
    const resultCount = document.getElementById('resultCount');
    const noResults = document.getElementById('noResults');
    const productCards = document.querySelectorAll('.product-card-wrapper');
    const totalProducts = productCards.length;

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        productCards.forEach(card => {
            const productName = card.getAttribute('data-name');
            const productDescription = card.getAttribute('data-description');
            
            if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update search info
        if (searchTerm === '') {
            searchInfo.style.display = 'none';
            noResults.style.display = 'none';
            clearButton.classList.remove('show');
        } else {
            clearButton.classList.add('show');
            
            if (visibleCount > 0) {
                searchInfo.style.display = 'block';
                noResults.style.display = 'none';
                resultCount.textContent = visibleCount;
            } else {
                searchInfo.style.display = 'none';
                noResults.style.display = 'block';
            }
        }
    }

    // Search functionality
    searchInput.addEventListener('input', performSearch);

    // Clear search
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });

    // Enter key search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });
});
</script>

</body>
</html>