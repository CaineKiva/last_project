@extends('layouts.master')
@section('titles', " $supplier->supplier_name ")
@section('content')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style type="text/css">
        #content{
            position: relative;
        }
        #form_information{
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
    <div id="list">
        <table class="table" id="list">
            <tr>
                <td align="right" colspan="8">
                    <button class="btn btn-primary fas fa-pencil-alt" style="color: white;" onclick="show()" title="Thêm thuốc/dược phẩm"></button>
                </td>
            </tr>
            <tr>
                <th scope="col" style="text-align: center;">Tên Thuốc/Dược phẩm</th>
                <th scope="col" style="text-align: center;">Giá bán</th>
                <th scope="col" style="text-align: center;">Sử dụng</th>
                <th scope="col" style="text-align: center;">Tình trạng</th>
                <th scope="col" style="text-align: center;">Số lượng (hộp, lọ)</th>
            </tr>
            <tbody>
            @foreach ($array_list as $medicine)
                <tr>
                    <th align="center" style="text-align: center; font-weight: normal;">
                        {{ $medicine->medicine_name }}
                    </td>
                    <td align="center">
                        {{ $medicine->price }} VND
                    </td>
                    <td align="center">
                        {{ $medicine->using }}
                    </td>
                    <td align="center">
                        @php
                            if ($medicine->status == 1){
                                echo "Đang bán";
                            }else {
                                echo "Hết hàng";
                            }
                        @endphp
                    </td>
                    <td align="center">
                        {{$medicine->quantity}}
                    </td>
                    <th scope="col" align="center" style="text-align: right;">
                        <button type="button" class="btn btn-success fas fa-check" style="color: white;" onclick="show()"
                                medicine_id = "{{$medicine->medicine_id}}" title="Thông tin thuốc/dược phẩm"></button>
                    </th>
                </tr>
            @endforeach
            <br>
            </tbody>
        </table>
    </div>

    <div id="form_information" style="display: none ;">
        <div class="card"  >
            <div class="card-header" align="center" style="height: 50px;">
                <div class="row form-group">
                    <div class="col-12 col-md-11"><strong></strong></div>
                    <div class="col-12 col-md-1"><input type="reset" align="right" value=" X " onclick="hiden()" style="background-color: red;"></div>
                </div>
            </div>
            <div class="card-body card-block" >
                <form action="" id="routes" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên Thuốc/Dược phẩm</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="medicine_name" name="medicine_name" class="form-control" placeholder="Tên Thuốc/Dược phẩm">
                            <input type="hidden" id="medicine_id" name="medicine_id" class="form-control" value="{{ $supplier->supplier_id }}">
                            <input type="hidden" id="supplier_id" name="supplier_id" class="form-control" value="{{ $supplier->supplier_id }}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Giá bán (VND)</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="price" name="price" class="form-control" placeholder="VND"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sử dụng</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="using" name="using" class="form-control" placeholder="Cách sử dụng"></div>
                    </div>
                    <div class="row form-group" id="treatment_div">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tình trạng</label></div>
                        <div class="col-12 col-md-9">
                            <select name="status" class="form-control" id="status">
                                <option value="0">Hết hàng</option>
                                <option value="1" selected>Đang bán</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số lượng (Hộp, lọ)</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="quantity" name="quantity" class="form-control" placeholder="Hộp, lọ"></div>
                    </div>
                    <div class="card-footer" align="center" >
                        <button class="btn btn-success btn-sm">
                            <i class="far fa-check-circle"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{$array_list->appends(['search' => $search])->links()}}
@endsection

@push('js')
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            $(document).on('click', '.btn.btn-success.fas.fa-check', function (){
                var medicine_id = $(this).attr('medicine_id');
                console.log(medicine_id);
                $.ajax({
                    url: '{{ route('ajax.medicine_information') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {medicine_id : medicine_id},
                })
                    .done(function(response) {
                        console.log(response)
                        $("strong").text("Thông tin thuốc/dược phẩm");
                        $("#medicine_id").val(response[0]['medicine_id']);
                        $("#medicine_name").val(response[0]['medicine_name']);
                        $("#price").val(response[0]['price']);
                        $("#using").val(response[0]['using']);
                        $("#status").val(response[0]['status']);
                        $("#quantity").val(response[0]['quantity']);
                        $("#routes").attr('action','{{ route('medicine.process_update') }}');
                    })
            });

            $(document).on('click', '.btn.btn-primary.fas.fa-pencil-alt', function (){
                $("strong").text("Thêm thuốc/dược phẩm");
                $("#routes").attr('action','{{ route('medicine.process_insert') }}');
                $("#routes").trigger("reset");
            });
        });

        function show() {
            document.getElementById("form_information").style.display = "block";
        }

        function hiden() {
            document.getElementById("form_information").style.display = "none";
        }
    </script>
@endpush
