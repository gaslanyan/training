<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div :key="b.to" class="page_link" v-for="b in $route.meta.breadCrumbs">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{text.main}}</router-link>
                                    <router-link class="nav-link" to="">{{b.text}}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row">
                    <div :key="course.id" class="col-lg-4" v-for="course in courses">
                        <div class="categories_post">
                            <!--<img :src="image_src" alt="post">-->
                            <div class="categories_details">
                                <div class="categories_text">
                                    <div v-if="!currentUser">
                                        <p>{{course.name}}</p>
                                    </div>
                                    <div v-else>
                                        <template v-if="!isOpened && course.account_course === null">
                                            <p>{{course.name}}</p>
                                        </template>

                                        <template v-else>
                                            <router-link :to="'/coursedetails/'+course.id" class="nav-link"><p>
                                                {{course.name}}</p></router-link>
                                        </template>
                                    </div>
                                    <div v-if="!currentUser">
                                        <div class="border_line yellow"></div>
                                        <span class="fa fa-lock yellow"></span>
                                        <div class='d-flex justify-content-center'>
                                            <router-link class="nav-link" to="/login">{{texts.login}}</router-link>
                                            <p class="nav-link">կամ</p>

                                            <router-link class="nav-link" to="/register"> {{text.register}}
                                            </router-link>

                                        </div>
                                    </div>
                                    <div v-else>
                                        <div v-if="!isOpened && course.account_course === null">
                                            <div class="border_line yellow"></div>
                                            <span class="fa fa-lock yellow"></span>
                                            <div class='d-flex justify-content-center'>
                                                <div>
                                                    <button id="show-modal" class="text-uppercase enroll nav-link btn"
                                                            @click="payment(course.id)">{{texts.pay}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- single course -->
                        <div class="row" v-if="currentUser">
                            <div class="col-lg-12 col-md-12">
                                <div class="single_course">
                                    <div class="course_content">
                                        <div class="course_meta d-flex justify-content-between">
                                            <div>
                                    <!--span class="meta_info">
                                        <a href="#">
                                            <i class="fa fa-user-o yellow"></i>355
                                        </a>
                                    </span-->

                                            </div>
                                            <div>
                                                <span ref="price" class="price">{{course.cost}} AMD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagetexts from './json/pages.json'
    import text from './json/registertexts.json';


    export default {

        data() {
            return {
                courses: [],
                image_src: '/css/frontend/img/background.png',
                texts: pagetexts,
                isOpened: false,
                text: text,
                cost: "",
                course_id: ""
            }
        },
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            allcourses: function () {
                let credentials = {
                    url: 'allcourses',
                    auth: false
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.courses = res.data;
                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            getCourses(id) {
                let credentials = {
                    id: id,
                    token: this.currentUser.token,
                    url: 'getcoursebyspec',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.courses = res.courses;
                    })
                    .catch(err => {
                    })
            },
            payment(id) {
                this.course_id = id ;
                localStorage.setItem('c_id',id);
                console.log(id);
                let credentials = {
                    account_id: this.currentUser.id,
                    token: this.currentUser.token,
                    // form: data,
                    url: "payment",
                    auth: true
                };

                getPromiseResult(credentials)
                    .then(res => {
                        location.href = 'https://servicestest.ameriabank.am/VPOS/Payments/Pay?id='+res.payment.PaymentID+'&lang=am';

                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            getPaymentQuery(query) {

                let credentials = {
                    PaymentID: `${query.paymentID}`,
                    account_id: this.currentUser.id,
                    token: this.currentUser.token,
                    course_id : localStorage.getItem('c_id'),
                    url: "getpayment",
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        console.log(res)
                    })
                    .catch(error => {
                        let msg = "", pattern = /\d+/,
                            e = pattern.exec(error);
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
            }
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            },
        },

        beforeMount() {
            if (!this.$store.getters.currentUser) {
                this.allcourses();
            } else {
                this.getCourses(this.$store.getters.currentUser.id);

                if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                    this.isOpened = true;
            }

        },
        mounted() {
            if (Object.keys(this.$route.query).length > 0) {

                this.getPaymentQuery(this.$route.query);
            }
        }


    }
</script>


