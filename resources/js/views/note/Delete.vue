<template>
    <button ref="hapus" @click="deleteNote">Delete</button>
</template>

<script>
import axios from 'axios'
export default {
    props: ['endpoint'],
    methods: {
        async deleteNote() {
            // console.log('Tombol fungsi')
            let q = window.confirm("Yakin?");
            if (q == true) {
                let res = await axios.delete(`/api/note/${this.endpoint}/delete`)
                if (res.status === 200){
                    this.$toasted.show(res.data.message, {
                        type: 'success',
                        duration: 3000,
                        position: 'bottom-right',
                        theme: 'outline'
                    })
                }
                this.$refs.hapus.parentNode.parentNode.remove()
            }
        }
    }
}
</script>
