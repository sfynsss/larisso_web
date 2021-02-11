@extends('layouts.app')

@section('content')
@include('customer.create')
{{-- @include('customer.detail') --}}

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Data Customer</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" onclick="setKdCust();" data-target=".bs-example-modal-lg">TAMBAH DATA</button> &nbsp
                    {{-- <a href="{{url('/sinkronisasi')}}"><button type="button" class="btn btn-success float-right" style="margin-right: 10px;">SINKRONISASI</button></a> --}}
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Cust</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">OTP</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @php($i = 1)
                @foreach($data as $data)
                <tr class="tb-odr-item">
                    <td>{{$i++}}</td>
                    <td class="tb-status text-success">{{$data->KD_CUST}}</td>
                    <td>{{$data->NM_CUST}}</td>
                    <td>{{$data->ALM_CUST}}</td>
                    <td class="tb-status text-warning">{{$data->HP}}</td>
                    <td class="tb-status text-primary">{{$data->E_MAIL}}</td>
                    <td>{{$data->KATEGORI}}</td>
                    @if($data->email_activation == 1)
                    <td class="tb-status text-success">Aktif</td>
                    @elseif($data->email_activation == 0)
                    <td class="tb-status text-danger">{{$data->activation_token}}</td>
                    @endif
                    <td>
                        <a class="label label-info m-r-10" href="" data-toggle="modal"  data-target=".modal_detail"><i class="icon ni ni-eye-fill"></i></a>
                        <a class="label label-primary m-r-10" href="" data-toggle="modal"  data-target=".bs-example-modal-lg" onclick="setIsi({{$data->KATEGORI}}, {{$data->KD_CUST}}, {{$data->NIK}}, {{$data->NM_CUST}});"><i class="icon ni ni-pen-alt-fill"></i></a>
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

    function setKdCust() {
        $.ajax({
         type:'POST',
         url:'/api/getKodeCust',
         headers: {
            "Accept":"application/json",
            "Authorization":"Bearer {{Auth::user()->api_token}}"
        },
        success:function(data){
          $("input[name=kode_cust]").val(data);
              // alert(data);
          }
        });
    }

    function setIsi() {

    }

    // window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;//compatibility for Firefox and chrome
    // var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
    // pc.createDataChannel('');//create a bogus data channel
    // pc.createOffer(pc.setLocalDescription.bind(pc), noop);// create offer and set local description
    // pc.onicecandidate = function(ice) {
    //     if (ice && ice.candidate && ice.candidate.candidate) {
    //         var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];  
    //         pc.onicecandidate = noop;
    //         // alert(myIP);
    //         document.getElementById("link_download").setAttribute("href", '{{url('/downloadCustomer')}}/'+myIP);
    //     }
    // };

</script>
@endsection