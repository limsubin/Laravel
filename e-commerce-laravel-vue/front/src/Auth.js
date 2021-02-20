export default {
    user: {
        authenticated: false,
        profile: null
    },
    check() {
        if (localStorage.getItem('jwt') !== null) {
            Vue.http.get(
                'api/user',
            ).then(response => {
                this.user.authenticated = true
                this.user.profile = response.data.data
            })
        }
    },
    register(context, name, email, password) {
        Vue.http.post(
            'api/register',
            {
                name: name,
                email: email,
                password: password
            }
        ).then(response => {
            context.success = true
        }, response => {
            context.response = response.data
            context.error = true
        })
    },
    signin(context, email, password) {
        Vue.http.post(
            'api/login',
            {
                email: email,
                password: password
            }
        ).then(response => {
            context.error = false
            localStorage.setItem('jwt', response.data.meta.token)
            Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')

            this.user.authenticated = true
            this.user.profile = response.data.data

            router.go({
                name: 'dashboard'
            })
        }, response => {
            context.error = true
        })
    },
    signout() {
        localStorage.removeItem('id_token')
        this.user.authenticated = false
        this.user.profile = null

        router.go({
            name: 'home'
        })
    }
}