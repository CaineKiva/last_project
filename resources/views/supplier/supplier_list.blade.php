@extends('layouts.master')
@section('content')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style type="text/css">
    #content{
        position: relative;
    }
    #form_insert{
        position: absolute;
        position: fixed;
        width: 60%;
        top: 0%;
        z-index: 9999;
    }
    #textarea-input{
        resize: none;
        height: 40px;
    }
</style>
<table class="table">
    <tr>
        <td align="right" colspan="8">
            <button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()" title="Thêm Nhà cung cấp"></button>
        </td>
    </tr>
    <tr>
        <th scope="col" style="text-align: center;">Nhà cung cấp</th>
        <th scope="col" style="text-align: center;">Danh sách thuốc và dược phẩm được cung cấp</th>
    </tr>
    <tbody>
    @foreach ($array_list as $supplier)
        <tr>
            <td align="center">
                <button class="btn btn-success" style="color: white; width: 700px;" supplier_id = "{{$supplier->supplier_id}}" onclick="show()" title="Thông tin chi tiết">{{$supplier->supplier_name}}</button>
            </td>
            <th scope="col" align="center" style="text-align: center;">
                <a href="{{ route('supplier.medicine_list',['supplier_id' => $supplier->supplier_id]) }}" class="btn btn-success" style="color: white; width: 250px;">Danh sách thuốc và dược phẩm</a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="form_insert" style="display: none ;">
    <div class="card"  >
        <div class="card-header" align="center" style="height: 50px;">
            <div class="row form-group">
                <div class="col-12 col-md-11"><strong>Thông tin nhà cung cấp</strong></div>
                <div class="col-12 col-md-1"><input type="reset" align="right" value=" X " onclick="hiden()" style="background-color: red;"></div>
            </div>
        </div>
        <div class="card-body card-block" >
            <form action="" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên Nhà Cung cấp</label></div>
                    <div class="col-12 col-md-9">
                        <input type="hidden" id="supplier_id" name="supplier_id" class="form-control">
                        <input type="text" id="supplier_name" name="supplier_name" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Địa chỉ</label></div>
                    <div class="col-12 col-md-9"><textarea name="address" id="address" rows="9" placeholder="Nhập địa chỉ" class="form-control" style="height: 60px; resize: none;"></textarea></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="email" name="email" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="phone" name="phone" class="form-control"></div>
                </div>
                <div class="card-footer" align="center" >
                    <button class="btn btn-success btn-sm">
                        <i class="far fa-check-circle"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" >
    jQuery(document).ready(function($) {
        $(document).on('click', '.btn.btn-success', function (){
            var supplier_id = $(this).attr('supplier_id');
            console.log(supplier_id);
            $.ajax({
                url: '{{ route('ajax.supplier_information') }}',
                type: 'GET',
                dataType: 'json',
                data: {supplier_id : supplier_id},
            }).done(function(response) {
                console.log(response);
                $("#routes").attr('action','{{ route('supplier.process_update') }}');
                $("#supplier_id").val(response[0]['supplier_id']);
                $("#supplier_name").val(response[0]['supplier_name']);
                $("#address").val(response[0]['address']);
                $("#email").val(response[0]['email']);
                $("#phone").val(response[0]['phone']);
            })
        });

        $(document).on('click', '.btn.btn-primary.fas.fa-pencil-alt', function (){
            $("#routes").attr('action','{{ route('supplier.process_insert') }}');
            $("#routes").trigger("reset");
        });

    });

    function show() {
        document.getElementById("form_insert").style.display = "block";
    }
    function hiden() {
        document.getElementById("form_insert").style.display = "none";
    }
</script>
@endpush
