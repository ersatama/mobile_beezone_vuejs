<template>
    <div>
        <header_cart></header_cart>
        <div class="body_cart" v-if="total !== 0">
            <div class="body_cart_time">
                <div class="body_cart_time_deliver">
                    <div class="body_cart_time_deliver_truck"></div>
                </div>
                <div class="body_cart_time_title">Отгрузка товара завтра</div>
            </div>
            <div class="body_cart_list">
                <div class="body_cart_list_item" v-for="(item) in list">
                    <div class="body_cart_list_item_title">{{item.total}} x {{item.title}}</div>
                    <div class="body_cart_list_item_price">{{item.total * item.price}} ₸</div>
                </div>
            </div>
            <div class="body_cart_total">
                <div class="body_cart_sum">
                    <div class="body_cart_sum_title">Итого</div>
                    <div class="body_cart_sum_sum">{{total}}₸</div>
                </div>
                <div class="body_cart_total_wave"></div>
            </div>
            <div class="body_cart_offer">
                <div class="body_main-next">Может, ещё кое-что?</div>
            </div>
            <!--
            {"brand":1,"id":0,"modal":true,"status":true,"view":true,"price":4500,"max":56,"limit":6,"total":24,"title":"Подгузники MommyBaby S (2)","img":"/img/img.png","matrix":[{"count":30,"point":5,"price":4500},{"count":150,"point":25,"price":4450},{"count":240,"point":40,"price":4400},{"count":1200,"point":120,"price":4300},{"count":3000,"point":500,"price":4200}],"index":0} ₸
            -->
        </div>
        <div class="body_cart" v-else>
            <div class="body_cart_main">
                <div class="body_cart_main_icon"></div>
                <div class="body_cart_main_title">Корзина пуста</div>
                <div class="body_cart_main_desc">Перейдите в каталог, чтобы выбрать и заказать нужный товар</div>
            </div>
        </div>
        <div class="footer_main">
            <div>
                <a href="/cart/order" v-if="total !== 0">
                    <div class="footer_main-btn">
                        <div class="footer_main-btn-title">Далее</div>
                        <div class="footer_main-btn-price" v-show="total !== 0">{{total}} ₸</div>
                    </div>
                </a>
                <a href="/" v-else>
                    <div class="footer_main-btn">
                        <div class="footer_main-btn-title">Назад</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import header_cart from './header/header_cart';
    export default {
        components: {
            header_cart,
        },
        name: "cart",
        data: function() {
            return {
                total: 0,
                list: [],
                sel: {},
            }
        },
        created() {
            if (localStorage.cart) {
                let data = JSON.parse(localStorage.cart);
                this.list = data;
                this.totalCount(data);
            }
        },
        methods: {
            price(index,id) {

                this.sel = this.goods[ index ].list[ id ];
                this.sel.modal = true;
                this.sel.index = index;
                this.sel.id = id;

            },
            checkProduct() {
                let data = [];
                if (localStorage.cart) {
                    data = JSON.parse(localStorage.cart);
                    let status = -1;
                    let self = this;
                    data.forEach(function callback(currentValue, index, array) {
                        if (currentValue.brand == self.sel.brand && currentValue.id == self.sel.id) {
                            status = index;
                        }
                    });
                    if (status != -1) {
                        data[ status ] = this.sel;
                    } else {
                        data.push(this.sel);
                    }
                } else {
                    data.push(this.sel);
                }
                localStorage.cart = JSON.stringify(data);
                return data;
            },
            selItem() {
                this.sel.status = true;
                let data = this.checkProduct();
                this.totalCount(data);
            },
            totalCount(data) {
                let total = 0;
                let self = this;
                data.forEach(function callback(currentValue, index, array) {
                    if (currentValue.total == 0) {
                        array.splice(index, 1);
                    } else {
                        currentValue.price = self.priceCount(currentValue);
                        total += currentValue.total*currentValue.price;
                    }
                });
                if (data.length !== 0) {
                    localStorage.cart = JSON.stringify(data);
                } else {
                    localStorage.removeItem('cart')
                }
                this.total = total;
            },
            priceCount(currentValue) {
                let price = 0;
                if (currentValue.matrix[1].count > currentValue.total) {
                    price = currentValue.matrix[0].price;

                } else if (currentValue.matrix[1].count <= currentValue.total || currentValue.matrix[2].count > currentValue.total) {

                    price = currentValue.matrix[1].price;

                } else if (currentValue.matrix[2].count <= currentValue.total || currentValue.matrix[3].count > currentValue.total) {

                    price = currentValue.matrix[2].price;

                } else if (currentValue.matrix[3].count <= currentValue.total || currentValue.matrix[4].count > currentValue.total) {

                    price = currentValue.matrix[3].price;

                } else if (currentValue.matrix[4].count > currentValue.total) {
                    price = currentValue.matrix[4].price;
                }
                return price;
            },
            remove() {
                let sum = this.sel.total-6;
                if (sum > 0) {
                    this.sel.total = sum;
                } else {
                    this.sel.total = 0;
                }
                let data = this.checkProduct();
                this.totalCount(data);
            },
            add() {
                let sum = this.sel.total+6;
                if (sum < this.sel.max) {
                    this.sel.total = sum;
                } else {
                    this.sel.total = this.sel.max;
                }

                let data = this.checkProduct();
                this.totalCount(data);
            }
        }
    }
</script>

<style scoped>

</style>
