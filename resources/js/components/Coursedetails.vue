<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 coursedetails_banner">
                <!--img :src="lesson_banner" alt="" style="width: 100%;"-->
                <h2 class="text-center pt-4">{{ datas.name }}</h2>
                <h3>{{ texts.class }}
                    <span v-if="specialites" class=""
                          v-for="spec in specialites">{{ `&nbsp;` + spec.name + `, ` }}</span>
                </h3>
            </div>
        </div>        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container" :key="datas.id">
                <!--div class="col-lg-12 m-0 pb-5"><h2 class="or text-center"> {{datas.name}}</h2></div-->
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <div v-if="(!isOpened && !isPaid)" class='d-flex justify-content-center look'>
                                <img id="lookOpened" v-bind:src="lock" alt="lock">
                                <div class="d-flex flex-column mt-3">
                                    <button class=" text-uppercase pay_btn btn" v-if="!isPaid"
                                            @click="payment(datas.id)">{{ texts.pay }}
                                    </button>

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
                                        <video ref="video" class="view-video col-lg-12" controls disablePictureInPicture  controlsList="nodownload"
                                               v-on:loadeddata="manageEvents(info.id, index)">
                                            <source :src="info.path">
                                        </video>
                                        <div class="col-lg-12 row">
                                            <div class="col-lg-6 col-md-6 col-xs-12 row mb-xs-3" >
                                                <img :src="lectureimg+info.lectures.image_name" alt="lectures"
                                                     class="col-4">
                                                <div class="col-8">
                                                    <h5 class="vid_content">{{
                                                            `${info.lectures.name} ${info.lectures.surname}
                                                    ${info.lectures.father_name}`
                                                        }}</h5>
                                                    <h4>{{ info.spec }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="justify-content-between d-flex">

                                                    <div class="attachment-mark row" v-if="books">
                                                        <div class="col-3 col-xs-12 pl-lg-0 pl-md-0 ">
                                                            <img :src="bookimg" alt="book">
                                                        </div>
                                                        <div class="col-9 col-xs-12 pr-0">
                                                            <template v-for="book in books">
                                                                <!--<i class="fa fa-book text"></i>-->
                                                               <h5 class="vid_content"><router-link :to="{name: 'book',params: {id: book.id}}"
                                                                             class="text"
                                                                             target="_blank">{{ book.title }}
                                                               </router-link></h5>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </slide>
                                    <hooper-pagination slot="hooper-addons"></hooper-pagination>
                                </hooper>
                            </div>

                        </div>
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
                                    <span class="or text-nowrap">{{ datas.duration }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{ texts.coursecost }} </p>
                                    <span class="or text-nowrap">{{ datas.cost }} AMD</span>
                                </a>
                            </li>

                        </ul>
                        <div v-if="isFinished && isPaid && isRead">
                            <router-link :to="{ name: 'test',params: {id: this.id} }"
                                         class="primary-btn text-uppercase enroll "
                                         :disabled="!isFinished && !isPaid && !isRead"
                                         :event="(isFinished && isRead) ? 'click' : ''"
                                         v-if="">{{ texts.test }}
                            </router-link>
                        </div>
                        <div v-else>
                            <button class="primary-btn text-uppercase enroll" @click="showswal">{{
                                    texts.test
                                }}
                            </button>
                        </div>
                        <div class="content">
                            <div class="review-top row pt-40">
                                <div class="col-lg-12">
                                    <h6 class="mb-15"></h6>
                                    <div class="d-flex flex-row reviews justify-content-between">
                                        <span>{{ texts.rate }}</span>
                                        <div class="star">
                                            <i class="fa fa-star" :id="item.id" v-on:click="raiting"
                                               v-bind:class="{ checked: isActive }" v-for="item in objects"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <hooper :settings="hooperSettings" class="hooper_carousel">
                <slide class="slide_carousel" v-for="(info, index) in courses" :key="index" :index="index">
                    <a :href="'/coursedetails/'+info.id" class="nav-link">
                        <div class="categories_post">
                            <div class="categories_details">
                                <img :src="info.image?info.image:lessonimg" :alt="info.name ">
                                <div class="categories_text">
                                    <p>
                                        {{ info.name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
        </section>
    </div>
</template>
<script>
import {getPromiseResult} from '../partials/help';
import texts from './json/course.json';
import {Hooper, Navigation as HooperNavigation, Pagination as HooperPagination, Slide} from 'hooper';
import 'hooper/dist/hooper.css';
import Swal from "sweetalert2";
import pagetexts from "./json/pages.json";

window.addEventListener('focus', function () {
    console.log('focus')
});
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
            lessonimg: '/css/frontend/img/logo.png',
            // courseimg: '/css/frontend/img/courses/course-details.jpg',
            // videoimg: '/css/frontend/img/blog/cat-post/cat-post-3.jpg',
            lock: '/css/frontend/img/lock.png',
            bookimg: '/css/frontend/img/book.jpg',
            lectureimg: '/uploads/images/avatars/',
            docs: [],
            texts: texts,
            feedbacksuccess: '',
            isActive: false,
            isOpened: false,
            isPaid: false,
            isRead: false,
            objects: [
                {id: 1},
                {id: 2},
                {id: 3},
                {id: 4},
                {id: 5}
            ],
            isFinished: 0,
            disabled: 1,
            pagetexts: pagetexts,
            hooperSettings: {
                infiniteScroll: true,
                centerMode: true,
                autoPlay: true,
                playSpeed: 3500,
                breakpoints: {
                    2400: {
                        itemsToShow: 5
                    },
                    1800: {
                        itemsToShow: 4
                    },
                    1500: {
                        itemsToShow: 3
                    },
                    1100: {
                        itemsToShow: 3
                    },
                    900: {
                        itemsToShow: 2
                    },
                    0: {
                        itemsToShow: 1
                    }
                }
            }
        };
    },
    computed: {
        currentUser: function () {
            if (!this.$store.getters.currentUser)
                return JSON.parse(localStorage.getItem('user'));
            return this.$store.getters.currentUser
        },
        show: function () {
            return !this.isOpened || !this.isPaid;
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
                if (this.currentUser.id) {
                    let credentials = {
                        id: id,
                        account_id: this.currentUser.id,
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
                                    let video = _this.$refs.video[index],
                                        isPlay = true;

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

                                        let back = backTime - supposedCurrentTime;
                                        if (back < 0) {
                                            supposedCurrentTime = backTime;
                                        } else {
                                            let delta = video.currentTime - supposedCurrentTime;
                                            if (Math.abs(delta) > 0.01) {

                                                video.currentTime = supposedCurrentTime;
                                            }
                                        }
                                    });

                                    video.addEventListener('pause', () => {
                                        // video.currentTime = supposedCurrentTime;
                                        _this.addPoint(id, video.currentTime);
                                    });

                                    video.addEventListener('ended', function () {

                                        _this.addPoint(id, video.currentTime);
                                    });
                                }
                            } else if (res.video.status === "finished")
                                this.$nextTick(function () {
                                    this.isFinished = 1;

                                })
                        })
                        .catch(error => {
                            this.$store.commit("getContentFailed", {error});
                        });
                }
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
                    console.log('es e')
                })
                .catch(error => {
                    console.log(error);
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
                    console.log(error, error);
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
                    console.log(error);
                    // this.$store.commit("registerFailed", {error});
                })
        },
        getPaymentById(query) {
            let credentials = {
                account_id: this.currentUser.id,
                token: this.currentUser.token,
                course_id: this.$route.params.id,
                url: "getpaymentbyid",
                auth: true,
                mobile: false
            };
            getPromiseResult(credentials)
                .then(res => {
                    if (res.data == 1)
                        this.isPaid = true;
                    if (res.read == 1)
                        this.isRead = true;
                })
                .catch(error => {
                    this.isPaid = false;
                    console.log(error)
                });
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
                    if (res.getpayment.PaymentID)
                        this.isPaid = true;
                    location.href = "/coursedetails/" + this.$route.params.id;
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
            let credentials;
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
                    localStorage.setItem('cb_id', this.id);
                })
                .catch(error => {
                    console.log(error);
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
                    console.log(error);
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

            localStorage.setItem("course_id", this.$route.params.id);
            location.href = '/login';
        },
        register: function () {

            localStorage.setItem("course_id", this.$route.params.id);
            location.href = '/register';
        },
        showswal: function () {

            Swal.fire({
                icon: 'error',
                title: pagetexts.warning,
                text: pagetexts.warningText,
                confirmButtonText:
                    `<i class="fa fa-thumbs-up"></i> ${pagetexts.close} `,
                confirmButtonColor: '#631ed8',
            });
        }
    },
    beforeMount() {
        this.coursedetails();
        this.getCourseById();
        if (this.$store.getters.currentUser) {
            this.finishedVideo();
            this.getPaymentById();
            if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                this.isOpened = true;
        }
    },
    mounted() {
        if (Object.keys(this.$route.query).length > 0) {
            if (this.$route.query) {
                this.getPaymentQuery(this.$route.query);
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
}

</script>

