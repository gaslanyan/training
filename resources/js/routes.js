import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Verify from './components/Verify.vue';
import Account from './components/Account.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Edit from './components/Edit.vue';
import ForgotPassword from './components/ForgotPassword';
import ResetPasswordForm from './components/ResetPasswordForm';
import Lesson from './components/Lesson.vue';
import Coursedetails from './components/Coursedetails.vue';
import Books from './components/Books.vue';
import Test from './components/Test.vue';
import NotFound from './components/NotFound.vue';
import Howtouse from './components/Howtouse.vue';
import PaymentTerms from './components/Payment.vue';
import PaymentIdram from './components/PaymentIdram.vue';


export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/verify/:id/:key',
        name: 'verify',
        component: Verify,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: {
            requiresAuth: true,
            breadCrumbs: [{
                to: '/account', // hyperlink
                text: 'Օգտվողի պրոֆիլ' // crumb text
            }]
        },
    },
    {
        path: '/edit/:id',
        name: 'edit',
        component: Edit,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            breadCrumbs: [{
                to: '/about', // hyperlink
                text: 'ՄԵՐ ՄԱՍԻՆ' // crumb text
            }]
        },
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
        meta: {
            breadCrumbs: [{
                to: '/contact', // hyperlink
                text: 'ՀԵՏԱԴԱՐՁ ԿԱՊ' // crumb text
            }]
        },
    },
    {
        path: '/howtouse',
        name: 'howtouse',
        component: Howtouse,
        meta: {
            breadCrumbs: [{
                to: '/howtouse', // hyperlink
                text: 'Ինչպես Օգտվել' // crumb text
            }]
        },
    },
    {
        path: '/lessons',
        name: 'lessons',
        component: Lesson,
        meta: {
            breadCrumbs: [{
                to: '/lessons', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑՆԵՐ' // crumb text
            }]
        },
    },
    {
        path: '/coursedetails/:id',
        name: 'coursedetails',
        component: Coursedetails,
        meta: {
            breadCrumbs: [{
                to: '/coursedetails', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑՆԵՐ' // crumb text
            }]
        },
    },
    {
        path: '/book/:id',
        name: 'book',
        component: Books,
        meta: {
            breadCrumbs: [{
                to: '/book', // hyperlink
                text: 'Գրքեր' // crumb text
            }]
        },
    },
    {
        path: '/test/:id',
        name: 'test',
        component: Test,
        meta: {
            requiresAuth: true,
            breadCrumbs: [{
                to: '/test', // hyperlink
                text: 'ԴԱՍԸՆԹԱՑԻ ՍՏՈՒԳՈՒՄ' // crumb text
            }]
        },
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        meta: {
            auth: false,
        }
    },
    {
        path: '/payment_terms',
        name: 'payment_terms',
        component: PaymentTerms,
        meta: {
            auth: false,
        }
    },
    {
        path: '/payment_idram',
        name: 'payment_idram',
        component: PaymentIdram,
        meta: {
            auth: true,
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
            auth: false
        }
    },

    {
        path: '/404',
        name: '404',
        component: NotFound,
    }, {
        path: '*',
        redirect: '/404'
    }
];
