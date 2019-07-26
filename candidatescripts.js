<script>
var elem2 = document.getElementById("btnFilter");
elem2.onclick = function(){
    var hiddenDiv = document.getElementById("filterRow");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#filterRow').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("dateAttendedFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("dateAttendedFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#dateAttendedFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem4 = document.getElementById("applicationStatusFilterBtn");
elem4.onclick = function(){
    var hiddenDiv = document.getElementById("applicationStatusFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#applicationStatusFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem5 = document.getElementById("processingBranchFilterBtn");
elem5.onclick = function(){
    var hiddenDiv = document.getElementById("processingBranchFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#processingBranchFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem6 = document.getElementById("dateAttendedRangeFilterBtn");
elem6.onclick = function(){
    var hiddenDiv = document.getElementById("dateAttendedRangeFilterDiv1");
    var hiddenDiv2 = document.getElementById("dateAttendedRangeFilterDiv2");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#dateAttendedRangeFilterDiv1').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
       hiddenDiv2.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
       hiddenDiv2.style.display = (this.value == "") ? "none":"block";
     }

};

var elem = document.getElementById("nameFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("nameFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#nameFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem = document.getElementById("mobileNumberFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("mobileNumberFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#mobileNumberFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem = document.getElementById("receptionistFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("receptionistFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#receptionistFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem = document.getElementById("confirmationStatusFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("confirmationStatusFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#confirmationStatusFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem = document.getElementById("adAppliedToFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("adAppliedToFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#adAppliedToFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem = document.getElementById("ownerFilterBtn");
elem.onclick = function(){
    var hiddenDiv = document.getElementById("ownerFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#ownerFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("confirmedDateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("confirmedDateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#confirmedDateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem6 = document.getElementById("confirmedDateRangeFilterBtn");
elem6.onclick = function(){
    var hiddenDiv = document.getElementById("confirmedDateRangeFilterDiv1");
    var hiddenDiv2 = document.getElementById("confirmedDateRangeFilterDiv2");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#confirmedDateRangeFilterDiv1').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
       hiddenDiv2.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
       hiddenDiv2.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("assignedDateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("assignedDateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#assignedDateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem6 = document.getElementById("assignedDateRangeFilterBtn");
elem6.onclick = function(){
    var hiddenDiv = document.getElementById("assignedDateRangeFilterDiv1");
    var hiddenDiv2 = document.getElementById("assignedDateRangeFilterDiv2");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#assignedDateRangeFilterDiv1').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
       hiddenDiv2.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
       hiddenDiv2.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("interviewedByFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("interviewedByFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#interviewedByFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("shuttledByDriverFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("shuttledByDriverFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#shuttledByDriverFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("shuttledByPromodiserFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("shuttledByPromodiserFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#shuttledByPromodiserFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("endorsementHistoryFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("endorsementHistoryFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#endorsementHistoryFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("shuttleStatusFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("shuttleStatusFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#shuttleStatusFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("locationFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("locationFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#locationFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("dateClientBilledFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("dateClientBilledFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#dateClientBilledFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("datePaidFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("datePaidFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#datePaidFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("billingClientFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("billingClientFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#billingClientFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};

var elem3 = document.getElementById("validationDateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("validationDateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#validationDateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem6 = document.getElementById("validationDateRangeFilterBtn");
elem6.onclick = function(){
    var hiddenDiv = document.getElementById("validationDateRangeFilterDiv1");
    var hiddenDiv2 = document.getElementById("validationDateRangeFilterDiv2");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
    var display = $('#validationDateRangeFilterDiv1').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
       hiddenDiv2.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
       hiddenDiv2.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("validationStatusFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("validationStatusFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#validationStatusFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("hiredDateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("hiredDateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#hiredDateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }

};


var elem3 = document.getElementById("startDateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("startDateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#startDateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("hiringCompanyFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("hiringCompanyFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#hiringCompanyFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("hiringAccountFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("hiringAccountFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#hiringAccountFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("isDuplicateFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("isDuplicateFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#isDuplicateFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("sourceFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("sourceFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#sourceFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};


var elem3 = document.getElementById("dateCreatedFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("dateCreatedFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#dateCreatedFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("dateModifiedFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("dateModifiedFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#dateModifiedFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};


var elem3 = document.getElementById("bpoExperienceFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("bpoExperienceFilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#bpoExperienceFilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("billingStatus1FilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("billingStatus1FilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#billingStatus1FilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};

var elem3 = document.getElementById("billingStatus2FilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("billingStatus2FilterDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#billingStatus2FilterDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};


var elem3 = document.getElementById("callStatusFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("callStatusDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#callStatusDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};



var elem3 = document.getElementById("attendanceStatusFilterBtn");
elem3.onclick = function(){
    var hiddenDiv = document.getElementById("attendanceStatusDiv");
    //hiddenDiv.style.display = (this.value == "") ? "block":"none";
     var display = $('#attendanceStatusDiv').css('display');
     //alert(display);

     if(display == "none"){
       hiddenDiv.style.display = (this.value == "") ? "block":"none";
     }else{
       hiddenDiv.style.display = (this.value == "") ? "none":"block";
     }
};


</script>
