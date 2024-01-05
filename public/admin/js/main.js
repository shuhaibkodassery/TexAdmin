var pageURL = window.location.href;
$('#CreateProduct').on('click', () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/product',
        method: 'POST',
        data: {
            product_code : $('#product_code').val(),
            product_name : $('#product_name').val(),
            purchase_price : $('#purchase_price').val(),
            product_price : $('#product_price').val()
        },
        success : (data) => {
            if(data == 3) {
                window.alert('Something went wrong');
            }else {
                window.alert('product Created successfully');
                window.location.reload();
            }
        },
        error: (data) => {
            console.log(data);
        }
    });
});

function deleteProduct(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/product/'+id,
        method: 'DELETE',
        success: (data) => {
            if(data == 3){
                window.alert('Something went wrong')
            }else{
                window.alert('Product deleted successfully')
                window.location.reload()
            }
        }
    });
}

$('#product').on('change', function(){
    id = $('#product').val();
    document.getElementById('product_price').value = $('#product_price_'+id).val();
});

$('#CreateSale').on('click', ()=> {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/sales',
        method: 'POST',
        data: {
            product_id: $('#product').val(),
            product_price: $('#product_price').val(),
            date: $('#date').val(),
            discount: $('#discount').val()
        },
        success: (data) => {
            if(data == 3){
                window.alert('Something went wrong');
            }else {
                window.alert('Sales Created');
                window.location.reload();
            }
        },
        error: (data) => {

        }
    })
})