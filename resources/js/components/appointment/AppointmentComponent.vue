<template>

    <div class="row row-cards row-deck">

        <div class="col-6">
            <div class="card">
                <div class="card-body p-0">

                    <div class="row p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <date-range-picker v-on:submit="updateRanges" v-bind:allow-compare="false"
                                                       lang="es"/>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2" v-for="i in Math.ceil(daysOfWeek.length / 3)">

                                    <div class="form-group">

                                        <div class="custom-controls-stacked"
                                             v-for="dayOfWeek in daysOfWeek.slice((i - 1) * 3, i * 3)">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       @change="getAvailableSchedules" v-bind:name="daysOfWeek.label"
                                                       v-bind:id="daysOfWeek.label" v-model="dayOfWeek.selected">
                                                <span class="custom-control-label" v-bind:for="dayOfWeek.label"
                                                      v-text="dayOfWeek.label"></span>
                                            </label>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2 offset-lg-2">

                                    <div class="form-group" v-for="shift in shifts">

                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       v-bind:name="shift.label" v-bind:id="shift.label"
                                                       v-model="shift.selected">
                                                <span class="custom-control-label" v-bind:for="shift.label"
                                                      v-text="shift.label"></span>
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Doctor</label>
                                        <multiselect v-model="selectedDoctors" :options="doctors" label="name"
                                                     v-bind:multiple="true" trackBy="id"
                                                     :closeOnSelect="false"></multiselect>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Especialidades</label>
                                        <multiselect v-model="selectedDoctorSpecialities" :options="doctorSpecialities"
                                                     label="name" v-bind:multiple="true" trackBy="id"
                                                     :closeOnSelect="false"></multiselect>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de cita</label>
                                        <multiselect v-model="selectedAppointmentType" :options="appointmentTypes"
                                                     label="name" v-bind:multiple="false" trackBy="id"></multiselect>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <multiselect v-model="selectedGender" :options="genders"
                                                     label="name" v-bind:multiple="false" trackBy="value"></multiselect>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-12">

                            <div class="table-responsive" style="max-height: 600px; overflow-y: scroll">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Doctor</th>
                                            <th>Fecha</th>
                                            <th>Hasta</th>
                                            <th>Desde</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="dateInfo in availableSchedules">
                                        <template v-for="doctorInfo in dateInfo">
                                            <tr v-for="availableSchedule in doctorInfo.available_schedules">
                                                <td><a href="">{{doctorInfo['first_name']}} {{doctorInfo['last_name']}}</a></td>
                                                <td>{{availableSchedule['date']}}</td>
                                                <td>{{availableSchedule['start_time']}}</td>
                                                <td>{{availableSchedule['end_time']}}</td>
                                                <td><button class="btn btn-secondary btn-sm" @click="onMakeAppointmentClick(dateInfo, doctorInfo, availableSchedule)">Realizar cita</button></td>
                                            </tr>
                                        </template>
                                    </template>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <template v-if="showAppointmentCompleteModal" @close="showAppointmentCompleteModal = false" @select="onSaveClick">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Completar cita
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                Por favor confirme las informaciones antes de aceptar:

                                <ul>
                                    <li></li>
                                </ul>

                            </slot>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger" v-on:click="$emit('accept')"><i class="fe fe-x"></i>Aceptar
                            </button>
                            <button class="btn btn-sm btn-danger" v-on:click="$emit('close')"><i class="fe fe-x"></i>Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>


</template>

<script>

    import DateRangePicker from '../date-range-picker/DateRangePicker';
    import Multiselect from 'vue-multiselect';

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

    const daysOfWeek = [
        {
            'value': 0,
            'label': 'Domingo',
            'selected': true
        },
        {
            'value': 1,
            'label': 'Lunes',
            'selected': true,
        },
        {
            'value': 2,
            'label': 'Martes',
            'selected': true,
        },
        {
            'value': 3,
            'label': 'Miércoles',
            'selected': true
        },
        {
            'value': 4,
            'label': 'Jueves',
            'selected': true,
        },
        {
            'value': 5,
            'label': 'Viernes',
            'selected': true,
        },
        {
            'value': 6,
            'label': 'Sábado',
            'selected': true
        }
    ];

    const shifts = [
        {
            'from': '04:00:00',
            'to': '12:00:00',
            'label': 'Dia',
            'selected': true
        },
        {
            'from': '12:00:00',
            'to': '18:00:00',
            'label': 'Tarde',
            'selected': true
        },
        {
            'from': '18:00:00',
            'to': '24:00:00',
            'label': 'Noche',
            'selected': true
        },
    ];

    const genders = [
        {
            value: "m",
            name: "Masculino"
        },
        {
            value: "f",
            name: "Femenino"
        }
    ];

    export default {
        name: "AppointmentComponent",
        components: {
            DateRangePicker,
            Multiselect,
        },
        data: function () {
            return {
                modifyingObject: Object.assign({}, appointmentModel),
                showForm: false,
                displayAlert: false,
                alertType: false,
                showAppointmentCompleteModal: false,
                doctorSpecialities: [],
                doctors: [],
                availableSchedules: [],
                appointmentTypes: [],
                selectedDoctorSpecialities: [],
                selectedDoctors: [],
                selectedDateRange: [],
                selectedAppointmentType: {},
                selectedGender: {},
                daysOfWeek: Object.assign([], daysOfWeek),
                shifts: Object.assign([], shifts),
                genders: Object.assign([], genders),
                selectedAppointment : {
                    scheduled_date : '',
                    start_time: '',
                    end_time: '',
                    status: 'active',
                    doctor_id: null,
                    notes: null,
                    appointment_type: null
                }
            }
        },
        mounted() {
            this.getAppointmentTypes();
            this.getSpecialities();
            this.getDoctors();

        },
        watch: {
            selectedDoctorSpecialities: function () {
                this.getAvailableSchedules();
            },
            selectedDoctors: function () {
                this.getAvailableSchedules();
            },
            selectedAppointmentType: function () {

                this.selectedAppointment['appointment_type'] = this.selectedAppointmentType;

                this.getAvailableSchedules();
            },
            daysOfWeek: function () {
                this.getAvailableSchedules();
            },
            shifts: function () {
                this.getAvailableSchedules();
            },
            selectedGender: function () {
                this.getAvailableSchedules();
            },
        },
        methods: {
            getAppointmentTypes() {

                axios.get('/api/appointment-type').then(
                    (response) => {
                        this.appointmentTypes = response.data;
                    },
                    (error) => {

                    }
                )

            },
            getSpecialities() {
                axios.get('/api/speciality').then(
                    (response) => {
                        this.doctorSpecialities = response.data;
                    },
                    (error) => {

                    }
                )
            },
            getDoctors() {
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
                params += `&appointment_dates=${JSON.stringify(dates)}`;
                params += `&appointment_type=${JSON.stringify(this.selectedAppointmentType)}`;
                params += `&days_of_week=${JSON.stringify(daysOfWeek)}`;
                params += `&shifts=${JSON.stringify(this.shifts)}`;

                if (this.selectedGender['value']){
                    params += `&gender=${this.selectedGender['value']}`;
                }

                axios.get(`/api/appointments/available-schedules${params}`).then(
                    (response) => {
                        this.availableSchedules = response.data.payload;
                    },
                    (error) => {

                    }
                );

            },
            onSaveClick() {

                axios.post('/api/appointments', this.selectedAppointment).then(
                    (response) => {
                        console.log(response.data);
                    }
                )
            },
            updateRanges: function (range) {
                this.selectedDateRange = Object.assign({}, range);
                this.getAvailableSchedules();
            },
            onMakeAppointmentClick: function(dateInfo, doctorInfo, availableSchedule){

                this.selectedAppointment['scheduled_date'] = availableSchedule['date'];
                this.selectedAppointment['start_time'] = availableSchedule['start_time'];
                this.selectedAppointment['end_time'] = availableSchedule['end_time'];
                this.selectedAppointment['doctor_id'] = doctorInfo['id'];



                if (!this.selectedAppointment['appointment_type']) {

                    alert('Por favor seleccione el tipo de cita antes de proceder a realizarla, esto es para asegurar el mejor tiempo posible.');
                    return ;

                }

                // this.showAppointmentCompleteModal = true;

                this.onSaveClick();


            }
        }
    }
</script>