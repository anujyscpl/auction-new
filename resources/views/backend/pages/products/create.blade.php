
@extends('backend.layouts.master')

@section('title')
Product Create - Admin Panel
@endsection

@section('styles')

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Admin Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Product Lists</a></li>
                    <li><span>Create Product</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create New Product</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Product Name</label>
                                <input type="text" required class="form-control"  id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Description</label>
                                <input type="text" required class="form-control"  name="description" placeholder="Enter Product Description">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="text">SKU</label>
                                <input type="text" required class="form-control"  name="sku" placeholder="Enter Product SKU">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="asking_price">Asking Price</label>
                                <input type="text" required class="form-control"  name="asking_price" placeholder="Enter Asking Price">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Select Category</label>
                                <select name="category" required id="category" class="form-control" style="height: auto">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="sub_category">Select Sub Category</label>
                                <select required name="sub_category" id="sub_category" class="form-control" style="height: auto">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="type">Auction Type</label>
                                <select name="type" required id="type" class="form-control" style="height: auto">
                                    <option value="">Select Auction Type</option>
                                    <option value="0">Weekly</option>
                                    <option value="1">Fixed</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="asking_price">Issued Year</label>
                                <input type="text" required class="form-control"  name="issued_year" placeholder="Enter Issued Year">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="is_featured">Is Featured</label>
                                <select name="is_featured" id="is_featured" class="form-control" style="height: auto">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="asking_price">User Id</label>
                                <input type="text" required class="form-control"  name="seller_id" placeholder="Enter Seller user id">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <div class="custom-file">
                                    <input required type="file" class="custom-file-input" name="images[]" multiple id="images" accept="image/*">
                                    <label class="custom-file-label" for="images">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit"  class="btn btn-primary mt-4 pr-4 pl-4">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>
@endsection

@section('scripts')

{{--    <script type="text/javascript" src="{{asset('app/controllers/products.js')}}"></script>--}}
<script>
    $(document).ready(function() {

        $('input[type="file"]').change(function (e) {
            const array = [];
            for (let i = 0; i < e.target.files.length; i++) {
                array.push(e.target.files[i].name)
            }
            console.log(e.target.files)
            $('.custom-file-label').html(array.join(', '));
        });

        $('#category').on('change', function () {
            const category_id = this.value;
            $("#sub_category").html('');
            $.ajax({
                url: '/admin/sub-category',
                type: "POST",
                data: {
                    category_id: category_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#sub_category').html('<option value="">-- Select Sub Category --</option>');
                    $.each(res.sub_categories, function (key, value) {
                        $("#sub_category").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });


    });

</script>
@endsection
