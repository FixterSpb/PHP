Vue.component('cart-counter', {
    // props: [
    //     'count',
    // ],

    data(){
        return {
            showCount: 0,
        };
    },

    mounted(){
        this.$root.getJSON('/api/cart')
            .then(data => {
                if (data.result === 0){
                    this.showCount = data.data.length;
                }
            });
    },

    computed:{
        count() {
            return this.showCount;
        }
    },

    template: `<span>Корзина <span class=cartCounter v-if="count > 0">({{ count }})</span></span>`

    });

//