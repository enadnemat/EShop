@extends('user.layouts.template')
@section("content")
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Shop Category</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="{{route('user.index')}}">Home</a>
                        <a href="{{route('shop.category')}}">Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <form method="get" id="filterForm">
        <section class="cat_product_area section_gap">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="product_top_bar">
                            <div class="left_dorp">
                                <select class="sorting" name="sort" onchange="this.form.submit()">
                                    <option value="id">Default sorting</option>
                                    <option value="AZ" @if(request('sort') == "AZ") selected @endif>Name (A-Z)</option>
                                    <option value="ZA" @if(request('sort') == "ZA") selected @endif>Name (Z-A)</option>
                                    <option value="LH" @if(request('sort') == "LH") selected @endif>Price (Low > High)
                                    </option>
                                    <option value="HL" @if(request('sort') == "HL") selected @endif>Price (High > Low)
                                    </option>
                                </select>
                                <select class="show" name="show" onchange="this.form.submit()">
                                    <option value="12" @if(request('show') == 12) selected @endif>Show 12</option>
                                    <option value="14" @if(request('show') == 14) selected @endif>Show 14</option>
                                    <option value="16" @if(request('show') == 16) selected @endif>Show 16</option>
                                </select>
                            </div>
                        </div>
                        <div class="latest_product_inner">
                            <div class="row">
                                @if(count($product) ==0)
                                    <h5 class="ml-3">There is no product</h5>
                                @else
                                    @foreach($product as $products)

                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <img class="card-img" src="{{asset($products->thumbnail)}}" alt=""/>
                                                    <div class="p_icon">
                                                        <a href="{{route('product.details',[$products->id ,auth()->user()->id])}}">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="ti-heart"></i>
                                                        </a>
                                                        <a>
                                                            <i class="ti-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-btm">
                                                    <a href="#" class="d-block">
                                                        <h4>{{$products->en_name}}</h4>
                                                    </a>
                                                    <div class="mt-3">
                                                        <span class="mr-4">${{$products->price}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="left_sidebar_area">
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Browse Categories</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list-group ">
                                        @if(count($category) ==0)
                                            <h5>There is no categories</h5>
                                        @else
                                            @foreach($category as $categoryy)
                                                <li class="list-group-item border-0">
                                                    <input onchange="this.form.submit()"
                                                       @if((request()->filled('category')) && in_array($categoryy->id , request('category'))) checked
                                                       @endif
                                                       class="form-check-input" name="category[]" type="checkbox"
                                                       value="{{$categoryy->id}}">{{$categoryy->en_name}}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </aside>

                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Product Brand</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        @if(count($brand) ==0)
                                            <h5>There is no brands</h5>
                                        @else
                                            @foreach($brand as $brands)
                                                <li class="list-group-item border-0">
                                                    <input onchange="this.form.submit()"
                                                       @if((request()->filled('brand')) && in_array($brands->id , request('brand'))) checked
                                                       @endif
                                                       name="brand[]" class="form-check-input me-1" type="checkbox"
                                                       value="{{$brands->id}}">{{$brands->en_name}}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </aside>
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Color Filter</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        @if(count($color) ==0)
                                            <h5>There is no colors</h5>
                                        @else
                                            @foreach($color as $colors)
                                                <li class="list-group-item border-0">
                                                    <input onchange="this.form.submit()"
                                                           @if((request()->filled('color')) && in_array($colors->id , request('color'))) checked
                                                           @endif
                                                           name="color[]" class="form-check-input me-1" type="checkbox"
                                                           value="{{$colors->id}}">{{$colors->en_name}}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </aside>

                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Price Filter</h3>
                                </div>
                                <div class="widgets_inner">
                                    <div class="range_item">
                                        <div id="slider-range"></div>
                                        <div class="">
                                            <label for="amount">Price : </label>
                                            <input type="text" id="amount" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!--================End Category Product Area =================-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
@endsection



