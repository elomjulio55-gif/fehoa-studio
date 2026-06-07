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