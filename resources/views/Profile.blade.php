<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center" style="width: 400px; margin: 0 auto;">
            <form method="POST" action="/update">
                @csrf

                <!-- Index No -->
                <div class="mb-3">
                    <label class="form-label" for="Index_no" >Index No</label>
                    <input type="text" class="form-control" id="Index_no" name="Index_no" >
                </div>
                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" >
                </div>

                <!-- Faculty -->
                <div class="mb-3">
                    <label class="form-label" for="Faculty">Faculty</label>
                    <select class="form-select" name="Faculty" id="Faculty">
                        <option selected disabled>-- Select Faculty --</option>
                        <option value="Computing">Computing</option>
                        <option value="Management">Management</option>
                        <option value="Applied Science">Applied Science</option>
                    </select>
                </div>

                <!-- Department -->
                <div class="mb-3">
                    <label class="form-label" for="Department">Department</label>
                    <select class="form-select" name="Department" id="Department">
                        <option selected disabled>-- Select Department --</option>
                    </select>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label" for="Address">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address"  >
                </div>

                <!-- Blood Type -->
                <div class="mb-3">
                    <label class="form-label" for="Blood_Group">Blood Type</label>
                    <select class="form-select" name="Blood_Group" id="Blood_Group">
                        <option selected disabled>-- Select Blood Type --</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="O+">O+</option>
                        <option value="AB+">AB+</option>
                    </select>
                </div>

                <!-- Medical Condition -->
                <div class="mb-3">
                    <label for="Medical_Condition" class="form-label">Medical Condition</label>
                    <textarea class="form-control" id="Medical_Condition" name="Medical_Condition" rows="3"></textarea>
                </div>

                <!-- Telephone -->
                <div class="mb-3">
                    <label class="form-label" for="Telephone">Telephone</label>
                    <input type="text" class="form-control" id="Telephone" name="Telephone" >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- JS for dynamic department selection -->
    <script>
        // Use IDs exactly as in the HTML (case-sensitive)
        const facultySelect = document.getElementById('Faculty');
        const departmentSelect = document.getElementById('Department');

        // Guard in case elements are missing
        if (facultySelect && departmentSelect) {
            const departments = {
                "Computing": ["Software Engineering", "Cyber Security", "Data Science"],
                "Management": ["Accounting", "Business Admin", "HR Management"],
                "Applied Science": ["Biology", "Physics", "Chemistry"]
            };

            facultySelect.addEventListener('change', function () {
                const selectedFaculty = this.value;
                departmentSelect.innerHTML = '<option selected disabled>-- Select Department --</option>';

                if (departments[selectedFaculty]) {
                    departments[selectedFaculty].forEach(dep => {
                        const option = document.createElement('option');
                        option.value = dep;
                        option.textContent = dep;
                        departmentSelect.appendChild(option);
                    });
                }
            });
        }
    </script>
</body>
</html>
