@extends('admin.layouts.app')

@section('title', 'Pendaftar')

@section('content')
    <h3>Data Pendaftar</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Budi</td>
                <td>budi@mail.com</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti</td>
                <td>siti@mail.com</td>
            </tr>
        </tbody>
    </table>
@endsection