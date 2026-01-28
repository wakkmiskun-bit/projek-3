document.addEventListener('DOMContentLoaded', function () {

    /* ================= NAVIGATION ================= */
    window.scrollToSection = function(sectionId) {
        document.querySelectorAll('.section').forEach(sec => sec.classList.remove('active'));

        const target = document.getElementById(sectionId);
        if (target && target.classList.contains('section')) {
            target.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    };

    // Default tampil katalog
    const katalog = document.getElementById('katalog');
    if (katalog) katalog.classList.add('active');


    /* ================= MODAL ELEMENTS ================= */
    const formModal   = document.getElementById('formModal');
    const detailModal = document.getElementById('detailModal');
    const userForm    = document.getElementById('userForm');
    const mobilIdInput = document.getElementById('mobilId');

    const closeFormBtn   = document.querySelector('.close');
    const closeDetailBtn = document.querySelector('.close-detail');
    const cancelBtn      = document.getElementById('cancelBtn');

    const detailFields = {
        nama: document.getElementById('detailNama'),
        merek: document.getElementById('detailMerek'),
        harga: document.getElementById('detailHarga'),
        mesin: document.getElementById('detailMesin'),
        transmisi: document.getElementById('detailTransmisi'),
        bahanbakar: document.getElementById('detailBahan'),
        cc: document.getElementById('detailCc'),
        warna: document.getElementById('detailWarna'),
        tahun: document.getElementById('detailTahun'),
        penggerak: document.getElementById('detailPenggerak')
    };

    const openModal = (modal) => {
        if (!modal) return;
        modal.classList.add('show');
        modal.style.display = 'flex';
    };

    const closeModal = (modal) => {
        if (!modal) return;
        modal.classList.remove('show');
        modal.style.display = 'none';
    };


    /* ================= OPEN MODAL BELI ================= */
    document.querySelectorAll('.btn-beli').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (mobilIdInput) mobilIdInput.value = this.dataset.id;
            openModal(formModal);
        });
    });


    /* ================= OPEN MODAL DETAIL ================= */
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            Object.keys(detailFields).forEach(key => {
                if (detailFields[key]) {
                    detailFields[key].innerText = this.dataset[key] || '-';
                }
            });

            openModal(detailModal);
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

            sedangMengirim = true;
            if (btn) {
                btn.disabled = true;
                btn.innerText = "Proses...";
            }

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

