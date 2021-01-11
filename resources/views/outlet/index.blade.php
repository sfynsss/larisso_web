@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Harga Ongkos Kirim COD</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setKodeOutlet();">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahOutlet')}}" method="post" id="link_url" name="link_url" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Kode Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="kd_outlet" name="kd_outlet" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Nama Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="nama_outlet" name="nama_outlet">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email-address-1">Keterangan</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status Aktif</label>
                                        <ul class="custom-control-group g-3 align-center">
                                            <li>
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1">
                                                    <label class="custom-control-label" for="status">Aktif</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left">Close</button>
                        <button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th>No</th>
                    <th>Kode Outlet</th>
                    <th>Nama Outlet</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @php($i = 1)
                @foreach($data as $data)
                <tr class="tb-odr-item">
                    <td>{{$i++}}</td>
                    <td>{{$data->kd_outlet}}</td>
                    <td>{{$data->nama_outlet}}</td>
                    <td>{{$data->keterangan}}</td>
                    @if($data->status == 1)
                    <td>Aktif</td>
                    @else
                    <td>Tidak Aktif</td>
                    @endif
                    <td>
                        <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="ubahOutlet('{{$data->kd_outlet}}', '{{$data->nama_outlet}}', '{{$data->keterangan}}', '{{$data->status}}');">Ubah</button>
                        <a href="{{url('deleteOutlet/')}}/{{$data->kd_outlet}}"><button type="submit" class="btn btn-danger" onclick="alert('Apakah Anda yakin untuk menghapus ?')">Hapus</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection

@section('script')
<script>
    function setKodeOutlet() {
        $("#nama_outlet").val("");
        $("#keterangan").val("");
        $('#status').removeAttr('checked');
        $.ajax({
            type:'GET',
            url:'/api/getKodeOutlet',
            headers: {
                "Accept":"application/json",
                "Authorization":"Bearer {{Auth::user()->api_token}}"
            },
            success:function(data){
                $("input[name=kd_outlet]").val(data);
            }
        });
    }

    function ubahOutlet($a, $b, $c, $d) {
        $('#link_url').attr('action', '{{url('/ubahOutlet')}}');
        $("#kd_outlet").val($a);
        $("#nama_outlet").val($b);
        $("#keterangan").val($c);
        if ($d == 1) {
            $('#status').attr('checked', 'checked');
        } else {
            $('#status').removeAttr('checked');
        }
    }

    // function alert($kd_outlet) {
    //     var checkstr =  confirm('Apakah Anda yakin untuk menghapus?');
    //     if(checkstr == true){
    //         $.ajax({
    //             type:'GET',
    //             url:'/deleteOutlet/{$kd_outlet}',
    //             success:function(){
    //                 location.reload();
    //             }
    //         });       
    //     }else{
    //         return false;
    //     }
    // }
</script>
@endsection