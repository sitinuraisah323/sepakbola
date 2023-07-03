<?php echo $this->extend('layouts/administrator');?>

<?php echo $this->section('csslibraies')?>
  <link rel="stylesheet" href="<?php echo base_url();?>/assets-panel/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/assets-panel/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<?php echo $this->endSection();?>

<?php echo $this->section('content');?>
<section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Peminjaman</h4>
                    <div class="card-header-action">
                      <a href="#" onclick="openModal()" class="btn btn-info" data-target="#modal-catalog-category" data-toggle="modal">Add</a>
                    </div>
                  </div>
                  <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Peminjam</th>
                                        <th>Nomor Telepon</th>
                                        <th>Alamat</th>
                                        <th>Buku</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            </div>

</section>
<form onsubmit="submitform(event)" class="modal fade" id="modal-catalog-category" tabindex="-1" role="dialog"
    aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Form Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                  <label for="tanggal_pinjam">Tanggal Pinjam</label>
                  <input type="date" class="form-control" name="tanggal_pinjam" id='tanggal_pinjam' value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                  <label for="tanggal_kembali">Tanggal Kembali</label>
                  <input type="date" class="form-control" name="tanggal_kembali" id='tanggal_kembali' value="">
                </div>
                <div class="form-group">
                    <label for="peminjam">Peminjam</label>
                    <input type="text" class="form-control" name="peminjam" id="peminjam">
                </div>
                <div class="form-group">
                    <label for="nomor_hp">Nomor Telepon</label>
                    <input type="text" class="form-control" name="nomor_hp" id="nomor_hp">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat">
                </div>
                <div class="form-group">
                    <label for="kategori">Buku</label>
                    <select class="form-control" name="buku" id="buku">
                        <option value="">Pilih Buku</option>
            
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control" name="jumlah" id="jumlah">
                </div>
      
                <button type="submit" class="btn btn-primary m-t-15 waves-effect btn-save">Save</button>
            </div>
        </div>
    </div>
    </div>
</form>
<?php echo $this->endsection();?>

<?php echo $this->section('jslibraies')?>
<script src="<?php echo base_url();?>/assets-panel/bundles/datatables/datatables.min.js"></script>
<script src="<?php echo base_url();?>/assets-panel/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
</script>
<script src="<?php echo base_url();?>/assets-panel/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="<?php echo base_url();?>/assets-panel/js/page/datatables.js"></script> -->
<script src="<?php echo base_url();?>/assets-panel/bundles/sweetalert/sweetalert.min.js"></script>
<!-- Page Specific JS File -->
<script src="<?php echo base_url();?>/assets-panel/js/page/sweetalert.js"></script>

 <script type="text/javascript">
        var dataTable;
        const formClear =  ()=>{
          $('#modal-catalog-category').find('[name="id"]').val('');
          $('#modal-catalog-category').find('[name="office_id"]').val('');
           $('#modal-catalog-category').find('[name="office_name"]').val('');
          $('#modal-catalog-category').find('[name="saldo"]').val('');
        }
        const openModal = ()=>{
          formClear();
          
          $('#modal-catalog-category').modal('show');
        }

        $('#upload-file').on('change', function(event){
          $('#modal-catalog-category').find('.btn-save').addClass('d-none');
          let file = event.target.files[0];
          let formData = new FormData();
          formData.append('file', file);
          axios.post(`<?php echo base_url();?>/api/filedrives/upload`, formData).then(res=>{
            let id = res.data.data.id;
            $('#id_file_drive').val(id);
          }).then(res=>{
            $('#modal-catalog-category').find('.btn-save').removeClass('d-none');
          })
        });

     

        const submitform = (event)=>{
          
          event.preventDefault();
          let formData = new FormData(event.target);
          formData.append('kategori',$('#kategori').val());
          let id = $('#modal-catalog-category').find('[name="id"]').val();
          console.log(formData);
          if(id === ''){
            axios.post(`<?php echo base_url();?>/api/peminjaman/insert`, formData).then(res=>{
                let status = res.data.status;
                let data = res.data.data;
               if(status === 422){
                  let message = Object.values(data)[0];
                  swal('Validasi Inputan', message, 'error');
                  return;
                }
                formClear();
                dataTable.ajax.reload();
                $('#modal-catalog-category').modal('hide');
            });
          }else{
            axios.post(`<?php echo base_url();?>/api/peminjaman/updated`, formData).then(res=>{
                let status = res.data.status;
                let data = res.data.data;
                if(status === 422){
                  let message = Object.values(data)[0];
                  swal('Validasi Inputan', message, 'error');
                  return;
                }
                formClear();
                dataTable.ajax.reload();
                $('#modal-catalog-category').modal('hide');
            });
          }
        }

        const initDataTable = ()=>{
          dataTable = $('#table-1').DataTable( {
                serverSide: true,
                ordering: true,
                searching: true,
                ajax:  {
                    url: `<?php echo base_url();?>/api/Peminjaman/dashboard`, 
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.message.totalRecord;
                        json.recordsFiltered = json.message.totalRecord;
                        json.data = json.data;            
                        return JSON.stringify( json ); // return JSON string
                    },  
                },                   
                columns: [
                      { data: "id" },   
                      { data: "tanggal_pinjam" },
                      { data: "tanggal_kembali",
                        // render: function ( data, type, row ) {      
                        //         return 'Rp ' + convertToRupiah(data);                            
                        // }
                      },
                      { data: "peminjam" },
                      { data: "nomor_hp" },
                      { data: "alamat" },
                      { data: "judul" },
                      { data: "jumlah" },
                      
                      {
                        data:function(data){
                          return    `   <button  onclick="btnEdit(${data.id})" class="btn btn-info btn-edit">Edit</button>
                                      <button  onclick="btnDelete(${data.id})" class="btn btn-danger btn-delete">Delete</button>`;
                        }
                      }
                  ],   
            } );
        }

        const btnDelete = (id)=>{
          axios.get(`<?php echo base_url();?>/api/peminjaman/view/${id}`).then(res=>{
              swal({
              title: 'Are you sure?',
              text: `Once deleted, you will not be able to recover ${res.data.data.peminjam}!`,
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                  axios.get(`<?php echo base_url();?>/api/peminjaman/deleted/${id}`).then(res=>{
                    swal(`Poof! ${res.data.data.peminjam} has been deleted!`, {
                      icon: 'success',
                    });
                    dataTable.ajax.reload();
                  });
                } else {
                  swal('Your imaginary file is safe!');
                }
              });
          })
          
        }

        const btnEdit = (id)=>{
          axios.get(`<?php echo base_url();?>/api/peminjaman/view/${id}`).then(res=>{
            $('#modal-catalog-category').find('[name="id"]').val(res.data.data.id);
            
            $('#modal-catalog-category').find('[name="tanggal_pinjam"]').val(res.data.data.tanggal_pinjam);
            $('#modal-catalog-category').find('[name="tanggal_kembali"]').val(res.data.data.tanggal_kembali);
            $('#modal-catalog-category').find('[name="peminjam"]').val(res.data.data.peminjam);
            $('#modal-catalog-category').find('[name="nomor_hp"]').val(res.data.data.nomor_hp);
            $('#modal-catalog-category').find('[name="alamat"]').val(res.data.data.alamat);
            
            $('#modal-catalog-category').find('[name="buku"]').val(res.data.data.buku);
            $('#modal-catalog-category').find('[name="jumlah"]').val(res.data.data.jumlah);
            }).then(res=>  $('#modal-catalog-category').modal('show'))
        }

      var buku = document.getElementById('buku');

      axios.get(`<?php echo base_url(); ?>/api/buku`).then(
        res => {
          const {
            data
          } = res.data;

          data.forEach(item => {
            var opt = document.createElement("option");
            opt.value = item.id;
            opt.text = item.judul;
            buku.appendChild(opt);

          })
        });

      var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      var date = new Date();

      var year = date.getFullYear().toString();
      var month = (date.getMonth()+1).toString();
      var dd = date.getDate().toString();
      var mmChars = month.split('');
      var ddChars = dd.split('');
      var today = year + '-' + (mmChars[1]?month:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);

      var cek = moment(today).add(2, 'days');

      if(myDays[cek._d.getDay()] == 'Sabtu'){
        var kembali = moment(today).add(4, 'days').format('YYYY-MM-DD');
      }else if(myDays[cek._d.getDay()] == 'Minggu'){
       var kembali = moment(today).add(3, 'days').format('YYYY-MM-DD');
      }else{
        var kembali = moment(today).add(2, 'days').format('YYYY-MM-DD');
      }

      $('#tanggal_kembali').val(kembali);
      

      axios.get(`<?php echo base_url(); ?>/api/buku`).then(
        res => {
          const {
            data
          } = res.data;

          data.forEach(item => {
            var opt = document.createElement("option");
            opt.value = item.id;
            opt.text = item.judul;
            buku.appendChild(opt);

          })
        });
        initDataTable();
    </script>
<?php echo $this->endSection();?>
