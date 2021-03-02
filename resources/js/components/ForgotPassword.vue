<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="register_form">
                    <h3>{{texts.resetpassword}}</h3>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                            <div class="form-group row">
                                <div v-if="reset_password" class="text-success">{{reset_password}}</div>
                                <div v-if="reset_failed" class="text-danger">{{reset_failed}}</div>
                            </div>
                            <div class="form-group">
                                <input autocomplete="off" type="email" id="email" name="email"
                                       v-validate="'required|email'" :placeholder="texts.email"
                                       :class="{'input': true, 'is-invalid': errors.has('email')}"
                                       class="form-control p-4" v-model="formReset.email"
                                       :data-vv-as="texts.email">
                                <span v-show="errors.has('email')"
                                      class="help is-danger">{{ errors.first('email') }}</span>
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
                has_error: false,
                texts: registertexts,
                formReset: {
                    email: '',
                },
                error: null,
            }
        },
        methods: {
            requestResetPassword() {
                this.$validator.validateAll()
                    .then((res) => {
                        if (res) {
                            console.log('result', this.$data.formReset.email);
                            axios.post("/api/reset-password",
                                {email: this.$data.formReset.email})
                                .then(result => {
                                        this.response = result.data;
                                        console.log(result.data.message);
                                        if (result.data.message == "Password reset email sent.") {
                                            this.$store.commit('resetPasswordSuccess', this.texts.resetPassword);
                                        } else {
                                            this.$store.commit('resetPasswordFailed', this.texts.not_sent);
                                        }
                                    },
                                    error => {
                                        console.error(error);
                                    });
                        }
                    });
            }
        },
        computed: {
            reset_password() {
                return this.$store.getters.reset_password
            }, reset_failed() {
                return this.$store.getters.reset_failed
            }
        }
    }
</script>
<style scoped>
    .error {
        text-align: center;
        color: red;
    }
</style>
