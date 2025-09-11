<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/profile.css" rel="stylesheet">
</head>
<body>

    <div class="profile-form-bg min-vh-100 d-flex align-items-center" style="background: #f6f8fa;">
    <div class="profile-form-container" style="width: 380px; min-width: 300px; min-height: 520px; padding: 32px 22px; box-shadow: 0 4px 16px rgba(44,62,80,0.08); border-radius: 18px; background: #fff;">
            <div class="text-center mb-4">
                <div class="profile-form-title" style="color: #185a9d; font-size: 1.6rem; font-weight: 700;">Edit Profile</div>
                <small class="text-muted">Update your student information</small>
            </div>
            <form method="POST" action="/update" class="profile-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="Index_no" style="color:#185a9d;">Index No</label>
                    <input type="text" class="form-control" id="Index_no" name="Index_no" style="background:#f8fafc;">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name" style="color:#185a9d;">Name</label>
                    <input type="text" class="form-control" id="name" name="name" style="background:#f8fafc;">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="Faculty" style="color:#185a9d;">Faculty</label>
                    <select class="form-select" name="Faculty" id="Faculty" style="background:#f8fafc;">
                        <option selected disabled>-- Select Faculty --</option>
                        <option value="Computing">Computing</option>
                        <option value="Management">Management</option>
                        <option value="Applied Science">Applied Science</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="Department" style="color:#185a9d;">Department</label>
                    <select class="form-select" name="Department" id="Department" style="background:#f8fafc;">
                        <option selected disabled>-- Select Department --</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="Address" style="color:#185a9d;">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" style="background:#f8fafc;">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="Blood_Group" style="color:#185a9d;">Blood Type</label>
                    <select class="form-select" name="Blood_Group" id="Blood_Group" style="background:#f8fafc;">
                        <option selected disabled>-- Select Blood Type --</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="O+">O+</option>
                        <option value="AB+">AB+</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Medical_Condition" class="form-label" style="color:#185a9d;">Medical Condition</label>
                    <textarea class="form-control" id="Medical_Condition" name="Medical_Condition" rows="3" style="background:#f8fafc;"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="Telephone" style="color:#185a9d;">Telephone</label>
                    <input type="text" class="form-control" id="Telephone" name="Telephone" style="background:#f8fafc;">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background:#185a9d; border:none; border-radius:30px;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS for dynamic department selection -->
    <script>
        const facultySelect = document.getElementById('Faculty');
        const departmentSelect = document.getElementById('Department');

        if (facultySelect && departmentSelect) {
            const departments = {
                "Computing": ["Software Engineering", "Computing and Information System", "Data Science","Information Systems"],
                "Management": ["Accounting", "Business Admin", "HR Management"],
                "Applied Science": ["Natural Resources", "Food Science", "Sports"],
                "Agriculture": ["Agronomy", "Horticulture", "Animal Science"],
                "Medicine": ["Nursing", "Pharmacy", "Public Health"],
                "Social Science and Languages": ["Psychology", "Sociology", "English"]
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
