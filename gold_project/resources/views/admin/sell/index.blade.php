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
                    <!-- <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('sell.create') }}"><i class="fa fa-plus"></i> ขายทอง</a>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form class="form-inline">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาชื่อการขายทอง">
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
                                    <th scope="col">ประเภท</th>
                                    <th scope="col">น้ำหนัก</th>
                                    <th scope="col">ผู้ขาย</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                                @foreach($productdetail as $row)
                                <tr>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->type_gold_id}}</td>
                                    <td>{{$row->size}}</td>
                                    <td>{{$row->user_id}}</td>
                                    <td>{{$row->status_trade}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{action('SellController@edit',$row->id)}}"><i class="fa fa-edit"></i> ขายทอง</a>
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                               
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection