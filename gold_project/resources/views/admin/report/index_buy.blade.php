@extends('layouts.master')
@section('title','ผลการดำเนินงานการซื้อย้อนหลัง')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $("body").on('click', '#print', function(e) {
            var id = $(this).data('id')
            Swal.fire({
                    title: 'ต้องการปริ้นใบรับซื้อฝากทองหรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('/report_buy/formbuy/' + id, '_blank')
                    }
                })
        })
    })
</script>

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>ผลการดำเนินงานการซื้อย้อนหลัง</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="list-section pt-80 pb-80">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>ประวัติการซื้อย้อนหลัง</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form class="form-inline" action="/report_buy" method="GET">
                            <input type="hidden" id="buy-all" name="buyall">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาข้อมูล">
                            <select class="form-control mr-sm-2" name="filter_customer">
                                <option value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}" {{isset($filter_customer) && $row->id == $filter_customer?"selected":""}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <input class="form-control" type="date" name="filter_date" value="{{$filter_date}}">&nbsp;ถึง&nbsp;
                            <input class="form-control" type="date" name="filter_date_end" value="{{$filter_date_end}}">
                            <input type="submit" class="btn btn-primary filters" value="ค้นหา">
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ลูกค้า</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">วันที่รับซื้อ</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($form as $row)
                                <tr>
                                    <td>{{$row->namecustomer}} {{$row->lastnamecustomer}}</td>
                                    <td>{{$row->telcustomer}}</td>
                                    <td>{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" id="print" data-id="{{$row['group_id']}}"><i class="fa fa-receipt"></i> ปริ้นใบรับเสร็จรับเงิน</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="col-6">
                            {{ $form->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection