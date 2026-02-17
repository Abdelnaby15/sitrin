@extends('layouts.app')

@section('title', 'Unsubscribed - SITRIN')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="bg-white p-5 rounded-3 shadow-sm">
                <i class="bi bi-check-circle-fill text-success display-1 mb-4"></i>
                <h2 class="mb-3">Successfully Unsubscribed</h2>
                <p class="text-muted mb-4">You will no longer receive stock notifications for this product.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
