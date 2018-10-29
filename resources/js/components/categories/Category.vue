<template>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <h1>{{ category.name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Поиск...">
            </div>
            <div class="col-sm-4">
                <select v-model="params.order" class="form-control">
                    <option value="0" disabled>Сортировка</option>
                    <option v-for="order in options.order" :key="order.id" :value="order.param">{{ order.name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 mt-3" v-for="product in category.products" :key="product.id">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <h4><span class="badge badge-success">{{ product.price }} руб.</span></h4>
                        <a href="" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
                order: 0
            }
        }
    },
    props: {
        category: {
            required: true,
            type: Object
        }
    }
}
</script>

