<h1 class="text-center">
    Welcome to Attendance Management page
</h1>


<div class="text-center">
    <button onclick="addEmployeePage()" id="addBtn">Add Employee's Attendance</button>
</div>

<div class="text-center">
    <h2>Check Attendance Record</h2>
</div>

<div>
    <div>

        <label>Choose a Month:</label>
        <select name="month" id="add-month">
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
        
    </select>
</div>

<div>
    <input id="add-year" type="text" placeholder="Add Year">
</div>
<div>
    <button class="button" id="attendanceRecord" onclick="attendanceRecordPage()">Submit</button>
</div>
</div>


<script>
    function addEmployeePage() {
        window.location.href = `http://localhost:8765/attendances/manage`;
    }

    function attendanceRecordPage(){
        let month = document.getElementById('add-month').value;
        let year = document.getElementById('add-year').value;    
        window.location.href = `http://localhost:8765/attendances/showattendancedata/${year}-${month}`;
    }
</script>