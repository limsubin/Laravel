<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <input v-model="email" class="form-control" type="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input v-model="password" class="form-control" type="password" placeholder="Password"/>
                    </div>
                    <button @click="login" class="btn btn-success pull-right">Login</button>
                </div>
            </div>
        </div>

        <pre>
            {{ $data }}
        </pre>
    </div>
</template>

<script>
export default {
    data () {
        return {
            email: '',
            password: ''
        }
    },
    methods:{
        login(){
            this.$http.get("")
        }
    }
    
}
</script>

<style>
    
</style>