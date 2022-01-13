@extends('layouts.master')
@section('title','ขายทอง')
@section('content')

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    $(document).ready(function() {
        $("body").on('click', '#btn-sell', function(e) {
            var sellgroup = $('.sell-group:checked').map(function() {
                return this.value;
            }).get().join(',')
            if (sellgroup != "") {
                console.log('ssss')
                window.location = "/sell/group/" + sellgroup
            }
        })

        $("body").on('click', '#delete_button', function(e) {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (confirm("ต้องการลบข้อมูลใช่หรือไม่")) {
                $.ajax({
                    url: "sell/" + id,
                    type: 'delete',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        window.location = "{{route('sell.index')}}"
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            } else {
                return false;
            }
        });
    });
</script>

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>ขายทอง</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<div class="list-section pt-80 pb-80">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>ขายทอง</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button id="btn-sell" type="button" class="btn btn-outline-info"><i class="fa fa-plus"></i> ขายทอง</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <form class="form-inline" action="/sell" method="GET">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาทองที่ต้องการขาย">
                            <select class="form-control mr-sm-2" name="filter_type" id="validationcategory">
                                <option value="">เลือกประเภท</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}" {{$row->id == $filter_type?"selected":""}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control " name="filter_size">
                                <option value="">เลือกนํ้าหนัก</option>
                                @foreach($productdetail as $row)
                                <option value="{{$row->size}}" {{$row->id == $filter_size?"selected":""}}>{{$row->size}}</option>
                                @endforeach
                            </select>
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
                                    <th scope="col">รหัสสินค้า</th>
                                    <th scope="col">ล็อต</th>
                                    <th scope="col">ประเภท</th>
                                    <th scope="col">น้ำหนัก</th>
                                    <!-- <th scope="col">ผู้ขาย</th>
                                    <th scope="col">นามสกุล</th> -->
                                    <th scope="col">ลาย</th>
                                    <th scope="col"></th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productdetail as $row)
                                <tr>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->lot_id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->size}}</td>
                                    <!-- <td>{{$row->nameemployee}}</td>
                                    <td>{{$row->lastnameemployee}}</td> -->
                                    <td>{{$row->striped}}</td>
                                    <!-- <td>{{$row->status_trade == '0' ? 'ยังไม่ขาย' : 'ขายออก'}}</td> -->
                                    <td>
                                        <div class="form-check text-center">
                                            <input class="form-check-input sell-group" type="checkbox" value="{{$row->id}}">
                                        </div>
                                    </td>
                                    <!-- <td class="text-center">
                                        <a class="btn btn-primary" href="{{action('SellController@edit',$row->id)}}"><i class="fa fa-edit"></i> ขายทอง</a>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productdetail->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection