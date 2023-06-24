window.onload = function() {
  // Code to be executed when the window has finished loading
  fetch('dashboard.php')
    .then(function(response) {
      // Add your code to handle the response from dashboard.php
    })
    .catch(function(error) {
      // Add your code to handle any errors from the fetch request
    });

  var maxValue = 130;

  var svgCircles = document.querySelectorAll(".foreground-circle svg circle");
  var numberInsideCircles = document.querySelectorAll(".number-inside-circle");
  var numberInsideCircles1 = document.querySelectorAll(".number-inside-circle1");
  var numberInsideCircles2 = document.querySelectorAll(".number-inside-circle2");

  // Get the stroke-dasharray value from CSS
  var svgStrokeDashArray = parseInt(
    window
      .getComputedStyle(svgCircles[0])
      .getPropertyValue("stroke-dasharray")
      .replace("px", "")
  );

  // To animate the circle from the previous value
  var previousStrokeDashOffsets = [svgStrokeDashArray, svgStrokeDashArray, svgStrokeDashArray];

  // To animate the number from the previous value
  var previousValues = [0, 0, 0];

  var animationDuration = 1000;

  // Call this method and pass any value to start the animation
  // The 'value' should be in between 0 to maxValue
  function animateCircle(circleIndex, value) {
    var svgCircle = svgCircles[circleIndex];
    var numberInsideCircle = numberInsideCircles[circleIndex];

    var offsetValue = Math.floor(((maxValue - value) * svgStrokeDashArray) / maxValue);

    // This is to animate the circle
    svgCircle.animate(
      [
        // initial value
        {
          strokeDashoffset: previousStrokeDashOffsets[circleIndex],
        },
        // final value
        {
          strokeDashoffset: offsetValue,
        },
      ],
      {
        duration: animationDuration,
      }
    );

    // Without this, circle gets filled 100% after the animation
    svgCircle.style.strokeDashoffset = offsetValue;

    // This is to animate the number.
    // If the current value and previous values are the same,
    // no need to do anything. Check the condition.
    if (value !== previousValues[circleIndex]) {
      var speed;
      if (value > previousValues[circleIndex]) {
        speed = animationDuration / Math.abs(value - previousValues[circleIndex]);
      } else {
        speed = animationDuration / Math.abs(previousValues[circleIndex] - value);
      }

      // start the animation from the previous value
      var counter = previousValues[circleIndex];

      var intervalId = setInterval(() => {
        if (counter === value || counter === -1) {
          // End of the animation

          clearInterval(intervalId);

          // Save the current values
          previousStrokeDashOffsets[circleIndex] = offsetValue;
          previousValues[circleIndex] = value;
        } else {
          if (value > previousValues[circleIndex]) {
            counter += 1;
          } else {
            counter -= 1;
          }

          numberInsideCircle.innerHTML = counter + " %";
        }
      }, speed);
    }
  }

  // Animate with some values when the page loads first time
  animateCircle(0, queryhighpercent);
  animateCircle(1, querymedpercent);
  animateCircle(2, querylowpercent);

  console.log("The window has finished loading!");
};
