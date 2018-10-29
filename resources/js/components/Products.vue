<template>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <div class="row">
                <div class="col">Товары</div>
                <div class="col text-right"><a href="#" class="btn btn-primary btn-sm" @click.prevent="add" v-if="!newProduct">Добавить</a></div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0" v-if="!newProduct">
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
            <form action="" class="m-3" @submit.prevent="save" v-else>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input id="name" v-model="form.name" type="text" class="form-control" placeholder="Введите название...">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Категория</label>
                            <select id="category" v-model="form.category" class="form-control">
                                <option>Выберите категорию</option>
                                <option :value="category.id" v-for="category in options.categories" :key="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                newProduct: false,
                form: {
                    name: '',
                    category: null
                },
                options: {
                    categories: []
                }
            }
        },
        methods: {
            getInitialData() {
                axios.get('webapi/products').then(res => {
                    this.products = res.data.products
                    this.options.categories = res.data.categories
                })
            },
            add() {
                this.newProduct = !this.newProduct
            },
            save() {
                axios.post('webapi/products').then(res => {
                    console.log(res)
                    this.add()
                }).catch(err => {
                    console.log(err.response.data)
                })
                
            }
        },
        mounted() {
            this.getInitialData()
        }
    }
</script>
