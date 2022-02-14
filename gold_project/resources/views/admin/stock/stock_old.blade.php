@extends('layouts.master')
@section('title','สต๊อกทองเก่า')
@section('content')
<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>สต๊อกทองเก่า</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br>
<form class="form-inline" action="/stock_old" method="GET">
    <div class="container">
        <div class="grid-item">
            <div class="card">
                <div class="card-header">
                    <h3>ทองเก่า</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="sell-all" name="sellall">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search3" value="{{isset($keyword3)?$keyword3:''}}" type="search" id="myInput" placeholder="ค้นหาทอง">
                            <select class="form-control mr-sm-2" name="filter_type3" id="validationcategory">
                                <option value="">เลือกประเภท</option>
                                @foreach($typegold as $row)
                                <option value="{{$row->id}}" {{$row->id == $filter_type3?"selected":""}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_size3">
                                <option value="">เลือกนํ้าหนัก</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{$sizeWay == $filter_size3?"selected":""}}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_status3">
                                <option value="">สถานะทอง</option>
                                @foreach(["0"=>"ทองเก่าในสต็อก" ,"2"=>"ส่งโรงหลอมแล้ว"] as $key => $val)
                                <option value="{{$key}}" {{($filter_status3 == '0' || $filter_status3 == '2') && $key == $filter_status3?"selected":""}}>{{$val}}</option>
                                @endforeach
                            </select>
                            <input class="form-control" type="date" name="filter_date2" value="{{$filter_date3}}">
                            <input type="submit" class="btn btn-primary filters" value="ค้นหา">
                        </div>
                    </div>
                    <br>
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
                                <th scope="col">สถานะ</th>
                                <th scope="col">วันที่นำเข้า</th>
                                <th scope="col">ผลการเช็คสต๊อก</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stock_old as $row)
                            <tr>
                                <td>{{$row->code}}</td>
                                <td>{{$row->details}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->size}}</td>
                                <td>{{$row->nameemployee}} {{$row->lastnameemployee}}</td>
                                <td>{{$row->namecustomer}} {{$row->lastnamecustomer}}</td>
                                <td>{{$row->allprice}}</td>
                                <td class="{{$row->status_trade == '2' ? 'text-success' : ''}}">{{$row->status_trade == '2' ? 'ส่งโรงหลอมแล้ว' : 'ทองเก่าในสต็อก'}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>-</td>
                                <td>
                                    <div class="form-check text-center">
                                        <input class="form-check-input" data-id="" name="" type="checkbox" value="">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="col-6">
                        {{ $stock_old->links() }}
                    </div>
                    <div class="text-right">
                        <a type="button" class="btn btn-secondary" href="{{url('/stock')}}">กลับ</a>
                        <a type="button" class="btn btn-primary" href="" data-toggle="modal" data-target="#exampleModal">อัปเดตผลการเช็คสต๊อก</a>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">ผลการเช็คสต๊อก</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a>กรุณาเลือกรายการผลการเช็คสต๊อก</a>
                            <br>
                            <select class="custom-select" name="status_check" id="">
                                <option selected disabled value="">เลือกผลการเช็ค</option>
                                @foreach(["0"=>"ปกติ","1"=>"ทองปลอม","2"=>"ทองหาย"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}">{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success">บันทึก</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
        </div>
    </div>
</form>
<br>
@endsection