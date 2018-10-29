<template>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <h1>{{ category.name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Поиск...">
            </div>
            <div class="col">filter</div>
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
    props: {
        category: {
            required: true,
            type: Object
        }
    }
}
</script>

