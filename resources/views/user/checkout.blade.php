@extends('user.layouts.template')
@section("content")
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Product Checkout</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.blade.php">Home</a>
                        <a href="checkout.html">Product Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <form class="row contact_form" id="shippingForm">
            @csrf
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Full name" id="full" value="{{auth()->user()->name}}" name="full_name"/>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="number" class="form-control" placeholder="Phone number" id="number" name="number"/>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Email" id="email" value="{{auth()->user()->email}}" name="email"/>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <select name="country" class="country_select">
                                    <option value="jordan">Jordan</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Address 1" id="add1" name="add1"/>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Address 2" id="add2" name="add2"/>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Town" id="town" name="town"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="postcode" name="postcode"
                                       placeholder="Postcode"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product<span>Total</span>
                                        </a>
                                    </li>
                                    @foreach($cart as $carts)
                                        <li>
                                            <a href="#">{{$carts->name}}
                                                <span class="price">${{$carts->price*$carts->quantity}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#"
                                        >Total
                                            <span>${{$total}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option4" name="selector"/>
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>

                                <input type="submit" class="main_btn" value="Send order">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================End Checkout Area =================-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <script>
        $("#shippingForm").validate({
            submitHandler: function (form) {
                var formData = new FormData(document.forms['shippingForm']);
                $.ajax({
                    url: "{{route('store-order',auth()->user()->id)}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        location.href = "{{Route('user.index')}}";
                    },
                    error: function (reject) {
                    },
                });
                return false;
            },
        });
    </script>
@endsection
