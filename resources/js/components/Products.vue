<template>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <div class="row">
                <div class="col">Товары</div>
                <div class="col text-right"><a href="#" class="btn btn-primary btn-sm">Добавить</a></div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Название</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        mounted() {
            axios.get('webapi/products').then(res => {
                this.products = res.data.data
            })
        }
    }
</script>
