window.axios = require('axios');
const debounce = require('debounce');
const axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.getCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

window.setCookie = (cName, cValue, expDays) => {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

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
                $('.cart_total_view').text(res.data.total + '฿')
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
                    offset: 90,
                    spacing: 10,
                    z_index: 1031,
                    delay: 500,
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

    $('#shipping_other').change(function (e) {
        if ($(this).is(':checked')) {
            $('#shipping-detail').show()
        } else {
            $('#shipping-detail').hide()
        }
    })

    $('#bill_address, #bill_phone, #bill_name, #shipping_address, #shipping_phone, #shipping_name')
        .keyup(debounce(getShippingList, 700))

    $('#bill_country, #bill_zipcode, #bill_province, #bill_district, #bill_amphoe, #shipping_zipcode, #shipping_province, #shipping_district, #shipping_amphoe, #shipping_country')
        .change(debounce(getShippingList, 700))

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
            $('.js-shipping-required-fill').text('กรุณากรอกที่อยู่จัดส่งก่อน')
            return
        }
        $('#shipping-list').empty()
        $('.js-shipping-required-fill').text('...กำลังค้นหา').show()
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
                if (res.status === 200) {
                    $('#shipping-list-wrap').show()
                    $('.js-shipping-required-fill').hide()
                    for (const [key, value] of Object.entries(res.data[0])) {
                        $('#shipping-list').append(
                            `<li>
                                <div class="radio-option flex-1">
                                    <input type="radio" name="courier_code" id="${value.courier_code}"
                                        data-price="${value.price}"
                                        data-name="${value.courier_name}"
                                        value="${value.courier_code}"
                                        required
                                    >
                                    <label class="w-[77%] font-normal" for="${value.courier_code}">
                                        <div class="clear-both">
                                            ${value.courier_name}
                                            <div class="float-right">${value.price} ฿</div>
                                        </div>
                                        <div class="text-gray-400 text-sm">${value.estimate_time}</div>
                                    </label>
                                </div>
                            </li>`
                        )
                    }
                    return
                }
                if ([404, 400].includes(res.status)) {
                    $('.js-shipping-required-fill').show()
                    $('#shipping-list-wrap').hide()
                    $('.js-shipping-required-fill').text('ไม่สามารถจัดส่งสินค้าได้ กรุณาติดต่อผู้ดูแลเว็บไซต์')
                }
            })
    }

    $(document).on('change', 'input[name="courier_code"]', function (e) {
        const shippingPrice = +$(this).data('price')
        const shippingName = $(this).data('name')
        $('#submit-form').attr('disabled', false)
        $('input[name="courier_price"]').val(shippingPrice)
        $('input[name="courier_name"]').val(shippingName)
        getTotal()
    })

    getShippingList()

    $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled')
    })

    $('#apply-coupon').click(function () {
        const couponCode = $('input[name="coupon_code"]').val()
        if (couponCode.trim() === '') {
            return
        }
        $(this).attr('disabled', true)
        axios.post('checkout/find-coupon', {
            code: couponCode
        })
            .then((res) => {
                if (res.status === 200) {
                    $('#coupon-price').text('-' + numeral(res.data.coupon.price).format('0,0.[00]') + ' ฿').show()
                    $('input[name=coupon_code]').data('price', res.data.coupon.price)
                    $('#coupon-input-wrap').hide()
                    $('#coupon-edit').show()
                }
                $(this).attr('disabled', false)
                getTotal()
            })
            .catch(() => {
                alert('ไม่สามารถใช้งานคูปองนี้ได้')
                $(this).attr('disabled', false)
            })
    })

    $('#coupon-edit').click(function () {
        $('#coupon-edit').hide()
        $('#coupon-price').hide()
        $('#coupon-input-wrap').show()
        $('input[name="coupon_code"]').val('').data('price', 0)
        getTotal()
    })

    function getTotal() {
        const subTotal = +$('#sub-total').data('sub-total')
        const shippingPrice = +$('input[name="courier_price"]').val()
        const couponPrice = +$('input[name="coupon_code"]').data('price')
        let total = subTotal + shippingPrice
        total = total - couponPrice
        if (total <= 0) {
            total = 0
        }
        $('#total').text(numeral(total).format('0,0.00'))
    }

    $('.js-address').click(function (e) {
        const address = $(this).data('address')
        if (address.is_bill_same_address == 2) {
            $('#shipping_other').prop('checked', true)
            $('#shipping-detail').show()

            $('input[name=bill_name]').val(address.bill_name)
            $('input[name=bill_phone]').val(address.bill_phone)
            $('input[name=bill_address]').val(address.bill_address)
            $('input[name=bill_district]').val(address.bill_district)
            $('input[name=bill_amphoe]').val(address.bill_amphoe)
            $('input[name=bill_province]').val(address.bill_province)
            $('input[name=bill_zipcode]').val(address.bill_zipcode)
            $('input[name=bill_country]').val(address.bill_country)

            $('input[name=shipping_name]').val(address.bill_name)
            $('input[name=shipping_phone]').val(address.bill_phone)
            $('input[name=shipping_address]').val(address.bill_address)
            $('input[name=shipping_district]').val(address.bill_district)
            $('input[name=shipping_amphoe]').val(address.bill_amphoe)
            $('input[name=shipping_province]').val(address.bill_province)
            $('input[name=shipping_zipcode]').val(address.bill_zipcode)
            $('input[name=shipping_country]').val(address.bill_country)
        } else {
            $('#shipping_other').prop('checked', false)
            $('#shipping-detail').hide()

            $('input[name=bill_name]').val(address.bill_name)
            $('input[name=bill_phone]').val(address.bill_phone)
            $('input[name=bill_address]').val(address.bill_address)
            $('input[name=bill_district]').val(address.bill_district)
            $('input[name=bill_amphoe]').val(address.bill_amphoe)
            $('input[name=bill_province]').val(address.bill_province)
            $('input[name=bill_zipcode]').val(address.bill_zipcode)
            $('input[name=bill_country]').val(address.bill_country)
        }
        getShippingList()
    })
})(jQuery)
