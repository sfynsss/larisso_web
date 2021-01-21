@extends('layouts.app')

@section('content')

<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between">
    <div class="nk-block-head-content">
      <h3 class="nk-block-title page-title">Selamat Datang di Web Admin LaRisso </h3>
      <div class="nk-block-des text-soft">
        <p>Kelola segala pengaturan untuk LaRisso Mobile Apps</p>
      </div>
    </div><!-- .nk-block-head-content -->
  </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
  <div class="row g-gs">
    <div class="col-xxl-8">
      <div class="card card-bordered card-full">
        <div class="card-inner">
          <div class="card-title-group">
            <div class="card-title">
              <h6 class="title"><span class="mr-2">Transaksi</span></h6>
            </div>
          </div>
        </div>
        <div class="card-inner p-0 border-top">
          <div class="nk-tb-list nk-tb-orders">
            <div class="nk-tb-item nk-tb-head">
              <div class="nk-tb-col"><span>Order No.</span></div>
              <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
              <div class="nk-tb-col tb-col-md"><span>Date</span></div>
              <div class="nk-tb-col tb-col-lg"><span>Ref</span></div>
              <div class="nk-tb-col"><span>Amount</span></div>
              <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
              <div class="nk-tb-col"><span>&nbsp;</span></div>
            </div>
            <div class="nk-tb-item">
              <div class="nk-tb-col">
                <span class="tb-lead"><a href="#">#95954</a></span>
              </div>
              <div class="nk-tb-col tb-col-sm">
                <div class="user-card">
                  <div class="user-avatar user-avatar-sm bg-purple">
                    <span>AB</span>
                  </div>
                  <div class="user-name">
                    <span class="tb-lead">Abu Bin Ishtiyak</span>
                  </div>
                </div>
              </div>
              <div class="nk-tb-col tb-col-md">
                <span class="tb-sub">02/11/2020</span>
              </div>
              <div class="nk-tb-col tb-col-lg">
                <span class="tb-sub text-primary">SUB-2309232</span>
              </div>
              <div class="nk-tb-col">
                <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
              </div>
              <div class="nk-tb-col">
                <span class="badge badge-dot badge-dot-xs badge-success">Paid</span>
              </div>
              <div class="nk-tb-col nk-tb-col-action">
                <div class="dropdown">
                  <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                    <ul class="link-list-plain">
                      <li><a href="#">View</a></li>
                      <li><a href="#">Invoice</a></li>
                      <li><a href="#">Print</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="nk-tb-item">
              <div class="nk-tb-col">
                <span class="tb-lead"><a href="#">#95850</a></span>
              </div>
              <div class="nk-tb-col tb-col-sm">
                <div class="user-card">
                  <div class="user-avatar user-avatar-sm bg-azure">
                    <span>DE</span>
                  </div>
                  <div class="user-name">
                    <span class="tb-lead">Desiree Edwards</span>
                  </div>
                </div>
              </div>
              <div class="nk-tb-col tb-col-md">
                <span class="tb-sub">02/02/2020</span>
              </div>
              <div class="nk-tb-col tb-col-lg">
                <span class="tb-sub text-primary">SUB-2309154</span>
              </div>
              <div class="nk-tb-col">
                <span class="tb-sub tb-amount">596.75 <span>USD</span></span>
              </div>
              <div class="nk-tb-col">
                <span class="badge badge-dot badge-dot-xs badge-danger">Canceled</span>
              </div>
              <div class="nk-tb-col nk-tb-col-action">
                <div class="dropdown">
                  <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                    <ul class="link-list-plain">
                      <li><a href="#">View</a></li>
                      <li><a href="#">Remove</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="nk-tb-item">
              <div class="nk-tb-col">
                <span class="tb-lead"><a href="#">#95135</a></span>
              </div>
              <div class="nk-tb-col tb-col-sm">
                <div class="user-card">
                  <div class="user-avatar user-avatar-sm bg-success">
                    <span>CH</span>
                  </div>
                  <div class="user-name">
                    <span class="tb-lead">Cassandra Hogan</span>
                  </div>
                </div>
              </div>
              <div class="nk-tb-col tb-col-md">
                <span class="tb-sub">01/29/2020</span>
              </div>
              <div class="nk-tb-col tb-col-lg">
                <span class="tb-sub text-primary">SUB-2305564</span>
              </div>
              <div class="nk-tb-col">
                <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
              </div>
              <div class="nk-tb-col">
                <span class="badge badge-dot badge-dot-xs badge-warning">Due</span>
              </div>
              <div class="nk-tb-col nk-tb-col-action">
                <div class="dropdown">
                  <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                    <ul class="link-list-plain">
                      <li><a href="#">View</a></li>
                      <li><a href="#">Invoice</a></li>
                      <li><a href="#">Notify</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-inner-sm border-top text-center d-sm-none">
          <a href="#" class="btn btn-link btn-block">See History</a>
        </div>
      </div><!-- .card -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .nk-block -->

@endsection
