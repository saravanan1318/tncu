<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.zaccordion.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.marquee.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>  
<script type="text/javascript">
$('.carousel-item:first-child').addClass('active');
</script>
<script type="text/javascript">
$('#exampleModalLong').modal({
show: true
})
</script>
<script type="text/javascript">
$('#demo').marquee(); 

</script>
<script type="text/javascript">
$('#demo').marquee({

// enable the plugin
enable : true,  //plug-in is enabled

// scroll direction
// 'vertical' or 'horizontal'
direction: 'vertical',

// children items
itemSelecter : 'li', 

// animation delay
delay: 3000,

// animation speed
speed: 1,

// animation timing
timing: 1,

// mouse hover to stop the scroller
mouse: true

});  
</script>
<script type="text/javascript">
$(document).ready(function() {
$("#example1").zAccordion({
timeout: 4000,
slideWidth: 800,
width: 1210,
height: 395
});
});
</script>
<style type="text/css">
.backs1 
{
border: 2px solid darkolivegreen;
padding: 10px;
border-radius: 25px;
background-color: revert;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
color: #fff;
background-color: green;
}
</style>
<script type="text/javascript">
$(function(){


$('#marquee-vertical').marquee();  
// $('#marquee-horizontal').marquee({direction:'horizontal', delay:0, timing:50});  

});

</script>