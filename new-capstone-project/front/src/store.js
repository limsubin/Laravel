export default function(Vue){
    let items= []
    let showCart= false
    let verified= false
    let quantity= 1

    Vue.store = {
            total() {
                var total = 0;
                for(var i = 0; i < this.items.length; i++) {
                    total += this.items[i].price;
                }
                return total;
            },
            addToCart(item) {
                item.quantity += 1;
                this.items.push(item);
            },
            removeFromCart(item) {
                item.quantity -= 1;
                this.items.splice(this.items.indexOf(item), 1);
            }
        }
    }
//Object.defineProperty() : 정적 메서드는 객체에 직접 새로운 속성을 정의하거나 이미 존재하는 속성을 수정한 후 그 객체를 반환합니다.
//prototype : 어디서나 액세스 할 수 있도록 정의
    Object.defineProperties(Vue.prototype,{
        $store:{
            get() {
                return Vue.store;
            }
        }
    })
}