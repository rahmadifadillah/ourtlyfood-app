<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kategori Artikel</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_kategori_artikel'); ?>'>Tambah Kategori</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table" style="width: 100%">
                <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Kategori</th>
                    <th>Link</th>
                    <th>Posisi</th>
                    <th>Aktif</th>
                    <th style='width:10%;'>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    echo "<tr><td>$no</td>
                              <td>$row[nama_kategori]</td>
                              <td><a target='_BLANK' href='" . base_url() . "artikel/kategori/$row[kategori_seo]'>artikel/kategori/$row[kategori_seo]</a></td>
                              <td>$row[sidebar]</td>
                              <td>$row[aktif]</td>
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/edit_kategori_artikel/$row[id_kategori]'><i class='fas fa-edit fa-fw'></i></a>
                                <button class='btn btn-danger btn-xs' title='Hapus' data-id='$row[id_kategori]' onclick=\"confirmation(event)\"><i class='fas fa-times fa-fw'></i></button>
                             </td>
                          </tr>";
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  function confirmation(ev) {
    ev.preventDefault();
    var data_id = ev.currentTarget.getAttribute('data-id');
    var currentLocation = window.location;
    Swal.fire({
      title: 'Konfirmasi Hapus Data',
      text: "Apakah Anda ingin menghapus data ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: site_url + 'admin/delete_kategori_artikel/' + data_id,
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            Swal.fire({
              title: 'Dihapus!',
              text: 'Data berhasil dihapus',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              location.reload();
            })
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
              title: 'Gagal!',
              text: 'Terdapat artikel yang menggunakan kategori ini',
              icon: 'error',
              showConfirmButton: false,
              timer: 2000
            })
          },
        });
      }
    })
  }
</script>