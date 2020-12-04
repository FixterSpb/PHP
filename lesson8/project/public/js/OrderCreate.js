Vue.component('productItem',{
    props:
        [
            'product',
        ],

    methods: {
        // setQty(){
        //     console.log(this.product.id + ": " + this.product.qty);
        // },
        // qtyChange(){
        //     if(this.product.qty < 1){
        //         this.product.qty = this.qty_old;
        //         return;
        //     }
        //     if(this.qty_old != this.product.qty){
        //         this.$root.putJSON('api/cart', {id: this.product.id, quantity: this.product.qty - this.qty_old})
        //             .then(data => {
        //                 if (data.result != 0) {
        //                     //TODO Обработка ошибок
        //                 }
        //             }
        //             );
        //     }
        // },
        // qtySave(){
        //     this.qty_old = this.product.qty;
        // },
        //
        // remove(){
        //     this.$root.deleteJSON('api/cart', {id: this.product.id})
        //         .then(data => {
        //             console.dir(data);
        //             if (data.result !== 0){
        //                 //TODO Обработка ошибок
        //             }else{
        //                 this.$parent.update();
        //                 // this.remove();
        //             }
        //         })
        // },
    },
    computed: {
       // calc(){
       //     return this.product.price * this.product.qty;
       // }
    },
    template:
        `<tr class="cart__tr">
<!--            <td class="cart__td cart__td-number">{{ number }}</td>-->
            <td class="cart__td cart__td-name" :title="product.name">{{ product.name }}</td>
            <td class="cart__td cart__td-price">{{ product.price }}</td>
            <td class="cart__td cart__td-qty">{{ product.qty }}</td>
            <td class="cart__td cart__td-amount">{{ product.qty * product.price  }}</td>
<!--            <td class="cart__td cart__delete"><button class="cart__bnDelete" @click.prevent="remove()">X</button></td>            -->
        </tr>`
});

Vue.component('order-create', {

    data() {
        return {
            products: [],
            total: 0,
        }
    },

    mounted(){
        this.update();
    },

    methods:{
      update(){
          this.$parent.getJSON('/api/orders/create')
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
    },

    template:
        `
        <div>
            <table class="cart__table">
                <tr class="cart__tr">
                    <th class="cart__th cart__th-name">Наименование</th>
                    <th class="cart__th cart__th-price">Цена, руб.</th>
                    <th class="cart__th cart__th-qty">Количество, шт.</th>
                    <th class="cart__th cart__th-amount">Сумма, руб.</th>
                    <th class="cart__th cart__th-delete"></th>
                </tr>
                    <productItem v-for="item of products" :key="item.id" :product="item" class="cart__tr"/>
                     <!-- :number="getNumber()" --> 
                <tr class="cart__tr">
                    <th class="cart__total" colspan="3">Итого:</th>
                    <th class="cart__total">{{ total}}</th>
                </tr>    
<!--                <tr>-->
<!--                    <td  style="text-align: center" colspan="5"> <button onclick="window.location.replace('/orders/create')">К оформлению</button></td>-->
<!--                </tr>                             -->
            </table>
        </div>`
});