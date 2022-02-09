@extends('layouts.master')
@section('title','จัดการข้อมูลทอง')
@section('content')

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0, 1];
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
            // if (confirm("ต้องการลบข้อมูลใช่หรือไม่")) {
            //     $.ajax({
            //         url: "productdetail/" + id,
            //         type: 'delete',
            //         data: {
            //             id: id,
            //             _token: token
            //         },
            //         success: function(data) {
            //             window.location = "{{route('productdetail.index')}}"
            //         },
            //         cache: false,
            //         contentType: false,
            //         processData: false
            //     });
            // } else {
            //     return false;
            // }

            Swal.fire({
                title: 'Are you sure?',
                text: "ต้องการลบข้อมูลทองหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: "/productdetail/" + id,
                    type: 'delete',
                    data: {
                        id: id,
                        _token: token
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.status){
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อย',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                window.location = '/productdetail'
                            })
                        }
                        
                    }
                    });
                }
            })
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
                    <h1>จัดการข้อมูลทอง</h1>
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
                        <h3>จัดการข้อมูลทอง</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('productdetail.create') }}"><i class="fa fa-plus"></i> เพิ่มทองเข้าร้าน</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <form class="form-inline" action="/productdetail" method="GET">
                            <input type="hidden" id="productdetail-all" name="productdetailall">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาข้อมูลทอง">
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
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->details}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->size}}</td>
                                    <td>{{$row->status == '0' ? 'ทองในถาด' : 'ทองในสต็อก'}}</td>
                                    <td>{{$row->lot_id}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('ProductDetailController@edit',$row->id)}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <td class="text-center">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row->id}}"><i class="fa fa-trash"></i> ลบ</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="col-6">
                            {{ $productdetail->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection