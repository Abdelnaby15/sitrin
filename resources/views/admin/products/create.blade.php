@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark-green mb-1 fw-bold">Add New Product</h2>
        <p class="text-muted mb-0">Create a new product in your inventory</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-2"></i>Back to Products
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="sku" class="form-label fw-semibold">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku') }}" required>
                            <small class="text-muted">Unique product identifier</small>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Pricing & Inventory -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Pricing & Inventory</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label fw-semibold">Price (EGP) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="sort_order" class="form-label fw-semibold">Display Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                <small class="text-muted">Lower numbers appear first</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Product Details</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label fw-semibold">Available Sizes</label>
                                <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size', 'One Size (160cm height × 90cm width)') }}" placeholder="One Size (160cm height × 90cm width)">
                                <small class="text-muted">Default: 160cm from shoulders, 90cm width</small>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="color" class="form-label fw-semibold">Color</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}" placeholder="Black, White, etc.">
                                <small class="text-muted">Product color or colors</small>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="fabric" class="form-label fw-semibold">Fabric/Material</label>
                                <input type="text" class="form-control @error('fabric') is-invalid @enderror" id="fabric" name="fabric" value="{{ old('fabric') }}" placeholder="Cotton, Silk, Polyester, etc.">
                                <small class="text-muted">Material or fabric type</small>
                                @error('fabric')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Images -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Product Images</h5>
                        
                        <div class="mb-3">
                            <label for="main_image" class="form-label fw-semibold">Main Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" id="main_image" name="main_image" accept="image/*" required>
                            <small class="text-muted">Upload the primary product image</small>
                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Additional Images</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
                            <small class="text-muted">Upload up to 5 additional images (optional)</small>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Status</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active (Product will be visible on the website)
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-check-circle me-2"></i>Create Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="mb-3 fw-bold">Tips</h5>
                <ul class="small text-muted">
                    <li class="mb-2">Use high-quality images for better presentation</li>
                    <li class="mb-2">Write detailed descriptions to help customers</li>
                    <li class="mb-2">Set accurate stock quantities</li>
                    <li>Choose the appropriate category</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
