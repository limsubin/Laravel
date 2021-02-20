export default function(Vue){
    let authenticatedUser = {}

    Vue.auth = {
        //로그인할 때 로컬스트레지에 저장해준다
        setToken(token, expiration) {
            localStorage.setItem('token', token)
            localStorage.setItem('expiration', expiration)
        },

        getToken() {
            //setToken()을 객체에 담는다
            var token = localStorage.getItem('token');
            var expiration = localStorage.getItem('expiration');

            //token, expiration이 없으면 null 반환
            if(!token || !expiration)
                return null;

            //일정시간이 지나면 localStorage에 있는 token 삭제
            //expiration : 만료시간    
            if(Date.now() > parseInt(expiration)){
                this.destroyToken()
                return null;
            //만료시간이 아니면 token을 반환    
            }else{
                return token;
            }
        },
        //일정시간 만료 됐을 때 삭제하기 위한 것
        destroyToken() {
            localStorage.removeItem('token')
            localStorage.removeItem('expiration')
        },

        //main.js에 로그인 유무로 이용
        isAuthenticated() {
            //login.vue에서 로그인했을 때setToken()한 token에 유무확인
            if(this.getToken())
                return true
            else
                return false
            
        },
        //상품들한테 사용자 정보를 전달하기 위함(인증 확장)
        setAuthenticatedUser(data){
            authenticatedUser = data
        },
        
        //상품들한테 사용자 정보를 담은 메소드
        getAuthenticatedUser(){
            return authenticatedUser
        }
    }
//Object.defineProperty() : 정적 메서드는 객체에 직접 새로운 속성을 정의하거나 이미 존재하는 속성을 수정한 후 그 객체를 반환합니다.
//prototype : 어디서나 액세스 할 수 있도록 정의
    Object.defineProperties(Vue.prototype,{
        $auth:{
            get() {
                return Vue.auth;
            }
        }
    })
}