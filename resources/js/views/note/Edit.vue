<template>
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Note</div>
                <div class="card-body">
                    <form action="" method="patch" @submit.prevent="update">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" v-model="form.title" id="title" class="form-control">
                            <div v-if="err.title" class="mt-2 text-danger">{{ err.title[0] }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="subject">Subject</label>
                            <select @change="selectBaru" id="subject" class="form-select">
                                <option :value="form.subject_id" v-text="form.subject"></option>
                                <template v-for="s in subjects">
                                    <option v-if="form.subject_id !== s.id" :key="s.id" :value="s.id">
                                        {{ s.name }}
                                    </option>
                                </template>
                            </select>
                            <div v-if="err.subject" class="mt-2 text-danger">{{ err.subject[0] }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                            <div v-if="err.description" class="mt-2 text-danger">{{ err.description[0] }}</div>
                        </div>

                        <template>
                            <button type="submit" class="btn btn-primary mt-3 d-flex align-items-center" v-if="loading">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="30px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <rect x="17.5" y="30" width="15" height="40" fill="#ffffff"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate> </rect> <rect x="42.5" y="30" width="15" height="40" fill="#f5fdff"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate> </rect> <rect x="67.5" y="30" width="15" height="40" fill="#e7f6ff"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate> </rect> </svg>
                            </button>
                            <button type="submit" class="btn btn-primary mt-3 d-flex align-items-center" v-else>
                                Update
                            </button>
                        </template>
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
            form: [],
            successMessage: '',
            subjects: [],
            selected: '',
            loading: false,
            err: [],
        }
    },

    mounted() {
        this.getSubject();
        this.getNote();
    },

    methods: {
        async getSubject() {
            let res = await axios.get('/api/subject')
            // console.log(res.data);
            if (res.status === 200) {
                this.subjects = res.data
            }
        },

        async getNote() {
            // Fetch data buat di form
            let res = await axios.get(`/api/note/${this.$route.params.noteSlug}`)
            if (res.status === 200){
                // console.log(res.data.data);
                this.form = res.data.data
                // console.log(this.form.subject_id);
            }
        },

        selectBaru(e) {
            // console.log(e.target.value)
            this.selected = e.target.value
        },

        async update() {
            this.loading = true
            // console.log(this.form)
            this.form['subject'] = this.selected || this.form.subject_id
            // console.log(this.form)
            try {
                let res = await axios.patch(`/api/note/${this.$route.params.noteSlug}/edit`, this.form)
                if (res.status === 200) {
                    this.loading = false
                    // console.log('setelah di patch: ',res.data);
                    this.$toasted.show(res.data.message, {
                        type: 'success',
                        duration: 3000,
                        position: 'bottom-right',
                        theme: 'outline'
                    })
                    this.$router.push('/note/list')
                }
            } catch (e) {
                this.loading = false
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
