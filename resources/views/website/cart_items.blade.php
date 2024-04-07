<div>
    @if($item_counts > 0)
        <div class="cart-form">
            <table class="shop_table table">
                <thead>
                <tr>
                    <th class="product-remove"></th>
                    <th class="product-thumbnail"> صوره المنتج</th>
                    <th class="product-name"> اسم المنتج</th>
                    <th class="product-quantity"> الكميه</th>
                    <th class="product-price"> سعر المنتج</th>

                    <th class="product-subtotal"></th>
                </tr>
                </thead>
                <tbody>
                @php $total_price = 0; @endphp
                @foreach($cartItems as $item)
                    <tr class="cart_item">
                        <td class="product-remove">
                            <button class="remove btn-sm deleteCartItem" data-cartid="{{$item['id']}}"><i
                                        class="fa fa-trash"></i></button>
                        </td>
                        <td class="product-thumbnail">
                            <a href="{{url('product_details/'.$item['productdata']['slug'])}}">
                                <img src="{{Storage::url($item['productdata']['image'])}}" alt="img"
                                     class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                            </a>
                        </td>
                        <td class="product-name" data-title="Product">
                            <a href="{{url('product_details/'.$item['productdata']['slug'])}}"
                               class="title"> {{$item['productdata']['name']}} </a>
                            <span
                                    class="attributes-select attributes-color"> السعر  :: </span>
                            @if($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null )

                                <span
                                        class="attributes-select attributes-size"> {{ $item['productdata']['price'] - $item['productdata']['discount']}} </span>
                            @else

                                <span
                                        class="attributes-select attributes-size">  {{$item['productdata']['price']}} </span>
                            @endif

                        </td>
                        <td class="product-quantity" data-title="Quantity">
                            <div class="quantity">
                                <div class="control">
                                    <a href="#"
                                       class="btn-number qtyplus quantity-plus updateCartItem"
                                       data-cartid="{{$item['id']}}"
                                       data-qty="{{$item['quantity']}}">+</a>

                                    <input type="text" data-step="1" min="1" data-min="0"
                                           value="{{$item['quantity']}}"
                                           title="Qty" class="input-qty qty" size="4">
                                    <a class="btn-number qtyminus quantity-minus updateCartItem"
                                       data-cartid="{{$item['id']}}" data-qty="{{$item['quantity']}}"
                                       href="#">-</a>

                                </div>
                            </div>
                        </td>
                        <td class="product-price" data-title="Price">
                                                <span class="woocommerce-Price-amount amount">
                                                    @if($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null )
                                                        @php $sub_total = ($item['productdata']['price'] - $item['productdata']['discount']) * $item['quantity']; @endphp
                                                        {{ $sub_total  }}
                                                    @else
                                                        @php $sub_total = $item['productdata']['price'] * $item['quantity']; @endphp
                                                        {{$sub_total}}
                                                    @endif
                                                      <span class="woocommerce-Price-currencySymbol">
                                                        ر.س
                                                    </span>
                                                </span>
                        </td>
                    </tr>
                    @php $total_price = $total_price + $sub_total @endphp
                @endforeach

                <tr>
                    <td class="actions">
                        <form id="applycoupon" method="post" action="javascript:void(0);"
                              @if(\Illuminate\Support\Facades\Auth::check()) user = "1" @endif>
                            @csrf
                            <div class="coupon">
                                <label class="coupon_code"> كود الخصم :</label>
                                <input id="code" name="code" type="text" class="input-text"
                                       placeholder="ادخل كود الخصم هنا ">
                                <button type="submit" class="button"> تاكيد الكوبون</button>
                            </div>
                        </form>
                        <div class="order-total">
                            @if(Session::has('coupon_amount'))
                                <span class="title">
                                                         قيمه الخصم :
                                                    </span>
                                <span class="total-price discountAmount">

                                                      {{Session::get("coupon_amount")}} <span> ر.س </span>
                                                    </span>
                            @endif
                        </div>
                        <br>
                        <div class="order-total">
                                                    <span class="title">
                                                        السعر الكلي :
                                                    </span>
                            <span class="total-price grand_total">
                                @if(Session::has('coupon_amount'))
                                    {{$total_price - Session::get('coupon_amount')}} <span> ر.س </span>
                                                    </span>
                            @else
                                <span class="total-price grand_total">

                                        {{$total_price}} <span> ر.س </span>
                                                    </span>
                            @endif
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="control-cart">
            <button class="button btn-continue-shopping">
                الاستمرار في التسوق
            </button>
            <a class="button btn-cart-to-checkout" href="{{url('checkout')}}"> اتمام الدفع </a>

        </div>
    @else
        <div class="control-cart">
            <div class="alert alert-info"> لا يوجد منتجات في سله المشتريات</div>
            <button class="button btn-continue-shopping">
                <a href="{{url('shop')}}"> تسوق الان </a>
            </button>

        </div>
    @endif
</div>


