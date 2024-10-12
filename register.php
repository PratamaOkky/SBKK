<?php
require_once("admin/database.php");

$message = "";
$errors = [];

// Inisialisasi variabel untuk menjaga nilai input
$username = '';
$password = '';
$nama = '';
$nisn = '';
$email = '';
$telpon = '';
$role = '';

if (isset($_POST['register']) && $_POST['register'] === "Register") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $email = $_POST['email'];
    $telpon = $_POST['telpon'];
    $role = $_POST['role'];

    // Cek apakah username sudah ada
    $sql = "SELECT COUNT(*) FROM user WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Username sudah digunakan.";
    }

    // Cek apakah email sudah ada
    $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Email sudah digunakan.";
    }

    // Cek apakah telpon sudah ada
    $sql = "SELECT COUNT(*) FROM user WHERE telpon = :telpon";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':telpon', $telpon);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Nomor telepon sudah digunakan.";
    }

    // Cek apakah nisn sudah ada
    $sql = "SELECT COUNT(*) FROM user WHERE nisn = :nisn";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':nisn', $nisn);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "NISN sudah digunakan.";
    }

    // Jika tidak ada kesalahan, lakukan insert
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password, nama, nisn, email, telpon, role, status) VALUES (:username, :password, :nama, :nisn, :email, :telpon, :role, 'Pending')";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashed_password);
        $stmt->bindValue(':nama', $nama);
        $stmt->bindValue(':nisn', $nisn);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':telpon', $telpon);
        $stmt->bindValue(':role', $role);

        if ($stmt->execute()) {
            $message = "Pendaftaran berhasil! Silakan tunggu verifikasi dari admin.";
            echo "<script>
                    alert('$message');
                    window.location.href = 'index'; // Ganti 'index' dengan URL ke formulir login Anda
                  </script>";
            exit();
        } else {
            $message = "Terjadi kesalahan. Silakan coba lagi.";
        }
    } else {
        $message = implode( '' , $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/esipi.png">
    <title>Register - Sistem Informasi Bursa Kerja Khusus</title>
    <!-- Bootstrap core CSS -->
    <link href="admin/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="admin/css/admin.css" rel="stylesheet">
    <script src="admin/js/gradient.js"></script>
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-login {
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px; /* Perlebar card menjadi 900px */
            margin: 0 auto; /* Pusatkan card */
        }

        .card-header {
            background: url('images/login.png') no-repeat center center;
            background-size: cover;
            height: 150px;
            /* Sesuaikan tinggi header sesuai dengan kebutuhan Anda */
        }

        .card-body {
            padding: 30px;
        }

        h3 {
            font-size: 28px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #adb5bd;
            padding: 12px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #004085;
            font-size: 16px;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #004085;
            border-color: #003770;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
</head>

<body id="gradient">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($nama); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter Username" value="<?php echo htmlspecialchars($username); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Saya Adalah</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="Alumni" <?php echo ($role === 'Alumni') ? 'selected' : ''; ?>>Alumni</option>
                                    <option value="Staff" <?php echo ($role === 'Staff') ? 'selected' : ''; ?>>Staff</option>
                                    <option value="Admin" <?php echo ($role === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input class="form-control" id="nisn" name="nisn" type="text" placeholder="NISN" value="<?php echo htmlspecialchars($nisn); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telpon">Telepon</label>
                                <input class="form-control" id="telpon" name="telpon" type="text" placeholder="Nomor Telepon" value="<?php echo htmlspecialchars($telpon); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="register" value="Register">Register</button>
                    <center>Sudah punya akun ?<br><a href="index">Masuk Disini</a>
                </form>
                <p class="text-center text-danger mt-3"><small><?php echo htmlspecialchars($message); ?></small></p>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
