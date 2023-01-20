@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add product</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="submitForm" enctype="multipart/form-data" data-parsley-validate
                          class="form-horizontal form-label-left">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4" for="first-name">Product
                                        name in english) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" id="en_name" name="en_name" value="{{$product->en_name}}"
                                               required class="form-control ">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4" for="first-name">Product
                                        name (In arabic) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="ar_name" name="ar_name" value="{{$product->ar_name}}"
                                               required class="form-control ">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="middle-name"
                                           class="col-form-label col-md-4 col-sm-4">Price<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="price" required class="form-control" value="{{$product->price}}"
                                               placeholder="In dollar"
                                               type="number" name="price">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4">Description<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea class="form-control" name="description" id="description"
                                                  rows="5" required>{{$product->description}}</textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4">Inspired
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="inspired">
                                            <option value="1">Inspired</option>
                                            <option value="0">Not Inspired</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">Category
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="">No Category</option>
                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->en_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">Brand
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="brand_id" id="brand_id">
                                            <option value="">No Brand</option>
                                            @foreach($brand as $brands)
                                                <option value="{{$brands->id}}">{{$brands->en_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">Color
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="color_id" id="color_id">
                                            <option value="">No Color</option>
                                            @foreach($color as $colors)
                                                <option value="{{$colors->id}}">{{$colors->en_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">Thumbnail <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" name="thumbnail" value="{{$product->thumbnail}}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">
                                        Current thumbnail
                                    </label>
                                    <img src="{{asset($product->thumbnail)}}"
                                         class="img img-responsive col-md-3 col-sm-3" width="100" height="100" alt="">
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3">Featured
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="featured">
                                            <option value="1">Featured</option>
                                            <option value="0">Not Featured</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6" id="wrapper">
                                @foreach($specification as $specifications)
                                    <div class="item form-group" id="added">
                                        <div class="col-sm-5 col-md-5">
                                            <label class="col-form-label col-md-5 col-sm-5">Specification(s)
                                            </label>
                                        </div>
                                        <div class="col-sm-5 col-md-5"><input type="text"
                                                                              value="{{$specifications->ar_name}}"
                                                                              name="specification_ar_name[]"
                                                                              class="form-control mb-1"
                                                                              placeholder="Name in arabic" required>
                                        </div>
                                        <div class="col-sm-5 col-md-5"><input type="text"
                                                                              value="{{$specifications->en_name}}"
                                                                              name="specification_en_name[]"
                                                                              class="form-control mb-1"
                                                                              placeholder="Name in english" required>
                                        </div>
                                        <div class="col-sm-5 col-md-5"><input type="text"
                                                                              value="{{$specifications->value}}"
                                                                              name="specification_value[]"
                                                                              class="form-control mb-1"
                                                                              placeholder="Value" required></div>
                                        <div class="col-sm-5 col-md-5 mt-2">
                                            <a href="javascript:void(0)" id="remove_button"><p>Remove specification</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-md-5 mt-2">
                                <a href="javascript:void(0)" id="add_button"><p>Add specification</p></a>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div id="dropzone"
                                 class="dropzone">
                                <div class="dz-message ">Drop files here to upload</div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>



    <script>
        var myDropzone = new Dropzone("#dropzone",
            {
                url: "{{route('update.photo',$id)}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                enctype: 'multipart/form-data',
                paramName: "dropzone",
                dictDefaultMessage: 'Drop or drop/Click to upload<span class="dz-message1"> Max: 5 files</span>',
                maxFiles: 8,
                maxFilesize: 4, //MB
                // renameFile: function(file) {
                // var dt = new Date();
                // var time = dt.getTime();
                // return time+"-"+file.name;    // to rename file name but i didn't use it. i renamed file with php in controller.
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,

                init: function () {
                    // get photos
                    var myDropzone = this;
                    $.ajax({
                        url: "{{ route('get.photo', $id)}}",
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            $.each(response, function (key, value) {
                                var file = {name: value.name, size: value.size};
                                myDropzone.options.addedfile.call(myDropzone, file);
                                myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                                myDropzone.emit("complete", file);
                            });
                        },
                    });
                },
                removedfile: function (file) {
                    if (this.options.dictRemoveFile) {
                        return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile, function () {
                            if (file.previewElement.id != "") {
                                var name = file.previewElement.id;
                            } else {
                                var name = file.name;
                            }
                            //console.log(name);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '{{route('destroy.photo',$id)}}',
                                data: {filename: name},
                                success: function (data) {
                                    alert(data.success + " File has been successfully removed!");
                                },
                                error: function (e) {
                                    console.log(e);
                                }
                            });
                            var fileRef;
                            return (fileRef = file.previewElement) != null ?
                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        });
                    }
                },
                success: function (file, response) {
                    file.previewElement.id = response.success;
                    //console.log(file);
                    // set new posts names in dropzone’s preview box.
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
            })


    </script>
    <script>

        var max_Field = 10;
        var addButton = $('#add_button');
        var wrapper = $('#wrapper');
        var x = 1;
        var html_Field = `<div class="item form-group" id="added">
                                    <div class="col-sm-5 col-md-5"><label class="col-form-label col-md-5 col-sm-5">Specification(s)</label>
                                    </div>
                                    <div class="col-sm-5 col-md-5"><input type="text" name="specification_ar_name[]"
                                                                          class="form-control mb-1"
                                                                          placeholder="Name in arabic" required></div>
                                    <div class="col-sm-5 col-md-5"><input type="text" name="specification_en_name[]"
                                                                          class="form-control mb-1"
                                                                          placeholder="Name in english" required></div>
                                    <div class="col-sm-5 col-md-5"><input type="text" name="specification_value[]"
                                                                          class="form-control mb-1"
                                                                          placeholder="Value" required></div>
                                    <div class="col-sm-5 col-md-5 mt-2">
                                        <a href="javascript:void(0)" id="remove_button"><p>Remove specification</p></a>
                                    </div>
                                </div>`;

        $(addButton).click(function () {
            if (x < max_Field) {
                x++;
                $(wrapper).append(html_Field);
            }

        });

        $(wrapper).on('click', '#remove_button', function (e) {
            if (x >= 0) {
                e.preventDefault();
                $(this).closest("#added").remove(); //Remove field html
                x--;
                console.log($(this));//Decrement field counter
            }
        });
    </script>
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
                    url: "{{route('update.product',$id)}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        location.href = "{{route('view.products')}}";
                    },
                    error: function (reject) {
                    },
                });

                return false;
            },
        });


    </script>
@endsection
