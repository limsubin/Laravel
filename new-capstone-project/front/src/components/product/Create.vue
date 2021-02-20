<template>
<!-- 상품 등록 -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                   <form @submit.prevent="create">
                    <div class="form-group">
                        <label for="">Name:</label>
                        <input type="file" class="form-control"
                            @change="imageChanged">
                    </div>

                    <div class="form-group">
                        <label for="">Name:</label>
                        <input name="name" type="text" class="form-control"
                            v-model="product.name" 
                            v-validate="'required'">
                        <!-- 입력을 안 하면 입력 안했다는 에러메시지 출력 -->
                        <div class="help-block alert alert-danger" v-show="errors.has('name')">{{errors.first('name')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="">Price:</label>
                        <input name="price" type="number" class="form-control" 
                            v-model="product.price"
                            v-validate="'max_value:50|min_value:1'">
                        <div class="help-block alert alert-danger" v-show="errors.has('price')">{{errors.first('price')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="">Description:</label>
                        <textarea class="form-control"  v-model="product.description"></textarea>
                    </div>
                    <!-- v-show : 엘리먼트를 조건부로 표시하기 위한 옵션, 항상 렌더링 되고 DOM에 남아있음-->
                    <!--  v-show="product.name && product.price && product.description", @click="create" -->
                    <input type="submit" class="btn btn-success pull-right" value="Create">
                   </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            product:{
                name: '',
                price: 0,
                description:'',
                image:''
            }
        }
    },
    methods:{
        imageChanged(e){
            console.log(e.target.files[0])
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) =>{
                this.product.image = e.target.result
            }

            console.log(this.product)
        },

        create(){
            // this.$validator.updateDictionary({
            //     'al':{
            //         attributes:{
            //             name:'emri'
            //         }
            //     }
            // })

            // this.$validator.setLocale('al')

            this.$validator.validateAll().then(()=>{
                this.$http.post('api/products', this.product) //ProductController@store : Product::create($request->all());
                    .then(response =>{
                        this.$router.push('/feed')
                    })
            })
        }
    }
}
</script>

<style>

</style>
