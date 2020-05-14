console.log("script loaded")

$(".carousel").carousel({
  interval: 3500,
});

$(".carousel-control-prev").click(() =>{
  $(".carousel").carousel('prev')
})

$(".carousel-control-next").click(() =>{
  $(".carousel").carousel('next')
})
