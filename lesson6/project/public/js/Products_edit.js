/* Больше не используется
Vue.component('productItem',{
    props:
        [
            'product',
            'mode'
        ],
    methods: {
        productDelete: function(id){
            return "location.href = '/edit/?id=" + id + "&action=delete'";
        }
    },

    template:
        `<div class = "product">
            <a :href="'/edit/?id=' + product.id + '&action=update'">
                <img class="product__image" :src="product.img" alt="">
                <p class="product__name">{{product.name}}</p>
            </a>
            <p class="product__price">{{ product.price }} руб.</p>   
                        
            <button v-if="product.status == 'active' " :onclick="productDelete(product.id)">Удалить</button>
            <button v-else disabled>Удалён</button>         
        </div>`
});

Vue.component('products-edit', {
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
        this.$parent.getJSON('api/allProducts/')
            .then(data => {
                for (let el of data) {
                    this.products.push(el);
                }
            });
    },

    template:
        `<div class="products-box">
            <h1 v-if="mode">Режим редактирования</h1>
            <productItem v-for="item of products" :key="item.id" :product="item" :mode="mode">
            </productItem>
            
       </div>`
});

*/