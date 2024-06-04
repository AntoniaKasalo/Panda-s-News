<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="skripta2.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header class="headera text-white text-center">
        <nav class="navbar navbar-expand-lg text-white">
            <div class="container">
                <ul class="navbar-nav mx-auto">
                    <li>
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div id="align">
        <div id="main">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color:#5f694b; color:white">
                <div id="register_card" class="card-body">
                    <h2 class="card-title text-center">Register</h2>
                    <form id="myForm" action="EmailService.php" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="input-group-append">
                                    <button class="prim" type="button" id="togglePasswordVisibility">Show</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <div class="input-group-append">
                                    <button class="prim" type="button" id="toggleConfirmPasswordVisibility">Show</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" id="role" name="role">
                                <option value="user">User</option>
                                <option value="reporter">Reporter</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="admin_password">Admin Password (if registering as admin):</label>
                            <input type="password" class="form-control" id="admin_password" name="admin_password">
                        </div>
                        <button onclick="validateForm()" type="submit" class="prim btn-block" name="send";>Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
    <footer class="text-white">
        <div>
            <p class="mb-0">&copy; 2024 Panda's News. Sva prava pridržana.</p>
            <p class="mb-0">Antonia Kasalo</p>
            <p><a href="mailto:akasalo@tvz.hr" class="text-white">akasalo@tvz.hr</a></p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordVisibilityBtn = document.getElementById('togglePasswordVisibility');
            const toggleConfirmPasswordVisibilityBtn = document.getElementById('toggleConfirmPasswordVisibility');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');

            togglePasswordVisibilityBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePasswordVisibilityBtn.textContent = type === 'password' ? 'Show' : 'Hide';
            });

            toggleConfirmPasswordVisibilityBtn.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                toggleConfirmPasswordVisibilityBtn.textContent = type === 'password' ? 'Show' : 'Hide';
            });
        });

        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                    alert('Passwords do not match!');
                    document.getElementById("myForm").action = "register.php";
                    return false;
                } else {
                    document.getElementById("myForm").action = "EmailService.php";
                    return true;
                }
        }

    </script>
</body>
</html>
