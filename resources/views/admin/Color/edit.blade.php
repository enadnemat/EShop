@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row" style="display: inline-block;">
        <div class="col-md-6 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Color</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" id="submitForm" class="submitForm">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Color name (In english)</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" id="en_name" value="{{$data->en_name}}" name="en_name" required class="form-control">
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label">Color name (In arabic)</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" id="ar_name" value="{{$data->ar_name}}" name="ar_name" required class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
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
                    url: "{{route('update.color',$data->id)}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#submitForm').trigger("reset");
                        location.href = "{{Route('view.colors')}}";
                    },
                    error: function (reject) {
                    },
                });
            },
        });
    </script>
@endsection
