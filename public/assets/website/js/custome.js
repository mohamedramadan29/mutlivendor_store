$(document).ready(function (){
    $("#sort").on('change',function (){
       this.form.submit();
    });
    /// Make Update Cart Items With Ajax Not Make Refresh  /////////
    $(document).on('click','.updateCartItem',function (){
       if($(this).hasClass('qtyplus')){
           // get the quantity
           var quantity = $(this).data('qty');
           // Increase The Quantity By 1
           var new_qty  = parseInt(quantity) + 1;
           // alert(new_qty);
       }
        if($(this).hasClass('qtyminus')){
            // get the quantity
            var quantity = $(this).data('qty');
            // check the quantity at least 1
            if(quantity <= 1){
                alert('كميه المنتج يجب ان تكون 1 او اكثر ');
            }else {
                // Decrease The Quantity By 1
                var new_qty  = parseInt(quantity) - 1;
                // alert(new_qty);
            }
        }
        var cartId = $(this).data('cartid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/cart/update',
            type:'post',
            data:{cartId:cartId,qty:new_qty},
            success:function (resp){
                $("#append_cart_items").html(resp.View);
            }
        });
    });

    ////////////////// Make Delete Cart Item ////////////////////////
    $(document).on('click','.deleteCartItem',function (){
        var cartId = $(this).data('cartid');
        var result = confirm(' هل انت متاكد من حذف هذا العنصر ؟');
        if(result){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/cart/delete',
                type:'post',
                data:{cartId:cartId},
                success:function (resp){
                    $("#append_cart_items").html(resp.View);
                }

            });
        }

    });

    // Apply Coupon Code

    $("#applycoupon").submit(function (){
        var user = $(this).attr('user');
       if(user == 1){
           // Do Something
       }else{
           alert('من فضلك سجل دخولك اولا  للحصول علي الخصم  ');
       }
       var code = $("#code").val();
       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           type:'post',
           url:'/apply_coupon',
           data:{code:code},
           success:function (resp){
               if(resp.message !=''){
                   alert(resp.message);
                   if(resp.coupon_amount > 0){
                       $(".discountAmount").text(resp.coupon_amount + "ر.س");
                   }else{
                       $(".discountAmount").text(" 0 ر.س");
                   }
                   if(resp.grand_total > 0){
                       $(".grand_total").text(resp.grand_total + "ر.س");
                   }
               }

           },error:function (){
               alert('error');
           }
       });
    })
});
