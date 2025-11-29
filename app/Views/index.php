<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maekuki - Kue Kering Premium & Halal</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <header class="navbar">
        <div class="container">
            <div class="logo">
                <img src="assets/Asset/maekukilogo.png">
                <h1>Maekuki Homemade Cookies</h1>
            </div>
            <nav class="nav-links">
                <a href="#beranda" class="active">Beranda</a>
                <a href="#katalog">Katalog</a>
                <a href="#tentang">Tentang Kami</a>
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
            <h2>Kue Kering Homemade <br>Premium</h2>
            <p>Resep keluarga yang diwariskan turun-temurun. Tanpa bahan pengawet, dibuat dengan cinta untuk momen spesial Anda.</p>
            <a href="#katalog" class="btn-lihat-produk">Lihat Produk <i class="fas fa-chevron-down"></i></a>
        </div>
    </section>

    <section id="katalog" class="katalog-section container">
        <div class="section-title">
            <p class="subtitle">KOLEKSI TERBAIK</p>
            <h2>Katalog Kue Kering</h2>
            <p class="description">Dibuat fresh setiap hari | Kemasan 500gr</p>
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

                            <div class="produk-card">
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
    </section>

    <section id="parcel" class="parcel-section">
        <div class="container">
            <h2>🎁 Parcel & Hampers Spesial</h2>
            <p>Jadikan momen spesial lebih berkesan dengan pilihan parcel kue kering premium kami. Cocok untuk hadiah Lebaran, Natal, atau acara istimewa lainnya.</p>
            <a href="#" class="btn-primary">Lihat Pilihan Parcel</a>
        </div>
    </section>

    <footer id="kontak" class="main-footer">
        <div class="container footer-grid">

            <div class="footer-col about">
                <h3>Maekuki</h3>
                <p>Menyajikan kue kering homemade berkualitas premium. Dibuat dengan bahan pilihan, higienis, dan **halal** untuk kepuasan Anda.</p>
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
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>KONTAK</h4>
                <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
                <p><i class="fas fa-envelope"></i> hello@maekuki.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Jakarta Selatan</p>
            </div>

            <div class="footer-col payment">
                <h4>PEMBAYARAN</h4>
                <div class="payment-methods">
                    <span class="method-tag bca">BCA</span>
                    <span class="method-tag mandiri">Mandiri</span>
                    <span class="method-tag qris">QRIS</span>
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
                    <p id="detail-product-description" style="margin-bottom: 15px;"></p>

                    <div style="margin-bottom: 20px;">
                        <p style="font-weight: 600;">Kemasan: <span id="detail-kemasan">500gr</span></p>
                        <p style="font-weight: 600;">Status: <span id="detail-status" style="color: var(--color-accent-green);">Aktif</span></p>
                    </div>

                    <h4 style="color: #E60023; font-size: 1.5rem;">Harga: <span id="detail-product-price"></span></h4>

                    <button id="detail-add-to-cart" class="btn-order" style="margin-top: 15px; padding: 10px 20px;">
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- Funsi Helper CI4 ---
        function base_url(uri) {
            return "<?= base_url() ?>" + uri;
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

        const CART_STORAGE_KEY = 'maekuki_cart';

        // --- FUNGSI TOAST NOTIFICATION ---
        function showToast(title, message, iconClass = 'fas fa-check-circle') {
            // Penting: Cek apakah elemen sudah diinisialisasi
            if (!toastElement) return;

            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toastIcon.className = '';
            toastIcon.classList.add(iconClass);

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
                deskripsi: `Kue ${name} spesial kami. Dibuat fresh setiap hari dengan bahan premium dan tanpa pengawet.`,
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
            detailProductDescription.textContent = product.deskripsi;
            detailProductPrice.textContent = formatRupiah(parseFloat(product.harga));

            // Siapkan data untuk tombol 'Tambah ke Keranjang' di dalam modal
            detailAddToCartBtn.setAttribute('data-id', product.id);
            detailAddToCartBtn.setAttribute('data-nama', product.nama);
            detailAddToCartBtn.setAttribute('data-harga', product.harga);
            detailAddToCartBtn.setAttribute('data-gambar', product.url_gambar);

            // Tampilkan Modal
            detailModal.style.display = 'block';
        }

        // --- D. Event Listeners ---
        document.addEventListener('DOMContentLoaded', () => {

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
            // --- AKHIR INISIALISASI BARU ---


            // Muat keranjang saat halaman pertama dimuat
            updateCartCount(getCart());

            // 1. Event Listener untuk Tombol Detail (di katalog)
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.produk-card');

                    // Ambil data dari atribut HTML untuk produk ini (Anda perlu menambahkan atribut ini!)
                    // KARENA DATA TIDAK ADA DI SINI, kita harus mengambilnya dari Model/Database

                    // --- SOLUSI SIMPLIFIKASI: Ambil data dari database melalui AJAX ---
                    // Karena kita tidak memiliki AJAX, kita akan menggunakan cara yang lebih sederhana:
                    // Cukup lewati tombol 'Detail' dan fokus pada tombol 'Tambah' di dalam modal.
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
                detailModal.style.display = 'none';
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
                });
            }

            // 4. Tutup Modal (Tombol X dan Klik di luar)
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    cartModal.style.display = 'none';
                });
            }

            window.addEventListener('click', function(event) {
                if (event.target == cartModal) {
                    cartModal.style.display = 'none';
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

            // 6. Tombol Checkout WhatsApp
            checkoutBtn.addEventListener('click', function() {
                const cart = getCart();
                if (Object.keys(cart).length === 0) {
                    alert("Keranjang kosong!");
                    return;
                }

                let message = "Halo, saya ingin memesan kue kering berikut:\n\n";
                let totalOrder = 0;

                for (const id in cart) {
                    const item = cart[id];
                    const subtotal = item.price * item.qty;
                    totalOrder += subtotal;

                    message += `${item.qty}x ${item.name} (${formatRupiah(item.price)} per pcs) = ${formatRupiah(subtotal)}\n`;
                }

                message += `\nTotal Belanja: ${formatRupiah(totalOrder)}\n\n`;
                message += "Mohon konfirmasi pesanan saya. Terima kasih!";

                const whatsappUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            });
        });
    </script>
</body>

</html>