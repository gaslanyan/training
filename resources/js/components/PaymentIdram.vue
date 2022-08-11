<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 lesson_banner">
                <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                <h2 class="home_title">{{ text.payment_terms }}</h2>
            </div>
        </div>
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content">
                                <div v-for="b in $route.meta.breadCrumbs" :key="b.to" class="page_link">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{ text.main }}</router-link>
                                    <router-link class="nav-link" to="">{{ b.text }}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Start About Area =================-->
        <div class="department_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.payment_methods }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.payment_methods_desc }}</p>
                        <p> {{ text.payment_methods_info }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.return_policy }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.return_policy_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.shipping_methods }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.shipping_methods_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-left">
                        <h2 class="home_title">{{ text.terms_conditions }}</h2>
                    </div>

                    <div class="col-12">
                        <p> {{ text.terms_conditions_desc }}</p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--================ End About Area =================-->

    </div>
</template>

<script>

import pagestext from './json/payment.json';
import Swal from "sweetalert2";
import pagetexts from "./json/pages.json";
import {getPromiseResult} from "../partials/help";

export default {
    data() {
        return {
            datas: [],
            lesson_banner: '/css/frontend/img/lessonbanner.png',
            text: pagestext,
        };
    },
    methods: {
        getPaymentIdramQuery(query) {
            let credentials = {
                PaymentID: `${query.paymentID}`,
                account_id: this.currentUser.id,
                token: this.currentUser.token,
                course_id: localStorage.getItem('c_id'),
                url: "getpaymentidram",
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    let icon = "error";
                    let title = pagetexts.error;

                    if (res.code === "00") {
                        icon = 'success';
                        title = pagetexts.thanks;
                        this.isPaid = true;
                    }
                    console.log(res)
                    // this.logout();
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: res.msg,
                        confirmButtonText:
                            `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                        confirmButtonColor: '#631ed8',
                    });

                    setTimeout(function () {
                        location.href = "/coursedetails/" + this.$route.params.id;
                    }, 500);
                })
                .catch(error => {
                    let msg = "", pattern = /\d+/,
                        e = pattern.exec(error);
                    console.log(e, error)
                    switch (e[0]) {
                        case '404':
                            this.$router.push({path: '/404'});
                            break;
                        case '401':
                            error = '401';
                            msg = 'unauthorized';
                            break;
                        default:
                            error = 'g';
                            msg = 'loginFailed';
                    }
                });
        },
    },
    mounted() {
        if (Object.keys(this.$route.query).length > 0) {
            if (this.$route.query) {
                this.getPaymentIdramQuery(this.$route.query);
            } else
                Swal.fire({
                    icon: error,
                    title: pagetexts.error,
                    text: pagetexts.again,
                    confirmButtonText:
                        `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                    confirmButtonColor: '#631ed8',
                });
        }
    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        },
    },
}
</script>
<style>
.home_banner_area {
    min-height: 234px;
}
</style>

