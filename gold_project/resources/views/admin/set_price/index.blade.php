@extends('layouts.master')
@section('title','แสดงราคาขาย')
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
                    url: "set_price/" + id,
                    type: 'delete',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        window.location = "{{route('set_price.index')}}"
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
                    <h1>ตั้งราคาขาย</h1>
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
                        <h3>ตั้งราคาขาย</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form class="form-inline">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหารหัสสินค้า">
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
                                    <th scope="col">รายละเอียดสินค้า</th>
                                    <th scope="col">หมวดหมู่</th>
                                    <th scope="col">นํ้าหนัก</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">ล๊อต</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($productdetail as $row)
                                <tr>
                                    <td>{{$row['code']}}</td>
                                    <td>{{$row['details']}}</td>
                                    <td>{{$row['category']}}</td>
                                    <td>{{$row['size']}}</td>
                                    <td>{{$row['status']}}</td>
                                    <td>{{$row['lot_id']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{action('SetPriceController@edit',$row['id'])}}"><i class="fa fa-edit"></i> ตั้งราคาขาย</a>
                                    </td>
                                    <td class="text-center">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row['id']}}"><i class="fa fa-trash"></i> ลบ</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection