<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary Countdown</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        flex-direction: column;
        color: #333;
        overflow: hidden;
      }

      .countdown {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
      }

      .countdown h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #ff6f61;
      }

      .countdown div {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
      }

      .countdown div div {
        font-size: 1.3rem;
        text-align: center;
      }

      .countdown div div span {
        display: block;
        font-size: 3rem;
        font-weight: bold;
        color: #ff6f61;
      }

      .btn {
        background-color: #ff6f61;
        color: white;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 30px;
        margin-top: 30px;
        display: inline-block;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.3s;
      }

      .btn:hover {
        background-color: #d35400;
        transform: translateY(-5px);
      }

      .footer {
        position: absolute;
        bottom: 20px;
        font-size: 0.9rem;
        color: white;
        text-align: center;
      }

      /* Love Animation */
      .heart {
        position: absolute;
        width: 30px;
        height: 30px;
        background-color: #ff69b4;
        transform: rotate(45deg);
        animation: float 4s ease-in-out infinite;
      }

      .heart:before,
      .heart:after {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        background-color: #ff69b4;
        border-radius: 50%;
      }

      .heart:before {
        top: -15px;
        left: 0;
      }

      .heart:after {
        left: -15px;
        top: 0;
      }

      @keyframes float {
        0% {
          opacity: 0;
          transform: translateY(0) rotate(45deg);
        }
        50% {
          opacity: 1;
        }
        100% {
          opacity: 0;
          transform: translateY(600px) rotate(45deg);
        }
      }

      /* Random hearts */
      @keyframes heartFall {
        0% {
          top: -50px;
        }
        100% {
          top: 100vh;
        }
      }

      .hearts-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
      }

      .hearts-container .heart {
        position: absolute;
        top: -50px;
        width: 30px;
        height: 30px;
        background-color: #ff69b4;
        transform: rotate(45deg);
        animation: heartFall 10s ease-in-out;
        opacity: 0.7;
      }

      .hearts-container .heart:before,
      .hearts-container .heart:after {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        background-color: #ff69b4;
        border-radius: 50%;
      }

      .hearts-container .heart:before {
        top: -15px;
        left: 0;
      }

      .hearts-container .heart:after {
        left: -15px;
        top: 0;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        .countdown h1 {
          font-size: 2rem;
        }

        .countdown div div span {
          font-size: 2.5rem;
        }

        .btn {
          font-size: 0.9rem;
          padding: 10px 20px;
        }
      }

      @media (max-width: 480px) {
        .countdown {
          padding: 20px;
        }

        .countdown h1 {
          font-size: 1.8rem;
        }

        .countdown div div span {
          font-size: 2rem;
        }

        .btn {
          font-size: 0.8rem;
          padding: 8px 15px;
        }
      }

    </style>
</head>
<body>
    <div class="countdown">
      <h1>Anniversary Countdown</h1>
      <div>
        <div>
          <span id="days">0</span> Hari
        </div>
        <div>
          <span id="hours">0</span> Jam
        </div>
        <div>
          <span id="minutes">0</span> Menit
        </div>
        <div>
          <span id="seconds">0</span> Detik
        </div>
      </div>
    </div>

    <div class="footer">Made with ❤️ for our special day</div>
    <!-- Love Hearts Container -->
    <div id="hearts-container" class="hearts-container"></div>

    <script>
      function countdown() {
        const anniversaryDate = new Date("Oct 31, 2024 00:00:00").getTime();
        const now = new Date().getTime();
        const timeleft = anniversaryDate - now;

        const days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // Jika countdown selesai, redirect ke halaman login setelah 20 detik
        if (timeleft <= 0) {
          clearInterval(interval);
          document.getElementById("days").innerHTML = 0;
          document.getElementById("hours").innerHTML = 0;
          document.getElementById("minutes").innerHTML = 0;
          document.getElementById("seconds").innerHTML = 0;
          setTimeout(() => {
            window.location.href = "login.php";
          }, 20000);  // 20 detik
        }
      }

      // Update countdown setiap 1 detik
      const interval = setInterval(countdown, 1000);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
