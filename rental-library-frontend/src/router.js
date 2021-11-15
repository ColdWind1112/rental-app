import { createWebHistory, createRouter } from "vue-router";
import Books from './components/Books.vue'
import Authors from './components/Authors.vue'
import Home from './components/LandingPage.vue'
import Book from './components/Book'
import Author from './components/Author'

const routes = [{
        path: `/books`,
        component: Books,
    },
    {
        path: `/add-book/:id`,
        component: Book,
    },
    {
        path: `/add-book`,
        component: Book,
    },
    {
        path: `/authors`,
        component: Authors,
    },
    {
        path: `/add-author/:id`,
        component: Author,
    },
    {
        path: `/add-author`,
        component: Author,
    },
    {
        path: `/`,
        component: Home,
    },
];


const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});


export default router;