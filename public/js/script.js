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


    /* ================= CLOSE MODALS ================= */
    if (closeFormBtn) closeFormBtn.onclick = () => closeModal(formModal);
    if (cancelBtn) cancelBtn.onclick = () => closeModal(formModal);
    if (closeDetailBtn) closeDetailBtn.onclick = () => closeModal(detailModal);

    window.onclick = function(e) {
        if (e.target === formModal) closeModal(formModal);
        if (e.target === detailModal) closeModal(detailModal);
    };


    /* ================= FORM SUBMIT (ANTI DOUBLE) ================= */
    let sedangMengirim = false;

    if (userForm) {
        userForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (sedangMengirim) return;

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
            .then(res => res.json())
            .then(() => {
                alert("✅ Pesanan Berhasil!");
                window.location.href = "/admin/pembelian";
            })
            .catch(() => {
                alert("❌ Gagal kirim data.");
                sedangMengirim = false;
                if (btn) {
                    btn.disabled = false;
                    btn.innerText = "KIRIM PEMBELIAN";
                }
            });
        });
    }

});
