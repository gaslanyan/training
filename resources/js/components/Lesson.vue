<template>
    <div class="container-fluid m-0 p-0 overflow-hidden">

            <div class="row">
                <div class="col-12 lesson_banner" >
            <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                    <h2>{{texts.lessons}}</h2>
                </div>
            </div>

        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content">
                                <div :key="b.to" class="page_link" v-for="b in $route.meta.breadCrumbs">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{ text.main }}</router-link>
                                    <router-link class="nav-link" to="">{{ b.text }}</router-link>

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
                    <div class="col-12">
                        <ul v-if="professions" class="lesson_filter">
                            <li @click="allcourses()">{{ text.all }}</li>
                            <li @click="getCoursesByProf(prof.id)" v-for="(prof) in professions">{{ prof.name }}</li>
                        </ul>
                    </div>
                    <div :key="course.id" class="col-lg-4" v-for="course in courses">
                        <div class="categories_post">
                            <!--<img :src="image_src" alt="post">-->
                            <div class="categories_details">
                                    <img :src = "lessonimg" />
                                <div class="categories_text">
                                    <div v-if="!currentUser">
                                        <p>{{ course.name }}</p>
                                    </div>
                                    <div v-else>
                                        <template v-if="!isOpened && course.account_course === null">
                                            <p>{{ course.name }}</p>
                                        </template>

                                        <template v-else>
                                            <router-link :to="'/coursedetails/'+course.id" class="nav-link"><p>
                                                {{ course.name }}</p></router-link>
                                        </template>
                                    </div>
                                    <div v-if="!currentUser">
                                        <div class="border_line yellow"></div>
                                        <span class="fa fa-lock yellow"></span>
                                        <div class='d-flex justify-content-center'>
                                            <router-link class="nav-link" to="/login">{{ texts.login }}</router-link>
                                            <p class="nav-link">կամ</p>

                                            <router-link class="nav-link" to="/register"> {{ text.register }}
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
                                                            @click="payment(course.id)">{{ texts.pay }}
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
                                                <span ref="price" class="price">{{ course.cost }} AMD</span>
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
import Swal from 'sweetalert2'

export default {
    data() {
        return {
            courses: [],
            image_src: '/css/frontend/img/background.png',
            lesson_banner: '/css/frontend/img/lessonbanner.png',
            lessonimg:'/css/frontend/img/lessonimg.png',
            texts: pagetexts,
            isOpened: false,
            text: text,
            cost: "",
            course_id: "",
            professions: ""
        }
    },
    methods: {
        beforeunloadFn(e) {
            console.log('refresh or close')
            // ...
        },
        created() {
            window.addEventListener('beforeunload', e => this.beforeunloadFn(e))
        },
        destroyed() {
            window.removeEventListener('beforeunload', e => this.beforeunloadFn(e))
        },
        logout() {
            this.$store.commit('logout');
            this.$router.push('/login');
        },
        allcourses() {
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
        getProfessions() {
            let credentials = {
                auth: false,
                url: 'prof'
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.professions = res.prof;
                })
                .catch(error => {
                    this.$store.commit("getContentFailed", {error});
                });

        },
        getCoursesByProf(id) {
            let credentials = {
                id: id,
                url: 'getcoursebyprof',
                auth: false
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.courses = res.courses;
                })
                .catch(err => {
                })
        },
        getCourses(id) {
            console.log(id)
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
            this.course_id = id;
            localStorage.setItem('c_id', id);
            localStorage.setItem('a_id', this.currentUser.id);
            let credentials = {
                account_id: this.currentUser.id,
                token: this.currentUser.token,
                course_id: id,
                mobile: false,
                url: "payment",
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    location.href = 'https://services.ameriabank.am/VPOS/Payments/Pay?id=' + res.payment.PaymentID + '&lang=am';
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
                course_id: localStorage.getItem('c_id'),
                url: "getpayment",
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    // console.log(res)
                    if (localStorage.get('m')) {
                        this.logout();
                        Swal.fire({
                            icon: 'success',
                            title: pagetexts.thanks,
                            text: pagetexts.backApp,
                            confirmButtonText:
                                `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                            confirmButtonColor: '#631ed8',
                        });
                        setTimeout(function () {
                            window.close();
                        }, 5000);
                    }
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
        }
    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        },
    },
    components: {
        'Swal': Swal
    },
    beforeMount() {
        if (!this.$store.getters.currentUser) {
            this.allcourses();
        } else {
            this.getCourses(this.$store.getters.currentUser.id);
            if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                this.isOpened = true;
        }
        this.getProfessions();
    },
    mounted() {
        if (Object.keys(this.$route.query).length > 0) {
            if (this.$route.query)
                this.getPaymentQuery(this.$route.query);
            else
                Swal.fire({
                    icon: 'error',
                    title: pagetexts.error,
                    text: pagetexts.again,
                    confirmButtonText:
                        `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                    confirmButtonColor: '#631ed8',
                });
        }
    }
}
</script>


