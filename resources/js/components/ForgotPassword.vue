<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="register_form">
                    <h3>{{texts.resetpassword}}</h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <div v-if="reset_password" class="text-success">{{reset_password}}</div>
                            <div v-if="reset_failed" class="text-danger">{{reset_failed}}</div>
                        </div>
                        <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" placeholder="էլ.հասցե"
                                       v-model="email" required>
                            </div>
                            <button type="submit" class="btn primary-btn">{{texts.resetlink}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import registertexts from './json/registertexts.json'

    export default {
        data() {
            return {
                email: null,
                has_error: false,
                texts: registertexts,
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/api/reset-password",
                    {email: this.email}).then(result => {
                    this.response = result.data;
                    if (result.data.data === "passwords.sent") {
                        this.$store.commit('resetPasswordSuccess', this.texts.resetPassword);
                    }else{
                        this.$store.commit('resetPasswordFailed', this.texts.not_sent);
                    }
                }, error => {
                    console.error(error);
                });
            }
        },
        computed: {
            reset_password() {
                return this.$store.getters.reset_password
            },reset_failed() {
                return this.$store.getters.reset_failed
            }
        }
    }
</script>
