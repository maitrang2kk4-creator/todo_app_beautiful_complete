<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Form Đăng ký</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #ffe6f0; /* Hồng nhạt */
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
            padding: 30px;
            background: #fff0f5; /* Hồng phấn */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(255, 105, 180, 0.3);
            border: 2px solid #ffb6c1; /* Viền hồng */
        }
        h2 {
            color: #ff4da6;
            font-weight: bold;
        }
        .btn-pink {
            background-color: #ff4da6;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-pink:hover {
            background-color: #e60073;
            color: white;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ffb6c1;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .alert-success {
            background-color: #ffb6c1;
            color: #800040;
            border: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
// Biến
$firstname = $lastname = $username = $email = $city = $state = $zip = "";
$fnameerr = $lnameerr = $nameerr = $emailerr = $cityerr = $stateerr = $ziperr = $agreeerr = "";
$agree = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $fnameerr = "* First name is required";
    } else {
        $firstname = $_POST["firstname"];
    }

    if (empty($_POST["lastname"])) {
        $lnameerr = "* Last name is required";
    } else {
        $lastname = $_POST["lastname"];
    }

    if (empty($_POST["username"])) {
        $nameerr = "* Username is required";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["email"])) {
        $emailerr = "* Email is required";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["city"])) {
        $cityerr = "* City is required";
    } else {
        $city = $_POST["city"];
    }

    if (empty($_POST["state"])) {
        $stateerr = "* State is required";
    } else {
        $state = $_POST["state"];
    }

    if (empty($_POST["zip"])) {
        $ziperr = "* ZIP code is required";
    } else {
        $zip = $_POST["zip"];
    }

    if (empty($_POST["agree"])) {
        $agreeerr = "* You must agree to the terms";
    } else {
        $agree = $_POST["agree"];
    }
}
?>

<div class="container">
    <h2 class="text-center mb-4">💖 Registration Form 💖</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">First Name</label>
				<input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="error"><?php echo $fnameerr; ?></span>
            </div>
            <div class="col">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="error"><?php echo $lnameerr; ?></span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="error"><?php echo $nameerr; ?></span>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailerr; ?></span>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="error"><?php echo $cityerr; ?></span>
            </div>
            <div class="col-md-3">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                <span class="error"><?php echo $stateerr; ?></span>
            </div>
            <div class="col-md-3">
                <label class="form-label">ZIP</label>
                <input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>">
                <span class="error"><?php echo $ziperr; ?></span>
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="agree" value="yes" <?php if($agree=="yes") echo "checked"; ?>>
            <label class="form-check-label">
                I agree to the Terms and Conditions
            </label>
            <br>
            <span class="error"><?php echo $agreeerr; ?></span>
        </div>

        <button type="submit" class="btn btn-pink w-100">Gửi thông tin 💌</button>
    </form>

    <?php
    if ($firstname && $lastname && $username && $email && $city && $state && $zip && $agree == "yes") {
        echo "<div class='alert alert-success mt-4 text-center'>";
        echo "🌸 <b>First Name:</b> " . $firstname . "<br>";
        echo "🌸 <b>Last Name:</b> " . $lastname . "<br>";
        echo "🌸 <b>Username:</b> " . $username . "<br>";
        echo "🌸 <b>Email:</b> " . $email . "<br>";
        echo "🌸 <b>City:</b> " . $city . "<br>";
        echo "🌸 <b>State:</b> " . $state . "<br>";
        echo "🌸 <b>ZIP:</b> " . $zip . "<br>";
        echo "✅ You agreed to the Terms and Conditions";
		echo "</div>";
    }
    ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>