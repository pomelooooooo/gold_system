@extends('layouts.master')
@section('title','สต๊อกทองใหม่')
@section('content')
<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>สต๊อกทองใหม่</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br>
<form class="form-inline" action="/stocknew" method="GET">
    <div class="container">
        <div class="grid-item">
            <div class="card">
                <div class="card-header">
                    <h3>ทองใหม่</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="sell-all" name="sellall">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาทอง">
                            <select class="form-control mr-sm-2" name="filter_type" id="validationcategory">
                                <option value="">เลือกประเภท</option>
                                @foreach($typegold as $row)
                                <option value="{{$row->id}}" {{$row->id == $filter_type?"selected":""}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_size">
                                <option value="">เลือกนํ้าหนัก</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{$sizeWay == $filter_size?"selected":""}}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_status">
                                <option value="">สถานะ</option>
                                @foreach(["0"=>"ทองในสต็อค" ,"1"=>"ขายออกแล้ว"] as $key => $val)
                                <option value="{{$key}}" {{($filter_status == '0' || $filter_status == '1') && $key == $filter_status?"selected":""}}>{{$val}}</option>
                                @endforeach
                            </select>
                            <input class="form-control" type="date" name="filter_date" value="{{$filter_date}}">
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
                                <th scope="col">ล๊อต</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">ราคาขายออก</th>
                                <th scope="col">วันที่นำเข้า</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocknew as $row)
                            <tr>
                                <td>{{$row->code}}</td>
                                <td>{{$row->details}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->size}}</td>
                                <td>{{$row->lot_id}}</td>
                                <td class="{{$row->status_trade == '0' ? '' : 'text-success'}}">{{$row->status_trade == '0' ? 'ทองในสต็อก' : 'ขายออกแล้ว'}}</td>
                                <td>{{$row->sellprice}}</td>
                                <td>{{$row->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<br>
@endsection