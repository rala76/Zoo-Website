<!-- 'Insert Employee' => 'Process Insert Employee' -->
<!doctype html>
<html>
<head>
    <!-- Include default employee page -->
    <?php include("employee.php") ?>

    <title>Insert New Employee</title>
</head>
<body>
    <!-- Example form for Employee_Data -->
    <form class="form-base" method="post" action="process-insert-employee.php">
        <div>
            <label class="required-input-label">Name</label><br>
            <input name="employee-name" type="text" class="form-control" required><br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="employee-date-of-birth" type="text" class="form-control" required><br>

            <!-- Should change to dropdown/select if possible -->
            <label class="required-input-label">Gender</label><br>
            <input name="employee-gender" type="text" class="form-control" required><br>

            <label class="input-label">Phone Number (###-###-####)</label><br>
            <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"><br>

            <label class="input-label">Supervisor ID</label><br>
            <input name="employee-supervisor-id" type="number" min="1" class="form-control" placeholder="NULL"><br>

            <label class="required-input-label">Department Name</label><br>
            <input name="employee-department-name" type="text" class="form-control" required><br>
            
            <label class="input-label">Enclosure ID</label><br>
            <input name="employee-enclosure-id" type="number" min="1" class="form-control" placeholder="NULL"><br>

            <label class="input-label">Store ID</label><br>
            <input name="employee-store-id" type="number" min="1" class="form-control" placeholder="NULL"><br>

            <label class="input-label">Event ID</label><br>
            <input name="employee-event-id" type="number" class="form-control" placeholder="NULL"><br>

            <!-- Should change to dropdown/select if possible -->
            <label class="required-input-label">'Hourly' or 'Salaried'</label><br>
            <input name="employee-hourly-or-salaried" type="text" class="form-control" required><br>

            <label class="input-label">Hourly Wage</label><br>
            <input name="employee-hourly-wage" type="number" min="1" step="0.01" class="form-control" placeholder="NULL"><br>

            <label class="input-label">Weekly Wage</label><br>
            <input name="employee-weekly-wage" type="number" min="1" step="0.01" class="form-control" placeholder="NULL"><br>

            <label class="input-label">Weekly Hours Worked</label><br>
            <input name="employee-weekly-hours-worked" type="number" min="1" class="form-control" placeholder="0"><br>

            <button name="employee-submit" type="submit" class="form-submit">Submit</button>
        </div>
    </form>
</body>
</html>
