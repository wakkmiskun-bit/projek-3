document.addEventListener('DOMContentLoaded', function () {

    // ===== NAVIGATION & SECTIONS =====
    window.scrollToSection = function(sectionId) {
        document.querySelectorAll('.section').forEach(section => {
            section.classList.remove('active');
        });
        
        const targetSection = document.getElementById(sectionId);
        if (targetSection && targetSection.classList.contains('section')) {
            targetSection.classList.add('active');
        }
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Show katalog by default
    setTimeout(() => {
        const katalogSection = document.getElementById('katalog');
        if (katalogSection) {
            katalogSection.classList.add('active');
        }
    }, 100);



    // ===== MODAL ELEMENTS =====
    const formModal = document.getElementById('formModal');
    const detailModal = document.getElementById('detailModal');
    const closeBtn = document.querySelector('.close');
    const closeDetail = document.querySelector('.close-detail');
    const cancelBtn = document.getElementById('cancelBtn');
    const userForm = document.getElementById('userForm');
    const mobilIdInput = document.getElementById('mobilId');

    const detailNama = document.getElementById('detailNama');
    const detailMerek = document.getElementById('detailMerek');
    const detailHarga = document.getElementById('detailHarga');
    const detailMesin = document.getElementById('detailMesin');
    const detailTransmisi = document.getElementById('detailTransmisi');
    const detailBahan = document.getElementById('detailBahan');
    const detailCc = document.getElementById('detailCc');
    const detailWarna = document.getElementById('detailWarna');
    const detailTahun = document.getElementById('detailTahun');
    const detailPenggerak = document.getElementById('detailPenggerak');

    let mobilData = {};

    // ===== OPEN MODAL BELI =====
    const btnBeliElements = document.querySelectorAll('.btn-beli');
    btnBeliElements.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            mobilData = {
                id: this.dataset.id,
                nama: this.dataset.nama,
                harga: this.dataset.harga
            };

            if (mobilIdInput) mobilIdInput.value = mobilData.id;
            if (formModal) {
                formModal.classList.add('show');
                formModal.style.display = 'flex';
            }
        });
    });

    // ===== CLOSE MODAL BELI =====
    if (closeBtn) {
        closeBtn.onclick = function(e) {
            e.preventDefault();
            if (formModal) {
                formModal.classList.remove('show');
                formModal.style.display = 'none';
            }
        };
    }
    
    if (cancelBtn) {
        cancelBtn.onclick = function(e) {
            e.preventDefault();
            if (formModal) {
                formModal.classList.remove('show');
                formModal.style.display = 'none';
            }
        };
    }

    // ===== OPEN MODAL DETAIL =====
    const btnDetailElements = document.querySelectorAll('.btn-detail');
    btnDetailElements.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (detailNama) detailNama.innerText = this.dataset.nama;
            if (detailMerek) detailMerek.innerText = this.dataset.merek;
            if (detailHarga) detailHarga.innerText = this.dataset.harga;
            if (detailMesin) detailMesin.innerText = this.dataset.mesin;
            if (detailTransmisi) detailTransmisi.innerText = this.dataset.transmisi;
            if (detailBahan) detailBahan.innerText = this.dataset.bahanbakar;
            if (detailCc) detailCc.innerText = this.dataset.cc;
            if (detailWarna) detailWarna.innerText = this.dataset.warna;
            if (detailTahun) detailTahun.innerText = this.dataset.tahun;
            if (detailPenggerak) detailPenggerak.innerText = this.dataset.penggerak;

            if (detailModal) {
                detailModal.classList.add('show');
                detailModal.style.display = 'flex';
            }
        });
    });

    // ===== CLOSE MODAL DETAIL =====
    if (closeDetail) {
        closeDetail.onclick = function(e) {
            e.preventDefault();
            if (detailModal) {
                detailModal.classList.remove('show');
                detailModal.style.display = 'none';
            }
        };
    }

    // ===== CLOSE MODAL WHEN CLICKING OUTSIDE =====
    window.onclick = function (e) {
        if (formModal && e.target === formModal) {
            formModal.classList.remove('show');
            formModal.style.display = 'none';
        }
        if (detailModal && e.target === detailModal) {
            detailModal.classList.remove('show');
            detailModal.style.display = 'none';
        }
    };

    // Gunakan variabel di luar scope agar tidak bisa di-reset oleh klik baru
let sedanganMengirim = false;

document.getElementById('userForm').onsubmit = function(e) {
    e.preventDefault();

    // 1. Jika sedang mengirim, blokir total
    if (sedanganMengirim) return false;

    const btn = document.getElementById('submitBtn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 2. Kunci status & visual tombol
    sedanganMengirim = true;
    btn.disabled = true;
    btn.innerText = "Proses...";

    fetch("/beli-mobil", {
        method: "POST",
        body: new FormData(this),
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert("✅ Pesanan Berhasil!");
        // 3. Refresh halaman adalah cara paling ampuh mencegah double post di database
        window.location.href = "/admin/pembelian";
    })
    .catch(error => {
        console.error(error);
        alert("Gagal kirim data.");
        // Buka kunci hanya jika gagal
        sedanganMengirim = false;
        btn.disabled = false;
        btn.innerText = "KIRIM PEMBELIAN";
    });

    return false;
};

});

