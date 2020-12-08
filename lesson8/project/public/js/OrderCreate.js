Vue.component('orderProductItem',{
    props:
        [
            'product',
        ],

    mounted(){
        console.dir(this.product);
    },

    template:
        `<tr class="cart__tr">
            <td class="cart__td cart__td-name" :title="product.name">{{ product.name }}</td>
            <td class="cart__td cart__td-price">{{ product.price }}</td>
            <td class="cart__td cart__td-qty">{{ product.qty }}</td>
            <td class="cart__td cart__td-amount">{{ product.qty * product.price  }}</td>
        </tr>`
});

Vue.component('order-create', {

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
          this.$parent.getJSON('/api/orderCreate')
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
            <label for="comment">Комментарий</label>
            <br>
            <textarea name="comment" cols="100" rows="5" v-model.text="comment"></textarea>
            <br>
            <button @click.prevent="submit()">Подтвердить</button>
            
        </div>`
});