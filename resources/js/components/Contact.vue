<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content">
                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">ԳԼԽԱՎՈՐ</router-link>
                                    <router-link to="" class="nav-link">{{ b.text }}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        <section class="contact_area section_gap">
            <div class="container-fluid p-0 m-0">
                <div class="row">
                    <div class="col-lg-12 pb-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195167.5734712645!2d44.34848097149138!3d40.15356842368178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406aa2dab8fc8b5b%3A0x3d1479ae87da526a!2sYerevan%2C%20Armenia!5e0!3m2!1sen!2s!4v1589744207208!5m2!1sen!2s"
                            width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
                <div class="container pt-4 pb-4 contact_content">
                <div class="row">
                    <div class="col-12 pt-5 ">
                        <div class="row contact_message col-12 justify-content-center">
                            <div class="message_item col-12 col-lg-3">
                                <i class="fa fa-home"></i>
                                <h6>{{ texts.address }}</h6>
                                <p>{{ texts.street }}</p>
                            </div>
                            <div class="message_item col-12 col-lg-3">
                                <i class="fa fa-phone"></i>
                                <h6><a href="#">{{ texts.phone }}</a></h6>
                                <p>{{ texts.workingtime }}</p>
                            </div>
                            <div class="message_item col-12 col-lg-3">
                                <i class="fa fa-envelope"></i>
                                <h6><a href="#">{{ texts.mail }}</a></h6>
                                <p>{{ texts.mailtext }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 pt-5 pb-5 justify-content-center">
                        <form class="row contact_form flex-column align-items-center" @submit.prevent="sendMail" method="post" id="contactForm"
                              novalidate="novalidate">
                            <div class="col-md-6 col-12 col-lg-6 ">
                                <div class="form-group">
                                    <input autocomplete="off" id="name" type="text" name="name" class="form-control p-4"
                                           v-validate="'required'"
                                           :class="{'input': true,
                               'is-invalid': errors.has('name') }"
                                           v-model="formContact.name" :data-vv-as="texts.name"
                                           ref="name" :placeholder="texts.name">
                                    <span ref="name" v-show="errors.has('name')"
                                          class="help is-danger">{{ errors.first('name') }}</span>

                                </div>
                                <div class="form-group">
                                    <input autocomplete="off" id="email" type="email" name="email"
                                           v-validate="'required|email'" :placeholder="texts.email"
                                           :class="{'input': true, 'is-invalid': errors.has('email') }"
                                           class="form-control p-4" v-model="formContact.email"
                                           :data-vv-as="texts.email">
                                    <span v-show="errors.has('email')" class="help is-danger">{{
                                            errors.first('email')
                                        }}</span>
                                </div>
                                <div class="form-group">
                                    <input autocomplete="off" id="subject" type="text" name="subject"
                                           v-validate="'required'" :placeholder="texts.subject"
                                           :class="{'input': true, 'is-invalid': errors.has('subject') }"
                                           class="form-control p-4" v-model="formContact.subject"
                                           :data-vv-as="texts.subject">
                                    <span v-show="errors.has('subject')"
                                          class="help is-danger">{{ errors.first('subject') }}</span>

                                </div>
                                <div class="form-group">
                                    <label for="message">{{ texts.message }}</label>
                                    <textarea autocomplete="off" id="message" name="message"
                                              class="form-control" :data-vv-as="texts.message"
                                              v-validate="'max:1024'"
                                              :class="{'input': true, 'is-invalid': errors.has('message') }"
                                              v-model="formContact.message"></textarea>
                                    <span v-show="errors.has('message')" ref="message"
                                          class="help is-danger">{{ errors.first('message') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 text-right">
                                <button type="submit" value="submit" class="btn primary-btn">{{ texts.send }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

        </section>
        <!--================Contact Area =================-->
    </div>
</template>

<script>
import contacttext from './json/contacttext.json'
import {getPromiseResult} from '../partials/help';
import Swal from 'sweetalert2';
import pagetexts from "./json/pages.json";

export default {
    data() {
        return {
            formContact: {
                email: '',
                name: '',
                subject: '',
                message: '',
            },
            error: null,
            texts: contacttext

        };
    },
    methods: {
        sendMail() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    let credentials = {
                        name: this.$data.formContact.name,
                        email: this.$data.formContact.email,
                        subject: this.$data.formContact.subject,
                        message: this.$data.formContact.message,
                        url: 'sendMail',
                        auth: false
                    };
                    getPromiseResult(credentials)
                        .then(res => {
                            console.log(res)
                            Swal.fire({
                                icon: 'info',
                                title: pagetexts.infoTitle,
                                text: pagetexts.info,
                                confirmButtonText:
                                    `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                                confirmButtonColor: '#631ed8',
                            });
                        })
                        .catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: pagetexts.error,
                                text: pagetexts.again,
                                confirmButtonText:
                                    `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                                confirmButtonColor: '#631ed8',
                            });
                        })
                }
                console.log('Correct them errors!');
            });
            this.$store.dispatch('login');

        },
    },
    components: {
        'Swal': Swal,
    },

}
</script>
<style>
input, textarea{
    border:none!important;
    border-bottom:1px solid #eeeeee!important;
}
</style>
