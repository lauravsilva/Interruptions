require('fastclick')(document.body);
var assign = require('object-assign');
var createConfig = require('./config');
var createRenderer = require('./lib/createRenderer');
var createLoop = require('raf-loop');
var contrast = require('wcag-contrast');
var canvas = document.querySelector('#canvas');
var background = new window.Image();
var context = canvas.getContext('2d');
var loop = createLoop();
var seedContainer = document.querySelector('.seed-container');
var seedText = document.querySelector('.seed-text');
var userInputContainer = document.querySelector('.user-input-container');
var userResultsContainer = document.querySelector('.user-results-container');
var userText = document.querySelector('#name-text');
var colorText = document.querySelector('#color-text');
var name = document.querySelector('.name-input-text');
var color = document.querySelector('.color-input-text');
var fillCanvas = document.querySelector('#fill');
var saveBtn = document.querySelector('.save');
var isIOS = /(iPad|iPhone|iPod)/i.test(navigator.userAgent);
if (isIOS) { // iOS bugs with full screen ...
    const fixScroll = () => {
        setTimeout(() => {
            window.scrollTo(0, 1);
        }, 500);
    };
    fixScroll();
    window.addEventListener('orientationchange', () => {
        fixScroll();
    }, false);
}
window.addEventListener('resize', resize);
document.body.style.margin = '0';
document.body.style.overflow = 'hidden';
canvas.style.position = 'absolute';
var randomize = (ev) => {
    if (ev) ev.preventDefault();
    reload(createConfig());
};
randomize();
resize();
const addEvents = (element) => {
    //  element.addEventListener('mousedown', (ev) => {
    //    if (ev.button === 0) {
    //      randomize(ev);
    //    }
    //  });
    element.addEventListener('touchstart', randomize);
};
const targets = [document.querySelector('#fill'), canvas];
targets.forEach(t => addEvents(t));

function reload(config) {
    loop.removeAllListeners('tick');
    loop.stop();
    var opts = assign({
        backgroundImage: background
        , context: context
    }, config);
    var pixelRatio = typeof opts.pixelRatio === 'number' ? opts.pixelRatio : 1;
    canvas.width = opts.width * pixelRatio;
    canvas.height = opts.height * pixelRatio;
    document.body.style.background = opts.palette[0];
    seedContainer.style.color = getBestContrast(opts.palette[0], opts.palette.slice(1));
    seedText.textContent = opts.seedName;
    userInputContainer.style.color = getBestContrast(opts.palette[0], opts.palette.slice(1));
    background.onload = () => {
        saveBtn.addEventListener("click", function () {
            if (localStorage) {
                var name = $("#name").val();
                var color = $("#color").val();
                localStorage.setItem("user_name", name);
                localStorage.setItem("user_color", color);
                getInput();
                var renderer = createRenderer(opts);
                if (opts.debugLuma) {
                    renderer.debugLuma();
                }
                else {
                    renderer.clear();
                    var stepCount = 0;
                    loop.on('tick', () => {
                        renderer.step(opts.interval);
                        stepCount++;
                        if (!opts.endlessBrowser && stepCount > opts.steps) {
                            loop.stop();
                        }
                    });
                    
                    context.font = "100px Oxygen";
                    context.fillStyle = colorText.innerHTML;
                    context.textAlign = "center";
                    context.fillText(userText.innerHTML, canvas.width/2, canvas.height/2);
                    
                    
                    loop.start();
                    
                    userInputContainer.style.display = "none";
                    fillCanvas.style.display = "block";
                    userResultsContainer.style.display = "none";
                                                            
                }
            }
            else {
                alert("Sorry, your browser do not support local storage.");
            }
        });
    };
    
    background.src = config.backgroundSrc;
    document.getElementById("body").style.background = colorText.innerHTML + "!important";
}

function getInput() {
    document.getElementById("name-text").innerHTML = localStorage.getItem("user_name");
    document.getElementById("color-text").innerHTML = localStorage.getItem("user_color");
}

function resize() {
    letterbox(canvas, [window.innerWidth, window.innerHeight]);
}

function getBestContrast(background, colors) {
    var bestContrastIdx = 0;
    var bestContrast = 0;
    colors.forEach((p, i) => {
        var ratio = contrast.hex(background, p);
        if (ratio > bestContrast) {
            bestContrast = ratio;
            bestContrastIdx = i;
        }
    });
    return colors[bestContrastIdx];
}
// resize and reposition canvas to form a letterbox view
function letterbox(element, parent) {
    var aspect = element.width / element.height;
    var pwidth = parent[0];
    var pheight = parent[1];
    var width = pwidth;
    var height = Math.round(width / aspect);
    var y = Math.floor(pheight - height) / 2;
    if (isIOS) { // Stupid iOS bug with full screen nav bars
        width += 1;
        height += 1;
    }
    // TEMPORARYYYYYY
//    height -= 100;
    //    width -= 100;
    element.style.top = y + 'px';
    element.style.width = width + 'px';
    element.style.height = height + 'px';
}