<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maekuki - Kue Kering Premium & Halal</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">


</head>

<body>

    <header class="navbar">
        <div class="container">
            <div class="logo logo-left-align">
                <img src="assets/Asset/maekukilogo.png">
                <h1>
                    <span class="brand-name">Maekuki</span><br>
                    <span class="brand-name2">Homemade Cookies</span>
                </h1>
            </div>

            <button class="menu-toggle" aria-label="Toggle Navigation">
                <i class="fas fa-bars"></i>
            </button>

            <nav class="nav-links">
                <a href="#beranda" class="active">Beranda</a>
                <a href="#katalog">Produk</a>
                <a href="#kontak">Kontak</a>
            </nav>

            <div class="cart-icon">
                <a href="#" id="cart-icon-btn"><i class="fas fa-shopping-cart"></i>
                    <span id="cart-count" class="cart-count">0</span>
                </a>
            </div>

            <!-- Keranjang icon -->
            <!-- <div id="cart-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>

                    <h2 style="color: #8B4513; margin-bottom: 20px;">
                        <i class="fas fa-shopping-bag" style="margin-right: 10px;"></i>
                        Keranjang Belanja
                    </h2>

                    <div id="cart-items-wrapper">
                        <p id="empty-cart-message" style="text-align: center; color: #888; margin: 50px 0; font-size: 1.1rem;">
                            Keranjang Anda kosong
                            <br><a href="#katalog" onclick="document.getElementById('cart-modal').style.display='none'">Mulai Belanja</a>
                        </p>

                    </div>

                    <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

                    <div id="cart-summary" style="display: flex; justify-content: space-between; align-items: center; font-size: 1.5rem; font-weight: 600;">
                        <span>Total</span>
                        <span id="cart-total-amount" style="color: #E60023;">Rp 0</span>
                    </div>

                    <button id="checkout-btn" class="btn-order" style="width: 100%; margin-top: 20px; padding: 12px;">
                        Order via WhatsApp
                    </button>
                </div>
            </div> -->
        </div>
    </header>

    <section id="beranda" class="hero-section">
        <div class="hero-content">
            <h2>Kue Kering Homemade <br>Premium & Halal</h2>
            <p>Resep keluarga yang diwariskan turun-temurun. Tanpa bahan pengawet, dibuat dengan cinta untuk momen spesial Anda.</p>
            <a href="#katalog" class="btn-lihat-produk">Lihat Produk <i class="fas fa-chevron-down"></i></a>
        </div>
    </section>

    <section id="keunggulan-kami" class="py-5" style="background-color: #FAF5E8;">
        <div class="container-keunggulan">

            <h2 class="judul-keunggulan">
                Keunggulan Kami
            </h2>

            <div class="keunggulan-wrapper">

                <div class="keunggulan-item">
                    <i class="fas fa-cookie-bite fa-4x keunggulan-icon" style="color: #6D4C41;"></i>
                    <h3 class="keunggulan-title">Fresh Setiap Hari</h3>
                    <p class="keunggulan-desc">
                        Menyajikan kue kering berkualitas premium yang selalu dibuat fresh setiap hari.
                    </p>
                </div>

                <div class="keunggulan-item">
                    <i class="fas fa-leaf fa-4x keunggulan-icon" style="color: #4CAF50;"></i>
                    <h3 class="keunggulan-title">Bahan Premium & Halal</h3>
                    <p class="keunggulan-desc">
                        Dibuat dari bahan-bahan premium, tanpa pengawet, dan 100% halal.
                    </p>
                </div>

                <div class="keunggulan-item">
                    <i class="fas fa-heart fa-4x keunggulan-icon" style="color: #6D4C41;"></i>
                    <h3 class="keunggulan-title">Resep Warisan Keluarga</h3>
                    <p class="keunggulan-desc">
                        Menggunakan resep turun-temurun dengan cita rasa khas untuk momen spesial Anda.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="katalog" class="katalog-section container">
        <div class="section-title">
            <p class="subtitle">KOLEKSI TERBAIK</p>
            <h2>Produk Kue Kering Kami</h2>
            <p class="description"></p>

            <div class="search-container">
                <form id="search-form" action="" method="GET">
                    <input type="text" id="search-input" name="keyword" placeholder="Cari Nastar, Kastengel, atau kue lainnya..." required>
                    <button type="submit" class="search-btn" aria-label="Cari Produk">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="product-grid" id="product-list">
            </div>
        </div>

        <div class="produk-grid-wrapper">
            <div class="produk-grid-container">

                <div class="produk-grid" id="katalogProduk">

                    <?php
                    // Pastikan data produk ($produk) dikirim dari Controller
                    if (isset($produk) && is_array($produk)):
                        // Lakukan looping pada setiap item produk
                        foreach ($produk as $item):
                    ?>

                            <div class="produk-card"
                                data-id="<?= $item['id'] ?>"
                                data-nama="<?= esc($item['nama']) ?>"
                                data-harga="<?= $item['harga'] ?>"
                                data-gambar="<?= esc($item['url_gambar']) ?>"
                                data-deskripsi="<?= esc($item['deskripsi']) ?>"
                                data-status="<?= esc($item['status']) ?>">
                                <img src="<?= base_url('assets/Asset/' . $item['url_gambar']) ?>"
                                    alt="<?= esc($item['nama']) ?>">

                                <h3><?= esc($item['nama']) ?></h3>



                                <p class="harga">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>

                                <div class="card-actions">
                                    <button class="btn-detail">Detail</button>
                                    <button class="btn-cart btn-order"
                                        data-id="<?= $item['id'] ?>"
                                        data-nama="<?= esc($item['nama']) ?>"
                                        data-harga="<?= $item['harga'] ?>"
                                        data-gambar="<?= esc($item['url_gambar']) ?>">
                                        <i class="fas fa-cart-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>

                        <?php
                        endforeach;
                    else:
                        ?>
                        <p>Belum ada produk aktif yang tersedia saat ini.</p>
                    <?php
                    endif;
                    ?>

                </div>
            </div>

        </div>

        <?php if (!empty($produk)): ?>
            <div class="pagination-controls" style="text-align: center; margin-top: 30px;">
                <div class="custom-pagination pagination-links">
                    <?= $pager->links() ?>
                </div>
            </div>
        <?php endif; ?>

    </section>

    <section id="parcel" class="parcel-section">
        <div class="container parcel-container">

            <div class="parcel-image-container">

                <img src="<?= base_url('assets/Asset/parcelremove.png') ?>" alt="Bingkisan Spesial Maekuki">
            </div>

            <div class="parcel-detail">
                <h2 class="parcel-title">Bingkisan Spesial untuk Momen Berharga</h2>

                <p class="parcel-description">
                    Hadirkan kebahagiaan dengan paket parcel eksklusif dari Maekuki. Cocok untuk hantaran Idul Fitri, Natal, atau hadiah untuk kerabat tersayang.
                </p>

                <ul class="benefit-list">
                    <li><i class="fas fa-check-circle"></i> Custom isi kue sesuai request</li>
                    <li><i class="fas fa-check-circle"></i> Free kartu ucapan & pita</li>
                    <li><i class="fas fa-check-circle"></i> Pengiriman aman ke seluruh kota</li>
                </ul>

                <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20paket%20hampers%20spesial%20Maekuki." class="btn-hubungi-admin">
                    <i class="fab fa-whatsapp"></i> konsultasi Sekarang
                </a>
            </div>

        </div>
    </section>

    <footer id="kontak" class="main-footer">
        <div class="container footer-grid">

            <div class="footer-col about">
                <h3>Maekuki</h3>
                <p>Menyajikan kue kering homemade berkualitas premium yang didirikan pada tahun 2021. Dibuat dengan bahan pilihan, higienis, dan halal untuk kepuasan Anda.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>MENU</h4>
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#katalog">Katalog</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>KONTAK</h4>
                <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
                <p><i class="fas fa-envelope"></i> hello@maekuki.com</p>
            </div>

            <div class="footer-col payment">
                <h4>ALAMAT</h4>
                <div class="Alamat-UMKM">
                    <p class="address-line"><i class="fas fa-map-marker-alt"></i> Jl. Manunggal 22, Maccini Sombala, Kec. Tamalate, Kota Makassar, Sulawesi Selatan 90224</p>
                </div>
                <h4 class="jam-operasional">Jam Operasional:</h4>
                <p>08.00 - 17.00 WIB</p>
            </div>
        </div>

        <div class="copyright">
            &copy; 2025 Maekuki. All Rights Reserved.
        </div>

        <a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </footer>

    <div id="cart-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>

            <h2 style="color: #8B4513; margin-bottom: 20px;">
                <i class="fas fa-shopping-bag" style="margin-right: 10px;"></i>
                Keranjang Belanja
            </h2>

            <div id="cart-items-wrapper">
                <p id="empty-cart-message" style="text-align: center; color: #888; margin: 50px 0; font-size: 1.1rem;">
                    Keranjang Anda kosong
                    <br><a href="#katalog" onclick="document.getElementById('cart-modal').style.display='none'">Mulai Belanja</a>
                </p>

            </div>

            <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

            <div id="cart-summary" style="display: flex; justify-content: space-between; align-items: center; font-size: 1.5rem; font-weight: 600;">
                <span>Total</span>
                <span id="cart-total-amount" style="color: #E60023;">Rp 0</span>
            </div>

            <button id="checkout-btn" class="btn-order" style="width: 100%; margin-top: 20px; padding: 12px;">
                Order via WhatsApp
            </button>
        </div>
    </div>

    <div id="toast-notification" class="toast-notification">
        <span id="toast-icon"></span>
        <div class="toast-content">
            <h4 id="toast-title"></h4>
            <p id="toast-message"></p>
        </div>
    </div>

    <div id="detail-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn detail-close-btn">&times;</span>

            <div id="detail-content" style="display: flex; gap: 25px; align-items: flex-start;">

                <div id="detail-image-container" style="flex-shrink: 0;">
                    <img id="detail-product-image" src="" alt="Foto Produk" style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>

                <div id="detail-info-container">
                    <h3 id="detail-product-name" style="color: var(--color-primary); font-size: 1.8rem; margin-top: 0;"></h3>

                    <div style="margin-bottom: 10px;">
                        <p style="font-weight: 600;">Jenis: <span id="detail-jenis">Kue Kering Klasik</span></p>
                    </div>

                    <p style="margin-bottom: 15px;">
                        <span style="font-weight: 600;">Deskripsi:</span>
                        <span id="detail-product-description"></span>
                    </p>

                    <div style="margin-bottom: 20px;">
                        <p style="font-weight: 600;">Kemasan: <span id="detail-kemasan">500gr</span></p>
                    </div>

                    <h4 style="color: #E60023; font-size: 1.6rem;">Harga : <span id="detail-product-price"></span></h4>

                    <button id="detail-add-to-cart" class="btn-order" style="margin-top: 15px; padding: 10px 20px;">
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="user-data-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn user-data-close-btn">&times;</span>
            <h2>Masukkan Data Pengiriman</h2>
            <form id="user-data-form">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="user-name">Nama Lengkap:</label>
                    <input type="text" id="user-name" required style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="user-phone">Nomor Telepon (WA):</label>
                    <input type="tel" id="user-phone" required style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="user-address">Alamat Pengiriman:</label>
                    <textarea id="user-address" required style="width: 100%; padding: 8px;"></textarea>
                </div>
                <button type="submit" id="final-checkout-btn" class="btn-order" style="width: 100%; padding: 12px; background: #DAA520;">Finalisasi Pesanan</button>
            </form>
        </div>
    </div>

    <script>
        // --- Funsi Helper CI4 ---
        function base_url(uri) {
            return "<?= base_url() ?>" + uri;
        }


        // Definisikan fungsi ini di atas initCatalogListeners()

        function handleAddToCart() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-nama');
            const price = this.getAttribute('data-harga');
            const image = this.getAttribute('data-gambar');
            addToCart(id, name, price, image);
        }

        function handleShowDetail() {
            const card = this.closest('.produk-card');
            const productData = getProductDataFromCard(card);
            showProductDetail(productData);
        }

        // app/Views/index.php (di bagian <script>)

        // --- FUNGSI BARU: MEMASANG SEMUA LISTENERS KERANJANG ---
        function initCatalogListeners() {
            // 1. Tombol Tambah ke Keranjang (Katalog)
            document.querySelectorAll('.btn-cart').forEach(button => {
                // Hapus listener lama (jika ada) sebelum menambahkannya lagi
                // (Meskipun tidak wajib di sini, ini adalah praktik yang baik)

                button.removeEventListener('click', handleAddToCart);
                button.addEventListener('click', handleAddToCart);
            });

            // 2. Tombol Detail (Katalog)
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.removeEventListener('click', handleShowDetail);
                button.addEventListener('click', handleShowDetail);
            });

            // Catatan: Anda perlu membuat fungsi handler yang terpisah (handleAddToCart, handleShowDetail)
        }

        // --- Fungsi untuk memuat konten katalog melalui AJAX ---
        async function loadKatalogPage(page = 1, keyword = '') {
            const katalogContainer = document.getElementById('katalogProduk');
            const paginationControls = document.querySelector('.pagination-controls');

            katalogContainer.style.opacity = '0.5';

            try {
                // --- KUNCI PERUBAHAN: BUAT URL DENGAN KEYWORD & PAGE ---
                let url = base_url('api/products') + `?page=${page}`;
                if (keyword) {
                    url += `&keyword=${encodeURIComponent(keyword)}`;
                }
                // Pastikan Anda mengubah base_url('api/products') sesuai dengan Controller Anda

                const response = await fetch(url);

                // Jika respons tidak OK (misalnya 404, 500)
                if (!response.ok) {
                    throw new Error('Gagal terhubung ke API: Status ' + response.status);
                }

                const data = await response.text();
                // ... (lanjutan logika parsing HTML) ...

                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');

                // PENTING: Jika produk kosong, tangani juga di sini
                const newKatalogContent = doc.getElementById('katalogProduk').innerHTML;
                const newPaginationLinks = doc.querySelector('.pagination-links').innerHTML;
                // newPaginationInfo tidak digunakan, bisa dihapus atau dilewatkan

                katalogContainer.innerHTML = newKatalogContent;
                document.querySelector('.pagination-links').innerHTML = newPaginationLinks;

                // ... (lanjutkan inisialisasi listener) ...

                initCatalogListeners();
                initPaginationListeners();

                // Update URL browser dengan parameter pencarian baru
                history.pushState(null, '', url);

            } catch (error) {
                console.error('Error memuat katalog via AJAX:', error);
                alert('Gagal memuat katalog. Error: ' + error.message);
            } finally {
                katalogContainer.style.opacity = '1';
            }
        }

        // --- FUNGSI BARU: MEMASANG LISTENERS PADA LINK PAGINATION ---
        function initPaginationListeners() {
            // 1. Target semua link di dalam container pagination kustom
            document.querySelectorAll('.custom-pagination a').forEach(link => {

                // Hapus listener lama jika ada (praktik yang baik)
                link.removeEventListener('click', handlePaginationClick);

                // Tambahkan listener baru
                link.addEventListener('click', handlePaginationClick);
            });
        }

        // --- FUNGSI HANDLER UNTUK KLIK PAGINATION ---
        function handlePaginationClick(event) {
            event.preventDefault();

            const newUrl = this.getAttribute('href');

            if (newUrl) {
                // KUNCI PERBAIKAN: Pisahkan URL menjadi page dan keyword
                const urlParams = new URLSearchParams(newUrl.split('?')[1]);
                const page = urlParams.get('page') || 1;
                const keyword = urlParams.get('keyword') || ''; // Ambil keyword dari URL pagination

                // Panggil loadKatalogPage dengan page dan keyword yang diekstrak
                loadKatalogPage(page, keyword);
            }
        }

        // --- Deklarasi Variabel Global (Diberi nilai nanti di DOMContentLoaded) ---
        // Dideklarasikan di sini agar bisa diakses oleh semua fungsi
        let cartCountElement = null;
        let cartModal = null;
        let closeBtn = null;
        let cartIconBtn = null;
        let cartWrapper = null;
        let cartTotalAmount = null;
        let checkoutBtn = null;
        let emptyCartMessage = null;

        // Variabel Toast
        let toastElement = null;
        let toastTitle = null;
        let toastMessage = null;
        let toastIcon = null;

        // Variabel untuk Modal Detail
        let detailModal = null;
        let detailCloseBtn = null;
        let detailProductImage = null;
        let detailProductName = null;
        let detailProductDescription = null;
        let detailProductPrice = null;
        let detailAddToCartBtn = null;
        let detailStok = null; // <-- DEKLARASI DI SINI SUDAH BENAR
        // ...

        let userDataModal = null;
        let userDataCloseBtn = null;
        let userDataForm = null;


        const CART_STORAGE_KEY = 'maekuki_cart';

        // --- FUNGSI TOAST NOTIFICATION ---
        function showToast(title, message, iconClass = 'fas fa-check-circle') {
            // Penting: Cek apakah elemen sudah diinisialisasi
            if (!toastElement) return;

            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toastIcon.className = '';

            const classes = iconClass.split(' ');
            toastIcon.classList.add(...classes);

            toastElement.classList.add('show');

            // Hapus notifikasi setelah 3 detik
            setTimeout(() => {
                toastElement.classList.remove('show');
            }, 3000);
        }

        // --- A. Fungsi Helper Local Storage ---
        function getCart() {
            const cartData = localStorage.getItem(CART_STORAGE_KEY);
            try {
                return cartData ? JSON.parse(cartData) : {};
            } catch (e) {
                console.error("Error parsing cart data:", e);
                return {};
            }
        }

        function saveCart(cart) {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            updateCartCount(cart);
            renderCartModal(); // Render ulang setelah setiap perubahan
        }

        // --- B. Logika Keranjang ---
        function formatRupiah(number) {
            if (typeof number !== 'number' || isNaN(number)) return 'Rp 0';
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
        }

        function updateCartCount(cart) {
            let totalItems = 0;
            for (const id in cart) {
                if (cart.hasOwnProperty(id)) {
                    totalItems += 1; // Hitung jumlah jenis produk
                }
            }
            cartCountElement.textContent = totalItems;
            // Tampilkan/sembunyikan notifikasi
            cartCountElement.style.display = totalItems > 0 ? 'flex' : 'none';
        }

        function addToCart(productId, name, price, image) {
            const cart = getCart();
            const floatPrice = parseFloat(price);

            if (cart[productId]) {
                cart[productId].qty += 1;
            } else {
                cart[productId] = {
                    id: productId,
                    name: name,
                    price: floatPrice,
                    qty: 1,
                    image: image // Simpan nama file gambar
                };
            }
            saveCart(cart);
            // PANGGILAN TOAST UNTUK NOTIFIKASI BERHASIL
            showToast("Berhasil ditambahkan", `${name} masuk ke keranjang.`, 'fas fa-shopping-bag');
        }

        function updateQuantity(productId, newQty) {
            const cart = getCart();
            const qty = parseInt(newQty);

            if (qty > 0) {
                cart[productId].qty = qty;
            } else {
                delete cart[productId];
            }
            saveCart(cart);
        }

        function removeItem(productId) {
            const cart = getCart();
            const removedItemName = cart[productId] ? cart[productId].name : "Produk";
            delete cart[productId];
            saveCart(cart);
            // PANGGILAN TOAST SAAT HAPUS
            showToast("Produk Dihapus", `${removedItemName} telah dikeluarkan dari keranjang.`, 'fas fa-trash');
        }

        // --- C. Logika Tampilan Card Modal ---
        function renderCartModal() {
            const cart = getCart();
            let total = 0;

            cartWrapper.innerHTML = '';

            if (Object.keys(cart).length === 0) {
                emptyCartMessage.style.display = 'block';
                checkoutBtn.disabled = true;
                cartWrapper.style.minHeight = '150px';
            } else {
                emptyCartMessage.style.display = 'none';
                checkoutBtn.disabled = false;
                cartWrapper.style.minHeight = 'auto';

                for (const id in cart) {
                    const item = cart[id];
                    const subtotal = item.price * item.qty;
                    total += subtotal;

                    // --- KODE HTML CARD PRODUK (SESUAI DESAIN ANDA) ---
                    const productHtml = `
                    <div class="cart-product-item">
                        <img src="${base_url('assets/Asset/' + item.image)}" alt="${item.name}">
                        
                        <div class="cart-detail">
                            <h4>${item.name}</h4>
                            <p>${formatRupiah(item.price)}</p>
                        </div>
                        
                        <div class="cart-actions-column">
                            <div class="quantity-control">
                                <button class="qty-minus-btn" data-id="${id}">-</button>
                                <span class="qty-display">${item.qty}</span>
                                <button class="qty-plus-btn" data-id="${id}">+</button>
                            </div>
                            <button class="delete-btn" data-id="${id}"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `;
                    cartWrapper.insertAdjacentHTML('beforeend', productHtml);
                }
            }
            cartTotalAmount.textContent = formatRupiah(total);
        }

        function getProductDataFromCard(card) {
            const btnCart = card.querySelector('.btn-cart');
            const name = btnCart.getAttribute('data-nama');
            const price = btnCart.getAttribute('data-harga');

            return {
                id: btnCart.getAttribute('data-id'),
                nama: name,
                // Karena deskripsi sudah dihapus dari HTML, kita pakai data statis:
                deskripsi: card.getAttribute('data-deskripsi'),
                harga: price,
                url_gambar: btnCart.getAttribute('data-gambar'),
                kemasan: "500gr", // Statis
                status: "Aktif" // Statis
            };
        }

        function showProductDetail(product) {
            // Isi data ke dalam elemen Modal Detail
            detailProductImage.src = base_url('assets/Asset/' + product.url_gambar);
            detailProductName.textContent = product.nama;

            // MENGISI NILAI STOK STATIS (10) dan Kemasan BARU
            document.getElementById('detail-kemasan').textContent = "500gr / Toples"; // Mengganti hardcode

            detailProductDescription.textContent = product.deskripsi;
            detailProductPrice.textContent = formatRupiah(parseFloat(product.harga));

            // Siapkan data untuk tombol 'Tambah ke Keranjang' di dalam modal
            detailAddToCartBtn.setAttribute('data-id', product.id);
            detailAddToCartBtn.setAttribute('data-nama', product.nama);
            detailAddToCartBtn.setAttribute('data-harga', product.harga);
            detailAddToCartBtn.setAttribute('data-gambar', product.url_gambar);

            // Tampilkan Modal
            //detailModal.style.display = 'block';

            // detailModal.style.display = 'block'; <--- HAPUS ATAU KOMENTARI INI

            // KUNCI PERBAIKAN: Terapkan logika animasi smooth yang baru
            detailModal.style.display = 'block';
            setTimeout(() => {
                detailModal.classList.add('show-modal');
            }, 10);
        }

        // --- D. Event Listeners ---
        document.addEventListener('DOMContentLoaded', () => {


            // index.php - Tambahkan kode ini di dalam DOMContentLoaded

            // --- LOGIKA HAMBURGER MENU ---
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            if (menuToggle && navLinks) {
                menuToggle.addEventListener('click', () => {
                    navLinks.classList.toggle('show');
                });

                // Menutup menu saat link di klik (agar berfungsi di mobile)
                navLinks.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        navLinks.classList.remove('show');
                    });
                });
            }
            // --- AKHIR LOGIKA HAMBURGER MENU ---

            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-input');

            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Mencegah form submit default

                    const keyword = searchInput.value.trim(); // Ambil nilai dan hapus spasi

                    // PANGGIL FUNGSI PEMUATAN KATALOG dengan keyword (bisa kosong)
                    loadKatalogPage(1, keyword);
                });

                // KUNCI PERBAIKAN: EVENT LISTENER UNTUK DETEKSI KEYWORD KOSONG
                searchInput.addEventListener('input', function() {
                    // Jika input dikosongkan (setelah di-search), muat ulang katalog penuh
                    if (this.value.trim() === '') {
                        // Berikan sedikit delay untuk menghindari panggilan terlalu cepat
                        setTimeout(() => {
                            // Panggil loadKatalogPage dengan keyword kosong (melihat semua produk)
                            loadKatalogPage(1, '');
                        }, 300); // Delay 300ms
                    }
                });
            }

            // --- 1. INISIALISASI SEMUA ELEMEN HTML DI SINI ---
            // Elemen Keranjang
            cartCountElement = document.getElementById('cart-count');
            cartModal = document.getElementById('cart-modal');
            closeBtn = document.querySelector('.close-btn');
            cartIconBtn = document.getElementById('cart-icon-btn');
            cartWrapper = document.getElementById('cart-items-wrapper');
            cartTotalAmount = document.getElementById('cart-total-amount');
            checkoutBtn = document.getElementById('checkout-btn');
            emptyCartMessage = document.getElementById('empty-cart-message');

            // Elemen Toast
            toastElement = document.getElementById('toast-notification');
            toastTitle = document.getElementById('toast-title');
            toastMessage = document.getElementById('toast-message');
            toastIcon = document.getElementById('toast-icon');
            // --- AKHIR INISIALISASI ---

            // Di dalam blok inisialisasi:
            // --- INISIALISASI BARU ---
            detailModal = document.getElementById('detail-modal');
            detailCloseBtn = document.querySelector('.detail-close-btn');
            detailProductImage = document.getElementById('detail-product-image');
            detailProductName = document.getElementById('detail-product-name');
            detailProductDescription = document.getElementById('detail-product-description');
            detailProductPrice = document.getElementById('detail-product-price');
            detailAddToCartBtn = document.getElementById('detail-add-to-cart');
            // INISIALISASI BARU
            detailStok = document.getElementById('detail-stok'); // <-- TAMBAHKAN INI

            // --- INISIALISASI BARU ---
            userDataModal = document.getElementById('user-data-modal');
            userDataCloseBtn = document.querySelector('.user-data-close-btn');
            userDataForm = document.getElementById('user-data-form');
            // ...
            // ...
            // --- AKHIR INISIALISASI BARU ---


            // Muat keranjang saat halaman pertama dimuat
            updateCartCount(getCart());

            // 1. Event Listener untuk Tombol Detail (di katalog)
            // 1. Event Listener untuk Tombol Detail (di katalog)
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.produk-card');

                    // Ambil data menggunakan fungsi pembantu
                    const productData = getProductDataFromCard(card);

                    // Panggil fungsi untuk menampilkan Modal Detail
                    showProductDetail(productData);
                });
            });

            // 2. Event Listener untuk Tombol Tambah ke Keranjang di dalam Modal Detail
            detailAddToCartBtn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-nama');
                const price = this.getAttribute('data-harga');
                const image = this.getAttribute('data-gambar');

                addToCart(id, name, price, image);
                detailModal.style.display = 'none'; // Tutup Modal setelah ditambahkan
            });

            // 3. Tutup Modal Detail
            detailCloseBtn.addEventListener('click', function() {
                // detailModal.style.display = 'none';
                detailModal.classList.remove('show-modal');
                setTimeout(() => {
                    detailModal.style.display = 'none';
                }, 300);
            });

            // 2. Tombol Tambah ke Keranjang (Katalog)
            document.querySelectorAll('.btn-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-nama');
                    const price = this.getAttribute('data-harga');
                    const image = this.getAttribute('data-gambar');
                    addToCart(id, name, price, image);
                });
            });

            // 3. Buka Modal (Ikon Keranjang)
            if (cartIconBtn) {
                cartIconBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    renderCartModal();
                    cartModal.style.display = 'block';

                    // KUNCI PERBAIKAN 2: Beri waktu singkat sebelum animasi dimulai
                    setTimeout(() => {
                        cartModal.classList.add('show-modal');
                    }, 10); // Delay 10ms cukup untuk transisi dimulai
                });
            }


            // Di dalam DOMContentLoaded:
            userDataForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const cart = getCart();
                const itemsArray = Object.values(cart); // Ambil array item dari cart object

                const userData = {
                    name: document.getElementById('user-name').value,
                    phone: document.getElementById('user-phone').value,
                    address: document.getElementById('user-address').value
                };

                const payload = {
                    user: userData,
                    items: itemsArray
                };

                // Tampilkan Loading/Disable tombol
                this.querySelector('#final-checkout-btn').textContent = 'Memproses...';
                this.querySelector('#final-checkout-btn').disabled = true;

                try {
                    const response = await fetch(base_url('api/checkout'), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            // CI4 memerlukan token CSRF jika diaktifkan. Kita abaikan dulu.
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        // Sukses: Tampilkan notif, kirim WA, dan hapus keranjang
                        showToast("Pesanan Berhasil!", `Pesanan ID ${result.id_pesanan} berhasil dicatat.`, 'fas fa-check-circle');

                        // Bersihkan Local Storage
            

                        // Kirim notifikasi WhatsApp
                        // Tambahkan di bagian Global Variables (sekitar baris 630 di script Anda)
                        // Anggap nomor WA Admin adalah: 0812-3456-7890 (sesuai contoh di Footer Anda)
                        // --- KUNCI PERBAIKAN: MEMBUAT PESAN WHATSAPP BARU (Itemized List + Total) ---

                        const ADMIN_PHONE = '6283144310325'; // Pastikan ini adalah nomor Admin yang benar

                        // 1. Dapatkan daftar item yang dipesan dan hitung total
                        const cart = getCart();
                        const itemsArray = Object.values(cart);
                        let pesananList = "";
                        let grandTotal = 0; // KUNCI: Variabel untuk menyimpan total harga

                        // 2. Loop untuk membuat daftar pesanan bernomor dan menghitung total
                        itemsArray.forEach((item, index) => {
                            const subtotal = item.price * item.qty;
                            grandTotal += subtotal; // Tambahkan ke grand total

                            // Format produk: Nama Produk : Kue Kastengel, Jumlah : 2
                            pesananList += `${index + 1}. Nama Produk : ${item.name}\n`;
                            pesananList += `   Jumlah            : ${item.qty}\n\n`;
                        });

                        // 3. Format Total Harga (sama seperti fungsi formatRupiah, tapi kita buat sederhana)
                        const totalRupiah = formatRupiah(grandTotal).replace('Rp', 'Rp '); // Menggunakan fungsi yang sudah ada

                        // 4. Teks Header dan Data Pelanggan
                        const header =
                            `📦 *Katalog Kue Kering – Maekuki* 🍪✨

_Halo ${userData.name}!
Terima kasih sudah berbelanja di UMKM Maekuki ❤️
Berikut katalog kue kering spesial kami:_

📍 *DATA PEMBELI*
Nama: ${userData.name}
No. Telepon: ${userData.phone}
Alamat Pengiriman: ${userData.address}
`;

                        // 5. Teks Detail Pesanan, Total Harga, dan Footer
                        const footer = `
🛍️ *DETAIL PESANAN*

${pesananList}
Total Harga Produk: ${totalRupiah}

Catatan tambahan: (Silakan isi jika ada)

Kami akan segera cek ketersediaan dan menghitung total + ongkir 😊
`;

                        const fullMessage = header + footer;

                        // 6. Kirim notifikasi WhatsApp
                        const whatsappUrl = `https://wa.me/${ADMIN_PHONE}?text=${encodeURIComponent(fullMessage)}`;
                        window.open(whatsappUrl, '_blank');

                        // ---------------------------------------------------------------------------------------

                        localStorage.removeItem(CART_STORAGE_KEY);
                        updateCartCount({}); // Update notifikasi angka ke 0

                    } else {
                        showToast("Gagal!", `Error: ${result.message}`, 'fas fa-times-circle');
                    }

                } catch (error) {
                    showToast("Error Koneksi", "Gagal menghubungi server.", 'fas fa-exclamation-triangle');
                    console.error('AJAX Error:', error);
                } finally {
                    // Reset form dan tombol
                    userDataModal.style.display = 'none';
                    this.querySelector('#final-checkout-btn').textContent = 'Finalisasi Pesanan';
                    this.querySelector('#final-checkout-btn').disabled = false;
                    this.reset();
                }
            });

            // 4. Tutup Modal (Tombol X dan Klik di luar)
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    cartModal.classList.remove('show-modal');

                    // KUNCI PERBAIKAN 3: Sembunyikan sepenuhnya setelah animasi selesai (0.3s)
                    setTimeout(() => {
                        cartModal.style.display = 'none';
                    }, 300);
                });
            }

            window.addEventListener('click', function(event) {
                if (event.target == cartModal) {
                    cartModal.classList.remove('show-modal');

                    // KUNCI PERBAIKAN 4: Sembunyikan sepenuhnya setelah animasi selesai
                    setTimeout(() => {
                        cartModal.style.display = 'none';
                    }, 300);
                }

                // TAMBAHKAN KONDISI INI UNTUK MODAL DETAIL
                else if (event.target == detailModal) {
                    // Logika penutupan Modal Detail
                    detailModal.classList.remove('show-modal');

                    setTimeout(() => {
                        detailModal.style.display = 'none';
                    }, 300);
                }
            });

            // 5. Update Kuantitas dan Hapus Item (Delegasi Event pada Modal)
            // Perbaikan untuk memastikan klik pada ikon/tombol terdeteksi dengan benar
            cartWrapper.addEventListener('click', function(e) {
                let target = e.target;

                // Mencari elemen terdekat dengan kelas aksi
                const plusBtn = target.closest('.qty-plus-btn');
                const minusBtn = target.closest('.qty-minus-btn');
                const deleteBtn = target.closest('.delete-btn');

                if (plusBtn || minusBtn || deleteBtn) {
                    const id = (plusBtn || minusBtn || deleteBtn).getAttribute('data-id');
                    const cart = getCart();

                    // Logika Hapus Item
                    if (deleteBtn) {
                        if (confirm("Apakah Anda yakin ingin menghapus produk ini dari keranjang?")) {
                            removeItem(id);
                        }
                    }
                    // Logika Kuantitas Plus/Minus
                    else if (plusBtn) {
                        updateQuantity(id, cart[id].qty + 1);
                    } else if (minusBtn) {
                        updateQuantity(id, cart[id].qty - 1);
                    }
                }
            });

            // GANTI event listener checkoutBtn LAMA dengan ini:
            // GANTI event listener checkoutBtn LAMA dengan ini:
            checkoutBtn.addEventListener('click', function() {
                const cart = getCart();
                if (Object.keys(cart).length === 0) {
                    showToast("Keranjang Kosong", "Tambahkan produk terlebih dahulu.", 'fas fa-exclamation-triangle');
                    return;
                }

                // 1. Tutup Modal Keranjang (Menggunakan animasi smooth)
                cartModal.classList.remove('show-modal');

                // Beri waktu untuk transisi (300ms)
                setTimeout(() => {
                    cartModal.style.display = 'none';

                    // 2. Buka Modal Data User (Dengan animasi smooth)
                    if (userDataModal) {
                        userDataModal.style.display = 'block';

                        // KUNCI: Panggil show-modal setelah display: block
                        setTimeout(() => {
                            userDataModal.classList.add('show-modal');
                        }, 10);
                    }
                }, 300); // 300ms = durasi transisi
            });

            // TUTUP Modal Data User
            // TUTUP Modal Data User (Tombol X, sekitar baris 819)
            if (userDataCloseBtn) {
                userDataCloseBtn.addEventListener('click', function() {
                    // Hapus class 'show-modal' untuk memulai fade out
                    userDataModal.classList.remove('show-modal');

                    // Sembunyikan sepenuhnya setelah animasi (300ms) selesai
                    setTimeout(() => {
                        userDataModal.style.display = 'none';
                    }, 300);
                });
            }

            // index.php - Ganti SELURUH BLOK window.addEventListener DENGAN INI (sekitar baris 793):

            window.addEventListener('click', function(event) {
                if (event.target == cartModal) {
                    cartModal.classList.remove('show-modal');
                    setTimeout(() => {
                        cartModal.style.display = 'none';
                    }, 300);
                } else if (event.target == detailModal) {
                    detailModal.classList.remove('show-modal');
                    setTimeout(() => {
                        detailModal.style.display = 'none';
                    }, 300);
                }
                // KUNCI: Pengecekan userDataModal di dalam else if atau terpisah
                else if (event.target == userDataModal) {
                    userDataModal.classList.remove('show-modal');
                    setTimeout(() => {
                        userDataModal.style.display = 'none';
                    }, 300);
                }
            });

            // Catatan: Pastikan logika penutupan Tombol X yang baru (userDataCloseBtn) tetap ada
        });
    </script>
</body>

</html>