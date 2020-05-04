<template>
    <div class="container-fulid">
        <div class="container-xl">
            <div class="row flex-center">
                <div class="col-md-6">
                    <h4>Multiple Date Picker</h4>
                    <!-- <div
                        v-for="(selected, i) in calendar.selectedDates"
                        :key="i"
                    >
                        <h4>{{ selected.date }}</h4>
          </div>-->

                    <div>
                        <span v-for="(data, i) in selected" :key="i">
                            {{ data.date }}
                        </span>
                    </div>

                    <functional-calendar
                        v-on:choseDay="clickDay"
                        class="calendar"
                        v-model="calendar"
                        :configs="calendarConfigs"
                    ></functional-calendar>
                </div>
                <button
                    type="submit"
                    @click="submit"
                    class="btn btn-success"
                >

                    <span >Submit free day</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { FunctionalCalendar } from "vue-functional-calendar";

export default {
    components: { FunctionalCalendar },
    data() {
        return {
            data: [],
            id:"",
            user_id:"",
            flights:[],
            selected: [],
            datePick: [],
            calendar: {},
            calendarConfigs: {
                disabledDates: ["beforeToday"],
                isMultipleDatePicker: true,
                markedDates: []
            }
        };
    },
    methods: {
        clickDay() {
            this.selected = this.calendar.selectedDates;
            // console.log(this.selected);
            // console.log(this.calendar.selectedDates);
        },
        submit(){
            // console.log("!!!!!!!!!!!!!!!!!");

            let data = {
                user_id:this.user_id,
                array_date:this.selected
            }
            axios.post('/api/backend/addNewWork',data).then(response=> {
                // console.log(response.data);

            });
        }
    },
    beforeMount(){


        axios.get('/api/admin/init').then(response => {
            this.id = response.data.id;
            axios.post('/api/backend/getflightdetail',{id: this.id}).then(response =>{
                // console.log(response.data);
                this.user_id = response.data[0];
                this.flights.push(response.data[1]);
            });

            axios.get(`/api/backend/schedule/${this.id}`).then(response =>{
                //console.log(response.data);

                response.data.forEach(each_day => {
                    var Sdate = each_day['work_date'].split("-");
                    var newDate = Number(Sdate[2])+"/"+Number(Sdate[1])+"/"+Sdate[0];
                    if(each_day['confirm_status'] == "confirm"){

                        this.calendarConfigs.markedDates.push({date:newDate,class:"green-line"});
                    }
                    else if (each_day['confirm_status'] == "free"){
                        //console.log(newDate);
                        this.calendarConfigs.markedDates.push({date: newDate,class:"grey-line"});
                    }
                });
            });
        });






    }
};
</script>

<style lang="scss">
.green-line {
    width: 30px;
    line-height: 30px;
    color: #ffffff;
    background-color: #45cc0d;
    border-radius: 100%;
    margin: 0 auto;
}

.grey-line {
    width: 30px;
    line-height: 30px;
    color: #ffffff;
    background-color: 	#A9A9A9;
    border-radius: 100%;
    margin: 0 auto;
}

.green-point {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #45cc0d;
    bottom: 3px;
    left: calc(50% - 4px);
}

.orange-point {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #ebae05;
    bottom: 3px;
    left: calc(50% - 4px);
}
</style>
