<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="register_form">
                    <h3>{{texts.new_password_confirm}}</h3>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="resetPassword">
                            <input autocomplete="off" type="hidden" name="_method" value="PUT">
                            <div class="form-group row">
                            </div>
                            <div class="form-group">

                                <input type="email" id="email" name="email" autocomplete="off"
                                       v-validate="'required|email'" :placeholder="texts.email"
                                       :class="{'input': true, 'is-invalid': errors.has('email')}"
                                       class="form-control p-4" v-model="formReset.email"
                                       :data-vv-as="texts.email">
                                <span v-show="errors.has('email')"
                                      class="help is-danger">{{ errors.first('email') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" ref="pass" class="form-control p-4 input"
                                       v-validate="'required|min:8'" name="password"
                                       v-model="formReset.password" :placeholder="texts.password"
                                       :class="{'input': true, 'is-invalid': errors.has('password') }"
                                       :data-vv-as="texts.password">
                                <span ref="password" v-show="errors.has('password')"
                                      class="help is-danger">{{ errors.first('password') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password_confirmation" class="form-control p-4 input"
                                       placeholder="" name="password_confirmation"
                                       :class="{'input': true, 'is-invalid': errors.has('password_confirmation')}"
                                       v-validate="'required|confirmed:pass'"
                                       v-model="formReset.password_confirmation"
                                       :placeholder="texts.confirmpassword"
                                       :data-vv-as="texts.confirmpassword">
                                <span ref="password_confirmation" v-show="errors.has('password_confirmation')"
                                      class="help is-danger">{{ errors.first('password_confirmation') }}</span>
                            </div>
                            <button type="submit" class="btn primary-btn">{{texts.update}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import registertexts from './json/registertexts.json';

    export default {
        data() {
            return {
                formReset: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                token: null,
                error: null,
                texts: registertexts,
            }
        },
        methods: {
            resetPassword() {
                this.$validator.validateAll()
                    .then((res) => {
                        console.log(res);
                        if (res) {
                            axios.post("/api/reset/password", {
                                token: this.$route.params.token,
                                _method: 'PUT',
                                email: this.$data.formReset.email,
                                password: this.$data.formReset.password,
                                password_confirmation: this.$data.formReset.password_confirmation
                            })
                                .then(result => {
                                    this.$router.push({name: 'login'})
                                }, error => {
                                    console.error(error);
                                });
                        }
                    });

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
