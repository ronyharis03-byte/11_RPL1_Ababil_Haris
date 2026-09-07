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


function validasiform(){
  var tglMulai = document.getElementById('tgl_Mulai')
  var tglSelesai = document.getElementById('tgl_Selesai')

  if (new date (tglselesai) < new date(tglmulai)){
    alert('tanggal selesai tidak boleh lebih awal dari tanggal mulai!');
  }
  return true;

}
