<template>
<div class="back">
  <!-- header 나중에 지우기 -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="opacity: 0.9;">
    <button type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
      <span class="navbar-toggler-icon"></span>
    </button> <div id="navbar1" class="collapse navbar-collapse justify-content-md-center"><ul class="navbar-nav"><li class="nav-item"><a href="/" class="navbar-brand router-link-active"><img src="/static/img/logo1-7.474cf47.png" width="150" alt="" class="d-inline-block align-top"></a></li> <li class="nav-item"><a href="/" class="nav-link router-link-active">Home</a></li>   <li class="nav-item"><a href="/shop" class="nav-link">Shop</a></li> <li class="nav-item"><a href="/community" class="nav-link">Community</a></li> <li class="nav-item"><a href="/profile" class="nav-link router-link-exact-active router-link-active">Mypage</a></li> <li class="nav-item"><a href="" class="nav-link">Logout</a></li></ul></div></nav>
  <!-- header 나중에 지우기 -->

    <div class="profile">
      <!-- <img src="static/img/background6.png" alt="" width="100%" height="150px" style="background"> -->
      <div style="width:100%; height:150px; background-color:#EBF6FA">
        <div class="email_name">
          <div style="font-size:40px">GoldSangWon</div>
          <div>GoldSangWon@gmail.com</div>
        </div>
      </div>
      <div style="position:absolute;">
        <p style="position:relative; top: -105px; left: 100px;">
          <img src="static/img/boss.png" alt="" weight="50px" height="50px" class="user">
        </p>
      </div>
    </div>

    <div style="margin:0px 110px">
      <div class="row">
        <div class="col-9">
        <div>
           <div class="btn-group mr-2" role="group" aria-label="First group">
           <button class="btn btn-active" 
              @click="day" 
              :class="{'btn': activeTab !== 1, 'is-active' : activeTab === 1}">
              <span>Day</span>
           </button>

           <button class="btn btn-active" 
              @click="week" 
              :class="{'btn': activeTab !== 2, 'is-active' : activeTab === 2}"
              style="border-left: solid 1px #F87079;">
              <span>Week</span>
            </button>

           <button class="btn btn-active" 
              @click="month" 
              :class="{'btn': activeTab !== 3, 'is-active' : activeTab === 3}"
              style="border-left: solid 1px #F87079;">
              <span>Month</span>
           </button>
           </div>
        </div>
        <br>
        <line-chart :chart-data="data"
                    :height="150"
                    :options="{responsive: true, maintainAspectRatio: true, scales:{yAxes:[{ticks:{max:1, min:-1, stepSize:1}}]},legend: {display: false}}">
        </line-chart>
          
         <div style="position:absolute;">
          <p style="position:relative; top: -370px; left: -14px;">
           <img src="static/img/smaile.png" alt="" weight="35" height="35">
          </p>
        </div>
        
        <div style="position:absolute;">
          <p style="position:relative; top: -215px; left: -13px;">
           <img src="static/img/normal.png" alt="" weight="35" height="35">
          </p>
        </div>

        <div style="position:absolute;">
          <p style="position:relative; top: -55px; left: -12px;">
           <img src="static/img/sad.png" alt="" weight="35" height="35">
          </p>
        </div>

    <br>
    <div class="card text-center">
      <div class="bubble">
        <h2 id="feedback"><q>&nbsp; {{this.feedback}}&nbsp; </q></h2>
      </div>
    </div>
   </div>

  <div class="col-3">
    <div class="row" style="margin: 70px 0px 20px 0px;">
      <div class="col-5" style="margin-left:40px;border-right: solid 1px lightgray;">
        <img src="static/img/po-2.png" alt="" weight="100px" height="100px">
        <div>긍정</div>
        <div style="font-size:40px">70%</div>
      </div>
      <div class="col-5">
        <img src="static/img/na-2.png" alt="" weight="100px" height="100px">
        <div>부정</div>
        <div style="font-size:40px">30%</div>
      </div>
    </div>
      <div class="grap">
        <canvas id="Chart2"></canvas>
      </div>
  </div>
  </div>
    <!-- 메뉴 선택가능 -->
    <hr>
 
    <br>
    <div class="row">
      <p id="triangle-right"></p>
      <h3>추천하는 아로마향</h3>
      <div class="select_box">
         <b-form-select calss="mb-3" v-model="selected" :options="gender">
          <template slot="first">
            <option :value="null" disabled>&nbsp;성별&nbsp;&nbsp;</option>
          </template>
         </b-form-select>
          <!-- <select class="selectpicker">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Barbecue</option>
          </select> -->
      </div>
    </div>
    <br>

      <!-- {{this.selected}} -->
        <div class="card text-center">
          <div class="row">
            <div class="col-lg-3 mb-2" v-for="(product, index) in productItems" @key="index" :key="index">
              <div class="card h-100" v-if="index < 4">
                <div class="card-body">

                  <div style="position:absolute;">
                    <p class="card-text" style="position: relative; top: -20px; left: 145px;">
                      <img :src="'static/img/'+index+'.png'" alt="" weight="110" height="110">
                    </p>
                  </div>
                </div>
                <router-link
                    :to = "'/products/' + product.id + '/view'">
                  <img :src="product.product_img" alt="" weight="290" height="270">
                </router-link>
                <br>
                <h5 class="card-title" v-html="product.product_name"></h5>
                <h4 class="card-title" v-html="product.product_price+'원'"></h4>
                <div class="card-title">
                  <br>
                  <router-link class="btn-view"
                    :to = "'/products/' + product.product_code + '/view'">자세히 보기</router-link>
                    <!-- product.id -->
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- /.row -->
      </div>
  </div>
</template>

<script>
import LineChart from './chart/LineChart.js'
import PieChart from './chart/PieChart.js'
import BarChart from './chart/BarChart.js'
import _ from 'lodash';

export default {
    components:{
        LineChart,
        PieChart,
        BarChart
    },
    data(){
        return {
            data:[],
            // row:[],
            // label:[],
            products:[],
            feedback: "",
            gender: [
              {text:'여성',value:'woman'},
              {text:'남성',value:'man'}
            ],

            age: [
              {text:'20대', value:'id_a'},
              {text:'30대', value:'user_id'},
              {text:'40대', value:'name_a'}
            ],//value에 값이 같은 경우 다른 것도 따라서 적용됨

            emotion: [
              {text:'슬픔', value:'id_e'},
              {text:'기쁨', value:'user_id_e'},
              {text:'보통', value:'name_e'}
            ],
            selected: null,
        options: [
          { value: null, text: 'Please select an option' },
          { value: 'a', text: 'This is First option' },
          { value: 'b', text: 'Selected Option' },
          { value: { C: '3PO' }, text: 'This is an option with object value' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ],
            activeTab: 0,

            
        }
    },
    beforeMount(){//mounted()
        // this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
        // this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
        // this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
        // this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');
            //chartjs

        this.axios.get('api/products')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })       

      this.day()//기본세팅
     },
     mounted(){
        var ctx = document.getElementById("Chart2");
        var myChart = new Chart(ctx, {
          type: 'pie',

          data: {
              datasets: [{
                data: [30,70],
                backgroundColor: ['#EB5238', '#75BB50'],
              }]
          },options: {responsive: true, maintainAspectRatio: false},
        }); 
     },
     computed:{
       productItems(){
         if(this.selected == null){
          //  this.axios.get('api/woman')
          //   .then(response =>{
          //     this.products = response.data
          //   })
           return _.orderBy(this.products, '')//빈 값으로 넣으면 for문에서 나오는 순서대로 나옴, 나중에 product테이블에 감정 수치별로 저장된 열 이름있으면 그냥 넣기만하면 됨
         }else if(this.selected == 'woman'){
           this.axios.get('api/woman')
            .then(response =>{
              this.products = response.data
            })
            return this.products
            // return _.orderBy(this.products, '')
         }else if(this.selected == 'man'){
           this.axios.get('api/man')
            .then(response =>{
              this.products = response.data
            })
            return this.products
          //  return _.orderBy(this.products, this.selected)
         }
          
       }
     },
    methods:{
        day(){
            this.axios.get('api/day')
              .then(response=>{
                  this.data = response.data
                  //this.row = response.data.rows
                  //this.label = response.data.labels
                  this.activeTab = 1;
                  this.feedback = response.data.temp
                  console.log(this.data)
              })
        },
        week(){
            this.axios.get('api/week')
              .then(response=>{
                  this.activeTab = 2;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
        },
        month(){
            this.axios.get('api/month')
              .then(response=>{
                  this.activeTab = 3;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
        },
        year(){
           this.axios.get('api/year')
              .then(response=>{
                  this.activeTab = 4;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
         }
    }
}
</script>

<style scoped>
.back{
  background-color: white;
}

.btn{
    background-color:white;
    border:solid 2px #F87079;
    /* border-radius:10px; */
    width: 80px;
    font-size:20px;
    /* margin:5px; */
}

.is-active {
  background-color:#F87079;
  color:white;
}

.btn:hover{
    background-color:#F87079;
    /* border:solid 1px white; */
    color:white;
    /* border-radius:10px; */
    /* padding:10px; */
    font-size:20px;
    /* margin:5px; */
}

.btn-view{
  background-color: #F87079;
  border:solid 2px #F87079;
  border-radius:10px;
  width: 115px;
  height: 50px;
  padding:10px;
  font-size:17px;
  margin:8px;
  color:white;
}

.btn-view:hover{
  background-color: white;
  border: #F87079 2px solid;
  color:#F87079;
  text-decoration: none;
}
/* select */
/* select option[selected]{
    background-color: #F87079;
} */

.card{
  border: solid 1px white;
}

#feedback{
  text-align:center;
  margin:40px;
}

h3{
  width: 85%;
  float: left;
  font-weight: bold;
}

#triangle-right {
  width: 0;
  height: 0;
  float: left;
  margin-right: 15px;
  border-top: 20px solid transparent;
  border-left: 30px solid #F87079;
  border-bottom: 20px solid transparent;
}

.select_box{
  float:right;
  margin: 5px;
}

.flex{
  width: 150px;
  margin: 5px;
}

/* 말풍선 */
.bubble 
{
position: relative;
width: 90%;/*750px*/
height: 120px;
padding: 0px;
margin: 0 auto;
background: 
linear-gradient(white, white) padding-box,
linear-gradient(to right, #FB9077, rgb(255, 60, 103)) border-box;
-webkit-border-radius: 31px;
-moz-border-radius: 31px;
border-radius: 31px;
border: transparent solid 3px;

}

.bubble:after 
{
content: '';
position: absolute;
border-style: solid;
border-width: 0 15px 15px;
border-color: #FFFFFF transparent;
display: block;
width: 0;
z-index: 1;
top: -15px;
left: 360px;
}

.bubble:before 
{
content: '';
position: absolute;
border-style: solid;
border-width: 0 17px 17px;
border-color: #FD636F transparent;
display: block;
width: 0;
z-index: 0;
top: -20px;
left: 358px;
}

.row{
  margin-left: 0px;
  margin-right: 0px;
}

.profile{
  /* width: 100%; */
  height: 210px;
  margin-bottom: 20px;
}

.user{
  background-color: white;
  /* border: solid 5px lightgray; */
  border-radius: 50%;
  width: 150px;
  height: 150px;
  padding: 10px;
}

.email_name{
  position: relative;
  left: 280px;
  top: 40px;
}

.grap{
  width: 280px;
  height: 280px;
  margin: 0 auto;
}

.col-5{
  text-align: center;
}
</style>
