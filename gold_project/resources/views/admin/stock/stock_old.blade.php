@extends('layouts.master')
@section('title','สต๊อกทองเก่า')
@section('content')
<script>
    $(document).ready(function(){
        $("body").on('click', '#btn-save', function(e) {
            // checkbox_update
            Swal.fire({
                title: 'อัปเดตผลการเช็คสต็อก',
                text: "ต้องการอัปเดตผลการเช็คสต็อกหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    if($('.checkbox').is(':checked')){
                        var id = ''
                        $.each($('input[name="checkbox[]"]:checked'), function(i, el){
                            id += $(this).data("id")+','
                        })
                        id = id.substr(0, id.length-1)

                        $.ajax({
                            url: "/stock_old/status_check",
                            type: 'POST',
                            data: {_token: "{{ csrf_token() }}", id: id, status_check: $('#status_check').val()},
                            dataType: 'json',
                            success: function(data) {
                                if(data.status){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'อัปเดตสถานะเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        window.location = '/stock_old'
                                    })
                                }
                            }
                        });

                    } else {
                        Swal.fire(
                            'Error!',
                            'กรุณาเลือกรายการ',
                            'warning'
                        )
                    }
                }
            })
        })
    })
</script>
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
                            <br>
                            <input class="form-control" type="date" name="filter_date3" value="{{$filter_date3}}"> ถึง
                            <input class="form-control" type="date" name="filter_date_end3" value="{{$filter_date_end3}}">
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
                                @php
                                    if($row->status_check == '0'){
                                        $status_check_color = 'text-success';
                                        $status_check_text = 'ปกติ';
                                    } else if($row->status_check == '1') {
                                        $status_check_color = 'text-warning';
                                        $status_check_text = 'ทองปลอม';
                                    } else if($row->status_check == '2') {
                                        $status_check_color = 'text-danger';
                                        $status_check_text = 'ทองหาย';
                                    } else {
                                        $status_check_color = '';
                                        $status_check_text = '-';
                                    }
                                @endphp
                                <td class="{{$status_check_color}}">{{$status_check_text}}</td>
                                <td>
                                    <div class="form-check text-center">
                                        <input class="form-check-input checkbox" data-id="{{$row->id}}" name="checkbox[]" type="checkbox" value="">
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
                            <select class="custom-select" name="status_check" id="status_check">
                                <option selected disabled value="">เลือกผลการเช็ค</option>
                                @foreach(["0"=>"ปกติ","1"=>"ทองปลอม","2"=>"ทองหาย"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}">{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="button" id="btn-save" class="btn btn-success">บันทึก</button>
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