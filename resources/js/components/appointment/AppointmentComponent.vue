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
                            <multiselect v-model="selectedDoctorSpecialities" :options="doctorSpecialities" label="name" v-bind:multiple="true"></multiselect>
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
            <div class="col-6 p-0">


                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nombre</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</template>

<script>

    import DateRangePicker from '../date-range-picker/DateRangePicker';
    import Multiselect from 'vue-multiselect';
    import { FullCalendar } from 'vue-full-calendar'

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
            Multiselect,
            FullCalendar
        },
        data: function () {
            return {
                modifyingObject: Object.assign({}, appointmentModel),
                showForm: false,
                displayAlert: false,
                alertType: false,
                showWarehouseModal: false,
                doctorSpecialities: [],
                doctors: [],
                availableSchedules: [],
                selectedDoctorSpecialities: [],
                selectedDoctors: [],
                selectedDateRange: []
            }
        },
        mounted() {
            this.getSpecialities();
            this.getDoctors();
        },
        watch: {
            selectedSpecialities: function(){
                this.getAvailableSchedules();
            }
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

                let params = '?';
                let dates = [this.selectedDateRange.startDate.format('YYYY-MM-DD'), this.selectedDateRange.endDate.format('YYYY-MM-DD')];
                params += `doctors=${JSON.stringify(this.selectedDoctors)}`;
                params += `&specialities=${JSON.stringify(this.selectedDoctorSpecialities)}`;
                params += `&appointment_dates=[${JSON.stringify(dates)}]`;

                console.log(params);

                axios.get(`/api/appointments/available-schedules${params}`).then(
                    (response) => {
                        console.log(response.data);
                        this.availableSchedules = response.data;
                    },
                    (error) => {

                    }
                )

            },
            onSaveClick() {},
            updateRanges: function (range) {
                this.selectedDateRange = Object.assign({}, range);
                this.getAvailableSchedules();
            }
        }
    }
</script>