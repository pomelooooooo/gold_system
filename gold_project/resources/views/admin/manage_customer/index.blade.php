@extends('layouts.master')
@section('title','จัดการข้อมูลลูกค้า')
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
            Swal.fire({
                title: 'ต้องการลบข้อมูลพนักงานหรือไม่?',
                // text: "ต้องการลบข้อมูลพนักงานหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/manage_customer/" + id,
                        type: 'delete',
                        data: {
                            id: id,
                            _token: token
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบข้อมูลเรียบร้อย',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    window.location = '/manage_customer'
                                })
                            }else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถลบได้',
                                    text: "ไม่สามารถลบลูกค้าได้เนื่องจากมีลูกค้าคนดังกล่าวอยู่ในระบบการจำนำ",
                                    showConfirmButton: false,
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
                    <h1>จัดการข้อมูลลูกค้า</h1>
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
                        <h3>จัดการข้อมูลลูกค้า</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('manage_customer.create') }}"><i class="fa fa-plus"></i> เพิ่มลูกค้า</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form class="form-inline" action="/manage_customer" method="GET">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาข้อมูลลูกค้า">
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">นามสกุล</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">ที่อยู่</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($managecustomer as $row)
                                <tr>
                                    <td>{{$row['name']}}</td>
                                    <td>{{$row['lastname']}}</td>
                                    <td>{{$row['tel']}}</td>
                                    <td>{{$row['address']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('ManageCustomerController@edit',$row['id'])}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row['id']}}"><i class="fa fa-trash"></i> ลบ</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="col-6">
                            {{ $managecustomer->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection