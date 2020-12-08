Vue.component('order', {

    props:[
        'id',
    ],

    data() {
        return {
            products: [],
            total: 0,
            comment: '',
        }
    },

    mounted(){
        this.update();
    },

    methods:{
        update(){
            this.$parent.getJSON('/api/orderItem?id=' + this.id)
                .then(result => {
                    if (result.result === 0) {
                        console.dir(result.data);
                        result.data.forEach(item => {
                                this.products.push(item)
                                this.total += item.qty * item.price;
                            }
                        )
                    }
                });
        },
        submit() {
            this.$parent.postJSON('/api/orders/create', {comment: this.comment})
                .then(result => {
                    if (result.result === 0){
                        window.location.replace('/orders')
                    }
                });
        }
    },

    template:
        `
        <div style="max-width: 768px; margin: 0 auto">
            <table class="cart__table">
                <tr class="cart__tr">
                    <th class="cart__th cart__th-name">Наименование</th>
                    <th class="cart__th cart__th-price">Цена, руб.</th>
                    <th class="cart__th cart__th-qty">Количество, шт.</th>
                    <th class="cart__th cart__th-amount">Сумма, руб.</th>
                </tr>
                    <orderProductItem v-for="item of products" :key="item.id" :product="item" class="cart__tr"/>
                     <!-- :number="getNumber()" --> 
                <tr class="cart__tr">
                    <th class="cart__total" colspan="3">Итого:</th>
                    <th class="cart__total">{{ total}}&nbsp;руб.</th>
                </tr>    
            </table>
            <br>
            <p>Комментарий:</p>
            <br>
            <p>{{ comment }}</p>
            <br>
            <button @click.prevent="submit()">Подтвердить</button>
            
        </div>`
});