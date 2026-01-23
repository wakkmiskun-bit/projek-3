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

    // ===== ADMIN PANELS =====
    window.toggleAdmin = function() {
        const adminPanel = document.getElementById('admin-panel-1');
        if (adminPanel) {
            adminPanel.classList.toggle('hidden');
        }
    };

    document.addEventListener('click', function(e) {
        const adminPanel1 = document.getElementById('admin-panel-1');
        if (adminPanel1 && e.target === adminPanel1) {
            adminPanel1.classList.add('hidden');
        }
    });

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

    // ===== SUBMIT FORM → WHATSAPP =====
    if (userForm) {
        userForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const nama = userForm.nama.value;
            const email = userForm.email.value;
            const telepon = userForm.telepon.value;
            const alamat = userForm.alamat.value;
            const kota = userForm.kota.value;

            const pesan = `
Halo Admin, saya ingin memesan mobil:

🚗 Mobil : ${mobilData.nama}
🆔 Seri  : ${mobilData.id}
💰 Harga : ${mobilData.harga}

👤 Nama  : ${nama}
📧 Email : ${email}
📞 Telp  : ${telepon}
🏠 Alamat: ${alamat}
🏙️ Kota  : ${kota}
            `;

            const noWA = "6285191163819";
            const url = `https://wa.me/${noWA}?text=${encodeURIComponent(pesan)}`;

            window.open(url, '_blank');
            
            userForm.reset();
            if (formModal) {
                formModal.classList.remove('show');
                formModal.style.display = 'none';
            }
        });
    }

});

