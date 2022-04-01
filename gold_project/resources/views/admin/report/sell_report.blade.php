@extends('layouts.master')
@section('title','รายงานผลการขายทอง')
@section('content')
<!-- <script>
    $(document).ready(function() {
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
                    if ($('.checkbox').is(':checked')) {
                        var id = ''
                        $.each($('input[name="checkbox[]"]:checked'), function(i, el) {
                            id += $(this).data("id") + ','
                        })
                        id = id.substr(0, id.length - 1)

                        $.ajax({
                            url: "/sell_report/status_check_new",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                status_check: $('#status_check').val(),
                                note: $('#note').val(),
                                note_check: $('#note_check').val()
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'อัปเดตสถานะเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        window.location = '/sell_report'
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
</script> -->

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>รายงานผลการขายทอง</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br>
<form class="form-inline" action="/sell_report" method="GET">
    <div class="container">
        <div class="grid-item">
            <div class="card">
                <div class="card-header">
                    <h3>ทองใหม่</h3>
                    <a type="button" class="btn btn-primary" href="{{url('/report_sell')}}">ใบเกำกับภาษีย้อนหลัง</a>
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
                                <option value="">สถานะการขาย</option>
                                @foreach(["0"=>"ยังไม่ขายออก" ,"1"=>"ขายออกแล้ว"] as $key => $val)
                                <option value="{{$key}}" {{($filter_status == '0' || $filter_status == '1') && $key == $filter_status?"selected":""}}>{{$val}}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_status_gold">
                                <option value="">สถานะทอง</option>
                                @foreach(["0"=>"ทองในถาด" ,"1"=>"ทองในสต็อก"] as $key => $val)
                                <option value="{{$key}}" {{($filter_status_gold == '0' || $filter_status_gold == '1') && $key == $filter_status_gold?"selected":""}}>{{$val}}</option>
                                @endforeach
                            </select>
                            <br>
                            <input class="form-control" type="date" name="filter_date" value="{{$filter_date}}"> ถึง
                            <input class="form-control" type="date" name="filter_date_end" value="{{$filter_date_end}}">
                            <input type="submit" class="btn btn-primary filters" value="ค้นหา">
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            @foreach($sell_reportCount as $key => $value)
                            <span><b>{{$value->name}} : </b>{{' จำนวน '.$value->total.' น้ำหนัก '.$value->total_gram.' กรัม'}}</span><br>
                            @endforeach
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
                                <th scope="col">สถานะทอง</th>
                                <th scope="col">ผู้ขาย</th>
                                <th scope="col">ลูกค้า</th>
                                <th scope="col">ราคาขายออก</th>
                                <th scope="col">วันที่ขาย</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sell_report as $row)
                            <tr>
                                <td>{{$row->code}}</td>
                                <td>{{$row->details}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->size}}</td>
                                <td>{{$row->status == '0' ? 'ทองในถาด' : 'ทองในสต็อก'}}</td>
                                @php
                                if($row->sellprice == ''){
                                $sellprice_text = '-';
                                } else {
                                $sellprice_text = $row->sellprice;
                                }
                                @endphp
                                <td>{{$row->nameusers}} {{$row->lastnameusers}}</td>
                                <td>{{$row->namecustomer}} {{$row->lastnamecustomer}}</td>
                                <td>{{$sellprice_text}}</td>
                                <td>{{Carbon\Carbon::parse($row->datetime)->format('Y-m-d')}}</td>
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