<template>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <h1>{{ category.name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Поиск..." @keyup.enter="search" v-model="params.search">
            </div>
            <div class="col-sm-4">
                <select v-model="params.order" class="form-control" @change.prevent="sort">
                    <option value="0" disabled>Сортировка</option>
                    <option v-for="order in options.order" :key="order.id" :value="order.param">{{ order.name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 mt-3" v-for="product in products" :key="product.id">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <h4><span class="badge badge-success">{{ product.price }} руб.</span></h4>
                        <a href="" class="btn btn-primary" @click.prevent="purchase(product.id)">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bus } from './../../bus'
export default {
    data() {
        return {
            options: {
                order: [
                    { id:1, name:'По цене', param: 'price'},
                    { id:2, name:'По имени', param: 'name'},
                ]
            },
            params: {
                search: '',
                order: ''
            },
            products: this.category.products
        }
    },
    methods: {
        search() {
            axios.get('/webapi/catalog/products', {
                params: {
                    category_id: this.category.id,
                    search: this.params.search
                }
            }).then(res => {
                this.products = res.data.data
            })
        },
        sort() {
            this.products = (this.params.order == 'price') ? _.sortBy(this.products, function(o) {
                return parseFloat(o.price)
            }) : _.sortBy(this.products, [this.params.order])
            
        },
        purchase(productId) {
           axios.post('/webapi/catalog/products/purchase', {
                params: {
                    productId
                }
            }).then(res => {
                //
            }) 
        }
    },
    props: {
        category: {
            required: true,
            type: Object
        }
    },
    mounted() {
        Bus.$on('users', users => {
            console.log(users)
        });
    }
}

</script>

