@extends('layout.app')

@section('section')
    @include('components.product.product-list')
    @include('components.product.product-create')
    @include('components.product.product-delete')
    @include('components.product.product-update')
@endsection