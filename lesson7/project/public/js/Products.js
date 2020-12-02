Vue.component('productItem',{
    props:
        [
            'product',
            'mode'
        ],
    data(){
        return {
            href: ""
        };
    },
    methods: {
      addToCart(){
          this.$root.putJSON('/api/cart/', {id: this.product.id, quantity: 1})
              .then(data => {
                  if (data.result === 0){
                      this.$root.$refs.cartCounter.showCount = data.data.countCart;
                  }
                  console.dir(data);
                  console.dir(this);
              });
          // return console.dir(this.$parent);
      },
        deleteProduct(){
          this.$root.deleteJSON('api/products', {id: this.product.id})
              .then(data => {
                  console.dir(data);
                  if(data.result === 0){
                      console.dir(data.data);
                      this.product.status = data.data.status;
                  };

              });
      }
    },

    mounted() {
        if(this.mode === 'edit'){
            this.href = `edit/?id=${this.product.id}&action=update`;
        }else{
            this.href = `product/?id=${this.product.id}`;
        }

    },
    template:
        `<div class = "product">
            <a :href="href">
                <img class="product__image" :src="product.img" alt="">
                <p class="product__name">{{product.name}}</p>
            </a>
            <p class="product__price">{{ product.price }} руб.</p>
            <button v-if="mode === 'view'"    @click.prevent="addToCart()">В корзину</button>
            <button v-else-if="mode === 'edit' && product.status === 'active'"    @click.prevent="deleteProduct()">Удалить</button>
            <button v-else disabled>Удалён</button>
            
        </div>`
});

Vue.component('products', {
    props:
    [
        'mode'
    ],
    data() {
      return {
          products: [],
      }
    },

    mounted(){
        let url = "";
        if (this.mode === 'view'){
            url = 'api/products';
        }else{
            url = 'api/allProducts'
        }
        this.$parent.getJSON(url)
            .then(data => {
                for (let el of data) {
                    this.products.push(el);
                }
            });
    },

    template:
        `<div class="products-box">
            <productItem v-for="item of products" :key="item.id" :product="item" :mode="mode">
            </productItem>            
       </div>`
});