<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
</head>
<body>
  <div class="signup-container">
    <h2 class="text-center mb-4">Sign Up</h2>
    <form method="post" action="signup.php">
      <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo:</label>
        <input type="text" placeholder="Enter your pseudo" name="pseudo" id="pseudo" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" placeholder="Enter your email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" placeholder="Min 12 characters" name="password" id="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="confirm" class="form-label">Confirm Password:</label>
        <input type="password" placeholder="Confirm password" name="confirm" id="confirm" class="form-control" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </div>
    </form>

    <?php if (isset($error)) : ?>
      <p class="text-danger mt-3 text-center"><?= $error ?></p>
    <?php endif ?>
  </div>
</body>
</html>
