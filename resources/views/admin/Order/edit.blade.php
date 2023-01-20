@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-6 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Color</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" id="submitForm" class="submitForm">
                        <div class="form-group item">
                            <label class="col-md-6 col-form-label">User name: <b>{{$data->user->name}}</b></label>
                        </div>
                        <div class="form-group item">
                            <label class="col-md-6 col-form-label">Order price: <b>{{$data->total_price}}</b></label>

                        </div>
                        <div class="form-group item">
                            <label class="col-md-6 col-form-label">Current status: <b>{{$data->status}}</b></label>
                        </div>
                        <div class="form-group item">
                            <label class="col-md-6 col-form-label">Ordered at: <b>{{$data->created_at}}</b></label>
                        </div>
                        <div class="form-group item">
                            <label class="col-md-2 col-form-label">Order status</label>
                            <select name="status" class="form-control">
                                <option value="In Transit">In transit</option>
                                <option value="Arrived">Arrived</option>
                                <option value="Rejected">Reject</option>
                                <option value="Under Review">Under Review</option>
                            </select>
                        </div>
                        <div class="form-group item">
                            <div class="col-md-2">
                                <button type="submit" id="store" class="btn btn-success">Submit</button>
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

            submitHandler: function (form) {

                var formData = new FormData(document.forms['submitForm']);

                $.ajax({
                    url: "{{route('update.order',$data->id)}}",
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
                        location.href = "{{route('view.orders')}}";
                    },
                    error: function (reject) {
                    },
                });
            },
        });
    </script>
@endsection
