<template>
    <div>

        <div class="row p-3">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <date-range-picker v-on:submit="updateRanges" v-bind:allow-compare="false" lang="es"/>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Especialidades</label>
                            <multiselect v-model="selectedSpecialities" :options="doctorSpecialities" label="name" v-bind:multiple="true"></multiselect>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Doctor</label>
                            <multiselect v-model="selectedDoctors" :options="doctors" label="name" v-bind:multiple="true"></multiselect>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>

    </div>

</template>

<script>

    import DateRangePicker from '../date-range-picker/DateRangePicker'
    import Multiselect from 'vue-multiselect'

    const appointmentModel = {
        id: null,
        notes: null,
        scheduled_date: '',
        start_time: '',
        end_time: '',
        created_at: '',
        updated_at: '',
        doctor_id: null,
        status: 1
    };

    export default {
        name: "AppointmentComponent",
        components: {
            DateRangePicker,
            Multiselect
        },
        data: function () {
            return {
                modifyingObject: Object.assign({}, appointmentModel),
                showForm: false,
                displayAlert: false,
                alertType: false,
                showWarehouseModal: false,
                selectedSpecialities: [],
                doctorSpecialities: [],
                selectedDoctors: [],
                doctors: []
            }
        },
        mounted() {
            this.getSpecialities();
            this.getDoctors();
        },
        methods: {
            getSpecialities(){
              axios.get('/api/speciality').then(
                  (response) => {
                      this.doctorSpecialities = response.data;
                  },
                  (error) => {

                  }
              )
            },
            getDoctors(){
                axios.get('/api/doctor').then(
                    (response) => {
                        this.doctors = response.data;
                    },
                    (error) => {

                    }
                )
            },
            getAvailableSchedules() {

            },
            onSaveClick() {

            },
            updateRanges: function (range) {
                console.log(range);
            }
        }
    }
</script>