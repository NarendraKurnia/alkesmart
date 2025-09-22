@php
    if (!session()->has('id_user')) {
        header('Location: ' . url('administrator/login'));
        exit;
    }

    if (request()->is('administrator/user') && session('unit_id') != 1) {
        header('Location: ' . url('administrator/produk'));
        exit;
    }

@endphp
@include('administrator/layout/head')
@include('administrator/layout/header')
@include('administrator/layout/menu')
@include($content)
@include('administrator/layout/footer')