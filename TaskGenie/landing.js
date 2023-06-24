
    window.human = false;

    var canvasEl = document.querySelector('.fireworks');
    var ctx = canvasEl.getContext('2d');
    var numberOfParticules = 40;
    var pointerX = 0;
    var pointerY = 0;
    var tap = ('ontouchstart' in window || navigator.msMaxTouchPoints) ? 'touchstart' : 'mousedown';
    var colors = ['#FF1461', '#18FF92', '#5A87FF', '#FBF38C'];

    function setCanvasSize() {
      canvasEl.width = window.innerWidth * 2;
      canvasEl.height = window.innerHeight * 2;
        canvasEl.style.width = window.innerWidth + 'px';
        canvasEl.style.height = window.innerHeight + 'px';
        canvasEl.getContext('2d').scale(2, 2);
        
    }

    function updateCoords(e) {
      pointerX = e.clientX || e.touches[0].clientX;
      pointerY = e.clientY || e.touches[0].clientY;
    }

    function setParticuleDirection(p) {
      var angle = anime.random(0, 360) * Math.PI / 180;
      var value = anime.random(50, 180);
      var radius = [-1, 1][anime.random(0, 1)] * value;
      return {
        x: p.x + radius * Math.cos(angle),
        y: p.y + radius * Math.sin(angle)
      }
    }

    function createParticule(x,y) {
      var p = {};
      p.x = x;
      p.y = y;
      p.color = colors[anime.random(0, colors.length - 1)];
      p.radius = anime.random(16, 32);
      p.endPos = setParticuleDirection(p);
      p.draw = function() {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, 2 * Math.PI, true);
        ctx.fillStyle = p.color;
        ctx.fill();
      }
      return p;
    }

    function createCircle(x,y) {
      var p = {};
      p.x = x;
      p.y = y;
      p.color = '#FFF';
      p.radius = 0.1;
      p.alpha = .5;
      p.lineWidth = 6;
      p.draw = function() {
        ctx.globalAlpha = p.alpha;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, 2 * Math.PI, true);
        ctx.lineWidth = p.lineWidth;
        ctx.strokeStyle = p.color;
        ctx.stroke();
        ctx.globalAlpha = 1;
      }
      return p;
    }

    function renderParticule(anim) {
      for (var i = 0; i < anim.animatables.length; i++) {
        anim.animatables[i].target.draw();
      }
    }

    function animateParticules(x, y) {
      var circle = createCircle(x, y);
      var particules = [];
      for (var i = 0; i < numberOfParticules; i++) {
        particules.push(createParticule(x, y));
      }
      anime.timeline().add({
        targets: particules,
        x: function(p) { return p.endPos.x; },
        y: function(p) { return p.endPos.y; },
        radius: 0.1,
        duration: anime.random(1200, 1800),
        easing: 'easeOutExpo',
        update: renderParticule
      })
        .add({
        targets: circle,
        radius: anime.random(80, 160),
        lineWidth: 0,
        alpha: {
          value: 0,
          easing: 'linear',
          duration: anime.random(600, 800),  
        },
        duration: anime.random(1200, 1800),
        easing: 'easeOutExpo',
        update: renderParticule,
        offset: 0
      });
    }

    var render = anime({
      duration: Infinity,
      update: function() {
        ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
      }
    });

    document.addEventListener(tap, function(e) {
      window.human = false;
      render.play();
      updateCoords(e);
      animateParticules(pointerX, pointerY);
    }, true);

    var centerX = window.innerWidth / 2;
    var centerY = window.innerHeight / 2;

    function autoClick() {
      if (window.human) return;
      animateParticules(
        anime.random(centerX-50, centerX+50), 
        anime.random(centerY-50, centerY+50)
      );
      anime({duration: 200}).finished.then(autoClick);
      
    }

    autoClick();
    setCanvasSize();
    window.addEventListener('resize', setCanvasSize, false);


// Clock 
// Just noticed accessing localStorage is banned from codepen, so disabling saving theme to localStorage

const deg = 6;
const hour = document.querySelector(".hour");
const min = document.querySelector(".min");
const sec = document.querySelector(".sec");

const setClock = () => {
	let day = new Date();
	let hh = day.getHours() * 30;
	let mm = day.getMinutes() * deg;
	let ss = day.getSeconds() * deg;

	hour.style.transform = `rotateZ(${hh + mm / 12}deg)`;
	min.style.transform = `rotateZ(${mm}deg)`;
	sec.style.transform = `rotateZ(${ss}deg)`;
};

// first time
setClock();
// Update every 1000 ms
setInterval(setClock, 1000);

const switchTheme = (evt) => {
	const switchBtn = evt.target;
	if (switchBtn.textContent.toLowerCase() === "light") {
		switchBtn.textContent = "dark";
		localStorage.setItem("theme", "dark");
		document.documentElement.setAttribute("data-theme", "dark");
	} else {
		switchBtn.textContent = "light";
		localStorage.setItem("theme", "light"); //add this
		document.documentElement.setAttribute("data-theme", "light");
	}
};

const switchModeBtn = document.querySelector(".switch-btn");
switchModeBtn.addEventListener("click", switchTheme, false);

let currentTheme = "dark";
 currentTheme = localStorage.getItem("theme")? localStorage.getItem("theme"): null;

if (currentTheme) {
	document.documentElement.setAttribute("data-theme", currentTheme);
	switchModeBtn.textContent = currentTheme;
}
$(document).ready(function() {
  // Define data for priority chart
  var priorityData = {
  labels: ["High", "Medium", "Low"],
  datasets: [{
  data: [75, 20, 5],
  backgroundColor: [
  "#FF6384",
  "#36A2EB",
  "#FFCE56"
  ]
  }]
  };
  
  // Define options for priority chart
  var priorityOptions = {
  title: {
  display: true,
  text: "Completion rate by priority"
  }
  };
  
  // Create priority chart
  var priorityChart = new Chart($("#priorityChart"), {
  type: "doughnut",
  data: priorityData,
  options: priorityOptions
  });
  
  // Define data for deadline chart
  var deadlineData = {
  labels: ["Past due", "Today", "Tomorrow", "Later"],
  datasets: [{
  data: [10, 20, 30, 40],
  backgroundColor: [
  "#FF6384",
  "#36A2EB",
  "#FFCE56",
  "#4BC0C0"
  ]
  }]
  };
  
  // Define options for deadline chart
  var deadlineOptions = {
  title: {
  display: true,
  text: "Completion rate by deadline"
  },
   scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
  };
  
  // Create deadline chart
  var deadlineChart = new Chart($("#deadlineChart"), {
  type: "bar",
  data: deadlineData,
  options: deadlineOptions
  });
  });

  /* Ayat Keren */
  var text = document.getElementById('text');
  var newDom = '';
  var animationDelay = 6;

  for(let i = 0; i < text.innerText.length; i++)
  {
      newDom += '<span class="char">' + (text.innerText[i] == ' ' ? '&nbsp;' : text.innerText[i])+ '</span>';
  }

  text.innerHTML = newDom;
  var length = text.children.length;

  for(let i = 0; i < length; i++)
  {
      text.children[i].style['animation-delay'] = animationDelay * i + 'ms';
  }
