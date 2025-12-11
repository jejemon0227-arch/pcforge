@extends('maindesign')

@section('viewcart_products')
<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"></div>

<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Title</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Unit Price</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Quantity</th> 
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Sub Total</th> 
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product image</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Action</th>
        </tr>
    </thead>

    <tbody>
        @php
            $grand_total = 0;
        @endphp
        
        @foreach($cart as $cart_product)
        @php
            $unit_price = $cart_product->product->product_price;
            $quantity = $cart_product->quantity;
            $sub_total = $unit_price * $quantity;
            $grand_total += $sub_total;
        @endphp
        
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 12px;">{{ $cart_product->product->product_title }}</td>
            <td style="padding: 12px;">₱{{ number_format($unit_price, 2) }}</td> 
            
            {{-- BAGONG CODE: QUANTITY INPUT FIELD WITH AUTO-SUBMIT --}}
            <td style="padding: 12px;">
                <form action="{{ route('update_cart_quantity', $cart_product->id) }}" method="POST" style="display: flex; justify-content: center;">
                    @csrf
                    @method('PATCH') {{-- Gagamitin natin ang PATCH method sa Controller --}}
                    
                    <input 
                        type="number" 
                        name="quantity" 
                        value="{{ $quantity }}" 
                        min="1" 
                        max="99" 
                        class="form-control"
                        style="width: 80px; text-align: center; border: 1px solid #ccc; padding: 5px;"
                        onchange="this.form.submit()" {{-- Awtomatikong magsa-submit kapag nagbago ang value --}}
                    >
                </form>
            </td>
            {{-- END BAGONG CODE --}}
            
            <td style="padding: 12px;">₱{{ number_format($sub_total, 2) }}</td> 
            <td style="padding: 12px;">
                <img style="width: 150px;" src="{{asset('products/'. $cart_product->product->product_image)}}">
            </td>
            <td style="padding: 12px;"><a style="padding: 10px; background-color: red; color:white;"   href="{{ route('removecartproducts', $cart_product->id) }}">Remove</a></td> 
        </tr>
        
        @endforeach
        
        {{-- DISPLAY GRAND TOTAL --}}
        <tr style="border-bottom: 1px solid #ddd; background-color: gray;">
            <td style="padding: 12px;" colspan="3">Grand Total Price</td> 
            <td style="padding: 12px;">=₱{{ number_format($grand_total, 2) }}</td> 
            <td style="padding: 12px;"></td>
            <td style="padding: 12px;"></td> 
        </tr>
        
    </tbody>
</table>

@if(session('confirm_order'))
     <div class="mb-4 bg-blue-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
         {{ session('confirm_order') }}
     </div>
@endif

<form action="{{ route('confirm_order')}}" method="post" style="margin-top: 20px;">
    @csrf
    <input type="text" name="receiver_address" id="" placeholder="Enter Your Address" required><br><br><br>
    <input type="text" name="receiver_phone" id="" placeholder="Enter Your Phone Number" required><br><br><br>
    <input class="btn btn-primary" type="submit" name="submit" value="Confirm Order"><br><br><br>
    
    {{-- Ipinapasa ang Grand Total para sa payment --}}
    <a href="{{ route('stripe', $grand_total) }}" style="background: #72d8cfff; padding: 12px; border-radius: 12px;" >pay now</a>
</form>

@endsection