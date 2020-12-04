Vue.component('cartItem',{
    props:
        [
            'product',
            'number'
        ],
    data() {
        return {
            qty_old:this.product.qty,
        }
    },
    methods: {
        setQty(){
            console.log(this.product.id + ": " + this.product.qty);
        },
        qtyChange(){
            if(this.product.qty < 1){
                this.product.qty = this.qty_old;
                return;
            }
            if(this.qty_old != this.product.qty){
                this.$root.putJSON('api/cart', {id: this.product.id, quantity: this.product.qty - this.qty_old})
                    .then(data => {
                        if (data.result != 0) {
                            //TODO Обработка ошибок
                        }
                    }
                    );
            }
        },
        qtySave(){
            this.qty_old = this.product.qty;
        },

        remove(){
            this.$root.deleteJSON('api/cart', {id: this.product.id})
                .then(data => {
                    console.dir(data);
                    if (data.result !== 0){
                        //TODO Обработка ошибок
                    }else{
                        this.$parent.update();
                        // this.remove();
                    }
                })
        },
    },
    computed: {
       calc(){
           return this.product.price * this.product.qty;
       }
    },
    template:
        `<tr class="cart__tr">
<!--            <td class="cart__td cart__td-number">{{ number }}</td>-->
            <td class="cart__td cart__td-name" :title="product.name">{{ product.name }}</td>
            <td class="cart__td cart__td-price">{{ product.price }}</td>
            <td class="cart__td cart__td-qty">
                <input type="number" class="cart__qty" v-model.number="product.qty" max="100000" @focus="qtySave()" @blur="qtyChange()">
            </td>
            <td class="cart__td cart__td-amount">{{ calc }}</td>
            <td class="cart__td cart__delete"><button class="cart__bnDelete" @click.prevent="remove()">X</button></td>            
        </tr>`
});

Vue.component('cart', {

    data() {
        return {
            products: [],
            empty: true,
            number: 1,
        }
    },

    mounted(){
        this.update();
    },

    computed:{
        total(){
            let total = 0;
            this.products.forEach(product => total += product.price * product.qty);
            return total;
        }
    },

    methods:{
      getNumber(){
          return this.number++;
      },
      update(){
          this.$parent.getJSON('/api/cart')
              .then(data => {
                  if(data.result === 0) {
                      this.empty = data.data.length === 0;
                      this.products = [];
                      this.$root.$refs.cartCounter.showCount = data.data.length;
                      for (let el of data.data) {
                          this.products.push(el);
                      }
                  }else{
                      console.dir(data);
                  }
              });
      },

        toOrder(){

        }
    },

    template:
        `
        <div>
            <h2 class="cart__empty" v-if="empty">Корзина пуста</h2>
            <table class="cart__table" v-else>
                <tr class="cart__tr">
    <!--                <th class="cart__th cart__th-number">№ п/п</th>-->
                    <th class="cart__th cart__th-name">Наименование</th>
                    <th class="cart__th cart__th-price">Цена, руб.</th>
                    <th class="cart__th cart__th-qty">Количество, шт.</th>
                    <th class="cart__th cart__th-amount">Сумма, руб.</th>
                    <th class="cart__th cart__th-delete"></th>
                </tr>
                    <cartItem v-for="item of products" :key="item.id" :product="item" class="cart__tr"/>
                     <!-- :number="getNumber()" --> 
                <tr class="cart__tr">
                    <th class="cart__total" colspan="3">Итого:</th>
                    <th class="cart__total">{{ total}}</th>
                </tr>    
                <tr>
                    <td  style="text-align: center" colspan="5"> <button onclick="window.location.replace('/orders/create')">К оформлению</button></td>
                </tr>                             
            </table>
        
        </div>`
});