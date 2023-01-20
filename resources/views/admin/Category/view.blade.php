@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>View all categories </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>English name</th>
                                    <th>Arabic name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /top tiles -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#table').dataTable({
                processing: true,
                serverSide: true,
                ajax: location.href,
                columns: [
                    {data: "id", name: "id"},
                    {data: "en_name", name: "en_name"},
                    {data: "ar_name", name: "ar_name"},
                    {data: "action", name: "action", "searchable": false},

                ]
            });
        });

        $(document).on('click', '#delete_btn', function (e) {
            e.preventDefault();
            var table = $('#table').DataTable();
            var d_id = $(this).attr('d_id');
            console.log(33);
            $.ajax({
                type: 'post',
                url: "{{Route('delete.category')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': d_id,
                },
                success: function (data) {
                    table.ajax.reload();
                },
                error: function (reject) {
                },
            });
        });
    </script>
@endsection
