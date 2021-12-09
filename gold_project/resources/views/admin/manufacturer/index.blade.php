@extends('layouts.master')
@section('title','จัดการผู้ผลิต')
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
            if (confirm("ต้องการลบข้อมูลใช่หรือไม่")) {
                $.ajax({
                    url: "manufacturer/" + id,
                    type: 'delete',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        window.location = "{{route('manufacturer.index')}}"
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
                        <h1>จัดการผู้ผลิต</h1>
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
                        <h3>ข้อมูลผู้ผลิต</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('manufacturer.create') }}"><i class="fa fa-plus"></i> ข้อมูลผู้ผลิต</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">รหัสผู้ผลิต</th>
                                    <th scope="col">ชื่อผู้ผลิต</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">ที่อยู่</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manufacturer as $row)
                                <tr>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->tel}}</td>
                                    <td>{{$row->address}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('ManufacturerController@edit',$row->id)}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <td class="text-center">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row->id}}"><i class="fa fa-trash"></i> ลบ</button>
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