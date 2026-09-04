function tampilkanNama () {
  document.getElementById("namaAnggota").innerHTML = `
  
  <ol style="list-style-type: decimal; padding-left:5%;">
    <li> haris (haris@gmail.com)</li>
    <li> ababil (ababil@gmail.com)</li>
  </ol>

  <a href="kontak_anggota.html">
      <button onclick="location.reload()">
        tutup kembali
     </button>
  `;
}


function tampilkanPesanan() {
  document.getElementById("KlikPesanan").innerHTML = `
  
  <ol style="list-style-type: decimal; padding-left:5%;">
    <li> sudah</li>
  </ol>

  <a href="resep_makanan.html">
      <button onclick="location.reload()">
        tutup kembali
     </button>
  `;
}
