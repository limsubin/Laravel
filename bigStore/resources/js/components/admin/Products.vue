<template>
    <div>
        <table class="table table-responseive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Product</td>
                    <td>Units</td>
                    <td>Price</td>
                    <td>Description</td>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(product, index) in products" @key="index" @dblclick="editingItem = product" :key="index">
                    <td>{{index+1}}</td>
                    <td v-html="product.name"></td>
                    <!-- <td>태그에 넣었을 때  v-model 오류 -->
                    <td><input v-model="product.units">{{product.units}}</td>
                     <td><input v-model="product.price">{{product.price}}</td>
                      <td><input v-model="product.description">{{product.description}}</td>
                </tr>
            </tbody>
        </table>
        <modal @close="endEditing" :product="editingItem" v-show="editingIten != null"></modal>
        <modal @close="addProduct" :product="addingProduct" v-show="addingProduct != null"></modal>
        <br>
        <button class="btn btn-primary" @click="newProduct">Add New Product</button>
    </div>
</template>

<script>
import Modal from './ProductModal'

export default {
    data(){
        return{
            products:[],
            editingItem:null,
            addingProduct:null
        }
    },
    components: {Modal},
    beforeMount(){
        axios.get('/api/products/').them(response => this.products = response.data)
    },
    methods:{
        //새 로컬 제품 객체를 시작하려고 할때 호출
        newProduct(){
            this.addingProduct = {
                name:null,
                units:null,
                price:null,
                image:null,
                description:null,
            }
        },
        //제품 편집이 끝나면 호출
        endEditing(product){
            this.editingItem = null

            let index = this.products.indexOf(product)
            let name = product.name
            let units = product.units
            let price = product.price
            let description = product.description

            axios.put('/api/products/${product.id}', {name, units, price, description})
             .then(response => this.products[index] = product)
        },
        //우리가 새로운 제품을 추가하고 싶을 때 호출
        addProduct(product){
            this.addingProduct = null

            let name = product.name
            let units = product.units
            let price = product.price
            let description = product.description
            let image = prodcut.image

            axios.post("/api/products/", {name, units, price, description, image})
             .then(response => this.products.push(product))
        }
    }
}
</script>

<style>

</style>
