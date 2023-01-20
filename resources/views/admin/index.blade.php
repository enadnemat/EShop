@extends('admin.layouts.template')
@section('content')
    <!-- top tiles -->
    <div class="row" style="display: inline-block;">
        <div class="tile_count">
            <div class="col-md-auto col-sm-4  tile_stats_count">
                <a href="{{route('view.products')}}"> <span class="count_top"> Total Product</span>
                <div class="count">{{ $product }}</div></a>
            </div>
            <div class="col-md-auto col-sm-4  tile_stats_count">
                <a href="{{route('view.categories')}}"><span class="count_top"> Total Category</span>
                <div class="count">{{$category}}</div></a>
            </div>
            <div class="col-md-auto col-sm-4  tile_stats_count">
                <a href="{{route('view.brands')}}"><span class="count_top"> Total Brands</span>
                <div class="count">{{$brand}}</div></a>
            </div>
            <div class="col-md-auto col-sm-4  tile_stats_count">
                <a href="{{route('view.colors')}}"><span class="count_top">Total Colors</span>
                <div class="count">{{$color}}</div></a>
            </div>
            <div class="col-md-auto col-sm-4  tile_stats_count">
                <a href="{{route('view.offers')}}"><span class="count_top">Total Offers</span>
                    <div class="count">{{$offer}}</div></a>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

@endsection
