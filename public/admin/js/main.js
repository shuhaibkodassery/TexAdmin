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
        url: pageURL.split('/')[0]+'/admin/product/delete/'+id,
        method: 'POST',
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
});

$('#SaleReportFilter').on('click', ()=> {
        filterSales();
});

function filterSales() {
    from_date = $('#from_date').val();
    to_date = $('#to_date').val();
    window.location.href = pageURL.split('/')[0]+'/admin/sales-report?from_date='+from_date+'&to_date='+to_date;
}

$('#CreateExpense').on('click', ()=> {
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/expense',
        method: 'POST',
        data : {
            expense: $('#expense').val(),
            expense_amount: $('#expense_amount').val(),
            date : $('#date').val(),
        },
        success: (data) => {
            if(data == 3) {
                window.alert('Something went wrong');
            }else {
                window.alert('Expense Created Successfully')
                window.location.reload();
            }
        },
        error: (data) => {
            console.error(data);
        }
    })
});

function deleteExpense(id) {
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/expense/delete/'+id,
        method: 'POST',
        success: (data) => {
            if(data == 3) {
                window.alert('Something went wrong');
            }else {
                window.alert('Expense Deleted Successfully')
                window.location.reload();
            }
        },
        error: (data) => {
            console.error(data);
        }
    })
}

$('#CreatePurchase').on('click', ()=> {
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/purchase',
        method: 'POST',
        data : {
            purchase: $('#purchase').val(),
            purchase_amount: $('#purchase_amount').val(),
            date : $('#date').val(),
        },
        success: (data) => {
            if(data == 3) {
                window.alert('Something went wrong');
            }else {
                window.alert('Purchase Created Successfully')
                window.location.reload();
            }
        },
        error: (data) => {
            console.error(data);
        }
    })
});

function deletePurchase(id) {
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/purchase/delete/'+id,
        method: 'POST',
        success: (data) => {
            if(data == 3) {
                window.alert('Something went wrong');
            }else {
                window.alert('Expense Deleted Successfully')
                window.location.reload();
            }
        },
        error: (data) => {
            console.error(data);
        }
    })
}

function deleteSales(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/sales/delete/'+id,
        method: 'POST',
        
        success: (data) => {
            if(data == 3){
                window.alert('Something went wrong');
            }else {
                window.alert('Sales Deleted Successfully');
                window.location.reload();
            }
        },
        error: (data) => {

        }
    })
}