<template>
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Note</div>
                <div class="card-body">
                    <form action="" method="post" @submit.prevent="store">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" v-model="form.title" id="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="subject">Subject</label>
                            <select v-model="form.subject" id="subject" class="form-select">
                                <option selected disabled value="">Choose one</option>
                                <option v-for="s in subject" :key="s.id" :value="s.id">
                                    {{ s.name }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                title: '',
                description: '',
                subject: '',
            },
            subject: [],

        }
    },

    mounted() {
        this.getSubject();
    },

    methods: {
        async getSubject() {
            let res = await axios.get('/api/subject')
            // console.log(res.data);
            if (res.status === 200) {
                this.subject = res.data
            }
        },

        async store() {
            let res = await axios.post('/api/note/create-new-note', this.form)
            // console.log(res.data)
            if (res.status === 200) {
                this.form.title = ""
                this.form.subject = ""
                this.form.description = ""
            }
        }
    }
}
</script>
