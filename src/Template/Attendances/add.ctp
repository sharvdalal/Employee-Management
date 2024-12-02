<div class="text-center">

    <button id="todayButton" onclick="addTodaysAttendancePage()" type="button">Add Today's Attendance</button>

    </div>

    <div class="callout success">

        <label for="attendance">Choose Date</label>
        <input class="" type="date" id="attendance" name="attendance">
        <button id="datebutton" onclick="addAttendancePage()">Submit</button>
    </div>
 



<script>
    const today = new Date();
    const dateSplit = today.toISOString().split('T')[0];
    document.getElementById('attendance').setAttribute('max', dateSplit);

    function addTodaysAttendancePage() {
        window.location.href = `http://localhost:8765/attendances/addattendance/${dateSplit}`;
    }

    function addAttendancePage(){
        let date = document.getElementById('attendance').value;
        if(!date) return;

        window.location.href = `http://localhost:8765/attendances/addattendance/${date}`;
    }
</script>