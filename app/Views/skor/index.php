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
                    <h4>Data Buku</h4>
                    <div class="card-header-action">
                      <a href="#" onclick="openModal()" class="btn btn-info" data-target="#modal-catalog-category" data-toggle="modal">Add</a>
                    </div>
                  </div>
                  <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Klub 1</th>
                                        <th>Skor 1</th>
                                        <th>VS</th>
                                        <th>Klub 2</th>
                                        <th>Skor 2</th>
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
                    <label for="klub_1">Klub 1</label>
                    <select class="form-control" name="klub_1" id="klub_1">
                        <option value="">Select Kategori</option>
            
                    </select>
                </div>
                 <div class="form-group">
                    <label for="skor_klub_1"> Skor Klub 1</label>
                    
                  <input type="text" class="form-control" name="skor_klub_1" id='skor_klub_1' value="">

                </div>


                 <div class="form-group">
                    <label for="skor_klub_2"> Skor Klub 2</label>
                    
                  <input type="text" class="form-control" name="skor_klub_2" id='skor_klub_2' value="">

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
          formData.append('klub_1',$('#klub_1').val());
          let id = $('#modal-catalog-category').find('[name="id"]').val();
          console.log(formData);
          if(id === ''){
            axios.post(`<?php echo base_url();?>/api/skor/insert`, formData).then(res=>{
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
            axios.post(`<?php echo base_url();?>/api/skor/updated`, formData).then(res=>{
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
                    url: `<?php echo base_url();?>/api/skor/custom`, 
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.message.totalRecord;
                        json.recordsFiltered = json.message.totalRecord;
                        json.data = json.data;            
                        return JSON.stringify( json ); // return JSON string
                    },  
                },                   
                columns: [
                      { data: "klub_1" },   
                      { data: "skor_klub_1" },
                      { data: "vs"},
                     { data: "klub_1" },   
                      { data: "skor_klub_1" },
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
          axios.get(`<?php echo base_url();?>/api/buku/view/${id}`).then(res=>{
              swal({
              title: 'Are you sure?',
              text: `Once deleted, you will not be able to recover ${res.data.data.judul}!`,
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                  axios.get(`<?php echo base_url();?>/api/buku/deleted/${id}`).then(res=>{
                    swal(`Poof! ${res.data.data.judul} has been deleted!`, {
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
          axios.get(`<?php echo base_url();?>/api/buku/view/${id}`).then(res=>{
            $('#modal-catalog-category').find('[name="id"]').val(res.data.data.id);
            
            $('#modal-catalog-category').find('[name="kode_buku"]').val(res.data.data.kode_buku);
            $('#modal-catalog-category').find('[name="kategori"]').val(res.data.data.kategori);
            $('#modal-catalog-category').find('[name="judul"]').val(res.data.data.judul);
            $('#modal-catalog-category').find('[name="stok"]').val(res.data.data.stok);
            $('#modal-catalog-category').find('[name="tahun"]').val(res.data.data.tahun);
            }).then(res=>  $('#modal-catalog-category').modal('show'))
        }

        const btnHistory = (id)=>{
          url = `<?php echo base_url();?>/api/settings/levelshistories?id_price_lm=${id}`;
          dataTableHistory.ajax.url(url).load();
          $('#modal-history').modal('show');
        }

    var klub_1 = document.getElementById('klub_1');

      axios.get(`<?php echo base_url(); ?>/api/klub`).then(
        res => {
          const {
            data
          } = res.data;

          data.forEach(item => {
            var opt = document.createElement("option");
            opt.value = item.id;
            opt.text = item.nama;
            klub_1.appendChild(opt);

          })
        });
        initDataTable();
    </script>
<?php echo $this->endSection();?>
