<template>
    <div class="modal_box" :class="{'modal_close':!view}">
        <div class="modal_box_body">
            <div class="modal_box_body_close" @click="close"></div>
            <div class="modal_box_content">
                <div class="modal_box_content_title">Способ оплаты</div>
                <div class="modal_box_content_item" v-for="(item,index) in list" @click="payment(index)">
                    <div class="modal_box_content_item_icon" :style="{backgroundImage: 'url('+item.img+')'}"></div>
                    <div class="modal_box_content_item_body">
                        <div class="modal_box_content_item_body_selected" v-if="item.status"></div>
                        <div class="modal_box_content_item_body_title">{{item.title}}</div>
                        <div class="modal_box_content_item_body_desc">{{item.desc}}</div>
                    </div>
                </div>
                <div class="modal_box_content_add-cart">
                    <div class="modal_box_content_add-cart_title">Добавить карту</div>
                    <div class="modal_box_content_add-cart_arrow"></div>
                </div>
                <div class="modal_box_time_button">
                    <div @click="close">
                        <div>Готово</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "map_box_payment",
        props: ['view'],
        data: function() {
            return {
                list: [
                    {
                        id: 0,
                        img: '/img/money.svg',
                        title: 'Наличными',
                        desc: 'без чаевых',
                        status: true,
                    },
                    {
                        id: 1,
                        img: '/img/card.svg',
                        title: 'Оплата картой',
                        desc: '4850 .... .... .... 5458',
                        status: false
                    },
                    {
                        id: 2,
                        img: '/img/kaspi.svg',
                        title: 'Оплата картой',
                        desc: '',
                        status: false,
                    },
                    {
                        id: 3,
                        img: '/img/oncredit.svg',
                        title: 'На реализацию',
                        desc: 'Нужно закрыть до конца месяца',
                        status: false
                    },
                ]
            }
        },
        methods: {
            payment(index) {
                this.list.forEach(function(item, index, array) {
                    item.status = false;
                });
                this.list[ index ].status = true;
                this.$emit('change_payment',this.list[ index ]);
            },
            close() {
                this.$emit('view_modal',false);
                this.view = false;
            }
        }
    }
</script>

<style scoped lang="scss">
    .modal_box_body_close {
        z-index: 10;
    }
    .modal_close {
        display: none;
    }
    .modal_box_time_button {
        height: 70px;
        width: 100%;
        position: relative;
        & > div {
            height: 50px;
            position: absolute;
            background: #FFE033;
            top: 9px;
            left: 9px;
            right: 9px;
            border-radius: 3px;
            & > div {
                font-weight: bold;
                font-size: 18px;
                line-height: 22px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }
    }
    .modal_box_body {
        height: 436px !important;
    }
    .modal_box_content {
        position: relative;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        &_title {
            font-weight: bold;
            font-size: 18px;
            line-height: 22px;
            color: #000;
            margin: 30px 0 14px 16px;
        }
        &_add-cart {
            height: 60px;
            border-bottom: 1px solid gainsboro;
            position: relative;
            &:hover, &:active {
                background: rgb(245,245,245);
            }
            &_title {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                font-size: 14px;
                line-height: 18px;
                font-weight: bold;
            }
            &_arrow {
                background: url('/img/arrow-right.svg') no-repeat center;
                width: 6px;
                height: 11px;
                right: 25px;
                position: absolute;
                top: 50%;
                transform: translate(0,-50%);
            }
        }
        &_item {
            overflow: hidden;
            display: grid;
            grid-template-columns: 50px auto;
            grid-gap: 7px;
            height: 60px;
            &:hover, &:focus {
                background: rgb(245,245,245);
            }
            &_icon {
                width: 30px;
                height: 30px;
                background: no-repeat center;
                position: relative;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
            &_body {
                position: relative;
                margin: 12px 0 0 0;
                &_selected {
                    width: 24px;
                    height: 14px;
                    background: url(/img/selected.svg) no-repeat center;
                    position: absolute;
                    right: 15px;
                    top: 10px;
                }
                &_title {
                    font-size: 14px;
                    line-height: 18px;
                    color: #000;
                    font-weight: bold;
                }
                &_desc {
                    font-size: 13px;
                    line-height: 17px;
                    color: #989898;
                }

            }

        }
    }
</style>
