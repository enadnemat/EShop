@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-6 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Offer to product</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" action="{{route('store.offer')}}" id="submitForm" class="submitForm">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Offer name</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" name="offer_name" class="form-control">
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label">Offer value</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="value">
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label">Product</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <select name="product_id" class="form-control">
                                        @foreach($product as $products)
                                            <option value="{{$products->id}}">{{$products->en_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <label class="col-form-label col-sm-6">Offer Image</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="file" name="offer_image" class="form-control" required>
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label"> Offer starting time</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input class="form-control" name="starts_at" type="datetime-local">
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label"> Offer ending time</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input class="form-control" name="ends_at" type="datetime-local">
                                </div>
                            </div>

                            <div class="form-group mt-2 ">
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" id="store" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /top tiles -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $("#submitForm").validate({
            rules: {
                en_name: "required",
                ar_name: "required",
            },
            messages: {
                en_name: "Please enter the name",
                ar_name: "Please enter the name",
            },
            submitHandler: function (form) {

                var formData = new FormData(document.forms['submitForm']);

                $.ajax({
                    url: "{{Route('store.offer')}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        location.href = "{{Route('view.offers')}}";
                    },
                    error: function (reject) {
                    },
                });
            },
        });
    </script>
@endsection
