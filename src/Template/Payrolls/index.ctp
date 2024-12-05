<h2 class="text-center">Payroll Management</h2>

<div class="text-center">
    <button id="generate" onclick="generatePayrollPage()">Generate Payroll</button>
</div>

<h3>View Payroll For Employee</h3>


<fieldset>
    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
        <div style="flex: 0 0 48%;">
            <label for="department-select">Department</label>
            <select id="department-select" name="department" onchange="fetchEmployees()">
                <option value="">Select a Department</option>
                <option value="Leadership">Leadership</option>
                <option value="HR">HR</option>
                <option value="Marketing">Marketing</option>
                <option value="Sales">Sales</option>
                <option value="Finance">Finance</option>
                <option value="Support">Support</option>
                <option value="IT">IT</option>
                <option value="R&D">R&D</option>
                <option value="Operations">Operations</option>
                <option value="Legal">Legal</option>
            </select>

        </div>

        <div style="display: flex; align-items: center; width: 48%;">
            <div style="width: 100%; max-width: 300px; flex-grow: 1; margin-right: 15px;">
                <label for="employees-select">Employee Name</label>
                <select id="employees-select" name="employee_id" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; font-size: 14px;">
                    <option value="">Select an Employee</option>
                </select>
            </div>
            <div id="employee-spinner" style="display: none; align-items: center;">
                <i class="fa-solid fa-spinner fa-spin" style="font-size: 20px;"></i>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
        <div style="flex: 0 0 48%;">
            <label for="month">Month</label>
            <select id="month" name="month">
                <option value="">Select Month</option>
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
        <div style="flex: 0 0 48%;">
            <label for="year">Year</label>
            <input type="text" id="year" name="year">
        </div>
    </div>

    <input type="hidden" name="first_form" value="first_form">
    <button onclick="viewPayrollPage()" type="submit">Submit</button>
</fieldset>


<script>
    function generatePayrollPage() {
       window.location.href = "/payrolls/add";
    }

    function fetchEmployees() {
        $('#employee-spinner').css('display', 'flex');
        $('#employees-select').empty();
        var department = $('#department-select').val();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/payrolls/fetchEmployees', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        var data = 'department=' + department;
        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#employee-spinner').css('display', 'none');
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        $('#employees-select').append(new Option("Select Employee", ""))
                        $.each(response.employees, function(key, value) {
                            $('#employees-select').append(new Option(value.name, value.id))
                        });
                    } else {
                        console.error('No message in response');
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    console.error('Response:', xhr.responseText);
                }
            } else {
                console.error('Unexpected error with status:', xhr.status);
            }
        };

        xhr.send(data);
    }

    function viewPayrollPage() {
        var employee_id = Number($("#employees-select").val());
        var month = $("#month").val();
        var year = $("#year").val();
        var date = year + "-" + month; 
        console.log(typeof(employee_id));

        const monthMap = {
            "01": "January",
            "02": "February",
            "03": "March",
            "04": "April",
            "05": "May",
            "06": "June",
            "07": "July",
            "08": "August",
            "09": "September",
            "10": "October",
            "11": "November",
            "12": "December",
        };

        month = monthMap[month];

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/payrolls/fetchPayrollID', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        var data = 'employee_id=' + employee_id + '&month=' + month + '&year=' + year;
        xhr.onload = function() {
            if (xhr.status === 200) {
                // $('#employee-spinner').css('display', 'none');
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        window.location.href = `/payrolls/view/${date}/${employee_id}/${response.id}`;
                    } else {
                        console.error('No message in response');
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    console.error('Response:', xhr.responseText);
                }
            }
            else if(xhr.status === 404){
                var response = JSON.parse(xhr.responseText);
                console.error('Error: ' + response.message);
                alert(response.message);
            }
             else {
                console.error('Unexpected error with status:', xhr.status);
            }
        };

        xhr.send(data);


    }
</script>