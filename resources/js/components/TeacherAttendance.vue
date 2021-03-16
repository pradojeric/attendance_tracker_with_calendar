<template>
    <div>
        <div class="form-group row">
            <label for="a_date" class="col-sm-2 col-form-label">
                Date:
            </label>
            <input type="date" id="a_date" :value="today" class="form-control col-sm-4">
            <div class="col-sm-auto">
                <button type="button" id="date_select" class="btn btn-primary">Select</button>
            </div>
            <div class="col-sm-auto">
                <button type="button" id="date_clear" class="btn btn-danger">Clear</button>
            </div>
        </div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Schedule</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Expiration</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody class="attend">

                </tbody>
        </table>
        <form action="#" method="post" id="att_form">
            @csrf
            @method('put')
        </form>
    </div>
</template>

<script>
    export default {
        mounted () {
            this.getAttendance();
        },
        props: ['room'],
        data() {
            return {
                room_id: this.room,
                today : new Date(),
                attendances: [],
                attendance: {
                  date: '',
                  schedule: '',
                  description: '',
                  created: '',
                  expiration: '',
                },
            }
        },
        methods: {
            getAttendance(date) {
                axios.get('/api/attendances').then(res => console.log(res));
            },
            activateAttendance(){

            },
            deleteAttendance(){

            },
            viewAttendance(){

            },
        },
    }
</script>
