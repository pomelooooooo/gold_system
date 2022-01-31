@extends('layouts.master')
@section('title','สต๊อกสินค้า')
@section('content')

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>สต๊อกสินค้า</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br>
<div class="grid-container">
  <div class="grid-item">
      <div class="card">
        <div class="card-header">
            <h3>ทองใหม่</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">รายละเอียดสินค้า</th>
                        <th scope="col">หมวดหมู่</th>
                        <th scope="col">นํ้าหนัก</th>
                        <th scope="col">ล๊อต</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">ราคาขายออก</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocknew as $row)
                        <tr>
                            <td>{{$row->code}}</td>
                            <td>{{$row->details}}</td>
                            <td>{{$row->type_gold_id == '1' ? 'ทองแท่ง' : 'ทองในสต็อก'}}</td>
                            <td>{{$row->size}}</td>
                            <td>{{$row->lot_id}}</td>
                            <td>{{$row->status_trade == '0' ? 'ทองในสต็อก' : 'ขายออกแล้ว'}}</td>
                            <td>{{$row->allprice}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
  </div>
  <div class="grid-item">
    <div class="card">
        <div class="card-header">
            <h3>ทองเก่า</h3>
        </div>
        <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">รายละเอียดสินค้า</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">นํ้าหนัก</th>
                        <th scope="col">ผู้รับซื้อ</th>
                        <th scope="col">ลูกค้า</th>
                        <th scope="col">ราคารับซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockold as $row)
                        <tr>
                            <td>{{$row->code}}</td>
                            <td>{{$row->details}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->size}}</td>
                            <td>{{$row->nameemployee}} {{$row->lastnameemployee}}</td>
                            <td>{{$row->namecustomer}} {{$row->lastnamecustomer}}</td>
                            <td>{{$row->allprice}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
  </div>
</div>
<br>

@endsection