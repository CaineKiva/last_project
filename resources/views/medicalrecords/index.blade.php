@extends('layouts.master')
@section('content')
    <table class="table">
        <tbody>
            <tr>
                <th scope="col" align="center" style="text-align: center;">
                    <a href="{{ route('medicalrecords.discharged') }}" class="btn btn-success" style="color: white; width: 350px;">Bệnh án của các bệnh nhân đã xuất viện</a>
                </th>
                <th scope="col" align="center" style="text-align: center;">
                    <a href="{{ route('medicalrecords.being_treated') }}" class="btn btn-success" style="color: white; width: 350px;">Bệnh án của các bệnh nhân đang điều trị</a>
                </th>
            </tr>
        </tbody>
    </table>
@endsection
