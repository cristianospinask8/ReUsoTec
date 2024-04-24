<script setup>
import PageLayout from '@/Layouts/PageLayout.vue'
import { ref, onMounted, defineProps } from "vue";
import { Head, Link } from '@inertiajs/vue3';


defineProps({

    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
//Para carga de video
const videoLoaded = ref(false);
//ref del pcontenedor del 3d
const particlesContainer = ref(null);

//Hover 3d
const handleMouseMove = (event) => {
    const { offsetX, offsetY, target } = event;
    const { clientWidth, clientHeight } = target;
    const rotateX = (offsetY - clientHeight / 2) / 10;
    const rotateY = (offsetX - clientWidth / 2) / 10;

    target.style.transform = `perspective(2000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotateZ(0deg) translateX(-30px) translateY(0px) translateZ(0px)`;
};


onMounted(() => {


    videoLoaded.value = true;

    if (!particlesContainer.value) return;

    const particleOptions = {
        dotColor: 'rgba(95, 207, 154, 0.7)',
        lineColor: 'rgba(95, 207, 154, 0.5)',
        // Otras opciones...
    };

    particleGround(particlesContainer.value, particleOptions);
});

const extend = function (out) {
    out = out || {};
    for (var i = 1; i < arguments.length; i++) {
        var obj = arguments[i];
        if (!obj) continue;
        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                if (typeof obj[key] === 'object')
                    deepExtend(out[key], obj[key]);
                else
                    out[key] = obj[key];
            }
        }
    }
    return out;
};

const particleDefaults = {
    minSpeedX: 0.1,
    maxSpeedX: 0.7,
    minSpeedY: 0.1,
    maxSpeedY: 0.7,
    directionX: 'center', // 'center', 'left' or 'right'. 'center' = dots bounce off edges
    directionY: 'center', // 'center', 'up' or 'down'. 'center' = dots bounce off edges
    density: 10000, // How many particles will be generated: one particle every n pixels
    dotColor: '#44A678',
    lineColor: '#44A678',
    particleRadius: 7, // Dot size
    lineWidth: 1,
    curvedLines: false,
    proximity: 100, // How close two dots need to be before they join
    parallax: true,
    parallaxMultiplier: 5, // The lower the number, the more extreme the parallax effect
    onInit: function () { },
    onDestroy: function () { }
};

const particleGround = function (element, options) {
    var canvasSupport = !!document.createElement('canvas').getContext;
    var canvas;
    var ctx;
    var particles = [];
    var raf;
    var mouseX = 0;
    var mouseY = 0;
    var winW;
    var winH;
    var desktop = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i);
    var orientationSupport = !!window.DeviceOrientationEvent;
    var tiltX = 0;
    var pointerX;
    var pointerY;
    var tiltY = 0;
    var paused = false;

    options = extend({}, particleDefaults, options);

    /**
     * Init
     */
    function init() {
        if (!canvasSupport) { return; }

        //Create canvas
        canvas = document.createElement('canvas');
        canvas.className = 'pg-canvas';
        canvas.style.display = 'block';
        element.insertBefore(canvas, element.firstChild);
        ctx = canvas.getContext('2d');
        styleCanvas();

        // Create particles
        var numParticles = Math.round((canvas.width * canvas.height) / options.density);
        for (var i = 0; i < numParticles; i++) {
            var p = new Particle();
            p.setStackPos(i);
            particles.push(p);
        };

        window.addEventListener('resize', function () {
            resizeHandler();
        }, false);

        document.addEventListener('mousemove', function (e) {
            mouseX = e.pageX;
            mouseY = e.pageY;
        }, false);

        if (orientationSupport && !desktop) {
            window.addEventListener('deviceorientation', function () {
                // Contrain tilt range to [-30,30]
                tiltY = Math.min(Math.max(-event.beta, -30), 30);
                tiltX = Math.min(Math.max(-event.gamma, -30), 30);
            }, true);
        }

        draw();
        hook('onInit');
    }

    /**
     * Style the canvas
     */
    function styleCanvas() {
        canvas.width = element.offsetWidth;
        canvas.height = element.offsetHeight;
        ctx.fillStyle = options.dotColor;
        ctx.strokeStyle = options.lineColor;
        ctx.lineWidth = options.lineWidth;
    }

    /**
     * Draw particles
     */
    function draw() {
        if (!canvasSupport) { return; }

        winW = window.innerWidth;
        winH = window.innerHeight;

        // Wipe canvas
        ctx.save();
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Update particle positions
        for (var i = 0; i < particles.length; i++) {
            particles[i].updatePosition();
        };
        // Draw particles
        for (var i = 0; i < particles.length; i++) {
            particles[i].draw();
        };
        ctx.restore();
        // Call this function next time screen is redrawn
        if (!paused) {
            raf = requestAnimationFrame(draw);
        }
    }

    /**
     * Add/remove particles.
     */
    function resizeHandler() {
        // Resize the canvas
        styleCanvas();

        var elWidth = element.offsetWidth;
        var elHeight = element.offsetHeight;

        // Remove particles that are outside the canvas
        for (var i = particles.length - 1; i >= 0; i--) {
            if (particles[i].position.x > elWidth || particles[i].position.y > elHeight) {
                particles.splice(i, 1);
            }
        };

        // Adjust particle density
        var numParticles = Math.round((canvas.width * canvas.height) / options.density);
        if (numParticles > particles.length) {
            while (numParticles > particles.length) {
                var p = new Particle();
                particles.push(p);
            }
        } else if (numParticles < particles.length) {
            particles.splice(numParticles);
        }

        // Re-index particles
        for (i = particles.length - 1; i >= 0; i--) {
            particles[i].setStackPos(i);
        };
    }

    /**
     * Pause particle system
     */
    function pause() {
        paused = true;
    }

    /**
     * Start particle system
     */
    function start() {
        paused = false;
        draw();
    }

    /**
     * Particle
     */
    function Particle() {
        this.stackPos;
        this.active = true;
        this.layer = Math.ceil(Math.random() * 3);
        this.parallaxOffsetX = 0;
        this.parallaxOffsetY = 0;
        // Initial particle position
        this.position = {
            x: Math.ceil(Math.random() * canvas.width),
            y: Math.ceil(Math.random() * canvas.height)
        }
        // Random particle speed, within min and max values
        this.speed = {}
        switch (options.directionX) {
            case 'left':
                this.speed.x = +(-options.maxSpeedX + (Math.random() * options.maxSpeedX) - options.minSpeedX).toFixed(2);
                break;
            case 'right':
                this.speed.x = +((Math.random() * options.maxSpeedX) + options.minSpeedX).toFixed(2);
                break;
            default:
                this.speed.x = +((-options.maxSpeedX / 2) + (Math.random() * options.maxSpeedX)).toFixed(2);
                this.speed.x += this.speed.x > 0 ? options.minSpeedX : -options.minSpeedX;
                break;
        }
        switch (options.directionY) {
            case 'up':
                this.speed.y = +(-options.maxSpeedY + (Math.random() * options.maxSpeedY) - options.minSpeedY).toFixed(2);
                break;
            case 'down':
                this.speed.y = +((Math.random() * options.maxSpeedY) + options.minSpeedY).toFixed(2);
                break;
            default:
                this.speed.y = +((-options.maxSpeedY / 2) + (Math.random() * options.maxSpeedY)).toFixed(2);
                this.speed.x += this.speed.y > 0 ? options.minSpeedY : -options.minSpeedY;
                break;
        }
    }

    /**
     * Draw particle
     */
    Particle.prototype.draw = function () {
        // Draw circle
        ctx.beginPath();
        ctx.arc(this.position.x + this.parallaxOffsetX, this.position.y + this.parallaxOffsetY, options.particleRadius / 2, 0, Math.PI * 2, true);
        ctx.closePath();
        ctx.fill();

        // Draw lines
        ctx.beginPath();
        // Iterate over all particles which are higher in the stack than this one
        for (var i = particles.length - 1; i > this.stackPos; i--) {
            var p2 = particles[i];

            // Pythagorus theorum to get distance between two points
            var a = this.position.x - p2.position.x
            var b = this.position.y - p2.position.y
            var dist = Math.sqrt((a * a) + (b * b)).toFixed(2);

            // If the two particles are in proximity, join them
            if (dist < options.proximity) {
                ctx.moveTo(this.position.x + this.parallaxOffsetX, this.position.y + this.parallaxOffsetY);
                if (options.curvedLines) {
                    ctx.quadraticCurveTo(Math.max(p2.position.x, p2.position.x), Math.min(p2.position.y, p2.position.y), p2.position.x + p2.parallaxOffsetX, p2.position.y + p2.parallaxOffsetY);
                } else {
                    ctx.lineTo(p2.position.x + p2.parallaxOffsetX, p2.position.y + p2.parallaxOffsetY);
                }
            }
        }
        ctx.stroke();
        ctx.closePath();
    }

    /**
     * update particle position
     */
    Particle.prototype.updatePosition = function () {
        if (options.parallax) {
            if (orientationSupport && !desktop) {
                // Map tiltX range [-30,30] to range [0,winW]
                var ratioX = (winW - 0) / (30 - -30);
                pointerX = (tiltX - -30) * ratioX + 0;
                // Map tiltY range [-30,30] to range [0,winH]
                var ratioY = (winH - 0) / (30 - -30);
                pointerY = (tiltY - -30) * ratioY + 0;
            } else {
                pointerX = mouseX;
                pointerY = mouseY;
            }
            // Calculate parallax offsets
            this.parallaxTargX = (pointerX - (winW / 2)) / (options.parallaxMultiplier * this.layer);
            this.parallaxOffsetX += (this.parallaxTargX - this.parallaxOffsetX) / 10; // Easing equation
            this.parallaxTargY = (pointerY - (winH / 2)) / (options.parallaxMultiplier * this.layer);
            this.parallaxOffsetY += (this.parallaxTargY - this.parallaxOffsetY) / 10; // Easing equation
        }

        var elWidth = element.offsetWidth;
        var elHeight = element.offsetHeight;

        switch (options.directionX) {
            case 'left':
                if (this.position.x + this.speed.x + this.parallaxOffsetX < 0) {
                    this.position.x = elWidth - this.parallaxOffsetX;
                }
                break;
            case 'right':
                if (this.position.x + this.speed.x + this.parallaxOffsetX > elWidth) {
                    this.position.x = 0 - this.parallaxOffsetX;
                }
                break;
            default:
                // If particle has reached edge of canvas, reverse its direction
                if (this.position.x + this.speed.x + this.parallaxOffsetX > elWidth || this.position.x + this.speed.x + this.parallaxOffsetX < 0) {
                    this.speed.x = -this.speed.x;
                }
                break;
        }

        switch (options.directionY) {
            case 'up':
                if (this.position.y + this.speed.y + this.parallaxOffsetY < 0) {
                    this.position.y = elHeight - this.parallaxOffsetY;
                }
                break;
            case 'down':
                if (this.position.y + this.speed.y + this.parallaxOffsetY > elHeight) {
                    this.position.y = 0 - this.parallaxOffsetY;
                }
                break;
            default:
                // If particle has reached edge of canvas, reverse its direction
                if (this.position.y + this.speed.y + this.parallaxOffsetY > elHeight || this.position.y + this.speed.y + this.parallaxOffsetY < 0) {
                    this.speed.y = -this.speed.y;
                }
                break;
        }

        // Move particle
        this.position.x += this.speed.x;
        this.position.y += this.speed.y;
    }

    /**
     * Setter: particle stacking position
     */
    Particle.prototype.setStackPos = function (i) {
        this.stackPos = i;
    }

    function option(key, val) {
        if (val) {
            options[key] = val;
        } else {
            return options[key];
        }
    }

    function destroy() {
        console.log('destroy');
        canvas.parentNode.removeChild(canvas);
        hook('onDestroy');
        if ($) {
            $(element).removeData('plugin_' + pluginName);
        }
    }

    function hook(hookName) {
        if (options[hookName] !== undefined) {
            options[hookName].call(element);
        }
    }

    init();

    return {
        option: option,
        destroy: destroy,
        start: start,
        pause: pause
    };
};

</script>

<template>

    <Head title="Welcome" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

    <PageLayout>
        <!-- parte 1 -->
        <div id="particles" ref="particlesContainer" class="h-screen bg-dark flex w-full overflow-hidden">
            <div id="intro" class="justify-center m-auto">
                <h1 class="">ReUsoTec</h1>
                <span class="animacionText">
                    <p class="px-12 sm:px-44 text-2xl sm:text-[38pt] text-center font-sans jersey-25-regular">Todo lo
                        que
                        hacemos es
                        para salvarnos a nosotros mismos</p>
                </span>

            </div>
        </div>
        <!-- parte 2 -->
        <div class="w-full flex h-full py-2 bg-gradient-to-b from-dark to-secondary overflow-hidden">
            <div class="sm:flex sm:grid grid-cols-6 gap-4 mt-12">
                <div class="sm:col-span-4 md:col-span-3 p-12 m-auto">
                    <!-- Agrega la etiqueta de video con la ruta del archivo de video -->
                    <video autoplay loop controls muted @mousemove="handleMouseMove"
                        class="flex justify-center rounded-xl shadow-2xl hover:shadow-6xl">
                        <source src="/assets/video/crisis.mp4" type="video/mp4">
                        Tu navegador no soporta el elemento de video.
                    </video>
                    
                </div>
                <div class="sm:col-span-2 md:col-span-3 p-6 m-auto">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-center text-white jersey-25-regular">¡Aportar un granito de arena,
                            sirve porque ganas descuentos en nuevos productos y ayudas al planeta!</h2>
                    </div>
                </div>
            </div>
        </div>

    </PageLayout>



</template>

<style>
/* ANIMACION */
.animacionText {
    display: block;
    border-right: 2px solid;
    animation: typing 2s steps(12),
        blink .5s step-end forwards;
    overflow: hidden;
    width: 100%;
}

@keyframes typing {
    from {
        width: 50%
    }
}

@keyframes blink {
    100% {
        border-color: transparent
    }

}

/* FIN */

/* .perspective-transform:hover {
    transform: perspective(2000px) rotateX(0deg) rotateY(30deg) rotateZ(0deg) translateX(-30px) translateY(0px) translateZ(0px);
} */


/* particleground demo */

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

html,
body {
    width: 100%;
    height: 100%;

}


.jersey-25-regular {
    font-family: "Jersey 25", sans-serif;
    font-weight: 400;
    font-style: normal;
}

#intro {
    position: absolute;
    left: 0;
    top: 40%;
    padding: 0 20px;
    width: 100%;
    text-align: center;
}


h1 {
    font-size: 50px;
    font-weight: 700;
    letter-spacing: 0.015em;
}

h1::after {
    content: '';
    width: 80px;
    display: block;
    background: #fff;
    height: 10px;
    margin: 30px auto;
    line-height: 1.1;
}


@media only screen and (max-width: 1000px) {
    h1 {
        font-size: 70px;
    }
}

@media only screen and (max-width: 800px) {
    h1 {
        font-size: 48px;
    }

    h1::after {
        height: 8px;
    }
}

@media only screen and (max-width: 568px) {
    #intro {
        padding: 0 10px;
    }

    h1 {
        font-size: 30px;
    }

    h1::after {
        height: 6px;
    }

    @keyframes typing {
        from {
            width: 70%
        }
    }



    .btn {
        font-size: 16px;
    }
}

@media only screen and (max-width: 320px) {
    h1 {
        font-size: 28px;
    }

    h1::after {
        height: 4px;
    }

    @keyframes typing {
        from {
            width: 80%
        }
    }
}
</style>
