window.axios = require('axios');
const debounce = require('debounce');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

(function ($) {
    const inputQty = $('input[name=quantity]')
    $('.quantity-right-plus').click(function () {
            inputQty.val(+inputQty.val() + 1)
    })
    $('.quantity-left-minus').click(function () {
        if (+inputQty.val() <= 1) {
            inputQty.val(1)
        } else {
            inputQty.val(+inputQty.val() - 1)
        }
    })

    $('.product-box .add-button, #addToCartOnShowPage').click(function (e) {
        const productId = e.target.dataset.productId
        const inputAmount = +$('input[name=quantity]').val() || 1
        axios.post('/cart', {
            product_id: productId,
            amount: inputAmount
        })
            .then((res) => {
                $('.cart_qty_cls').text(res.data.count)
                $('.cart_qty_view').text(res.data.count)
                $.notify({
                    icon: 'fa fa-check',
                    title: 'สำเร็จ!',
                    message: 'เพิ่มสินค้าเรียบร้อยแล้ว'
                }, {
                    element: 'body',
                    position: null,
                    type: "success",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 1500,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                    icon_type: 'class',
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
                })
            })
    })

    $('.cart-section input[name="quantity"]').change(function (e) {
        const productId = e.target.dataset.productId
        let amount = e.target.value || 1
        axios.put('/cart', {
            product_id: productId,
            amount: +amount
        })
            .then(() => {
                window.location.reload()
            })
    })

    $('#shipping-option').change(function (e) {
        if ($(this).is(':checked')) {
            $('#shipping-detail').show()
        } else {
            $('#shipping-detail').hide()
        }
    })

    $('#bill_address, #bill_zipcode, #bill_province, #bill_phone, #bill_name, #bill_district, #bill_amphoe, #shipping_address, #shipping_zipcode, #shipping_province, #shipping_phone, #shipping_name, #shipping_district, #shipping_amphoe')
        .change(debounce(getShippingList, 500))

    function getShippingList() {
        let prefix = '#bill'
        if ($('#shipping-option').is(':checked')) {
            prefix = '#shipping'
        }
        const address = $(prefix+'_address').val()
        const zipcode = $(prefix+'_zipcode').val()
        const province = $(prefix+'_province').val()
        const phone = $(prefix+'_phone').val()
        const name = $(prefix+'_name').val()
        const district = $(prefix+'_district').val()
        const amphoe = $(prefix+'_amphoe').val()
        if (!address || !zipcode || !province || !phone || !name || !district || !amphoe) {
            console.log('dd')
            return
        }
        axios.post('checkout/shipping-list', {
            address,
            zipcode,
            province,
            phone,
            name,
            district,
            amphoe,
        })
            .then((res) => {
                console.log(res)
            })
    }
})(jQuery);
