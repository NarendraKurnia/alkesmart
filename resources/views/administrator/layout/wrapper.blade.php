@php
    if (!session()->has('id_user')) {
        header('Location: ' . url('administrator/login'));
        exit;
    }

    if (request()->is('security/user') && session('unit_id') != 1) {
        header('Location: ' . url('security/produk'));
        exit;
    }

@endphp
@include('administrator/layout/head')
@include('administrator/layout/header')
@include('administrator/layout/menu')
@include($content)
@include('administrator/layout/footer')