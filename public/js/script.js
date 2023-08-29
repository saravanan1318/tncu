let today = new Date(),
day = today.getDate(),
month = today.getMonth()+1, //January is 0
year = today.getFullYear()-18;
if(day<10){
    day='0'+day
} 
if(month<10){
    month='0'+month
}
today = year+'-'+month+'-'+day;
console.log(today);
document.getElementById("DOB").setAttribute("max", today);
document.getElementById("DOB").setAttribute("value", today);



$('#IsDifferentlyAbled').on('change', function() {
    if(this.value == "Yes"){
        $("#IsDifferentlyAbledfile").show();
    }else{
        $("#IsDifferentlyAbledfile").hide();
    }
});


$('#iswidow').on('change', function() {
    if(this.value == "Yes"){
        $("#iswidowfile").show();
    }else{
        $("#iswidowfile").hide();
    }
});


$('#isserviceman').on('change', function() {
    if(this.value == "Yes"){
        $("#isservicemandiv").show();
    }else{
        $("#isservicemandiv").hide();
    }
});


$('#divorcee').on('change', function() {
    if(this.value == "Yes"){
        $("#divorceefile").show();
    }else{
        $("#divorceefile").hide();
    }
});


$('#refugee').on('change', function() {
    if(this.value == "Yes"){
        $("#refugeefile").show();
    }else{
        $("#refugeefile").hide();
    }
});

$('#athlete').on('change', function() {
    if(this.value == "Yes"){
        $("#athletefile").show();
    }else{
        $("#athletefile").hide();
    }
});

$('#asltotalmark,#aslsecumark,#aslpercentage').on('blur', function() {
   var asltotalmark = parseInt($("#asltotalmark").val());
   var aslsecumark = parseInt($("#aslsecumark").val());

   if(asltotalmark != "" && aslsecumark != ""){
    var aslpercentage = aslsecumark/asltotalmark * 100;
    $("#aslpercentage").val(Math.round(aslpercentage * 100) / 100);
   }
});

$('#ahstotalmark,#ahssecumark,#ahspercentage').on('blur', function() {
    var ahstotalmark = parseInt($("#ahstotalmark").val());
    var ahssecumark = parseInt($("#ahssecumark").val());
 
    if(ahssecumark != "" && ahssecumark != ""){
     var ahspercentage = ahssecumark/ahstotalmark * 100;
     $("#ahspercentage").val(ahspercentage);
     $("#ahspercentage").val(Math.round(ahspercentage * 100) / 100);
    }
});

$('#ugtotalmark,#ugsecumark,#ugpercentage').on('blur', function() {
    var ugtotalmark = parseInt($("#ugtotalmark").val());
    var ugsecumark = parseInt($("#ugsecumark").val());
 
    if(ugtotalmark != "" && ugsecumark != ""){
     var ugpercentage = ugsecumark/ugtotalmark * 100;
     $("#ugpercentage").val(Math.round(ugpercentage * 100) / 100);
    }
});

 $('#bgtotalmark,#bgsecumark,#bgpercentage').on('blur', function() {
    var bgtotalmark = parseInt($("#bgtotalmark").val());
    var bgsecumark = parseInt($("#bgsecumark").val());
 
    if(bgtotalmark != "" && bgsecumark != ""){
     var aslpercentage = bgsecumark/bgtotalmark * 100;
     $("#bgpercentage").val(Math.round(bgpercentage * 100) / 100);
    }
 });

//var date = new Date("Mon Jan 01 2018 00:00:00 GMT+0530");
var date = new Date();
//var date = "Sun Jan 07 2018 00:00:00 GMT+0530";
//var date = "2018-01-01";
date.setDate(date.getDate() - 1);


function setAge(d) {


    var Ag = moment().diff(d, 'years', true);


    var asondate = new Date();
    // var dob = new Date($("#DOB").val());
    var selectedDOB = $('#DOB').val();

    var dob = new Date(selectedDOB);


    console.log("tt: " + selectedDOB);
    console.log("DOB: " + dob);
    console.log("AS ON D: " + asondate);


    var today = new Date();
    var age = Math.floor((asondate - dob) / (365.25 * 24 * 60 * 60 * 1000));
    // $('#age').html(age+' years old');


    // var Age = Math.floor(Ag, 0);
    $('#Age').val(age);

    $("#Community").val('');
    $('#FatherName').val('').change();
}

function ageck() {
    var Age = $('#Age').val();
    if (Age < 18) {

        alert("Your age is " + Age + ". You are Ineligible  to apply ");
        document.getElementById('Age').value = '';
        //document.getElementById("FatherName").value="";
        $('#FatherName').val("").change();
        document.getElementById('DOB').focus();
        //alert('raj');
    }
    else if (Age >= 53) {
        alert("Your age is " + Age + ". You are Ineligible  to apply ");
        $('#FatherName').val("").change();
    }
}


$(function () {
    $('.manual').change(function () {
        var isoDate = new Date($(this).val()).toISOString();
        setAge(moment(isoDate));

    });
    $('#datetimepickerDOB').change(function(){
        setAge(this.val);
    })
});


$('#datetimepickerRegistrationDate').datetimepicker({
    format: 'DD-MM-YYYY',
    //minDate: -20, maxDate: "+1M +10D",
    //formatTime: 'h:mm a',
    //formatDate: 'DD.MM.YYYY',
    // enabledDates: moment().add(30, 'days'),

    //changeMonth: true,
    //changeYear: true,
    //showOn: "button",
    //buttonImage: "calendar-blue.gif",
    //buttonImageOnly: true,
    //dateFormat: "dd-mm-yy",
    //beforeShowDay: onlyPastdays,
    maxDate: moment().subtract(0, 'years')
});

$('#datetimepickerDOI').datetimepicker({
    format: 'DD-MM-YYYY',
    //minDate: -20, maxDate: "+1M +10D",
    //formatTime: 'h:mm a',
    //formatDate: 'DD.MM.YYYY',
    // enabledDates: moment().add(30, 'days'),

    //changeMonth: true,
    //changeYear: true,
    //showOn: "button",
    //buttonImage: "calendar-blue.gif",
    //buttonImageOnly: true,
    //dateFormat: "dd-mm-yy",
    //beforeShowDay: onlyPastdays,
    maxDate: moment().subtract(0, 'years')
});

$('#datetimepickerDOII').datetimepicker({
    format: 'DD-MM-YYYY',
    //minDate: -20, maxDate: "+1M +10D",
    //formatTime: 'h:mm a',
    //formatDate: 'DD.MM.YYYY',
    // enabledDates: moment().add(30, 'days'),

    //changeMonth: true,
    //changeYear: true,
    //showOn: "button",
    //buttonImage: "calendar-blue.gif",
    //buttonImageOnly: true,
    //dateFormat: "dd-mm-yy",
    //beforeShowDay: onlyPastdays,
    maxDate: moment().subtract(0, 'years')
});

//function showdate() {
//alert($('#datetimepickerDOB').val());
// }
function onlyPastdays(date) {
    var day = date.getDay();
    var today = new Date();
    today.setDate(today.getDate() - 1);
    return [(date < today), ''];
}

function SaveCandidate() {
    var photo = new FormData();
    var files = $("#UploadImg").get(0).files;
    if (files.length > 0) {
        photo.append(files[0].name, files[0]);
    }
    $.ajax({
        type: 'POST',
        url: "/Register/SaveCandidate",
        data: $("#frmCandidate").serialize(),
        dataType: 'json',
        processData: false,
        success: function (data) {
            if (data == "true") {
                alert("Candidate data saved");
            }
            else {
                alert("Candidate data not saved. Please try again after sometime");
            }
        }, error: function (er) {
            //$('#loaderUploadImg').css('display', 'none');
            alert(er.Message);
        }
    });
}

function ShowHideEmployment() {
    var id = $("#IsRegisterEmployment").val();
    if (id == "1") {
        $("#divemployment").show();
    }
    else {
        $("#divemployment").hide();
    }
}


function otherstate() {
    //alert("rd");
    var id = $("#NativeState").val();
    if (id == "2") {
        //alert(id);
        $("#otherstate").show();
    }


    else {
        //alert(id);
        $("#otherstate").hide();
    }
}

function othernation() {
    // alert("rd");
    var id = $("#Nationality").val();
    if (id == "other") {
        $("#othernation").show();
    }
    else {
        $("#othernation").hide();
    }
}


function otherregion() {
    var id = $("#Religion").val();
    if (id == "Others") {
        $("#otherreligion").show();
    }
    else {
        $("#otherreligion").hide();
    }
}

function periage() {
    //alert("rd");spousename
    var id = $("#ClaimPriority").val();
    if (id == "12") {
        alert("You are eligible");
    }
    else {
        alert("Your are not eligible");
    }
}

function eduqfy() {
    //alert("rd");
    var id = $("#eduqualify").val();

    if (id == "1") {

        //alert("rd2");
        $("#hsc_head").show();
        $("#hsc_content").show();
        $("#twm_head").show();
        $("#twm1").show();
        $("#twm2").hide();
        $("#twm3").hide();
        $("#iti_head").hide();
        $("#iti_content").hide();
        $("#tr_hd").hide();
        $("#tr_scr").hide();
        $("#iti_esl").hide();
        $("#itiels_content").hide();
        $("#tresl_hd").hide();
        $("#tr_scr").hide();
        $("#tresl_scr").hide();

    }


    else if (id == "2") {
        $("#hsc_head").hide();
        $("#hsc_content").hide();
        $("#iti_head").show();
        $("#iti_content").show();
        $("#tr_hd").show();
        $("#tr_scr").show();
        $("#twm_head").show();
        $("#twm1").hide();
        $("#twm2").show();
        $("#twm3").hide();

        $("#iti_esl").hide();
        $("#itiels_content").hide();
        $("#tresl_hd").hide();
        $("#tr_scr").show();
        $("#tresl_scr").hide();

    }
    else if (id == "3") {
        $("#hsc_head").hide();
        $("#hsc_content").hide();
        $("#iti_head").hide();
        $("#iti_content").hide();
        $("#tr_hd").hide();
        $("#iti_esl").show();
        $("#itiels_content").show();
        $("#tresl_hd").show();
        $("#tr_scr").show();
        $("#tresl_scr").show();
        $("#twm_head").show();
        $("#twm1").hide();
        $("#twm2").hide();
        $("#twm3").show();
    }
    else {
        $("#hsc_head").hide();
        $("#hsc_content").hide();
        $("#iti_head").hide();
        $("#iti_content").hide();
        $("#tr_hd").hide();
        $("#tr_scr").hide();
        $("#twm_head").hide();
        $("#twm1").hide();
        $("#twm2").hide();
        $("#iti_esl").hide();
        $("#itiels_content").hide();
        $("#tresl_hd").hide();
        $("#tr_scr").hide();
        $("#tresl_scr").hide();
        $("#twm_head").hide();
    }
}





function marry() {
    //alert("rd");
    var id = $("#mstatus").val();
    if (id == "1") {
        $("#spousename").show();
    }
    else {
        $("#spousename").hide();
    }
}


//amount call name="Community"

function cmamount() {

    // alert("rt");
    var comm = $("#Community").val();

    if (comm == '4' || comm == '5' || comm == '6') {
        //alert(comm);
        document.getElementById('Amount').value = 50 + (50 * 18 / 100);
    }

    //var selectedText = $("#Community").val();

    else {
        document.getElementById('Amount').value = 100 + (100 * 18 / 100);

    }
}


//var id = $("#mstatus").val();
$("#caspa").click(function () {

    if ($(this).prop("checked") == true) {
        // alert("Checkbox is checked.");
        var a = $("#plotno").val();
        var b = $("#streetname").val();
        var c = $("#city").val();
        var d = $("#district").val();
        var e = $("#state").val();
        var f = $("#pincode").val();
        //alert(d);
        document.getElementById('pplotno').value = a;
        document.getElementById('pstreetname').value = b;
        document.getElementById('pcity').value = c;
        document.getElementById('pdistrict').value = d;
        document.getElementById('pstate').value = e;
        document.getElementById('ppincode').value = f;

        $("#pplotno").attr('readonly', 'readonly');
        $("#pstreetname").attr('readonly', 'readonly');
        $("#pcity").attr('readonly', 'readonly');
        $("#pdistrict").attr('readonly', 'readonly');
        $("#pstate").attr('readonly', 'readonly');
        $("#ppincode").attr('readonly', 'readonly');
        // $("#pDFPNo").val()= d;
    }
    else if ($(this).prop("checked") == false) {
        //alert("Checkbox is unchecked.");

        document.getElementById('pplotno').value = '';
        document.getElementById('pstreetname').value = '';
        document.getElementById('pcity').value = '';
        document.getElementById('pdistrict').value = '';
        document.getElementById('pstate').value = '';
        document.getElementById('ppincode').value = '';


        $("#pplotno").removeAttr('readonly');
        $("#pstreetname").removeAttr('readonly');
        $("#pcity").removeAttr('readonly');
        $("#pdistrict").removeAttr('readonly');
        $("#pstate").removeAttr('readonly');
        $("#ppincode").removeAttr('readonly');
    }
});

function dope() {
    //alert("rd");
    var id = $("#DOPE").val();
    if (id == "1") {
        $("#doe_head").show();
        $("#doe_content").show();
    }
    else {
        // $("#spousename").hide();
        $("#doe_head").hide();
        $("#doe_content").hide();
    }
}

function dcpd() {
    //alert("rd");
    var id = $("#DCPD").val();
    if (id == "1") {
        //$("#doe_head").show();
        $("#dcp_head").show();
    }
    else {
        // $("#spousename").hide();
        $("#dcp_head").hide();
        //$("#doe_content").hide();
    }
}


//start
function slcalc() {
    //alert("rd");
    var id = $("#slnofa").val();
    //var iid= $("#islnofa").val();
    //var id = $("#sslnofa").val();
    var stm = Number($("#sltotalmark").val());
    var ssm = Number($("#slsecumark").val());
    //var id = $("#slnofa").val();
    //alert(id);
    if (id == "1") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);

        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 1) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("slpercentage").value = slper + "%";
        document.getElementById("slmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.9) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("slpercentage").value = slper + "%";
        document.getElementById("slmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.8) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("slpercentage").value = slper + "%";
        document.getElementById("slmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.7) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("slpercentage").value = slper + "%";
        document.getElementById("slmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.6) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("slpercentage").value = slper + "%";
        document.getElementById("slmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }


    var swm = Number($("#slmarkweight").val());
    var hwm = Number($("#hsmarkweight").val());
    //alert(swm);
    //alert(hwm);
    //document.getElementById("totwmark").value = swm + hwm;

    if (stm < ssm) {
        document.getElementById("sltotalmark").value = "";
        document.getElementById("slsecumark").value = "";
        document.getElementById("sltotalmark").focus();
        document.getElementById("slpercentage").value = "";
        document.getElementById("slmarkweight").value = "";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = swm + hwm;
    }

    //alert("rt");
    if (isNaN(swm)) {
        return 0;
    }

    document.getElementById("totwmark").value = swm + hwm;

}

//end


//start
function islcalc() {
    //alert("rd");
    var id = $("#islnofa").val();
    //var iid= $("#islnofa").val();
    //var id = $("#sslnofa").val();
    var stm = Number($("#isltotalmark").val());
    var ssm = Number($("#islsecumark").val());
    //var id = $("#slnofa").val();
    //alert(id);
    if (id == "1") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 1) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("islpercentage").value = slper + "%";
        document.getElementById("islmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.9) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("islpercentage").value = slper + "%";
        document.getElementById("islmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.8) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("islpercentage").value = slper + "%";
        document.getElementById("islmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.7) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("islpercentage").value = slper + "%";
        document.getElementById("islmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.6) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("islpercentage").value = slper + "%";
        document.getElementById("islmarkweight").value = slmrkwg;
        // $("#spousename").show();
    }

    else {
        // $("#spousename").hide();
    }

    var iswm = Number($("#islmarkweight").val());
    var itwm = Number($("#itimarkweight").val());
    //alert(iswm);
    if (stm < ssm) {
        document.getElementById("isltotalmark").value = "";
        document.getElementById("islsecumark").value = "";
        document.getElementById("isltotalmark").focus();
        document.getElementById("islpercentage").value = "";
        document.getElementById("islmarkweight").value = "";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = iswm + itwm;
    }
    if (isNaN(itwm)) {
        return 0;
    }
    document.getElementById("totwmark").value = iswm + itwm;
    //alert(tm);
}

//end


//start
function ieslcalc() {
    //alert("rd");
    var id = $("#ieslnofa").val();
    //var iid= $("#islnofa").val();
    //var id = $("#sslnofa").val();
    var stm = Number($("#iesltotalmark").val());
    var ssm = Number($("#ieslsecumark").val());
    //var id = $("#slnofa").val();
    //alert(id);
    if (id == "1") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 1) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("ieslpercentage").value = slper + "%";
        //document.getElementById("islmarkweight").value=slmrkwg;
        document.getElementById("ieslmarkweight").value = 0;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.9) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("ieslpercentage").value = slper + "%";
        //document.getElementById("islmarkweight").value=slmrkwg;
        document.getElementById("ieslmarkweight").value = 0;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.8) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("ieslpercentage").value = slper + "%";
        //document.getElementById("islmarkweight").value=slmrkwg;
        document.getElementById("ieslmarkweight").value = 0;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.7) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("ieslpercentage").value = slper + "%";
        //document.getElementById("islmarkweight").value=slmrkwg;
        document.getElementById("ieslmarkweight").value = 0;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");
        var slper = (ssm * 100) / stm;
        slper = slper.toFixed(2);
        //alert(per);
        //$("#slpercentage").val() = per;

        var slmrkwg = (slper * 40 * 0.6) / 100;
        slmrkwg = slmrkwg.toFixed(2);
        document.getElementById("ieslpercentage").value = slper + "%";
        //document.getElementById("islmarkweight").value=slmrkwg;
        document.getElementById("ieslmarkweight").value = 0;

    }

    else {

    }

    var iswm = Number($("#ieslmarkweight").val());
    var itwm = Number($("#itiemarkweight").val());

    //alert(iswm);
    if (stm < ssm) {
        document.getElementById("iesltotalmark").value = "";
        document.getElementById("ieslsecumark").value = "";
        document.getElementById("iesltotalmark").focus();
        document.getElementById("ieslpercentage").value = "";
        //document.getElementById("ieslmarkweight").value="";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = iswm + itwm;
    }

    if (isNaN(itwm)) {
        return 0;
    }
    document.getElementById("totwmark").value = iswm + itwm;
    //alert(tm);
}

//end


//start itiecalc
function itiecalc() {
    //alert("rd");
    var id = $("#itienofa").val();
    var stm = Number($("#itietotalmark").val());
    var ssm = Number($("#itiesecumark").val());

    //var id = $("#itinofa").val();
    //alert(stm);
    if (id == "1") {


        //alert("ty");

        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(itiper);
        //$("#itipercentage").val() = per;


        var itimrkwg = (itiper * 60 * 1) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itiepercentage").value = itiper + "%";
        document.getElementById("itiemarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");

        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.9) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itiepercentage").value = itiper + "%";
        document.getElementById("itiemarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");

        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.8) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itiepercentage").value = itiper + "%";
        document.getElementById("itiemarkweight").value = itimrkwg;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");

        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.7) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itiepercentage").value = itiper + "%";
        document.getElementById("itiemarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");

        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        alert(itiper);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.6) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itiepercentage").value = itiper + "%";
        document.getElementById("itiemarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    else {
        // $("#spousename").hide();
    }
    var iswm = Number($("#ieslmarkweight").val());
    var itwm = Number($("#itiemarkweight").val());
    //alert(iswm);
    if (stm < ssm) {
        document.getElementById("itietotalmark").value = "";
        document.getElementById("itiesecumark").value = "";
        document.getElementById("itietotalmark").focus();
        document.getElementById("itiepercentage").value = "";
        document.getElementById("itiemarkweight").value = "";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = "";
    }

    if (isNaN(itwm)) {
        return 0;
    }
    document.getElementById("totwmark").value = iswm + itwm;
}

//end


//start hscalc
function hscalc() {
    //alert("rd");
    var id = $("#hsnofa").val();
    var stm = Number($("#hstotalmark").val());
    var ssm = Number($("#hssecumark").val());
    //var id = $("#hsnofa").val();
    //alert(id);
    if (id == "1") {
        //alert("ty");
        var hsper = (ssm * 100) / stm;
        hsper = hsper.toFixed(2);
        //alert(hsper);
        //$("#hspercentage").val() = per;

        var hsmrkwg = (hsper * 60 * 1) / 100;
        hsmrkwg = hsmrkwg.toFixed(2);
        document.getElementById("hspercentage").value = hsper + "%";
        document.getElementById("hsmarkweight").value = hsmrkwg;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");
        var hsper = (ssm * 100) / stm;
        //alert(per);
        //$("#hspercentage").val() = per;
        hsper = hsper.toFixed(2);
        var hsmrkwg = (hsper * 60 * 0.9) / 100;
        hsmrkwg = hsmrkwg.toFixed(2);
        document.getElementById("hspercentage").value = hsper + "%";
        document.getElementById("hsmarkweight").value = hsmrkwg;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");
        var hsper = (ssm * 100) / stm;
        //alert(per);
        //$("#hspercentage").val() = per;
        hsper = hsper.toFixed(2);
        var hsmrkwg = (hsper * 60 * 0.8) / 100;
        hsmrkwg = hsmrkwg.toFixed(2);
        document.getElementById("hspercentage").value = hsper + "%";
        document.getElementById("hsmarkweight").value = hsmrkwg;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");
        var hsper = (ssm * 100) / stm;
        //alert(per);
        //$("#hspercentage").val() = per;
        hsper = hsper.toFixed(2);

        var hsmrkwg = (hsper * 60 * 0.7) / 100;
        hsmrkwg = hsmrkwg.toFixed(2);
        document.getElementById("hspercentage").value = hsper + "%";
        document.getElementById("hsmarkweight").value = hsmrkwg;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");
        var hsper = (ssm * 100) / stm;
        //alert(per);
        //$("#hspercentage").val() = per;
        hsper = hsper.toFixed(2);

        var hsmrkwg = (hsper * 60 * 0.6) / 100;
        hsmrkwg = hsmrkwg.toFixed(2);
        document.getElementById("hspercentage").value = hsper + "%";
        document.getElementById("hsmarkweight").value = hsmrkwg;
        // $("#spousename").show();
    }

    else {
        //$("#spousename").hide();
    }

    var swm = Number($("#slmarkweight").val());
    //alert(swm);
    var hwm = Number($("#hsmarkweight").val());

    if (stm < ssm) {
        document.getElementById("hstotalmark").value = "";
        document.getElementById("hssecumark").value = "";
        document.getElementById("hstotalmark").focus();
        document.getElementById("hspercentage").value = "";
        document.getElementById("hsmarkweight").value = "";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = swm + hwm;
    }


    if (isNaN(hwm)) {
        return 0;
    }
    document.getElementById("totwmark").value = swm + hwm;
    //alert(tm);
}

//end


//start iticalc
function iticalc() {
    //alert("rd");
    var id = $("#itinofa").val();
    var stm = Number($("#ititotalmark").val());
    var ssm = Number($("#itisecumark").val());
    //var id = $("#itinofa").val();
    //alert(id);
    if (id == "1") {
        //alert("ty");
        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 1) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itipercentage").value = itiper + "%";
        document.getElementById("itimarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "2") {
        //alert("ty");
        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.9) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itipercentage").value = itiper + "%";
        document.getElementById("itimarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "3") {
        //alert("ty");
        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.8) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itipercentage").value = itiper + "%";
        document.getElementById("itimarkweight").value = itimrkwg;
        // $("#spousename").show();
    }


    if (id == "4") {
        //alert("ty");
        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.7) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itipercentage").value = itiper + "%";
        document.getElementById("itimarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    if (id == "5") {
        //alert("ty");
        var itiper = (ssm * 100) / stm;
        itiper = itiper.toFixed(2);
        //alert(per);
        //$("#itipercentage").val() = per;

        var itimrkwg = (itiper * 60 * 0.6) / 100;
        itimrkwg = itimrkwg.toFixed(2);
        document.getElementById("itipercentage").value = itiper + "%";
        document.getElementById("itimarkweight").value = itimrkwg;
        // $("#spousename").show();
    }

    else {
        // $("#spousename").hide();
    }
    var iswm = Number($("#islmarkweight").val());
    var itwm = Number($("#itimarkweight").val());
    //alert(iswm);


    if (stm < ssm) {
        document.getElementById("ititotalmark").value = "";
        document.getElementById("itisecumark").value = "";
        document.getElementById("ititotalmark").focus();
        document.getElementById("itipercentage").value = "";
        document.getElementById("itimarkweight").value = "";
        alert("Enter Correct Secure Mark");
        document.getElementById("totwmark").value = iswm + itwm;
    }


    if (isNaN(itwm)) {
        return 0;
    }
    document.getElementById("totwmark").value = iswm + itwm;
}

//end


// function tofd() {
//     //alert("rd");
//     var id = $("#IsDifferentlyAbled").val();
//     if (id == "1") {
//         $("#typeof").show();
//     }
//     if (id == "2") {
//         //$("#typeof").prop('selectedIndex', 0);
//         $("#typeof").hide();
//         $("#typeofd").val("0").change();
//     }
// }

function iswid() {
    //alert("rd");
    var id = $("#Iswidow").val();
    if (id == "1") {

        //document.getElementById("IsDifferentlyAbled").selectedIndex="2";
        //document.getElementById("Isserviceman").selectedIndex="2";
        $("#IsDifferentlyAbled").prop('selectedIndex', 2);
        $("#Isserviceman").prop('selectedIndex', 2);
        //$("#IsDifferentlyAbled").val("2").change();
        //$("#Isserviceman").val("2").change();
        $('#IsDifferentlyAbled').css('pointer-events', 'none');
        $('#Isserviceman').css('pointer-events', 'none');
    }
    if (id == "2") {
        $("#IsDifferentlyAbled").prop('selectedIndex', 2);
        $("#Isserviceman").prop('selectedIndex', 2);
        $('#IsDifferentlyAbled').css('pointer-events', 'visible');
        $('#Isserviceman').css('pointer-events', 'visible');

    }

}


function isserv() {
    //alert("rd");
    var id = $("#Isserviceman").val();
    if (id == "1") {
        //document.getElementById("IsDifferentlyAbled").selectedIndex="2";
        //document.getElementById("Iswidow").selectedIndex="2";
        $("#IsDifferentlyAbled").prop('selectedIndex', 2);
        $("#Iswidow").prop('selectedIndex', 2);
        $('#IsDifferentlyAbled').css('pointer-events', 'none');
        $('#Iswidow').css('pointer-events', 'none');
        // $("#Iswidow").attr('disabled','disabled');
        //$("#IsDifferentlyAbled").attr('disabled','disabled');

    }
    if (id == "2") {

        //$("#Iswidow").removeAttr('disabled','disabled');
        //$("#IsDifferentlyAbled").removeAttr('disabled','disabled');
        $("#IsDifferentlyAbled").prop('selectedIndex', 2);
        $("#Iswidow").prop('selectedIndex', 2);
        $('#IsDifferentlyAbled').css('pointer-events', 'visible');
        $('#Iswidow').css('pointer-events', 'visible');

    }

}


function ShowHidePriority() {
    var id = $("#IsClaimPriority").val();
    var Age = $('#Age').val();
    var Community = $('#Community').val();


    if (id == "1") {
        $("#divpriority").show();
    }
    if (id == "2") {
        $("#divpriority").hide();
        //			$("#ClaimPriority").val("").change();
        var id = $("#ClaimPriority").val();
        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }

        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }

        }
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
            }

        }

    }
    var id = $("#ClaimPriority").val();
    if (id == "12") {
        if (Age >= 42) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 45) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 40) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();

            }

        }
    }
    if (id == "4") {
        if (Age >= 35) {
            alert("Your age is" + Age + ". You are Ineligible  to apply ");

            $("#ClaimPriority").val("").change();

        }
    }
    if (id == "7") {
        if (Age >= 48) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 53) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

    }

    if (id == "1") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
                $("#Community").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#divpriority").val("").change();
                $("#Community").val("").change();
            }

        }

    }

    if (id == "2") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "3") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "5") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "6") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "6") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "8") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "9") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "10") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "11") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();

            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "13") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "14") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "15") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "16") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "17") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "18") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "19") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "20") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }

    if (id == "21") {
        if (Age >= 30) {
            if (Community == "7") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }

        if (Age >= 32) {
            if (Community == "1") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "2") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "3") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }


        }
        if (Age >= 35) {
            if (Community == "4") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "5") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }
            if (Community == "6") {
                alert("Your age is" + Age + ". You are Ineligible  to apply");
                $("#IsClaimPriority").val("").change();
                $("#ClaimPriority").val("").change();
            }

        }

    }


}

function GetTaluk() {
    var id = $("#District").val();
    $.ajax({
        url: '/Register/GetTaluk',
        type: "GET",
        dataType: "JSON",
        data: {districtid: id},
        success: function (list) {
            $("#Taluk").html(""); // clear before appending new list
            $.each(list, function (i, item) {
                $("#Taluk").append(
                    $('<option></option>').val(item.Value).html(item.Text));
            });
        }
    });
}

function GetQueryStringByParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function () {
    var QueryString = GetQueryStringByParameter('msg');
    if (QueryString != "")
        alert(QueryString);
    $("#divpriority").hide();
    $("#divemployment").hide();
    $('#btnPreview').click(function () {

        $('#lblName').text($('#Name').val());
        $('#lblGender').text($("#Gender option:selected").text());
        $('#lblDOB').text($('#DOB').val());
        $('#lblAge').text($('#Age').val());
        $('#lblFName').text($('#FatherName').val());
        $('#lblMName').text($('#MotherName').val());
        $('#lblmstatus').text($("#mstatus option:selected").text());
        $('#lblSName').text($('#SpouseName').val());
        $('#lblpbirth').text($('#placeofbirth').val());
        $('#lblpbirth').text($('#placeofbirth').val());
        $('#lblAddress').text($('#Address').val());
        $('#lblReligion').text($('#Religion').val());
        $('#lblCommunity').text($('#Community').val());
        $('#lblCCNumber').text($('#CommunityCertificateNumber').val());
        $('#lblDistrict').text($("#District option:selected").text());
        $('#lblTaluk').text($("#Taluk option:selected").text());
        $('#lblPin').text($('#Pincode').val());
        $('#lblEmail').text($('#Email').val());
        $('#lblMobile').text($('#Mobile1').val());
        $('#lblMobile2').text($('#Mobile2').val());
        $('#lblDisability').text($("#IsDifferentlyAbled option:selected").text());
        $('#lblIsRegisterEmployment').text($("#IsRegisterEmployment option:selected").text());
        $('#lblRegNumber').text($('#RegistrationNumber').val());
        $('#lblRegDate').text($('#RegistrationDate').val());

        $('#lblITIDegree').text($("#ITIInstitutionTypeId option:selected").text());
        $('#lblITIInstitutionName').text($('#ITIInstitutionName').val());
        $('#lblITIAttempt').text($("#ITIAttempt option:selected").val());
        $('#lblITIPercentage').text($('#ITIPercentage').val());
        $('#lblITIDurationFrom').text($("#ITIDurationFromMonth option:selected").val() + "/" + $("#ITIDurationFromYear option:selected").val());
        $('#lblITIDurationTo').text($("#ITIDurationToMonth option:selected").val() + "/" + $("#ITIDurationToYear option:selected").val());
        $('#lblITIPassYear').text($("#ITIPassMonth option:selected").val() + "/" + $("#ITIPassYear option:selected").val());

        $('#lblHSCDegree').text($("#HSCInstitutionTypeId option:selected").text());
        $('#lblHSCInstitutionName').text($('#HSCInstitutionName').val());
        $('#lblHSCAttempt').text($("#HSCAttempt option:selected").val());
        $('#lblHSCPercentage').text($('#HSCPercentage').val());
        $('#lblHSCDurationFrom').text($("#HSCDurationFromMonth option:selected").val() + "/" + $("#HSCDurationFromYear option:selected").val());
        $('#lblHSCDurationTo').text($("#HSCDurationToMonth option:selected").val() + "/" + $("#HSCDurationToYear option:selected").val());
        $('#lblHSCPassYear').text($("#HSCPassMonth option:selected").val() + "/" + $("#HSCPassYear option:selected").val());

        $('#lblSSLCDegree').text($("#SSLCInstitutionTypeId option:selected").text());
        $('#lblSSLCInstitutionName').text($('#SSLCInstitutionName').val());
        $('#lblSSLCAttempt').text($("#SSLCAttempt option:selected").val());
        $('#lblSSLCPercentage').text($('#SSLCPercentage').val());
        $('#lblSSLCDurationFrom').text($("#SSLCDurationFromMonth option:selected").val() + "/" + $("#SSLCDurationFromYear option:selected").val());
        $('#lblSSLCDurationTo').text($("#SSLCDurationToMonth option:selected").val() + "/" + $("#SSLCDurationToYear option:selected").val());
        $('#lblSSLCPassYear').text($("#SSLCPassMonth option:selected").val() + "/" + $("#SSLCPassYear option:selected").val());


        $("#PreviewModal").modal();


    });


    $("#Category_Id").change(function () {
        //var end = this.text;
        var selectedText = $("#Category_Id option:selected").text()
        var selectedGenderText = $("#Gender_id option:selected").text()
        // alert($("#Category_Id option:selected").text());
        if (selectedText == 'SC' || selectedText == 'ST' || selectedText == 'PH') {
            $('#Amount').val('100');
        }
        else {
            $('#Amount').val('300');
        }

        if (selectedGenderText == "Female") {
            $('#Amount').val('100');
        }

    });

});


//img
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        //alert(reader);

        reader.onload = function (e) {
            $('#cimage')
                .attr('src', e.target.result);
            //alert(e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function readUR(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#csign')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function (e) {

    $("#Community").change(function (e) {


        var selVal = $(this).val();

        if (selVal == '7') {

            $("#Subcaste").rules("remove");
            $("#CommunityCertificateNumber").rules("remove");
            $("#ccDOI").rules("remove");
            $("#ccIssuingauthority").rules("remove");
            $("#ccTaluk").rules("remove");
            $("#ccDistrict").rules("remove");

            $("#Subcaste").parent().parent().parent().hide();
            $("#CommunityCertificateNumber").parent().parent().parent().parent().hide();
            $("#ccDOI").parent().parent().parent().parent().hide();
            $("#ccIssuingauthority").parent().parent().parent().hide();
            $("#ccTaluk").parent().parent().parent().hide();
            $("#ccDistrict").parent().parent().parent().hide();
        }
        else {

            $("#Subcaste").rules("add", {
                required: true,
                messages: {
                    required: "The Subcaste field is required."
                }
            });
            $("#CommunityCertificateNumber").rules("add", {
                required: true,
                messages: {
                    required: "This field is required."
                }
            });
            $("#ccDOI").rules("add", {
                required: true,
                messages: {
                    required: "This field is required."
                }
            });
            $("#ccIssuingauthority").rules("add", {
                required: true,
                messages: {
                    required: "This field is required."
                }
            });
            $("#ccTaluk").rules("add", {
                required: true,
                messages: {
                    required: "This field is required."
                }
            });
            $("#ccDistrict").rules("add", {
                required: true,
                messages: {
                    required: "This field is required."
                }
            });

            $("#Subcaste").parent().parent().parent().show();
            $("#CommunityCertificateNumber").parent().parent().parent().parent().show();
            $("#ccDOI").parent().parent().parent().parent().show();
            $("#ccIssuingauthority").parent().parent().parent().show();
            $("#ccTaluk").parent().parent().parent().show();
            $("#ccDistrict").parent().parent().parent().show();
        }
    });
});


$(document).ready(function (e) {


    $("#Gender").change(function (e) {
        var selVal = $(this).val();
        if (selVal == '1') {
            $("#cimage").attr('src', 'images/maleIcon.png');
        }
        else {
            $("#cimage").attr('src', 'images/femaleIcon.png');
        }


    });


    $("#btnPayment").click(function (e) {

        console.log("Clicked");


    });


    $("#btnPayment").click(function (e) {

        console.log("Form is trying to submit");
        e.preventDefault();
        if($("#regform").validate()){
            $("#regform").submit();
        }
    
    });


    // $("#btnPayment").click(function(e){
    //
    //    alert("button clicned");
    //     $("#regform").submit();
    // });
    //
    // $("#regform").submit(function(e){
    //     e.preventDefault();
    //     alert("Not submitting");
    // })
    //
    //
});


$(document).ready(function () {
    //Disable full page
    $("body").on("contextmenu", function (e) {
        return false;
    });

    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });

});
$("#typeof").hide();
$("#typeofd").val("0").change();
