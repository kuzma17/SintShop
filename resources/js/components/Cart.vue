<template>
    <div>
        <div class="clean_cart">
            <a href="" @click="cleanCart()">{{$t('clean_cart')}}</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ $t('good_name') }}</th>
                <th scope="col" class="hidden-mobile">{{ $t('code') }}</th>
                <th scope="col" class="hidden-mobile">{{ $t('price') }}</th>
                <th scope="col">{{ $t('good_count') }}</th>
                <th scope="col">{{ $t('good_sum') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(good) in products" :key="good.id">
                <td><a :href="'/catalog/'+good.category.slug+'/'+good.slug" ><img :src="good.photo"> {{good.name}}</a></td>
                <td class="hidden-mobile">{{good.code}}</td>
                <td class="hidden-mobile">{{good.price}} {{$t('curr')}}</td>
                <td>
                    <input-quantity
                        v-model="good.qty"
                        @click="editCart(good)"
                    ></input-quantity>
                </td>
                <td>{{Math.round(good.price * good.qty, 2)}} {{$t('curr')}}</td>
                <td><i @click="removeItem(good)" class="fa-regular fa-trash-can delete" :title="$t('delete_good')"></i></td>
            </tr>
            </tbody>
        </table>
        <div class="total">
            {{$t('in_cart_item')}} <span class="count">{{this.cart_count}}</span> {{$t('in_sum')}} <span class="sum">{{this.total_sum}} {{$t('curr')}}</span>
        </div>
    </div>
</template>

<script>


export default {
    name: "Cart",
    props:[
        'goods',
        'count',
        'sum'
    ],
    mounted() {
        this.products = this.goods
        this.cart_count = this.count
        this.total_sum = this.sum
    },
    data(){
        return{
            products: [],
            cart_count: 0,
            total_sum: 0
        }
    },
    methods:{
        editCart(good){
            let data ={
                'id': good.id,
                'qty': good.qty
            }
            axios.post('/cart/edit', data)
                .then(response => {
                    //console.log(response.data);
                    this.cart_count = response.data.cart_count
                    this.total_sum = response.data.total_sum
                    this.emitter.emit('CartCount', {'cart_count': response.data.cart_count})
                })
                .catch(error => {
                    console.log(error);
                })
        },

        removeItem(good){
            let data ={
                'id': good.id,
            }
            axios.post('/cart/remove', data)
                .then(response => {
                    //console.log(response.data);
                    delete this.products[good.id]
                    this.cart_count = response.data.cart_count
                    this.total_sum = response.data.total_sum
                    this.emitter.emit('CartCount', {'cart_count': response.data.cart_count})
                })
                .catch(error => {
                    console.log(error);
                })
        },

        cleanCart(){
            axios.post('/cart/clean')
                .then(response => {
                    //console.log(response.data);
                    this.products = []
                    this.cart_count = 0
                    this.total_sum = 0
                    this.emitter.emit('CartCount', {'cart_count': 0})
                })
                .catch(error => {
                    console.log(error);
                })
        }


    }
}
</script>

<style scoped>

</style>
