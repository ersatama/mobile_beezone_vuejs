<template>
    <div>
        <header_checkout></header_checkout>
        <div class="body_cart">
            <div class="body_cart_time">
                <div class="checkout_title">Личные данные</div>
                <div class="login-title-form checkout-title-form">
                    <div class="login-title-form-title">ФИО</div>
                    <div class="login-title-form-input">
                        <input type="text" name="phone" class="login-title-form-input-text" v-model="info.fullName">
                    </div>
                    <div class="login-title-form-title checkout-title-form-title">Электронная почта</div>
                    <div class="login-title-form-input">
                        <input type="text" name="phone" class="login-title-form-input-text" v-model="info.email">
                    </div>
                    <div class="login-title-form-remember">
                        <div class="login-title-form-remember-icon" :class="{'login-title-form-remember-icon-mark':info.remember}" @click="info.remember = !info.remember"></div>
                        <div class="login-title-form-remember-desc" @click="info.remember = !info.remember">Соглашаюсь получать рекламные сообщения на эл. почту, аб. номер и в приложении</div>
                    </div>
                </div>
            </div>
            <div class="body_cart_address">
                <div class="login-title-form checkout-title-form">
                    <div class="login-title-form-title">Адрес доставки</div>
                    <div class="modal-next" @click="modal = true"></div>
                    <div class="login-title-form-input">
                        <input type="text" name="phone" class="login-title-form-input-text" v-model="info.address">
                    </div>
                </div>
                <div class="login-title-form checkout-title-form">
                    <div class="login-title-form-title">Время доставки</div>
                    <div class="modal-next"></div>
                    <div class="login-title-form-input">
                        <input type="text" name="phone" class="login-title-form-input-text" v-model="info.time.title" readonly>
                    </div>
                </div>
                <div class="login-title-form checkout-title-form">
                    <div class="login-title-form-title">Способ оплаты</div>
                    <div class="modal-next" @click="pay"></div>
                    <div class="login-title-form-input">
                        <input type="text" name="phone" class="login-title-form-input-text" v-model="info.payment.title" readonly>
                    </div>
                </div>
                <div class="login-title-form checkout-title-form">
                    <div class="login-title-form-title">Комментарий к заказу</div>
                    <div class="login-title-form-input">
                        <input type="text" v-model="info.comment" name="phone" class="login-title-form-input-text">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_main">
            <div>
                <a href="/cart/order" v-if="total !== 0">
                    <div class="footer_main-btn">
                        <div class="footer_main-btn-title">Далее</div>
                        <div class="footer_main-btn-price" v-if="total != 0">{{total}} ₸</div>
                    </div>
                </a>
                <a href="/cart" v-else>
                    <div class="footer_main-btn">
                        <div class="footer_main-btn-title">Назад</div>
                    </div>
                </a>
            </div>
        </div>
        <map_box @coordinates="coordinates" @close="close" :view="modal"></map_box>
        <map_box_payment @change_time="change_payment" @view_modal="view_modal" :view="modal_payment"></map_box_payment>
    </div>
</template>

<script>
    import header_checkout from './header/header_checkout';
    import map_box from './modal/map_box';
    import map_box_payment from './modal/map_box_payment';
    export default {
        components: {
            header_checkout,
            map_box,
            map_box_payment
        },
        name: "checkout",
        data: function() {
            return {
                modal: false,
                modal_payment: false,
                total: 0,
                info: {
                    fullName: '',
                    email: '',
                    remember: true,
                    address: '',
                    comment: '',
                    time: {
                        id: 0,
                        title: 'Как можно скорее',
                    },
                    payment: {
                        id: 0,
                        img: '/img/money.svg',
                        title: 'Наличными',
                        desc: 'без чаевых',
                        status: true,
                    },
                }
            }
        },
        methods: {
            change_payment(data) {
                this.info.payment = JSON.parse(JSON.stringify(data));
            },
            pay() {
                this.modal_payment = true;
            },
            view_modal(status) {
                this.modal_payment = status;
            },
            coordinates(data) {
                this.info.address = data.features[0].place_name;

            },
            close(status) {
                this.modal = status;
            }
        }
    }
</script>

<style scoped lang="scss">
    .modal {
        &-next {
            background: url('/img/next.svg') no-repeat center;
            position: absolute;
            width: 9px;
            height: 11px;
            right: 0;
            top: 10px;
        }
    }
</style>
