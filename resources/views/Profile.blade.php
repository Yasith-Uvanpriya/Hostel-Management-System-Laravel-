<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 30px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-card">
                    <form method="POST" action="/update">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('images/hostel.png') }}" alt="Profile Picture" class="profile-picture">
                                <h4 class="mt-3">{{ Auth::user()->name }}</h4>
                                <p class="text-muted">Student</p>
                            </div>
                            <div class="col-md-8">
                                <h3 class="mb-4">Edit Your Profile</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Index_no">Index No</label>
                                        <input type="text" class="form-control" id="Index_no" name="Index_no">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Faculty">Faculty</label>
                                        <select class="form-select" name="Faculty" id="Faculty">
                                            <option selected disabled>-- Select Faculty --</option>
                                            <option value="Computing">Computing</option>
                                            <option value="Management">Management</option>
                                            <option value="Applied Science">Applied Science</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Department">Department</label>
                                        <select class="form-select" name="Department" id="Department">
                                            <option selected disabled>-- Select Department --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="Address">Address</label>
                                        <input type="text" class="form-control" id="Address" name="Address">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Blood_Group">Blood Type</label>
                                        <select class="form-select" name="Blood_Group" id="Blood_Group">
                                            <option selected disabled>-- Select Blood Type --</option>
                                            <option value="A+">A+</option>
                                            <option value="B+">B+</option>
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="Telephone">Telephone</label>
                                        <input type="text" class="form-control" id="Telephone" name="Telephone">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="Medical_Condition" class="form-label">Medical Condition</label>
                                        <textarea class="form-control" id="Medical_Condition" name="Medical_Condition" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS for dynamic department selection -->
    <script>
        const facultySelect = document.getElementById('Faculty');
        const departmentSelect = document.getElementById('Department');

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