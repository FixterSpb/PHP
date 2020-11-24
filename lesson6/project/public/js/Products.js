Vue.component('productItem',{
    props: ['product'],
    data() {
        return{

        }
    },
    template:
        `<div class = "product">
            <a :href="'product/?id=' + product.id">
                <img class="product__image" :src="product.img" alt="">
                <p class="product__name">{{product.name}}</p>
            </a>
            <!-- TODO Звёзды  -->
            <p class="product__price">{{ product.price }} руб.</p>
        </div>`
});

Vue.component('products', {
    props: ['mode'],
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
            <h1 v-if="mode">Режим редактирования</h1>
            <productItem v-for="item of products" :key="item.id" :product="item">
            </productItem>
            
       </div>`
});