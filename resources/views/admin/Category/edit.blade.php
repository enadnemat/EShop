@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row" style="display: inline-block;">

        <h3>Add Category</h3>

        <form method="post" id="submitForm" class="submitForm">
            @csrf
            <div class="container">
                <div class="form-group">
                    <label for="en_name">Name in english</label>
                    <input type="text" class="form-control" id="en_name" value="{{$data->en_name}}" name="en_name" required
                           placeholder="Name in english">
                </div>
                <div class="form-group">
                    <label for="ar_name">Name in Arabic</label>
                    <input type="text" class="form-control" id="ar_name" value="{{$data->ar_name}}" name="ar_name" required
                           placeholder="Name in arabic">
                </div>
                <button id="store" class="btn btn-primary"> Update Category</button>
            </div>
        </form>
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
                    url: "{{Route('update.category',$data->id)}}",
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
                        location.href = "{{route('view.categories')}}";
                    },
                    error: function (reject) {
                    },
                });
            },
        });
    </script>
@endsection
