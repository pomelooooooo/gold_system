@extends('layouts.master')
@section('title','จัดการข้อมูลร้าน')
@section('content')

<script>
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
                title: 'ต้องการลบข้อมูลร้านหรือไม่?',
                // text: "ต้องการลบข้อมูลลายหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/stores/" + id,
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
                                    window.location = '/stores'
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
                    <h1>จัดการข้อมูลร้าน</h1>
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
                        <h3>ข้อมูลสาขา</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('stores.create') }}"><i class="fa fa-plus"></i> เพิ่มร้านสาขา</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ชื่อร้าน</th>
                                    <th scope="col">ที่อยู่</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col"></th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stores as $row)
                                <tr>
                                    <td>{{$row['name']}}</td>
                                    <td>{{$row['address']}}</td>
                                    <td>{{$row['tel']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('StoresController@edit',$row['id'])}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <!-- <td class="text-center">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row['id']}}"><i class="fa fa-trash"></i> ลบ</button>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection