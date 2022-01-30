<template>
    <div id="flipbook">
        <flipbook class="flipbook" :pages="images" :startPage="page" v-slot="flipbook" ref="flip">
            <div class="action-bar">
        <span class="page-num or text-uppercase">
           {{ flipbook.page }}-ը  {{ flipbook.numPages }} {{ text.page }}
        </span>
                <button @click="flipbook.flipLeft" class="flip_button_left btn left disabled">
                    <i class="fa fa-angle-left fa-8x"></i>
                </button>
                <button @click="flipbook.flipRight; clickFlipRight()" class="flip_button_right btn right disabled">
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
            images: [
                null,
            ],
            count: 0,
            page: null,
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
                url: 'book',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.count = res.book.count;
                    for (let i = 0; i < res.book.count; i++) {
                        let name = i + 1;
                        this.images.push(`${res.book.path}/${name}.jpg`);

                    }
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
                })
        },
        clickFlipRight: function () {
            let page = this.$refs.flip.page;
            let credentials = {
                token: this.currentUser.token,
                account_id: this.currentUser.id,
                course_id: localStorage.getItem('cb_id'),
                page: page,
                count: this.count,
                url: 'readingBook',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    console.log(res)

                })
                .catch(error => {
                    console.log(error)
                })
            this.$refs.flip.flipRight();
        },
        getPage: function () {

            let credentials = {
                token: this.currentUser.token,
                account_id: this.currentUser.id,
                course_id: localStorage.getItem('cb_id'),
                url: 'getpage',
                auth: true
            };
            getPromiseResult(credentials)
                .then(res => {
                    this.page =res.page;

                })
                .catch(error => {
                    console.log(error)
                })
            this.$refs.flip.flipRight();
        }
    },
    mounted() {
        this.getBook();
        this.getPage();
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
