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
            <form method="POST" action="{{ url('/profile') }}">
                @csrf

                <!-- Index No -->
                <div class="mb-3">
                    <label class="form-label" for="index_no">Index No</label>
                    <input type="text" class="form-control" id="index_no" name="index_no" >
                </div>

                <!-- Faculty -->
                <div class="mb-3">
                    <label class="form-label" for="faculty">Faculty</label>
                    <select class="form-select" name="faculty" id="faculty">
                        <option selected disabled>-- Select Faculty --</option>
                        <option value="Computing">Computing</option>
                        <option value="Management">Management</option>
                        <option value="Applied Science">Applied Science</option>
                    </select>
                </div>

                <!-- Department -->
                <div class="mb-3">
                    <label class="form-label" for="department">Department</label>
                    <select class="form-select" name="department" id="department">
                        <option selected disabled>-- Select Department --</option>
                    </select>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" >
                </div>

                <!-- Blood Type -->
                <div class="mb-3">
                    <label class="form-label" for="blood_type">Blood Type</label>
                    <select class="form-select" name="blood_type" id="blood_type">
                        <option selected disabled>-- Select Blood Type --</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="O+">O+</option>
                        <option value="AB+">AB+</option>
                    </select>
                </div>

                <!-- Medical Condition -->
                <div class="mb-3">
                    <label for="medical" class="form-label">Medical Condition</label>
                    <textarea class="form-control" id="medical" name="medical" rows="3"></textarea>
                </div>

                <!-- Telephone -->
                <div class="mb-3">
                    <label class="form-label" for="telephone">Telephone</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- JS for dynamic department selection -->
    <script>
        const facultySelect = document.getElementById('faculty');
        const departmentSelect = document.getElementById('department');

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
    </script>
</body>
</html>
