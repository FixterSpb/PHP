Vue.component('orderItem', {

    props: [
        'order'
    ],
    data() {
        return {
            statusList:
            {
                new: 'Новый',
            },
            status: '',
            id: 0,
        }
    },

    mounted(){
        switch (this.order.status){
            case 'new':
                this.status = "Новый";
        }

        this.id = this.order.id;
        console.dir(this.id);
    },

    template:
        `
            <tr class="order__tr">
                <td class="order__td"><a class="order__link" :href="'/order?id='+order.id">{{ order.id }}</a></td>
                <td class="order__td"><a class="order__link" :href="'/order?id='+order.id">{{ status }}</a></td>
                <td class="order__td"><a class="order__link" :href="'/order?id='+order.id">{{ order.total }}&nbsp;руб.</a></td>
            </tr>

        `
});

Vue.component('order-list', {
    data() {
        return {
            'orders': [],
        };
    },

    mounted() {
        this.$root.getJSON('/api/orders/get')
            .then(result =>{
                if (result.result === 0){
                    for (let item of result.data){
                        this.orders.push(item);
                    };
                }
            });
        console.dir(this.orders);
    },

    template:
        `<div>
            <table class="order__table" style="" cellspacing="0" cellpadding="0">
                <tr class="order__tr">
                    <th class="order__th">Номер заказа</th>
                    <th class="order__th" >Статус</th>
                    <th class="order__th" >Сумма</th>
                </tr>
                <orderItem  v-for="item of orders" :key="'order-' + item.id" :order="item"></orderItem>
            </table>
            
         </div>
`
})