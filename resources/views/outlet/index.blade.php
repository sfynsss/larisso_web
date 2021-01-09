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
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/outlet')}}" method="post" id="link_url" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-6">Nama Outlet</label>
                                            <div class="col-md-6">
                                                <input type="number" min="0" class="form-control" name="harga_awal" id="harga_awal" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-6">Keterangan</label>
                                            <div class="col-md-6">
                                                <input type="number" min="0" class="form-control" required name="harga_per_km" id="harga_per_km">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-6">Status Aktif</label>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked="" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">Aktif</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" onclick="clear();">Close</button>
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
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                <tr class="tb-odr-item">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection