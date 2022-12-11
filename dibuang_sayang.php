<div class="nk-tb-list nk-tb-orders">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span>No Ent</span></div>
        <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
        <div class="nk-tb-col"><span>Total</span></div>
        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
        <div class="nk-tb-col"><span class="d-none d-sm-inline">Pengiriman</span></div>
        <div class="nk-tb-col"><span class="d-none d-sm-inline">Resi</span></div>
        <div class="nk-tb-col"><span>&nbsp;</span></div>
    </div>
    @foreach($data as $data)
    <div class="nk-tb-item">
        <div class="nk-tb-col">
            <span class="tb-lead"><a href="#">{{$data->no_ent}}</a></span>
        </div>
        <div class="nk-tb-col tb-col-sm">
            <div class="user-card">
                <div class="user-name">
                    <span class="tb-lead">{{$data->NM_CUST}}</span>
                </div>
            </div>
        </div>
        <div class="nk-tb-col tb-col-md">
            <span class="tb-sub">{{substr($data->tanggal, 0, 10)}}</span>
        </div>
        <div class="nk-tb-col">
            <span class="tb-sub tb-amount">@currency($data->total)</span>
        </div>
        <div class="nk-tb-col">
            @if($data->sts_byr == 0)
            <span class="badge badge-dot badge-dot-xs badge-danger">Belum Terbayar</span>
            @elseif($data->sts_byr == 1)
            <span class="badge badge-dot badge-dot-xs badge-success">Terbayar</span>
            @elseif($data->sts_byr == 2 || $data->sts_transaksi == "BATAL")
            <span class="badge badge-dot badge-dot-xs badge-danger">Transaksi Batal</span>
            @endif
        </div>
        <div class="nk-tb-col">
            <span class="tb-sub tb-amount">{{$data->jns_pengiriman}}</span>
        </div>
        <div class="nk-tb-col">
            @if($data->sts_transaksi == "BATAL")
            <span class="badge badge-dot badge-dot-xs badge-danger">Transaksi Batal</span>
            @elseif($data->sts_transaksi == "MASUK")
            <span class="badge badge-dot badge-dot-xs badge-warning">Baru</span>
            @elseif($data->sts_transaksi == "PROSES")
            <span class="badge badge-dot badge-dot-xs badge-success">Proses</span>
            @elseif($data->sts_transaksi == "SIAP DIAMBIL")
            <span class="badge badge-dot badge-dot-xs badge-primary">Siap Diambil</span>
            @elseif($data->sts_transaksi == "SELESAI")
            <span class="badge badge-dot badge-dot-xs badge-success">Transksi Selesai</span>
            @elseif($data->no_resi == "")
            <span class="badge badge-dot badge-dot-xs badge-danger">Belum Dikirim</span>
            @elseif($data->no_resi != "")
            <span class="badge badge-dot badge-dot-xs badge-warning">{{$data->no_resi}}</span>
            @endif
        </div>
        <div class="nk-tb-col nk-tb-col-action">
            <div class="dropdown">
                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                    <ul class="link-list-plain">
                        <li><a class="dropdown-item" onclick="setId('{{$data->no_ent}}');" data-toggle="modal" data-target="#exampleModal">View</a></li>
                        @if($data->jns_pengiriman == 'cod' or $data->jns_pengiriman == 'pickup')

                        @if($data->jns_pengiriman == 'pickup' && $data->sts_transaksi == 'SIAP DIAMBIL')
                        <li><a class="dropdown-item" href="{{ url('print_ticket') }}/{!! str_replace('/', '-', $data->no_ent) !!}">Print Ticket</a></li>
                        @endif

                        @elseif($data->sts_byr == 0 && $data->jns_pengiriman != 'cod' && $data->no_resi == "")
                        <li><a class="text-primary" onclick="alert('Belum Terbayar !!!');">Resi</a></li>
                        @elseif($data->no_resi != "")
                        <li><a class="text-primary" onclick="if (confirm('Apakah Anda akan mengganti resi?')){return setNoEnt('{{$data->no_ent}}', '{{$data->jns_pengiriman}}');;}else{event.stopPropagation(); event.preventDefault();};" data-toggle="modal" data-target=".modal_edit">Resi</a></li>
                        @else
                        <li><a class="text-primary" onclick="setNoEnt('{{$data->no_ent}}', '{{$data->jns_pengiriman}}');" data-toggle="modal" data-target=".modal_edit">Resi</a></li>
                        @endif
                        <li><a class="text-primary" onclick="setNoEnt1('{{$data->no_ent}}');" data-toggle="modal" data-target=".modal_edit_status">Edit Status</a></li>
                        <li><a class="text-primary" href="{{url('invoice')}}/{!! str_replace('/', '-', $data->no_ent) !!}">Invoice</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>




{
    data: 'transaction_date',
    name: 'transaction_date',
    render: function (data) {
        let dt = new Date(data);
        return dt.getDate() + " " + monthNames[dt.getMonth()] + " " + dt.getFullYear();
    }
},
{
    data: 'kode',
    name: 'kode',
    render: function (data, type, row, meta) {
        data = '<a href="' + baseURL + 'pos/selling/detail/' + data + '">' + data + '</a>';
        return data;
    }
},
{
    data: 'name',
    name: 'name'
},
{
    data: 'status',
    name: 'status',
    render: function (data) {
        if (data === 0) {
            return '<span class="badge badge-danger">Void</span>';
        } else if (data === 1) {
            return '<span class="badge badge-primary">Open</span>';
        } else if (data === 2) {
            return '<span class="badge badge-success">Paid</span>';
        } else if (data === 3) {
            return '<span class="badge badge-warning">Partial</span>';
        }
    }
},
{
    data: 'total',
    name: 'total',
    render: function (data) {
        return "Rp. " + number_format(data, 2, ',', '.');
    }
},
{
    data: 'cash',
    name: 'cash',
    render: function (data) {
        return "Rp. " + number_format(data, 2, ',', '.');
    }
},
{
    data: 'change',
    name: 'change',
    render: function (data) {
        return "Rp. " + number_format(data, 2, ',', '.');
    }
},