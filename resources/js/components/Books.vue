<template>
    <div id="flipbook">
        <flipbook class="flipbook" :pages="images" v-slot="flipbook">
            <div class="action-bar">
        <span class="page-num or text-uppercase">
           {{ flipbook.page }}-ը  {{ flipbook.numPages }} {{text.page}}
        </span>
                <button @click="flipbook.flipLeft" class="flip_button_left btn left disabled">
                    <i class="fa fa-angle-left fa-8x"></i>
                </button>
                <button @click="flipbook.flipRight" class="flip_button_right btn right disabled">
                    <i class="fa fa-angle-right fa-8x"></i>
                </button>
            </div>
        </flipbook>
    </div>
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import Flipbook from 'flipbook-vue';
    import text from './json/pages.json';
    // import Flipbook from 'flipbook-vue/src/Flipbook.vue'

    export default {
        data() {
            return {
                id: "",
                path: '/uploads/books/',
                images: [
                    null,
                    '/uploads/books/1/01.jpg',
                    '/uploads/books/1/02.jpg',
                    '/uploads/books/1/03.jpg',
                    '/uploads/books/1/04.jpg',
                    '/uploads/books/1/05.jpg',
                    '/uploads/books/1/06.jpg',
                ],
                text: text
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
            'flipbook': Flipbook

        },
        methods: {
            getBook: function () {

                let credentials = {
                    id: this.$route.params.id,
                    token: this.currentUser.token,
                    url: 'books',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {

                        // this.images = res;
                        console.log(res);

                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })

                // axios.get('/api/auth/books/' + id)
                //     .then(function (response) {
                //         console.log(response);
                //
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     });

            },
        },
        mounted() {
            this.getBook();
        }

    }
</script>
<style>
    #flipbook {
        border-bottom: 2px dotted #eee;
    }

    .flipbook {
        width: 90vw;
        height: 90vh;

    }

    .action-bar {
        width: 100%;
        height: 30px;
        padding: 10px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5vw;
        margin-top: 2vh;
    }

    .flip_button_right, .flip_button_left {
        position: absolute;
        cursor: pointer;
        z-index: 10;
        opacity: 0.2;
        right: 0;
        top: 64vh;
        display: block;
    }

    .flip_button_left {
        left: 0;
    }

    .flip_button_right i, .flip_button_left i {
        transform: scale(2, 3);
        -webkit-transform: scale(2, 3);
    }
</style>
