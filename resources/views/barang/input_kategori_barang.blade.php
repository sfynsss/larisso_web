<!-- Large modal -->
<div class="modal fade modal_input" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg">
    <div class="modal-content">
      <form method="post" action="{{url('barang/input_kategori')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Kategori Barang</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label" for="default-01">Outlet</label>
                <div class="form-control-wrap">
                  <select class="form-select" required name="kd_outlet">
                    <option disabled="true" selected="none">Pilih Salah Satu</option>
                    @foreach($outlet as $outlet)
                    <option value="{{$outlet->kd_outlet}}">{{$outlet->nama_outlet}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row gy-4">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Kode Kategori</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" readonly id="kd_kategori" name="kd_kategori">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Nama Kategori</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" id="default-01" name="nm_kategori" placeholder="Nama Kategori">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Status Tampil</label>
                <div class="form-control-wrap">
                  <select class="form-select" name="status">
                    <option disabled="true" selected="none">Pilih Salah Satu</option>
                    <option value="1">Tampil</option>
                    <option value="0">Tidak Tampil</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Gambar Kategori</label>
                <div class="form-control-wrap">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="gambar" accept=".jpg, .jpeg, .png">
                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('script')
<script>
  $(document).ready(function() {
    $.ajax({
      type:'GET',
      url:'/api/getKodeKategori',
      headers: {
        "Accept":"application/json",
        "Authorization":"Bearer {{Auth::user()->api_token}}"
      },
      success:function(data){
        $("input[name=kd_kategori]").val(data);
              // alert(data);
            }
          });
  });
</script>
@endsection