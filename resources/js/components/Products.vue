<template>
    <div class="card">
        <div v-bind:class="{ 'isActive': isLoading, 'loader': true, 'loader-def': true }"></div>
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
                        <th>Цена <span class="help-block alert-danger p-1" v-if="errors.price">{{ errors.price[0] }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>
                            <form class="form-inline" action="" @submit.prevent="publish(product.id)">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="product.price" placeholder="Введите цену...">
                                </div>
                                <button type="submit" class="btn btn-success ml-1">></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form action="" class="m-3" @submit.prevent="save" v-else>
                <div class="row mb-3">
                    <div class="col">
                        <vue-dropzone 
                            ref="fileUploader" 
                            id="fileUploader"
                            :options="dropzoneOptions"
                            :destroyDropzone="false"
                            @vdropzone-success="fileUploaded" />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input id="name" v-model="form.name" type="text" class="form-control" placeholder="Введите название...">
                            <span class="help-block alert-danger p-1" v-if="errors.name">{{ errors.name[0] }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Категория</label>
                            <select id="category" v-model="form.category_id" class="form-control">
                                <option>Выберите категорию</option>
                                <option :value="category.id" v-for="category in options.categories" :key="category.id">{{ category.name }}</option>
                            </select>
                            <span class="help-block alert-danger p-1" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Сохранить</button> <a href="#" class="btn btn-dark" @click.prevent="cancel">Отменить</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <h5>Счет: {{ account.amount }}</h5>
            <form class="form-inline" action="" @submit.prevent="replenish">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Пополнить...">
                </div>
                 <button type="submit" class="btn btn-dark ml-1">></button>
            </form>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.css'

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        data() {
            return {
                products: [],
                newProduct: false,
                form: {
                    name: '',
                    category_id: null,
                    image_id: null
                },
                options: {
                    categories: []
                },
                errors: {},
                isLoading: false,
                dropzoneOptions: {
                    url: `/webapi/files`,
                    thumbnailWidth: 150,
                    resizeWidth: 400,
                    resizeHeight: 200,
                    resizeMethod: 'crop',
                    timeout: 0,
                    maxFilesize: 100,
                    maxFiles: 1,
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    }
                },
                account: {}
            }
        },
        methods: {
            getInitialData() {
                this.isLoading = true
                axios.get('webapi/products').then(res => {
                    this.products = res.data.products
                    this.options.categories = res.data.categories
                    this.account = res.data.account
                    this.isLoading = false
                })
            },
            add() {
                this.newProduct = !this.newProduct
            },
            save() {
                this.isLoading = true
                this.errors = {}
                axios.post('webapi/products', {...this.form}).then(res => {
                    this.products = [...this.products, res.data.data]
                    this.add()
                    this.isLoading = false
                }).catch(err => {
                    this.errors = {...err.response.data.errors}
                    this.isLoading = false
                })
                
            },
            publish(id) {
                this.isLoading = true
                this.errors = {}
                const product = _.find(this.products, ['id', id])
                product.category_id = product.category.id

                axios.patch(`/webapi/products/${id}`, {...product}).then(res => {
                    this.isLoading = false
                }).catch(err => {
                    this.errors = {...err.response.data.errors}
                    this.isLoading = false
                })
            },
            cancel() {
                this.add()
            },
            fileUploaded(file, response) {
                this.form.image_id = response
            },
            replenish() {
                axios.patch('webapi/accounts', {...this.form}).then(res => {
                    //
                })
            }
        },
        mounted() {
            this.getInitialData()
        }
    }
</script>
