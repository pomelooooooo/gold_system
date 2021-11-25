@extends('layouts.master')
@section('title','จัดการล็อตทอง')
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
        $('.delete_from').on('submit', function() {
            if (confirm("ต้องการลบข้อมูลใช่หรือไม่")) {
                return true;
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
                    <h1>จัดการล็อตทอง</h1>
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
                        <h3>จัดการล็อตทอง</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('product.create') }}"><i class="fa fa-plus"></i> เพิ่มล็อตทอง</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form class="form-inline">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหารหัสล็อตทอง">
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">รหัสล๊อต</th>
                                    <th scope="col">จำนวนสินต้า</th>
                                    <th scope="col">วันที่นำเข้า</th>
                                    <th scope="col">ราคาทอง</th>
                                    <th scope="col">ค่าแรง</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($product as $row)
                                <tr>
                                    <td>{{$row->lot_id}}</td>
                                    <td>{{$row->lot_count}}</td>
                                    <td>{{$row->date_of_import}}</td>
                                    <td>{{$row->price_of_gold}}</td>
                                    <td>{{$row->wage}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('ProductController@edit',$row->id)}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" class="delete_from" action="{{action('ProductController@destroy',$row->id)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> ลบ</button>
                                        </form>
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