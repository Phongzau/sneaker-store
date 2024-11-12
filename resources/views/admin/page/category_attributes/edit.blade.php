@extends('layouts.admin')

@section('title')
    Sneaker Store | Edit Category Attribute
@endsection

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Edit Category Attribute</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Category Attribute</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.category_attributes.update', $categoryAttribute->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $categoryAttribute->title) }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" name="order" value="{{ old('order', $categoryAttribute->order) }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $categoryAttribute->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $categoryAttribute->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
