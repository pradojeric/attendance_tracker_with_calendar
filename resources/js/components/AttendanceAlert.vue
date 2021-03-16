<template>
    <div>

    </div>
</template>

<script>
    export default {
        props: [
            'room_id'
        ],
        data() {
            return {
                room: this.room_id,
            }
        },
        mounted() {
            console.log('Component mounted.')
            Echo.private('attendance-tracker.' + this.room)
            .listen('AttendanceActivated', (e) => {
                console.log('attendance is activated');
                console.log(e);
            });
        }
    }
</script>
