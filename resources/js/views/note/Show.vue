<template>
    <div class="container">
        <h1>{{ note.title }}</h1>
        <hr />
        <div class="mb-4">{{ note.subject }} - {{ note.published }}</div>
        {{ note.description }}
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            note: [],
        };
    },

    mounted() {
        // console.log(this.$route.params.noteSlug);
        this.getNote();
    },

    methods: {
        async getNote() {
            let { data } = await axios.get(
                "/api/note/" + this.$route.params.noteSlug
            );
            this.note = data.data;
        },
    },
};
</script>
