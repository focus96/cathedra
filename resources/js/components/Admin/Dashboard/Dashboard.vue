<template>
    <div>
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <party-week :settings="settings"></party-week>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2';
    import PartyWeek from "./PartyWeek";

    export default {
        data: () => ({

        }),
        props: ['settings'],
        components: {
            PartyWeek,
        },
        methods: {

        },
        created() {

        }
    }
</script>


