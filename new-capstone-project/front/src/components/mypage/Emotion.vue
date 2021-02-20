<template>
<div>
    <div class="row">
        <div>
           <button class="btn btn-active" 
              @click="day" 
              :class="{'btn': activeTab !== 1, 'is-active' : activeTab === 1}">
              <span>Day</span>
           </button>

           <button class="btn btn-active" 
              @click="week" 
              :class="{'btn': activeTab !== 2, 'is-active' : activeTab === 2}">
              <span>Week</span>
            </button>

           <button class="btn btn-active" 
              @click="month" 
              :class="{'btn': activeTab !== 3, 'is-active' : activeTab === 3}">
              <span>Month</span>
           </button>

           <button class="btn btn-active" 
              @click="year" 
              :class="{'btn': activeTab !== 3, 'is-active' : activeTab === 4}">
              <span>Year</span>
           </button>
        </div>

        <div class="col-sm-12">
            <line-chart :chart-data="data"
                        :height="150"
                        :options="{responsive: true, maintainAspectRatio: true, scales:{yAxes:[{ticks:{max:1, min:-1, stepSize:1}}]}}">
            </line-chart>
         <div style="position:absolute;">
          <p style="position:relative; top: -410px; left: -14px;">
           <img src="src/assets/img/smaile.png" alt="" weight="35" height="35">
          </p>
        </div>
        
        <div style="position:absolute;">
          <p style="position:relative; top: -230px; left: -13px;">
           <img src="src/assets/img/normal.png" alt="" weight="35" height="35">
          </p>
        </div>

        <div style="position:absolute;">
          <p style="position:relative; top: -55px; left: -12px;">
           <img src="src/assets/img/sad.png" alt="" weight="35" height="35">
          </p>
        </div>

   <br>
   <div class="container">
    <div class="card text-center">
      <div class="bubble">
        <h2 id="feedback"><q>&nbsp; {{this.feedback}}&nbsp; </q></h2>
      </div>
    </div>
    <!-- 메뉴 선택가능 -->
    <hr>
 
    <br>
    <div class="row">
       <p id="triangle-right"></p>
       <h3>추천하는 아로마향</h3>
    
       <div class="select_box">
        <v-flex>
          <v-select
            v-model="selected"
            :items="emotion"
            item-text="text"
            item-value="value"
            color="red lighten-1"
            attach
            chips
            label="감정"
            multiple
          ></v-select>
        </v-flex>
       </div>

       <div class="select_box">
        <v-flex>
          <v-select
            v-model="selected"
            :items="age"
            item-text="text"
            item-value="value"
            color="red lighten-1"
            attach
            chips
            label="나이"
            multiple
          ></v-select>
        </v-flex>&nbsp;
      </div>
      <div class="select_box">
        <v-flex>
          <v-select
            v-model="selected"
            :items="gender"
            item-text="text"
            item-value="value"
            color="red lighten-1"
            attach
            chips
            label="성별"
            multiple
          ></v-select>
        </v-flex>
      </div>
    </div>
    <br>

{{this.selected}}
    <div class="card text-center">
    <div class="row">
      <div class="col-lg-3 mb-2" v-for="(product, index) in productItems" @key="index" :key="index">
        <div class="card h-100" v-if="index < 4">
          <div class="card-body">

            <div style="position:absolute;">
              <p class="card-text" style="position: relative; top: -20px; left: 145px;">
                <img :src="'src/assets/img/'+index+'.png'" alt="" weight="120" height="120">
              </p>
            </div>
          </div>
          <router-link
              :to = "'/products/' + product.id + '/view'">
            <img :src="product.image" alt="" weight="300" height="300">
          </router-link>
          <h4 class="card-header center" v-html="product.name"></h4>
          <div class="card-footer">
            <br>
            <router-link class="btn-view"
              :to = "'/products/' + product.id + '/view'">자세히 보기</router-link>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- /.row -->
  </div>
</div>
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
              {text:'남성',value:'id'},
              {text:'여성',value:'user_id_a'}
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
            selected: [],
            activeTab: 0
        }
    },
    beforeMount(){//mounted()
        // this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
        // this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
        // this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
        // this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');

        this.$http.get('api/products')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })       

      this.day()//기본세팅
     },
     computed:{
       productItems(){
         if(this.selected == []){
           return _.orderBy(this.products, '')//빈 값으로 넣으면 for문에서 나오는 순서대로 나옴, 나중에 product테이블에 감정 수치별로 저장된 열 이름있으면 그냥 넣기만하면 됨
         }else{
           return _.orderBy(this.products, this.selected)
         }
          
       }
     },
    methods:{
        day(){
            this.$http.get('api/day')
              .then(response=>{
                  this.data = response.data
                  //this.row = response.data.rows
                  //this.label = response.data.labels
                  this.activeTab = 1;
                  this.feedback = response.data.temp
                  //console.log(this.row, this.label)
              })
        },
        week(){
            this.$http.get('api/week')
              .then(response=>{
                  this.activeTab = 2;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
        },
        month(){
            this.$http.get('api/month')
              .then(response=>{
                  this.activeTab = 3;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
        },
        year(){
            this.$http.get('api/year')
              .then(response=>{
                  this.activeTab = 4;
                  this.data = response.data
                  this.feedback = response.data.temp
              })
         }
    }
}
</script>

<style>
img{
  visibility:hidden;
}
.btn{
    background-color:white;
    border:solid 2px #F87079;
    border-radius:10px;
    padding:10px;
    font-size:20px;
    margin:5px;
}

.is-active {
  background-color:#F87079;
  color:white;
}

.btn:hover{
    background-color:#F87079;
    border:solid 2px white;
    color:white;
    border-radius:10px;
    padding:10px;
    font-size:20px;
    margin:5px;
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

#feedback{
  text-align:center;
  margin:40px;
}

h3{
  margin: 7px;
  padding: 15px;
  float: left;
  font-weight: bold;
}

#triangle-right {
  width: 0;
  height: 0;
  float: left;
  margin-top:13px;
  border-top: 20px solid transparent;
  border-left: 30px solid #F87079;
  border-bottom: 20px solid transparent;
}

.select_box{
  float:right;
}

.flex{
  width: 150px;
  margin: 5px;
}

/* 말풍선 */
.bubble 
{
position: relative;
width: 70%;/*750px*/
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
</style>