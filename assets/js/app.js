gsap.from(".hero-title",{

    y:80,
    opacity:0,
    duration:1.2

});

gsap.from(".hero-description",{

    y:40,
    opacity:0,
    duration:1.2,
    delay:.3

});

gsap.from(".hero-buttons",{

    y:40,
    opacity:0,
    duration:1.2,
    delay:.5

});

gsap.from(".hero-stats",{

    y:40,
    opacity:0,
    duration:1.2,
    delay:.7

});

//Animation des cartes flottantes

gsap.to(".card-1",{

    y:-20,
    duration:3,
    repeat:-1,
    yoyo:true,
    ease:"power1.inOut"

});

gsap.to(".card-2",{

    y:20,
    duration:4,
    repeat:-1,
    yoyo:true,
    ease:"power1.inOut"

});

gsap.to(".card-3",{

    y:-15,
    duration:2.5,
    repeat:-1,
    yoyo:true,
    ease:"power1.inOut"

});

window.addEventListener('scroll', ()=>{

    const navbar =
    document.querySelector('.navbar-custom');

    if(window.scrollY > 50){

        navbar.classList.add('navbar-scrolled');

    }
    else{

        navbar.classList.remove('navbar-scrolled');

    }

});
//compteur
const counters =
document.querySelectorAll('.counter');

counters.forEach(counter=>{

    const updateCounter = ()=>{

        const target =
        +counter.getAttribute('data-target');

        const count =
        +counter.innerText;

        const increment =
        target / 80;

        if(count < target){

            counter.innerText =
            Math.ceil(count + increment);

            setTimeout(updateCounter,20);
        }
        else{

            counter.innerText = target;

        }

    }

    updateCounter();

});
AOS.init({
    duration:1000,
    once:true
});

document.addEventListener(
'mousemove',
(e)=>{

    gsap.to('.hero-bg',{

        x:(e.clientX-500)/40,

        y:(e.clientY-300)/40,

        duration:2

    });

});
//Effet GSAP

gsap.from(".timeline-content",{

    y:60,
    opacity:0,

    duration:1,

    stagger:.2,

    scrollTrigger:{
        trigger:".timeline",
        start:"top 70%"
    }

});

 //barre de progression animation
    window.addEventListener('scroll',()=>{

    let winScroll =
    document.documentElement.scrollTop;

    let height =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;

    let scrolled =
    (winScroll/height)*100;

    document.querySelector(
        '.scroll-progress'
    ).style.width = scrolled+'%';

  });

  
//pour le bouton backup
const btn =
document.getElementById('backToTop');

window.addEventListener('scroll',()=>{

    if(window.scrollY > 500){

        btn.style.opacity = "1";
        btn.style.visibility = "visible";

    }
    else{

        btn.style.opacity = "0";
        btn.style.visibility = "hidden";

    }

});

btn.addEventListener('click',()=>{

    window.scrollTo({

        top:0,
        behavior:'smooth'

    });

});