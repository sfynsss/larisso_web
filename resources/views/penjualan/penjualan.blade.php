@extends('layouts.app')

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table" id="isi">
					
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Large modal -->
<div class="modal fade modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg">
		<div class="modal-content">
			<form method="post" action="{{url('inputResi')}}">
				{{csrf_field()}}
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Masukkan Resi</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row gy-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01">No Invoice</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" readonly="true" id="no_ent" name="no_ent">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01" id="judul">No Resi</label>
								<div class="form-control-wrap">
									<input type=text class="form-control" id="no_resi" name="no_resi">
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

<!-- Large modal -->
<div class="modal fade modal_edit_status" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg">
		<div class="modal-content">
			<form method="post" action="{{url('gantiStatusTransaksi')}}">
				{{csrf_field()}}
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Ganti Status Transaksi</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row gy-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01">No Invoice</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" readonly="true" id="no_ent1" name="no_ent1">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01" id="judul">Status Transaksi</label>
								<div class="form-control-wrap">
									<select class="form-select" name="status" id="status">
										<option disabled="true" selected="none">Pilih Salah Satu</option>
										<option value="PROSES">PROSES</option>
										<option value="SIAP DIAMBIL">SIAP DIAMBIL</option>
										<option value="SELESAI">SELESAI</option>
										<option value="BATAL">BATAL</option>
									</select>
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

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head col-xxl-12">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Penjualan</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
					<div class="toggle-expand-content" data-content="pageMenu">
						<ul class="nk-block-tools g-3">
							<li>
								<div class="drodown">
									<a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-truck"></em><span><span class="d-none d-md-inline">Sortir</span> Berdasarkan Pengiriman</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
									<div class="dropdown-menu dropdown-menu-right">
										<ul class="link-list-opt no-bdr">
											<li><a href="{{url('penjualan')}}"><span>Semua Pengiriman</span></a></li>
											<li><a href="{{url('penjualanPickup')}}"><span>Ambil di Tempat</span></a></li>
											<li><a href="{{url('penjualanCOD')}}"><span>Larisso Courier (COD)</span></a></li>
											<li><a href="{{url('penjualanJNE')}}"><span>JNE</span></a></li>
											<li><a href="{{url('penjualanJNT')}}"><span>J&T</span></a></li>
											<li><a href="{{url('penjualanPOS')}}"><span>POS</span></a></li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div>
	<div class="col-xxl-12">
		<div class="card card-bordered card-full">
			<div class="card-inner">
				<div class="card-title-group">
					<div class="card-title">
						<h6 class="title"><span class="mr-2">Transaction</span></h6>
					</div>
					<div class="card-tools">
						<ul class="card-tools-nav">
							<li><a href="#"><span>Paid</span></a></li>
							<li><a href="#"><span>Pending</span></a></li>
							<li class="active"><a href="#"><span>All</span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card card-bordered card-preview">
				<div class="card-inner">
					<table class="datatable-init table" id="datatables">
						<thead>
							<tr>
								<th>No Ent</th>
								<th>Customer</th>
								<th>Date</th>
								<th>Total</th>
								<th>Status</th>
								<th>Pengiriman</th>
								<th>Resi</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="card-inner-sm border-top text-center d-sm-none">
				<a href="#" class="btn btn-link btn-block">See History</a>
			</div>
		</div><!-- .card -->
	</div>
</div>
@endsection

@section('script')
<script>
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    $(document).ready(function () {
        getData();
    })

    function setId($id) {
        var a = $id.substr(0, 8);
        var b = $id.substr(9, 5);
        var c = $id.substr(15, 8);
        var view_url = "{{url('detPenjualan')}}" + "/" + a + "-" + b + "-" + c;
        // alert(view_url);
        $.getJSON(view_url, function (result) {
            console.log(result);
            // console.log(result);
            $("#isi").empty();
            $("#isi").append("<div class='nk-tb-item nk-tb-head'>" +
                "<div class='nk-tb-col'><span>Kode Barang</span></div>" +
                "<div class='nk-tb-col'><span>Nama Barang</span></div>" +
                "<div class='nk-tb-col'><span>Harga Jual</span></div>" +
                "<div class='nk-tb-col'><span>Quantity</span></div>" +
                "<div class='nk-tb-col'><span>Sub Total</span></div>" +
                "</div>")

            result.forEach(function (r) {
                // alert(r);
                $("#isi").append("<div class='nk-tb-item'>" +
                    "<div class='nk-tb-col'><span class='tb-sub'>" + r['kd_brg'] + "</span></div>" +
                    "<div class='nk-tb-col'><span class='tb-sub'>" + r['nm_brg'] + "</span></div>" +
                    "<div class='nk-tb-col'><span class='tb-sub'>" + r['harga'] + "</span></div>" +
                    "<div class='nk-tb-col'><span class='tb-sub'>" + r['jumlah'] + "</span></div>" +
                    "<div class='nk-tb-col'><span class='tb-sub'>" + r['sub_total'] + "</span></div>" +
                    "<div>");
            });
        });
    };

    function setNoEnt($id, $jns_pengiriman) {
        $('#no_ent').val($id);
        if ($jns_pengiriman == "cod") {
            // alert("masuk sini");
            // $("#input_resi").empty().append('<select class="form-select" name="status" id="status">'
            // 	+'<option disabled="true" selected="none">Pilih Salah Satu</option>'
            // 	+'<option value="1">Tampil</option>'
            // 	+'<option value="0">Tidak Tampil</option>'
            // 	+'</select>');
            // $("#input_resi").empty().append(function() {
            // 	return $("<select name='sopir' id='sopir'>")
            // 	.append("<option disabled='true' selected='none'>Pilih Salah Satu</option>")
            // 	.append("<option value='budi'>Budi</option>")
            // 	.append("<option value='dani'>Dani</option>");
            // });
            // var element = document.getElementById("sopir");
            // element.classList.add("form-group");
            $("#judul").empty();
            $("#judul").append("Nama Sopir");
        } else {
            // alert("masuk sana");
            // $("#input_resi").empty().append("<input type='text' class='form-control' id='no_resi' name='no_resi'>");
            $("#judul").empty();
            $("#judul").append("No Resi");
        }
    };

    function setNoEnt1($id) {
        $('#no_ent1').val($id);
    };

	$(document).on('click', '.view_invoice', function(e) {
		e.preventDefault();

		var no_ent = $(this).data('id').replaceAll('/', '-');
		window.location.href = baseURL + 'invoice/' + no_ent
	})

	$(document).on('click', '.print_ticket', function(e) {
		e.preventDefault();

		var no_ent = $(this).data('id').replaceAll('/', '-');
		window.location.href = baseURL + 'print_ticket/' + no_ent
	})

    function getData() {
        table = $("#datatables").DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "bDestroy": true,
            ajax: {
                url: baseURL + 'data_penjualan',
                data: function (d) {

                }
            }, // memanggil route yang menampilkan data json
            columns: [{
                    data: 'no_ent',
                    name: 'no_ent',
					render: function (data) {
						var url = '{{ url("invoice") }}';
						return '<span class="tb-lead"><a href="'+url+'/'+data.replaceAll('/', '-')+'">'+data+'</a></span>'
					}
                },
                {
                    data: 'NM_CUST',
                    name: 'NM_CUST',
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function (data) {
                        let dt = new Date(data);
                        return dt.getDate() + " " + monthNames[dt.getMonth()] + " " + dt.getFullYear();
                    }
                },
                {
                    data: 'total',
                    name: 'total',
                },
                {
                    data: 'sts_byr',
                    name: 'sts_byr',
                    render: function (data) {
                        var html = "";
                        if (data === 0) {
                            html += '<span class="badge badge-dot badge-dot-xs badge-danger">Belum Terbayar</span>';
                        } else if (data === 1) {
                            html += '<span class="badge badge-dot badge-dot-xs badge-success">Terbayar</span>';
                        } else {
                            html += '<span class="badge badge-dot badge-dot-xs badge-danger">Transaksi Batal</span>';
                        }

                        return html;
                    }
                },
                {
                    data: 'jns_pengiriman',
                    name: 'jns_pengiriman',
                },
                {
                    data: 'sts_transaksi',
                    name: 'sts_transaksi',
                    render: function (data) {
                        var html = "";
                        if (data == "BATAL") {
                            html += '<span class="badge badge-dot badge-dot-xs badge-danger">Transaksi Batal</span>';
                        } else if (data == "MASUK") {
                            html += '<span class="badge badge-dot badge-dot-xs badge-warning">Baru</span>';
                        } else if (data == "PROSES") {
                            html += '<span class="badge badge-dot badge-dot-xs badge-success">Proses</span>';
                        } else if (data == "SIAP DIAMBIL") {
                            html += '<span class="badge badge-dot badge-dot-xs badge-primary">Siap Diambil</span>';
                        } else if (data == "SELESAI") {
                            html += '<span class="badge badge-dot badge-dot-xs badge-success">Transksi Selesai</span>';
                        }

                        return html
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ],
            columnDefs: [{
                    "searchable": false,
                    "targets": [0, 1, 2]
                },
                {
                    'targets': 0,
                    'orderable': false,
                    'checkboxes': {
                        selectRow: false,
                        stateSave: false
                    }
                },
            ]
        });
    }

</script>
@endsection