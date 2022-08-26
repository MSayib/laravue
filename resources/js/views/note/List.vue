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
                </tr>
            </thead>
            <tbody>
                <tr v-for="n in notes" :key="n.id">
                    <td><router-link :to="{name:'note.show', params:{ noteSlug: n.slug} }">{{ n.title }}</router-link></td>
                    <td>{{ n.subject }}</td>
                    <td>{{ n.published }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
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
