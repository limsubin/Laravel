<template>
<!-- 모든 사용자 데이터를 가져와서 페이지에 표시 -->
	<div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Joined</td>
                    <td>Total Orders</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" @key="index" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.orders.length}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
        data(){
            return {
                users : []
            }
        },
        beforeMount(){
            this.$http.get('http://localhost:8000/api/users/')
            .then(response => {
                this.users = response.data
            })
            .catch(error => {
                console.error(error);
            })     
        }
    }
</script>