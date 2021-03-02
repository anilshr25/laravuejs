<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;/img/login/login.jpeg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                        <div class="form-group pt-3"><Input type="email" v-model="data.email" placeholder="Enter Email Address..." size="large" /></div>
                                        <div class="form-group pt-3"><Input type="password" v-model="data.password" placeholder="Password" size="large" /></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check pt-3"><checkbox>Remember Me</checkbox></div>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3"><Button type="primary" @click="login" size="large" long :disabled="isLogging" :loading="isLogging">{{ isLogging ? 'Logging' : 'Login' }}</Button></div>
                                    <div class="text-center pt-3"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                                    <div class="text-center pt-1"><a class="small" href="register.html">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: {
                email: '',
                password: ''
            },
            isLogging: false
        }
    },
    methods: {
        async login() {
            if(this.data.email.trim() == '') return this.error('Email is required!!')
            if(this.data.password.trim() == '') return this.error('Password is required!!')
            if(this.data.password.length < 6) return this.error('Password should at least 6 !!')
            const res = await this.callApi('post', '/user/login', this.data);
                if(res.status == 200) {
                    window.location = '/dashboard'
                    this.success(res.data.msg);
                }else {
                    if(res.status == 422){
                        if(res.data.errors){
                            for(let i in res.data.errors) {
                                this.error(res.data.errors[i][0])
                            }
                        }
                    } else if(res.status == 401) {
                        this.error(res.data.msg);
                    } else if(res.status == 403 ) {
                        this.error(res.data.msg);
                    } else{
                        this.swrong();
                    }
                }
        }
    },
    beforeCreate() {
        this.$nextTick().then(() => document.body.classList.add('bg-gradient-primary'))
    }
}
</script>
