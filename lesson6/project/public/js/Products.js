Vue.component('productItem',{
    props: ['product'],
    methods: {
      addToCart(){
          this.$root.getJSON('/api/cart/' + this.product.id, 1)
              .then(data => console.dir(data));
          // return console.dir(this.$parent);
      }
    },
    template:
        `<div class = "product">
            <a :href="'product/?id=' + product.id">
                <img class="product__image" :src="product.img" alt="">
                <p class="product__name">{{product.name}}</p>
            </a>
            <p class="product__price">{{ product.price }} руб.</p>
            <button @click.prevent="addToCart()">В корзину</button>
        </div>`
});

Vue.component('products', {
    data() {
      return {
          products: [],
      }
    },

    mounted(){
        this.$parent.getJSON('api/products')
            .then(data => {
                for (let el of data) {
                    this.products.push(el);
                }
            });
    },

    template:
        `<div class="products-box">
            <productItem v-for="item of products" :key="item.id" :product="item">
            </productItem>            
       </div>`
});