@extends('layouts.master')
@section('title','สต๊อกทองใหม่')
@section('content')
<script>
    $(document).ready(function(){
        $("body").on('click', '#btn-update', function(e) {
            // checkbox_update
            Swal.fire({
                title: 'Are you sure?',
                text: "ต้องการส่งโรงหลอมหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    if($('.checkbox_update').is(':checked')){
                        var id = ''
                        $.each($('input[name="checkbox_update[]"]:checked'), function(i, el){
                            id += $(this).data("id")+','
                        })
                        id = id.substr(0, id.length-1)

                        $.ajax({
                            url: "/stockold/group",
                            type: 'POST',
                            data: {_token: "{{ csrf_token() }}", id: id},
                            dataType: 'json',
                            success: function(data) {
                                if(data.status){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'อัปเดตสถานะเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        window.location = '/stockold'
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
                    <h1>สต๊อกทองใหม่</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br>
<form class="form-inline" action="/stockold" method="GET">
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
                            <input class="form-control mr-sm-2" name="search2" value="{{isset($keyword2)?$keyword2:''}}" type="search" id="myInput" placeholder="ค้นหาทอง">
                            <select class="form-control mr-sm-2" name="filter_type2" id="validationcategory">
                                <option value="">เลือกประเภท</option>
                                @foreach($typegold as $row)
                                <option value="{{$row->id}}" {{$row->id == $filter_type2?"selected":""}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_size2">
                                <option value="">เลือกนํ้าหนัก</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{$sizeWay == $filter_size2?"selected":""}}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <input class="form-control" type="date" name="filter_date2" value="{{$filter_date2}}">
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
                                <th scope="col">วันที่นำเข้า</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col"></th>
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
                                <td>{{$row->created_at}}</td>
                                <td class="{{$row->status_trade == '3' ? 'text-success' : ''}}">{{$row->status_trade == '3' ? 'ส่งโรงหลอมแล้ว' : 'ทองเก่าในสต็อก'}}</td>
                                <td>
                                    <div class="form-check text-center">
                                        <input class="form-check-input checkbox_update" data-id="{{$row->id}}" name="checkbox_update[]" type="checkbox" value="">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="col-6">
                        {{ $stockold->links() }}
                    </div>
                    <br>
                    <div class="text-right">
                        <a type="button" class="btn btn-secondary" href="{{url('/stock')}}">กลับ</a>
                        <button id="btn-update" type="button" class="btn btn-success">นำส่งโรงหลอม</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<br>
@endsection