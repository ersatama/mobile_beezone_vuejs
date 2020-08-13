<template>
    <div>
        <header_main></header_main>
        <div class="body_main">
            <div class="body_main-title">Акции</div>
            <div class="body_main-share">
                <div>
                    <div class="body_main-share-item" v-for="product in products" :style="{backgroundImage: 'url('+product.img+')'}"></div>
                </div>
            </div>
            <template v-for="(good,index) in goods">
                <div class="body_main-next">{{good.title}}</div>
                <div class="body_main-list">
                    <div>
                        <div class="body_main-list-item" v-for="(item,id) in good.list">
                            <div class="body_main-list-item-icon" :style="{backgroundImage: 'url('+item.img+')'}"></div>
                            <div class="body_main-list-item-title">{{item.title}}</div>
                            <div class="body_main-list-item-count" @click="">{{item.max}} шт</div>
                            <div class="body_main-list-item-btn" @click="price(index,id)">от {{item.price}} ₸</div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="footer_main">
            <div>
                <a href="/cart">
                    <div class="footer_main-btn">
                        <div class="footer_main-btn-title" @click="sel.modal = true;">Корзина</div>
                        <div class="footer_main-btn-price" v-if="total != 0">{{total}} ₸</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="modal_box" v-if="Object.keys(sel).length !== 0" :class="{modal_box_hide:!sel.modal,modal_box_up: sel.status}">
            <div class="modal_box_body">
                <div class="modal_box_body_close" @click="sel.modal = false;"></div>
                <div class="modal_box_screen" v-if="sel.view"></div>
                <div class="modal_box_screen_details" v-else>
                    <div class="modal_box_screen_details_title">Матрица Цен</div>
                    <div class="modal_box_screen_details_item" v-for="(item,index) in sel.matrix">
                        <div>{{index+1}}</div>
                        <div>от {{item.count}} упаковок ({{item.point}} бл)</div>
                        <div>{{item.price}} ₸ </div>
                    </div>
                </div>
                <div class="modal_box_slider">
                    <div class="modal_box_slider_item" :class="{modal_box_slider_item_sel:sel.view}" @click="sel.view = true"></div>
                    <div class="modal_box_slider_item" :class="{modal_box_slider_item_sel:!sel.view}" @click="sel.view = false"></div>
                </div>
                <div class="modal_box_title">{{sel.title}}</div>
                <div class="modal_box_sum" v-if="sel.view">{{sel.max}} шт</div>
                <div class="modal_box_sum" v-if="!sel.view">{{sel.price}} ₸ • блок: {{sel.limit}} • макс: {{sel.max}} шт</div>
                <div class="modal_box_btn" v-if="!sel.status">
                    <button class="modal_box_buy" @click="selItem()">{{sel.price}} ₸</button>
                </div>
                <div class="modal_box_list" v-else>
                    <button class="modal_box_remove" @click="remove()">-</button>
                    <div class="modal_box_count">
                        <div>{{sel.total}}</div>
                    </div>
                    <button class="modal_box_add" @click="add()">+</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import header_main from './header/header_main';
    export default {
        components: {
            header_main,
        },
        name: "home",
        data: function() {
            return {
                total: 0,
                sel: {},
                products: [
                    {
                        img: '/img/banner2.png',
                    },
                    {
                        img: '/img/banner3.png'
                    }
                ],
                goods: [
                    {
                        title: 'MommyBaby',
                        list: [
                            {
                                brand: 1,
                                id: 1,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 1,
                                id: 2,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 1,
                                id: 3,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 1,
                                id: 4,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 1,
                                id: 5,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                        ]
                    },
                    {
                        title: 'MommyBaby',
                        list: [
                            {
                                brand: 2,
                                id: 1,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 2,
                                id: 2,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 2,
                                id: 3,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 2,
                                id: 4,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                            {
                                brand: 2,
                                id: 5,
                                modal: true,
                                status: false,
                                view: true,
                                price: 4500,
                                max: 56,
                                limit: 6,
                                total: 24,
                                title: 'Подгузники MommyBaby S (2)',
                                img: '/img/img.png',
                                matrix: [
                                    {
                                        count: 30,
                                        point: 5,
                                        price: 4500,
                                    },
                                    {
                                        count: 150,
                                        point: 25,
                                        price: 4450,
                                    },
                                    {
                                        count: 240,
                                        point: 40,
                                        price: 4400,
                                    },
                                    {
                                        count: 1200,
                                        point: 120,
                                        price: 4300,
                                    },
                                    {
                                        count: 3000,
                                        point: 500,
                                        price: 4200,
                                    }
                                ]
                            },
                        ]
                    }
                ]
            }
        },
        created() {
            if (localStorage.cart) {
                let data = JSON.parse(localStorage.cart);
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
