<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 coursedetails_banner">
                <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                <h2 class="text-center pt-4">{{ datas.name }}</h2>
                <h3>{{ texts.class }} {{ datas.specialities }} </h3>
            </div>
        </div>        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container" :key="datas.id">
                <!--div class="col-lg-12 m-0 pb-5"><h2 class="or text-center"> {{datas.name}}</h2></div-->
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <!--                        <div v-if="!isOpened">-->
                        <div class="main_image">
                            <div class='d-flex justify-content-center look'>
                                <img id="look" v-bind:src="lock" alt="lock">

                                <div class="d-flex flex-column mt-3">
                                    <button class=" text-uppercase pay_btn btn"
                                            @click="payment(datas.id)">{{ texts.pay }}
                                    </button>
                                    <!--                                    -->
                                    <div class="d-flex justify-content-center" v-if="!currentUser">

                                        <button class="text-uppercase nav-link btn-none" @click="login">
                                            {{ texts.login }}
                                        </button>
                                        <button class="text-uppercase nav-link btn-none" @click="register">
                                            {{ texts.register }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="video_info">
                                <hooper :itemsToShow="1">
                                    <slide v-for="(info, index) in video_info" :key="index" :index="index">
                                        <video ref="video" class="view-video col-lg-12" controls
                                               v-on:loadeddata="manageEvents(info.id, index)">
                                            <source :src="info.path">
                                        </video>
                                        <div class="col-lg-12">
                                            <!--h5 class="title">{{ info.title }}</h5-->
                                            <h5 class="vid_content">{{
                                                `${info.lectures.name} ${info.lectures.surname}
                                                ${info.lectures.father_name}`
                                                }}</h5>
                                            <h5>{{`${info.lectures.specialites}}}</h5>

                                        </div>
                                    </slide>
                                    <hooper-pagination slot="hooper-addons"></hooper-pagination>
                                </hooper>
                            </div>
                        </div>
                        <!--<div class="attachment-mark" v-if="books">-->
                            <!--<h4 class="title">{{ texts.books }}</h4>-->
                            <!--<template v-for="book in books">-->
                                <!--<i class="fa fa-book text"></i>-->
                                <!--<router-link :to="{name: 'book',params: {id: book.id}}" class="text" target="_blank">-->
                                    <!--{{ book.title }}-->
                                <!--</router-link>-->
                            <!--</template>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-4 right-contents">
                        <ul>
                            <li v-if="datas.status ==='active'">
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{ texts.status }} </p>
                                    <span class="or"> {{ texts.status_active }}</span>
                                </a>
                            </li>
                        </ul>

                        <a class="d-flex" href="#">
                            <div class="dot"></div>
                            <p class="credit">{{ texts.credit }}</p>
                        </a>
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#"
                                   v-for="c in datas.credit">
                                    <span>{{ creditName(c.name) }}</span>
                                    <span class="or">{{ c.credit }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{ texts.duration }} </p>
                                    <span class="or text-nowrap">{{ datas.duration_date }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{ texts.coursecost }} </p>
                                    <span class="or text-nowrap">{{ datas.cost }} AMD</span>
                                </a>
                            </li>

                        </ul>
                        <div>
                            <a class="justify-content-between d-flex" href="#">

                                <div class="attachment-mark" v-if="books">
                                    <img :src="bookimg"/>
                                    <template v-for="book in books">
                                        <!--<i class="fa fa-book text"></i>-->
                                        <router-link :to="{name: 'book',params: {id: book.id}}" class="text"
                                                     target="_blank">{{ book.title }}
                                        </router-link>
                                    </template>
                                </div>
                            </a>
                        </div>
                        <router-link :to="{ name: 'test',params: {id: this.id} }"
                                     class="primary-btn text-uppercase enroll "
                                     :disabled="!isFinished"
                                     :event="isFinished ? 'click' : ''">{{ texts.test }}
                        </router-link>

                        <div class="content">
                            <div class="review-top row pt-40">
                                <div class="col-lg-12">
                                    <h6 class="mb-15"></h6>
                                    <div class="d-flex flex-row reviews justify-content-between">
                                        <span>{{ texts.rate }}</span>
                                        <div class="star">
                                            <i class="fa fa-star" :id="item.id" v-on:click="raiting"
                                               v-bind:class="{ checked: isActive }" v-for="(item, key) in objects"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--div-- class="feedeback">
                                <h6>{{texts.feedback}}{{feedbacksuccess}}</h6>
                                <form @submit.prevent="sendcomment">
                                    <textarea name="feedback" class="form-control" ref="feedback" cols="10" rows="10"
                                              id="feedback" v-model="feedback"></textarea>
                                    <div class="mt-10 text-right">
                                        <button class="primary-btn text-right text-uppercase comment">
                                            {{texts.send}}
                                        </button>
                                    </div>
                                </form>
                            </div-->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-4 mb-4 content_wrapper d-flex justify-content-center flex-column text-center container">
            <h2 class="title align-self-center">{{ texts.content }}</h2>
                        <div v-html="datas.content" class="content text-left">
                {{ datas.content }}
            </div>
        </div>
        <!--================ End Course Details Area =================-->
        <section class="course_details_carousel section_gap container">
            <hooper :itemsToShow="3">
                <slide class="slide_carousel" v-for="(info, index) in courses" :key="index" :index="index">
                    <router-link :to="'/coursedetails/'+info.id" class="nav-link">
                        <div class="categories_post">
                            <div class="categories_details">
                                <img :src="lessonimg"/>
                                <div class="categories_text">
                                    <p>
                                        {{ info.name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
        </section>
    </div>
</template>
<script>
import {getPromiseResult} from '../partials/help';
import texts from './json/course.json';
import {Hooper, Pagination as HooperPagination, Navigation as HooperNavigation, Slide} from 'hooper';
import 'hooper/dist/hooper.css';
import Swal from "sweetalert2";
import pagetexts from "./json/pages.json";

export default {
    data() {
        return {
            id: '',
            courses: [],
            video_info: [],
            books: [],
            feedback: '',
            rating: 0,
            datas: [],
            specialites: [],
            lessonimg: '/css/frontend/img/lessonimg.png',
            // courseimg: '/css/frontend/img/courses/course-details.jpg',
            // videoimg: '/css/frontend/img/blog/cat-post/cat-post-3.jpg',
            lock: '/css/frontend/img/lock.png',
            bookimg: '/css/frontend/img/book.jpg',
            docs: [],
            texts: texts,
            feedbacksuccess: '',
            isActive: false,
            isOpened: false,
            objects: [
                {id: 1},
                {id: 2},
                {id: 3},
                {id: 4},
                {id: 5}
            ],
            isFinished: 0,
            disabled: 1,
            pagetexts: pagetexts
        };
    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        }
    },
    components: {
        Hooper,
        Slide, HooperPagination,
        HooperNavigation
    },
    methods: {
        manageEvents(id, index) {
            this.$nextTick(() => {
                let credentials = {
                    id: id,
                    token: this.currentUser.token,
                    url: 'videoinfo',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        if (res.video.status === "progress" || !res.video) {
                            let _this = this;
                            if (_this.$refs.video) {
                                let supposedCurrentTime = 0, backTime = 0;
                                let video = _this.$refs.video[index], isPlay = true;

                                video.addEventListener('play', function () {
                                    if (isPlay) {
                                        video.currentTime = res.video.point;
                                        supposedCurrentTime = res.video.point;
                                        isPlay = false;
                                    }
                                });

                                video.addEventListener('timeupdate', function () {
                                    if (!video.seeking) {
                                        supposedCurrentTime = video.currentTime;
                                    } else
                                        backTime = video.currentTime;
                                });

                                video.addEventListener('seeking', function () {
                                    console.log('seeking', video.currentTime);
                                    let back = backTime - supposedCurrentTime;
                                    if (back < 0) {
                                        supposedCurrentTime = backTime;
                                    } else {
                                        let delta = video.currentTime - supposedCurrentTime;
                                        if (Math.abs(delta) > 0.01) {
                                            console.log("Seeking is disabled");
                                            video.currentTime = supposedCurrentTime;
                                        }
                                    }
                                });

                                video.addEventListener('pause', () => {
                                    // video.currentTime = supposedCurrentTime;
                                    _this.addPoint(id, video.currentTime);
                                });

                                video.addEventListener('ended', function () {
                                    console.log('ended', id);
                                    _this.addPoint(id, video.currentTime);
                                });
                            }
                        }
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            });
        },
        addPoint(id, point) {
            let credentials = {
                id: id,
                user_id: this.currentUser.id,
                token: this.currentUser.token,
                point: point,
                url: "addpoint",
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                })
                .catch(error => {
                    console.log('error');
                    // this.$store.commit("registerFailed", {error});
                })
        },
        finishedVideo() {
            let credentials = {
                id: this.$route.params.id,
                user_id: this.currentUser.id,
                token: this.currentUser.token,
                url: 'finishedvideo',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.isFinished = res;

                })
                .catch(error => {
                    console.log('error', error);
                    // this.$store.commit("registerFailed", {error});
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
        },
        coursedetails: function () {
            let credentials = {};
            if (!this.currentUser)
                credentials = {
                    id: this.$route.params.id,
                    url: 'courseinfo',
                    auth: false
                };
            else
                credentials = {
                    id: this.$route.params.id,
                    token: this.currentUser.token,
                    url: 'coursedetails',
                    auth: true
                };
            getPromiseResult(credentials)
                .then(res => {

                    this.datas = res.data;
                    this.datas.credit = JSON.parse(res.data.credit);
                    this.video_info = JSON.parse(res.data.videos);
                    this.books = JSON.parse(res.data.books);
                    this.specialites = res.specialities;
                    this.id = res.data.id;
                    console.log(res.data);
                    // this.manageEvents();

                })
                .catch(error => {
                    console.log('error');
                    // this.$store.commit("registerFailed", {error});
                })
        },
        getCourseById: function () {
            let credentials = {
                id: this.$route.params.id,
                url: 'getcoursebyid',
                auth: false
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.courses = res.courses;
                })
                .catch(error => {
                    console.log('error');
                    // this.$store.commit("registerFailed", {error});
                })
        },
        raiting: function (event) {
            var loop_count = 5 - parseInt(event.currentTarget.id);
            var t_id = parseInt(event.currentTarget.id);
            var r = 0;
            if (!event.currentTarget.classList.contains('checked')) {
                for (var i = 1; i <= parseInt(t_id); i++) {
                    event.currentTarget.classList.add("checked");
                    var s = i.toString();
                    r = event.currentTarget.id;
                    document.getElementById(s).classList.add("checked");
                }
            } else {
                for (var j = 5; j >= t_id; j--) {
                    var ss = j.toString();
                    r = event.currentTarget.id - 1;
                    document.getElementById(ss).classList.remove("checked");
                }
            }
            console.log(event.currentTarget.id);
            let user = JSON.parse(localStorage.getItem('user'));
            axios.post('/api/rating', {
                rating: parseInt(r),
                account_id: user.id,
                course_id: this.$route.params.id
            })
                .then(function (response) {
                    //alert(response.data);


                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        // sendcomment: function () {
        //     // if(this.feedback != ''){
        //     //console.log(this.$refs.feedback.text);
        //     let user = JSON.parse(localStorage.getItem('user'));
        //     // this.feedback = this.$refs.feedback.text;
        //     axios.post('/api/comment', {
        //         comment: feedback.value,
        //         account_id: user.id,
        //         course_id: this.$route.params.id
        //     })
        //         .then(function (response) {
        //             //alert(response.data);
        //             feedback.value = '';
        //             feedbacksuccess = "Մեկնաբանությունը հաջողությամբ ուղարկվեց";
        //         })
        //         .catch(function (error) {
        //             console.log(error);
        //         });
        //     /* }else{
        //          alert('Fill all fields.');
        //      }*/
        // },
        creditName: function (name) {
            let hy_name = '';
            switch (name) {
                case 'theoretical':
                    hy_name = texts.theoretical;
                    break;
                case 'practical':
                    hy_name = texts.practical;
                    break;
                case 'selfeducation':
                    hy_name = texts.selfeducation;
                    break;
            }
            return hy_name;
        },
        login: function () {
            console.log(this.$route.params.id)
            localStorage.setItem("course_id", this.$route.params.id);
            location.href = '/login';
        },
        register: function () {
            console.log(this.$route.params.id)
            localStorage.setItem("course_id", this.$route.params.id);
            location.href = '/register';
        }
    },
    beforeMount() {
        this.coursedetails();
        this.getCourseById();
        if (this.$store.getters.currentUser) {
            this.finishedVideo();

            if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                this.isOpened = true;
        }
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
<style>
.home_banner_area {
    min-height: 234px;
}

.hooper {
    height: 600px;
}

.hooper-pagination {
    top: 0
}

.isDisabled {
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
    pointer-events: none;
}

.btn-none {
    background-color: transparent;
    outline: none;
    color: #fff;
}
</style>

