@extends('maindesign')

@section('all_products')
    <div class="container">
        
        <div class="row">
            @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="{{ route('product_details',$product->id) }}">
                        <div class="img-box">
                            <img src="{{ asset('products/'.$product->product_image)}}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                                {{$product->product_title}}
                            </h6>
                            <h6>
                                Price
                                <span>
                                    ₱{{$product->product_price}}
                                </span>
                            </h6>
                        </div>
                        <div class="new">
                            <span>
                                New
                            </span>
                        </div>
                    </a>
                    
                    {{-- DITO TAYO MAGDADAGDAG NG FORM PARA SA QUANTITY --}}
                    <form action="{{ route('add_to_cart', $product->id) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <div class="d-flex justify-content-center align-items-center mt-2 mb-2">
                            
                            {{-- QUANTITY INPUT --}}
                            <input 
                                type="number" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                max="99" 
                                class="form-control" 
                                style="width: 80px; text-align: center; margin-right: 5px;"
                            >
                            
                            {{-- ADD TO CART BUTTON --}}
                            <button type="submit" class="btn btn-danger btn-sm">
                                Add to Cart
                            </button>
                            
                        </div>
                    </form>
                    {{-- END OF FORM --}}

                </div>
            </div> 
            @endforeach     
        </div>
        <div class="btn-box">
            <a href="{{ route('index') }}">
                View Latest Products
            </a>
        </div>
    </div>
 
@endsection