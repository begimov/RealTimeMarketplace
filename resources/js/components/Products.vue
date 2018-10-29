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
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>
                            <form class="form-inline" action="" @submit.prevent="publish">
                                <div class="form-group">
                                    <input type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">+</button>
                            </form>
                        </td>
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
                            <select id="category" v-model="form.category_id" class="form-control">
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
                    category_id: null
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
                axios.post('webapi/products', {...this.form}).then(res => {
                    this.products = [...this.products, res.data.data]
                    this.add()
                }).catch(err => {
                    console.log(err.response.data)
                })
                
            },
            publish() {
                console.log('OK')
            }
        },
        mounted() {
            this.getInitialData()
        }
    }
</script>
