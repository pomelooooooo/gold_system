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
        $("body").on('click', '#delete_button', function(e) {
            var id = $(this).data("id");
            var lot_id = $(this).data("lot_id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'ต้องการลบข้อมูลล็อตหรือไม่?',
                // text: "ต้องการลบข้อมูลล็อตหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ไม่',
                confirmButtonText: 'ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/product/" + id,
                        type: 'delete',
                        data: {
                            id: id,
                            lot_id: lot_id,
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
                                    window.location = '/product'
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถลบได้',
                                    text: "ไม่สามารถลบล็อตทองได้เนื่องจากมีทองล็อตดังกล่าวอยู่ในคลังทอง",
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
                    <div class="col-12">
                        <form class="form-inline" action="/product" method="GET">
                            <i class="fas fa-search" id="mySearch"></i>
                            <input class="form-control mr-sm-2" name="search" value="{{isset($keyword)?$keyword:''}}" type="search" id="myInput" placeholder="ค้นหาข้อมูลล็อตทอง">
                            <input class="form-control" type="date" name="filter_date" value="{{$filter_date}}">&nbsp;&nbsp;ถึง&nbsp;&nbsp;
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
                                    <th scope="col">รหัสล็อต</th>
                                    <th scope="col">ประเภท</th>
                                    <th scope="col">ผู้ผลิต</th>
                                    <th scope="col">น้ำหนัก(ต่อเส้น)</th>
                                    <th scope="col">จำนวนสินต้า</th>
                                    <th scope="col">วันที่นำเข้า</th>
                                    <th scope="col">ราคาทอง(บาท)</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($product as $row)
                                <tr>
                                    <td>{{$row->lot_id}}</td>
                                    <td>{{$row->typename}}</td>
                                    <td>{{$row->manuname}}</td>
                                    @php
                                    if($row->weight == '001'){
                                    $weight_text = 'ครึ่งสลึง';
                                    } else if($row->weight == '01') {
                                    $weight_text = '1 สลึง';
                                    } else if($row->weight == '02') {
                                    $weight_text = '2 สลึง';
                                    } else if($row->weight == '03') {
                                    $weight_text = '3 สลึง';
                                    } else if($row->weight == '06') {
                                    $weight_text = '6 สลึง';
                                    } else if($row->weight == '1') {
                                    $weight_text = '1 บาท';
                                    } else if($row->weight == '2') {
                                    $weight_text = '2 บาท';
                                    }else if($row->weight == '3') {
                                    $weight_text = '3 บาท';
                                    } else if($row->weight == '4') {
                                    $weight_text = '4 บาท';
                                    }else if($row->weight == '5') {
                                    $weight_text = '5 บาท';
                                    }else {
                                    $weight_text = '10 บาท';
                                    }
                                    @endphp
                                    <td>{{$weight_text}}</td>
                                    <td>{{$row->lot_count}}</td>
                                    <td>{{\Carbon\Carbon::parse($row->date_of_import)->format('d/m/Y')}}</td>
                                    <td>{{$row->price_of_gold}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('ProductController@edit',$row->id)}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                        {{csrf_field()}}
                                        <button class="btn btn-danger" type="button" id="delete_button" data-id="{{$row->id}}" data-lot_id="{{$row->lot_id}}"><i class="fa fa-trash"></i> ลบ</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $product->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection