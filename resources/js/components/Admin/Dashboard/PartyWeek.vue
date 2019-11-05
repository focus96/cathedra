<template>
    <div>
       <div>
           Четность текущей недели:&nbsp;&nbsp;&nbsp;
           <input class="form-check-input" type="radio" @change="partyChange()" v-model="party" id="exampleRadios1" value="even" checked>
           <label class="form-check-label" for="exampleRadios1">
               *
           </label>
           &nbsp;&nbsp;&nbsp;
           <input class="form-check-input" type="radio" @change="partyChange()" v-model="party" id="exampleRadios2" value="odd">
           <label class="form-check-label" for="exampleRadios2">
               |
           </label>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2';

    export default {
        data: () => ({
            party: 'even',
        }),
        props: ['settings'],
        methods: {
            partyChange() {
                axios.post('/admin/save-party', {
                    party: this.party
                }).then(response => {
                    this.message = null;
                    Swal.fire(
                        'Сохранено',
                        `Четность недели успешно сохранена`,
                        'success'
                    )
                }).catch(error => {
                    Swal.fire(
                        'Ошибка',
                        'Упс.. Произошла ошибка при сохранении четности недели',
                        'error'
                    )
                });
            }
        },
        created() {
            console.log(this.settings);
            this.party = this.settings.party_week ? this.settings.party_week : this.party;
        }
    }
</script>


