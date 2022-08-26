import Home from '../views/Home'
import About from '../views/About'
import Contact from '../views/Contact'
import NewNote from '../views/note/Create'

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'page.about',
            component: About
        },
        {
            path: '/contact',
            name: 'page.contact',
            component: Contact
        },
        {
            path: '/note/create',
            name: 'note.create',
            component: NewNote
        },
    ]
}
