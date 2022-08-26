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
                            <div v-if="err.title" class="mt-2 text-danger">{{ err.title[0] }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="subject">Subject</label>
                            <select v-model="form.subject" id="subject" class="form-select">
                                <option disabled value="">Choose one</option>
                                <option v-for="s in subjects" :key="s.id" :value="s.id">
                                    {{ s.name }}
                                </option>
                            </select>
                            <div v-if="err.subject" class="mt-2 text-danger">{{ err.subject[0] }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                            <div v-if="err.description" class="mt-2 text-danger">{{ err.description[0] }}</div>
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
                subject: '', //select yg dipilih user nantinya
            },
            successMessage: '',
            subjects: [], //data untuk select dari db
            err: [],
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
                this.subjects = res.data
            }
        },

        async store() {
            try {
                let res = await axios.post('/api/note/create-new-note', this.form)
                // console.log(res.data)
                if (res.status === 200) {
                    this.form.title = ""
                    this.form.subject = ""
                    this.form.description = ""
                    this.err = []

                    this.$toasted.show(res.data.message, {
                        type: 'success',
                        duration: 3000,
                        position: 'bottom-right',
                        theme: 'outline'
                    })
                }
            } catch (e) {
                // console.log(e.response.data.errors);
                this.err = e.response.data.errors;
                this.$toasted.show("Something went wrong", {
                    type: 'error',
                    duration: 3000,
                    position: 'bottom-right',
                    theme: 'outline'
                })
            }
        }
    }
}
</script>
