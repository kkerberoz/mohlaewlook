<template>
    <div>
        <h1 class = "title"> Dlife single:  please call me: 0xxxxxxxxx </h1>
        <h4>เราไม่ทิ้งกัน</h4>
        <form action = "#">
            <div class = "form-group">
                <label>อาชีพ : </label>
                <input type = "text" class = "form-control" v-model = "job">
            </div>
            <div class = "form-group">
            <button type="submit" class="btn btn-primary" v-on:click="addNewData()">ยืนยัน</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            job: ''
        }
    },
    method:{
        addNewData(){
            console.log(job);
        }
    }
}
</script>
