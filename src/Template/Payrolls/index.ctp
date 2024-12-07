<div style="margin-bottom: 5rem;">
    <h2 class="text-center" style="font-size: 2rem; color: #333; font-weight: bold;">Payroll Management</h2>
</div>

<div class="card" style="width: 300px; margin: 20px auto; padding: 20px; border-radius: 10px; background-color: #fff; 
                        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease; margin-bottom: 5rem;">
    <div class="card-body text-center" style="padding: 20px;">
        <h3 style="margin-bottom: 20px; color: #333; font-size: 1.5rem; font-weight: 600;">Generate Payroll</h3>
        <button id="generate" onclick="generatePayrollPage()" style="padding: 12px 24px; font-size: 16px; 
                background-color: #007bff; color: white; border: none; border-radius: 8px; cursor: pointer; 
                transition: background-color 0.3s; box-shadow: 0 2px 4px rgba(0, 123, 255, 0.3);">
            Generate Payroll
        </button>
    </div>
</div>

<div style="display: flex; margin-bottom:6rem">



    <div style="width: 100%; display: flex; justify-content: center; align-items: center; background-color: #f4f7fa;">
        <div style="width: 100%; max-width: 600px; background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;">
            <h3 class="text-center" style="font-size: 1.75rem; color: #333; margin-bottom: 1.5rem; font-weight: bold;"> Payroll For Employee</h3>
            <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 8px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                    <div style="flex: 0 0 48%;">
                        <label for="department-select" style="font-size: 1rem; color: #333; margin-bottom: 0.5rem;">Department</label>
                        <select id="department-select" name="department" onchange="fetchEmployees()" style="width: 100%;  border-radius: 8px; border: 1px solid #ccc; font-size: 14px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
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

                    <div style="display: flex; align-items: center; width: 48%; flex-grow: 1;">
                        <div style="width: 100%; max-width: 300px; flex-grow: 1; margin-right: 15px;">
                            <label for="employees-select" style="font-size: 1rem; color: #333; margin-bottom: 0.5rem;">Employee Name</label>
                            <select id="employees-select" name="employee_id" style="width: 100%;  border-radius: 8px; border: 1px solid #ccc; font-size: 14px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                <option value="">Select an Employee</option>
                            </select>
                        </div>
                        <div id="employee-spinner" style="display: none; align-items: center;">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                    <div style="flex: 0 0 48%;">
                        <label for="month" style="font-size: 1rem; color: #333; margin-bottom: 0.5rem;">Month</label>
                        <select id="month" name="month" style="width: 100%; border-radius: 8px; border: 1px solid #ccc; font-size: 14px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
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
                        <label for="year" style="font-size: 1rem; color: #333; margin-bottom: 0.5rem;">Year</label>
                        <input
                            type="text"
                            id="year"
                            name="year"
                            style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 14px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    </div>
                </div>

                <input type="hidden" name="first_form" value="first_form">
                <button
                    onclick="viewPayrollPage()"
                    type="submit"
                    style="padding: 14px 28px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, transform 0.2s; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);">
                    Submit
                </button>
            </fieldset>
        </div>
    </div>




    <div style="width:100%; display: flex; justify-content: center; align-items: center; ">
        <div style="width: 100%; max-width: 500px; background-color: #f9f9f9; border-radius: 8px; padding: 2rem;  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;">
            <h3 class="text-center" style="font-size: 1.75rem; color: #333; margin-bottom: 1.5rem; font-weight: bold;"> Payroll For Department Wise Per</h3>

            <input
                type="text"
                id="payroll-dept-year"
                placeholder="Enter Year"
                style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; margin-bottom: 1.5rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); transition: border-color 0.3s;">

            <div style="width: 100%; display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="flex: 1; min-width: 160px;">
                    <label for="month" style="font-size: 1rem; color: #333; display: block; margin-bottom: 0.5rem;">Month</label>
                    <select
                        id="payroll-dept-month"
                        name="month"
                        style="width: 100%; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                        <option value="">Select Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
            </div>

            <button
                id="payroll-dept-submit"
                onclick="payrollDeptSubmit()"
                type="submit"
                style="padding: 14px 28px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, transform 0.2s; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);">
                Submit
            </button>
        </div>
    </div>


</div>

<div style="display: flex;">

    <div style="width:100%; display: flex; justify-content: center; align-items: center;">
        <div style="width: 100%; max-width: 500px; background-color: #f9f9f9; border-radius: 8px; padding: 2rem; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;">
            <h3 class="text-center" style="font-size: 1.75rem; color: #333; margin-bottom: 1.5rem; font-weight: bold;"> Payroll For Employee Month Wise</h3>
            <input
                type="text"
                id="payroll-emp-mon-year"
                placeholder="Enter Year"
                style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; margin-bottom: 1.5rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); transition: border-color 0.3s;">

            <div style="width: 100%; display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="flex: 1; min-width: 160px;">
                    <label for="month" style="font-size: 1rem; color: #333; display: block; margin-bottom: 0.5rem;">Month</label>
                    <select
                        id="payroll-emp-mon-month"
                        name="month"
                        style="width: 100%;  border-radius: 8px; border: 1px solid #ccc; font-size: 16px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                        <option value="">Select Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
            </div>

            <button
                id="payroll-emp-mon-submit"
                onclick="payrollEmpMonSubmit()"
                type="submit"
                style="padding: 14px 28px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, transform 0.2s; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);">
                Submit
            </button>
        </div>
    </div>



    <div style="width:100%; display: flex; justify-content: center; align-items: center;">
        <div style="width: 100%; max-width: 500px; background-color: #f9f9f9; border-radius: 8px; padding: 2rem; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;">
            <h3 class="text-center" style="font-size: 1.75rem; color: #333; margin-bottom: 1.5rem; font-weight: bold;"> Payroll For Employee Year Wise</h3>
            <input
                type="text"
                id="payroll-emp-year-year"
                placeholder="Enter Year"
                style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; margin-bottom: 1.5rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); transition: border-color 0.3s;">
            <button
                id="payroll-emp-mon-submit"
                onclick="payrollEmpYearSubmit()"
                type="submit"
                style="padding: 14px 28px; font-size: 16px; background-color: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, transform 0.2s; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);">
                Submit
            </button>
        </div>
    </div>

</div>










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
            } else if (xhr.status === 404) {
                var response = JSON.parse(xhr.responseText);
                console.error('Error: ' + response.message);
                alert(response.message);
            } else {
                console.error('Unexpected error with status:', xhr.status);
            }
        };

        xhr.send(data);


    }
</script>


<script>
    function payrollDeptSubmit() {


        var year = document.getElementById('payroll-dept-year').value;
        var month = document.getElementById('payroll-dept-month').value;

        if (year.length >= 4 && month) {
            window.location.href = `/payrolls/payrolldept/${year}/${month}`;
        }

    }


    function payrollEmpMonSubmit() {

        var year = document.getElementById('payroll-emp-mon-year').value;
        var month = document.getElementById('payroll-emp-mon-month').value;

        if (year.length >= 4 && month) {
            window.location.href = `/payrolls/payrollempmon/${year}/${month}`;
        }
    }


    function payrollEmpYearSubmit() {

        var year = document.getElementById('payroll-emp-year-year').value;

        if (year.length >= 4) {
            window.location.href = `/payrolls/payrollempyear/${year}`;
        }
    }
</script>