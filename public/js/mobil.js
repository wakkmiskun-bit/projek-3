function editMobil(id) {
    fetch('/mobil/' + id + '/edit')
        .then(response => {
            if (!response.ok) throw new Error('Data gagal diambil');
            return response.json();
        })
        .then(data => {
            // Mengisi field berdasarkan ID yang kita buat di modal tadi
            document.getElementById('edit_nama').value = data.nama_mobil;
            document.getElementById('edit_merek').value = data.merek;
            document.getElementById('edit_harga').value = data.harga;
            document.getElementById('edit_stok').value = data.stok;
            
            // Mengubah action form agar mengarah ke route update
            document.getElementById('formEditMobil').action = '/mobil/' + id;
            
            // Memunculkan modal
            let modalElement = document.getElementById('modalEditMobil');
            let myModal = bootstrap.Modal.getOrCreateInstance(modalElement);
            myModal.show();
        })
        .catch(error => {
            console.error(error);
            alert('Waduh, gagal! Coba cek koneksi atau route edit kamu.');
        });
}