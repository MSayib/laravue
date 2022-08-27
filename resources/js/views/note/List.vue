<template>
    <div class="container">
        <h3>Note List</h3>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Published</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="n in notes" :key="n.id">
                    <td><router-link :to="{name:'note.show', params:{ noteSlug: n.slug} }">{{ n.title }}</router-link></td>
                    <td>{{ n.subject }}</td>
                    <td>{{ n.published }}</td>
                    <td><router-link :to="{name:'note.edit', params:{ noteSlug: n.slug} }">Edit</router-link></td>
                    <td><delete-note :endpoint="n.slug"/></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import DeleteNote from './Delete'
export default {
    components: {
        DeleteNote,
    },
    data() {
        return {
            notes: [],
        }
    },

    mounted() {
        this.getNotes()
    },

    methods: {
        async getNotes() {
            let res = await axios.get('/api/note');
            this.notes = res.data.data
            // console.log(res.data.data)
        }
    }
}
</script>
