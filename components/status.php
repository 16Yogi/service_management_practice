<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Status Tracker</title>
  <style>
    .tracker {
      width: 400px;
      margin: 50px auto;
      position: relative;
      font-family: Arial, sans-serif;
    }

    .steps {
      display: flex;
      justify-content: space-between;
      position: relative;
      z-index: 2;
    }

    .step {
      text-align: center;
      width: 33%;
    }

    .circle {
      width: 20px;
      height: 20px;
      margin: 0 auto;
      border-radius: 50%;
      background-color: gray;
      z-index: 2;
    }

    .label {
      margin-top: 8px;
      font-size: 13px;
      color: #333;
    }

    .progress-line {
      position: absolute;
      top: 10px;
      left: 10px;
      right: 10px;
      height: 6px;
      background-color: gray;
      z-index: 1;
    }

    .progress-fill {
      height: 6px;
      background-color: orange;
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 2;
      transition: width 0.4s ease;
    }

    .active .circle {
      background-color: darkgreen;
    }
  </style>
</head>
<body>

<div class="tracker">
  <div class="progress-line"></div>
  <div class="progress-fill" id="progressFill" style="width: 0%;"></div>

  <div class="steps">
    <div class="step" id="step1">
      <div class="circle"></div>
      <div class="label">Book Initiated</div>
    </div>
    <div class="step" id="step2">
      <div class="circle"></div>
      <div class="label">Booking Confirmed</div>
    </div>
    <div class="step" id="step3">
      <div class="circle"></div>
      <div class="label">Completed</div>
    </div>
  </div>
</div>

<script>
  // Set this from backend (0 = no status, 1 = Book Initiated, 2 = Confirmed, 3 = Completed)
  const currentStep = 2; // Simulate backend value

  const steps = [
    document.getElementById('step1'),
    document.getElementById('step2'),
    document.getElementById('step3')
  ];

  // Mark active steps
  for (let i = 0; i < currentStep; i++) {
    steps[i].classList.add('active');
  }

  // Adjust progress fill width
  const progressFill = document.getElementById('progressFill');
  const widths = ["0%", "0%", "50%", "100%"];
  progressFill.style.width = widths[currentStep];
</script>

</body>
</html>
