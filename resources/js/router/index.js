import Home from '../views/Home'
import About from '../views/About'
import Contact from '../views/Contact'
import NewNote from '../views/note/Create'
import NoteList from '../views/note/List'
import ShowNote from '../views/note/Show'

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
        {
            path: '/note/list',
            name: 'note.list',
            component: NoteList
        },
        {
            path: '/note/:noteSlug',
            name: 'note.show',
            component: ShowNote
        },
    ]
}
