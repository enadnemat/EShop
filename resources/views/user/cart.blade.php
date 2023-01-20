@extends('user.layouts.template')
@section("content")
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div
                    class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Cart</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.blade.php">Home</a>
                        <a href="cart.html">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">

                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $carts)
                        <form method="post" action="{{route('updateCart',[auth()->user()->id,$carts->id])}}">
                            @csrf
                                <tr>
                                    <th>{{$carts->id}}</th>
                                    <th>{{$carts->name}}</th>
                                    <th>{{$carts->price}}</th>
                                    <th><input type="number" name="quantity" onchange="this.form.submit()"
                                               value="{{$carts->quantity}}"></th>
                                    <th>{{$carts->price * $carts->quantity}}</th>
                                </tr>
                        </form>
                        @endforeach
                        <tr class="bottom_button">
                            <td colspan="5">
                                <a class="gray_btn" href="{{route('checkout',auth()->user()->id)}}">Complete
                                    purchase</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

{{--    <script>--}}
{{--        $("#submitForm").validate({--}}

{{--            submitHandler: function (form) {--}}

{{--                var formData = new FormData(document.forms['submitForm']);--}}

{{--                $.ajax({--}}
{{--                    url: "{{route('updateCart',[auth()->user()->id ,$carts->id])}}",--}}
{{--                    type: 'POST',--}}
{{--                    data: formData,--}}
{{--                    processData: false,--}}
{{--                    contentType: false,--}}
{{--                    cache: false,--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        --}}
{{--                    },--}}
{{--                    error: function (reject) {--}}
{{--                    },--}}
{{--                });--}}

{{--                return false;--}}
{{--            },--}}
{{--        });--}}

{{--    </script>--}}
@endsection
