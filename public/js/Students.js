
var StudentID = 0;
var instalments = [];
var members = [];
var health_histories = [];
var DiscountOptions = [];
function Fill(FromElementName, ToElementName) {
    $("#" + ToElementName).text($("#" + FromElementName).val());
    //// Add new family member 
}
//// Add new family member 
function AddNewFamilyMember() {
    var NewMember = {
        name: $('#FmailyMembername').val(),
        date_of_birth: $('#date_of_birth_family').val(),
        educational_degree: $('#educational_degree').val(),
        remark: $('#remark_family').val()
    };
    members.push(NewMember);
    var html = '';
    html += '<tr>';
    html += '<td>' + NewMember.name + '</' + 'td>';
    html += '<td>' + NewMember.date_of_birth + '</td>';
    html += '<td>' + NewMember.educational_degree + '</td>';
    html += '<td>' + NewMember.remark + '</td>';
    html += '<td>' + '<a class="btn default red-stripe btn-xs" onclick="Delete('+"'tbl_FamilyMembers'"+');">' + '<i class="fa fa-times"></i>' + ' Delete' + '</a>' +'</td>';
    html += '</tr>'; 
    $("#tbl_FamilyMembers tbody").append(html);
    $("#tbl_FamilyMembersinfo tbody").append(html);
}
//// Add new Chronic
function AddNewDisease() {
    var NewMember = {
        description: $('#description_od_disase').val(),
        date: $('#date_of_disaes').val()
    };
    health_histories.push(NewMember);
    var html = '';
    html += '<tr>';
    html += '<td>' + NewMember.description + '</' + 'td>';
    html += '<td>' + NewMember.date + '</td>';
    html += '<td>' + '<a class="btn default red-stripe btn-xs" onclick="Delete(' + "'Tbl_Chronic'" + ');">' + '<i class="fa fa-times"></i>' + ' Delete' + '</a>' +'</td>';
    html += '</tr>';
    $("#Tbl_Chronic tbody").append(html);
    $("#Tbl_Chronicinfo tbody").append(html);
}
// To Delete from Html table
function Delete(Tbl_Name) {
  var  row = $(this).parent().index();
  document.getElementById(Tbl_Name).deleteRow(row);
    document.getElementById(Tbl_Name +'info').deleteRow(row);
 
}
////Function for getting the Data Based upon Class ID
function getFeesType(id) {
    $.ajax({

        url: "/Registration/getFeesType/" + id,

        typr: "GET",

        contentType: "application/json;charset=UTF-8",

        dataType: "json",

        success: function (result) {
            var SubTotal = 0;
            var html = '';
            $.each(result, function (key, item) {
                    html += '<tr>';
                    html += '<td>' + item.fessname + '</td>';
                    html += '<td>' + item.amount + '</td>';
                    html += '<td>' + item.remark + '</td>';
                    if (item.is_must === true) {
                        html += '<td>' + '<input disabled="disabled" type="checkbox" class="mt-checkbox mt-checkbox-outline">' + '</td>';
                        SubTotal = SubTotal + item.amount;
                    } else {
                        html += '<td>' + '<input value=' + item.amount + ' +  type="checkbox" class="mt-checkbox mt-checkbox-outline">' + '</td>';
                    }
                    html += '</tr>';

            });
            $('#LblSTotal').text(SubTotal);
            $('#LblGrandTotal').text(SubTotal);
            $("#tbl_Feesinfo tbody").empty();
            //append htnl 
            $("#tbl_Feesinfo tbody").append(html);
            getDiscount();
            getInstallmentHead(id);
        },

        error: function (errormessage) {

            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });

        }

    });
    return false;
}
////Function for getting the Data Based upon Class ID
function getInstallmentHead(id) {
 
    $.ajax({
        url: "/Registration/getInstallmentHead/" + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';
            html += '<tr>';
            html += '<th>' +   'Date'+ '</th>';
            $.each(result, function (key, item) {
              
                html += '<th class="tblinstallmenthead">' + item.feename + '</th>';
            //    getInstallmentBody();
            });
           // html += '<th>' + 'Total' + '</th>';
            //html += '<th>' + '' + '</th>';
            html += '<tr>';
            $("#tbl_FeesInstallment thead").empty();
            //append htnl 
            $("#tbl_FeesInstallment thead").append(html);
            GetInstallmentDate();
        },
        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });
    return false;
}
function getInstallmentBody() {
    $.ajax({
        url: "/InstallmentSetup/getInstallmentBody/",
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",

        success: function (result) {
            var html = '';
           
            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + item.feename + '</td>';
                for (var i = 0; i < 10; i++) {
                    html += '<td align="center">' + '<input type="text" onblur="checkifactive(' + item.feeid + ', ' + i + ' , this.value '+',' + item.year_id +');" id="' + item.feeid + 'txt' + i +  '" class="form-control input-xsmall">' + '</td>';
                }
                html += '</tr>';
            });
            $("#tbl_installment tbody").append(html);
            BindInstallmentBody();
        },

        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });

}
function BindInstallmentBody() {
    $.ajax({
        url: "/InstallmentSetup/BindInstallmentBody/",
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            $.each(result, function (key, item) {
                // Bind 
                for (var i = 0; i < 10; i++) {
                    if (i === item.installment_no) {
                        $('#ch' + i).prop('checked', true);
                        $('#txtdate' + i).val(item.due_date);
                        $('#' + item.fee_id + 'txt' + i).val(item.percantage);
                    }
                }
            });
     
        },
        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });

}

// this is to get class installments  
function GetInstallmentDate() {
    $("#tbl_FeesInstallment tbody").empty();
    $.ajax({
        url: "/Fees/GetinstallmentDates/",
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            $.each(result, function (key, item) {
               
                BindFeesInstallmentBody(item.duedate, item.no);
            });

        },
        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });

}
// this is  to bind fees installment body
function BindFeesInstallmentBody(id, no) {
   console.log(id);
    $.ajax({

        url: "/Fees/BindFeesInstallmentBody/" + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        async: false,
        success: function (result) {
            var html = '';
            html += '<tr>';
            html += '<td width="8%">' + '<input type="date" value="' + id + '" id="' + no + 'txtdate' + '" class="form-control input-small installmendate">' + '</td>';
            $.each(result, function (key, item) {           

                if (item.is_transportation==true) {
                    html += '<td>' + '<input type="text"  id="' + item.installment_no + 'txtfee' + item.fee_id + '" value="0" class="form-control input-xsmall installmentbodysum">' + '</td>';
                } else {
                    var remainingValue = $("#" + item.fee_id + "txtRmainingAmount").val();
                    var Installmentvalue = (parseFloat(remainingValue) * parseFloat(item.percantage)) / 100;
                    html += '<td>' + '<input type="text"  id="' + item.installment_no + 'txtfee' + item.fee_id + '" value="' + Installmentvalue + '" class="form-control input-xsmall installmentbodysum">' + '</td>';
                }
            });
            html += '</tr>';
            $("#tbl_FeesInstallment tbody").append(html);
        },
        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });


}
// this is  to add new  fees installment body
function addnewinstallmentbodyrow() {
    var id = $('#class_id').val();
    $.ajax({
        url: "/Registration/getInstallmentHead/" + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';
            var rowCount = $('#tbl_FeesInstallment tr').length - 2;
          
            html += '<tr>';
            html += '<td width="8%">' + '<input type="date"  id="' + rowCount + 'txtdate' + '" class="form-control input-small">' + '</td>';
          
            $.each(result, function (key, item) {

                html += '<td >' + '<input type="text"  id="' + rowCount + 'txtfee' + item.feeid + '" value="0" class="form-control input-xsmall">' + '</td>';
            });
            html += '<tr>';
            $("#tbl_FeesInstallment tbody").append(html);
         
        },
        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });

    return false;


}
////Function for getting the Data Based upon Class ID
function getDiscount() {
    $.ajax({

        url: "/Registration/getDiscount/" ,

        typr: "GET",

        contentType: "application/json;charset=UTF-8",

        dataType: "json",

        success: function (result) {
     
            var html = '';
            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + item.name + '</td>';
                html += '<td>' + item.discount_percantage + '</td>';
                html += '<td>' + item.remark + '</td>';
                html += '<td>' + '<input value=' + item.discount_percantage + ' +  type="checkbox" class="mt-checkbox mt-checkbox-outline">' + '</td>';
                //html += '<td>' + '<a class="btn default green-stripe btn-xs" id="btnAddd" value="Default" onclick="ClaclDiscount(' + item.discount_percantage + ');">' + '<i class="fa fa-minus"></i>' + '</a>' + '</td>';
                html += '</tr>';
            });
            $("#tbl_Discount tbody").empty();
            //append htnl 
            $("#tbl_Discount tbody").append(html);
        },

        error: function (errormessage) {

            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });

        }

    });

    return false;

}
$('#tbl_Discount').on('click', 'input[type="checkbox"]', function () {
    if (this.checked == true) {
        var Percen = $(this).val();
        var DiscountValue = (parseFloat($('#LblSTotal').text()) * Percen) / 100; 
        $('#LblGrandTotal').text( parseFloat($('#LblGrandTotal').text()) - DiscountValue );
        $('#LblDiscount').text(parseFloat($('#LblDiscount').text()) + parseFloat(Percen));
      
    } else {
        var Percen = $(this).val();
        var DiscountValue = (parseFloat($('#LblSTotal').text()) * Percen) / 100;
        $('#LblGrandTotal').text(parseFloat($('#LblGrandTotal').text()) + DiscountValue);
        $('#LblDiscount').text(parseFloat($('#LblDiscount').text()) - Percen);
    }

});
$('#ChkboxContainer').on('click', 'input[type="checkbox"]', function () {
    var res = this.value.split(",");
    if (this.checked == true) {
        varTxtDiscountvalue = $("#" + res[1] + "txtDiscountAmount").val();
        $("#" + res[1] + "txtDiscountAmount").val(parseFloat(varTxtDiscountvalue) + parseFloat(res[0]));
    
        //alert("value=" + res[0] + "feeid=" +res[1] + "id=" +res[2] );
    } else {
        varTxtDiscountvalue = $("#" + res[1] + "txtDiscountAmount").val();
        $("#" + res[1] + "txtDiscountAmount").val(parseFloat(varTxtDiscountvalue) - parseFloat(res[0]));
    }
    $("#" + res[1] + "txtRmainingAmount").val(parseFloat($("#" + res[1] + "txtSubTotal").val()) - (parseFloat($("#" + res[1] + "txtSubTotal").val()) * parseFloat( $("#" + res[1] + "txtDiscountAmount").val())) / 100);
    $("#tbl_FeesInstallment tbody").empty();
    GetInstallmentDate();
});
$('#tbl_Feesinfo').on('click', 'input[type="checkbox"]', function () {
    if (this.checked == true) {
        var Amount = $(this).val();
        $('#LblGrandTotal').text(parseFloat($('#LblGrandTotal').text()) + parseFloat(Amount));
        $('#LblSTotal').text(parseFloat($('#LblSTotal').text()) + parseFloat(Amount));
    } else {
        var Amount = $(this).val();
        $('#LblGrandTotal').text(parseFloat($('#LblGrandTotal').text()) - parseFloat(Amount));
        $('#LblSTotal').text(parseFloat($('#LblSTotal').text()) - parseFloat(Amount));
    }
});
function DDLOnChenge(DDl_name, ToDDLName, Controller, FunctionName) {
    var name = "#" + DDl_name;
    var id = $(name).val();
    var url = '/' + Controller + '/' + FunctionName + '/' + id;
    $.ajax({
        url: url,
        type: "Get",
        success: function (data) {
            $("#" + ToDDLName + " option").remove();
            var defaultOpt = "<option selected='selected' value='-1'>--Please Select--</option>";
            $("#" + ToDDLName).append(defaultOpt);
            for (var i = 0; i < data.length; i++) {
                var opt = new Option(data[i].Text, data[i].Value);
                $("#" + ToDDLName).append(opt);
            }
           // getFeesType(id);
        }
    });
}
function checkifactive(feeid , controlno , Percantage , year_id) {
    if (Percantage !== '') {
        var chboxId = 'ch' + controlno;
        var duedate = $('#' + 'txtdate' + controlno).val();
        var installmentNo = controlno;
        if ($('#' + chboxId).is(":checked")) {
            var newrow = {
                installment_no: installmentNo,
                fee_id: feeid,
                due_date: duedate,
                percantage: Percantage, 
                year_id: year_id
            }
            instalments.push(newrow);
            //console.log(instalments);
        }
        else {
            swal(
                'wrong!!',
                'Please Activate the Instalment then fill the fildes',
                'error');
        }
    }
 



    
}
//Add Data Function   
function Create() {
    if (instalments.length === 0) {
        swal({
            title: "Humml :( !!",
            text: "there's a null data Make sure you made any changes",
            icon: "warning",
            button: "Try agen!"
        });
    } else {
        $.ajax({

            url: "/InstallmentSetup/Create",

            data: JSON.stringify(instalments),

            type: "POST",

            contentType: "application/json;charset=utf-8",

            dataType: "json",

            success: function (result) {
                swal({
                    title: "Well Done!",
                    text: "Record has been saved successfully",
                    type: "success"
                });
                instalments = [];
            },

            error: function (errormessage) {
                swal({
                    title: "There is something wrong!!",
                    text: "Make sure the operation is correct",
                    icon: "warning",
                    button: "Try agen!"
                });
            }

        });
    }
 

}
// add students function 
function addStudent() {
    var student = {
        name: $('#LblStudentFullName').text(),
        date_of_birth: $('#LblDateofBirth').text(),
        gender: $('#LblGender').text(),
        student_code :$('#LlbStudentCode').text() ,
        remarks :$('#Lblremark').text() ,
        guardian_name: $('#lblGuardianName').text(),
        primary_phone: $('#LblPrimeryPhoneNo').text(),
        secondary_phone: $('#LblSecondaryphone').text(),
        address: $('#LblGuardAddress').text(),
            relationship: $('#LblRelationShip').text(),
            occupation: $('#LblOccupation').text(),
            blood_type: $('#LblbBloodGroup').text(),
            insanity: $('#LblHaveInsanity').text(),
        insanity_description: $('#LblInanityDescription').text()
    };
    var registration = {
        reg_id: $('#LlbStudentCode').text(),
        class_id : $('#DDlClass').val() ,
        classrom_id: $('#DDlClassRoom').val()
    };
    $.ajax({

        url: "/Registration/AddStudent/",

        data: JSON.stringify({ student, members, health_histories ,registration }),

        type: "POST",

        contentType: "application/json;charset=utf-8",

        dataType: "json",

        success: function (result) {

         //   clearTextBox();
            swal({
                title: "Well Done!",
                text: "Student has been saved successfully" ,
                type: "success"
            });
        },
        error: function (errormessage) {
            alert(errormessage.responseText);
        }
    });

}
function loadStudentData(Controller, tblname) {
    $.ajax({
        url: '/' + Controller + '/List',
        //url: "/Areas/List",
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function (result) {
            var html = '';
            $.each(result, function (key, item) {
                html += '<tr>';
                for (i in item) {
                    //html += '<td>' + 'dfsdfsdf' + '</td>';
                    html += '<td>' + item[i] + '</td>';
                }
                html += '<td>' +
                    '<div class="btn-group btn-sm">'
                    + '<button class="btn btn-xs  btn-primary dropdown-toggle" type="button" data-toggle="dropdown" data-delay="1000" data-close-others="true" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>'
                    + '<ul class="dropdown-menu" role="menu">'
                    + '<li>'
                    + '<a href="/StudentProfile/index/?Stdid=' + item.code + '">'
                    + '<i class="fa fa-folder-o"></i>'
                    + ' Porfile'
                    + '</a>'
                    + '</li>'
                    + '<li>'
                    + '<a href="/Fees/index/?Stdid=' + item.code + '">'
                    + '<i class="fa fa-money"></i>'
                    + ' Fees'
                    + '</a>'
                    + ' </li>'
                    //+ '<li>'
                    //+ '<a onclick="Delete(' + ControllerID + ' ,' + item.id
                    //+ '  , ' + TblID + ')">'
                    //+ '<i class="fa fa-user "></i>'
                    //+ ' Behavior'
                    //+ '</a>'
                    //+ ' </li>'
                    + '<li>'
                    + '<a>'
                    + '<i class="fa fa-ban "></i>'
                    + 'Deactivate'
                    + '</a>'
                    + ' </li>'
                    + ' </ul>'
                    + ' </div>'
                    + '</td>';

      
                html += '</tr>';

            });

            //$('.tbody').html(html);
            if ($.fn.DataTable.isDataTable("#" + tblname)) {
                $("#" + tblname).DataTable().destroy();
            }

            $("#" + tblname + " tbody").empty();
            //append htnl 
            $("#" + tblname + " tbody").append(html);

            $("#" + tblname).DataTable({
                responsive: true
            });
        },
        error: function (errormessage) {
            error_msg();
        }
    });
}
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
////Get Student Details to fees
function getStudentById(id) {
    $.ajax({
        url: '/Fees/GetbyID/'  + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            $('#txtstudent_code').val(result.stdcode);
            $('#student_name').val(result.name);
            StudentID.value = result.id;
            $('#acadmic_year').val(result.academic_year);
            $('#Institutes').val(result.institute);
            $("#class_id").val(result.clas).trigger('change');
            $("#classrom_id").val(result.classroom).trigger('change');
            getInstallmentHead(result.clas);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}

function OnTransportation(type) {
    if (type === "Private" || type === "None") {
        $('#DDLSector').prop("disabled", true);
    } else if (type === "One way" || type === "Full") {
        $('#DDLSector').prop("disabled", false);
    }
}
function OnSectorChange(id) {
   
    $.ajax({
        url: "/Fees/GetSector/"+  id,
        type: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var direction = $("#" + result.feeid + "DDLtransportation").val();
            if (direction == "One way") {
                $("#" + result.feeid + "txtSubTotal").val(result.oneway_amount);
                $("#" + result.feeid + "txtRmainingAmount").val(result.oneway_amount);
                } else {
                $("#" + result.feeid + "txtSubTotal").val(result.towway_amonut);
                $("#" + result.feeid + "txtRmainingAmount").val(result.towway_amonut);
                }
            GetCars(id);
        },

        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });
}
function GetCars(id) {

    $.ajax({
        url: "/Fees/GetCars/" + id,
        type: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var defaultOpt = "<option selected='selected' value='-1'>--Please Select--</option>";
            $('#DDLCar').append(defaultOpt);
            for (var i = 0; i < result.length; i++) {
                var opt = new Option(result[i].Text, result[i].Value);
                $('#DDLCar').append(opt);
                $('#DDLCar').prop("disabled", false);
            }
        },

        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });
}
// this to bind Fees Types in Fees reg 
function BindFeesBody() {
    $.ajax({
        url: "/Fees/BindFeesTypes/",
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",

        success: function (result) {
            var html = '';

            $.each(result, function(key, item) {
                html += '<tr>';
                html += '<td>' + item.name + '</td>';
         
                if (item.is_transportation==true) {
                    var ddltransportation = '<select id="' + item.fee_id + "DDLtransportation" + '" class="form-control select2 ddltranportation " onchange="OnTransportation(this.value);">' +
                        '<option value="None">None</option><option value="One way">One way</option><option value="Full">Full</option><option value="Private">Private</option></select>';
                    $("#divDDLtransportation").append(ddltransportation);
                    // 
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" +  id="' +
                        item.fee_id +
                        'txtSubTotal' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<select onchange="OnDDLDiscountChange(\'' + item.fee_id + '\');"  id="' + item.fee_id + 'DDLDiscount' + '"   class="form-control select2 input-small"></select>' + '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" +  id="' +
                        item.fee_id +
                        'txtDiscountAmount' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" +  id="' +
                        item.fee_id +
                        'txtPayedAmount' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" id="' +
                        item.fee_id +
                        'txtRmainingAmount' +
                        '" class="form-control input-xsmall subtot">' +
                        '</td>';
                } else {
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="' +
                        item.amount +
                        '" +  id="' +
                        item.fee_id +
                        'txtSubTotal' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<select onchange="OnDDLDiscountChange(\'' + item.fee_id + '\');"  id="' + item.fee_id + 'DDLDiscount' + '"   class="form-control select2 input-small"></select>' + '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" +  id="' +
                        item.fee_id +
                        'txtDiscountAmount' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="0" +  id="' +
                        item.fee_id +
                        'txtPayedAmount' +
                        '" class="form-control input-xsmall">' +
                        '</td>';
                    html += '<td align="center">' +
                        '<input type="text" disabled="disabled" value="' +
                        item.amount +
                        '" +  id="' +
                        item.fee_id +
                        'txtRmainingAmount' +
                        '" class="form-control input-xsmall subtot">' +
                        '</td>';
                }
                html += '</tr>';
            });
            $.each(result, function(key, item) {
                DDLBinder(item.fee_id + 'DDLDiscount');

            });
        
            $("#tbl_Feestype tbody").append(html);
        },

        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });
}
function BindFeesDiscounts(feeid) {
    $.ajax({
        url: "/Fees/BindDDLDiscounts/",
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",

        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html +=
                    '<div class="col-md-6"><div class="form-group"><label><input value=' + item.Value + ',' + feeid + ',' + item.id +
                    ' type="checkbox" id="' + feeid + 'Chk' + item.id + '"   class="mt-checkbox mt-checkbox-outline"/> ' +
                    item.Text +
                    ' </label></div></div>';
                 
            });
            $("#ChkboxContainer").empty();
            $("#ChkboxContainer").append(html);
        },

        error: function (errormessage) {
            swal({
                title: "There is something wrong!!",
                text: "Make sure the operation is correct",
                icon: "warning",
                button: "Try agen!"
            });
        }
    });
}
function DDLBinder(DDl_name) {
    var url = '/Fees/BindDDLDiscounts/';
    $.ajax({
        url: url,
        type: "Get",
        success: function (data) {
            var defaultOpt = "<option selected='selected' value='-1'>None</option>";
            var defaultMultiOpt = "<option  value='-2'>multi Discounts</option>";
            $("#" + DDl_name).append(defaultOpt);
            $("#" + DDl_name).append(defaultMultiOpt);
            for (var i = 0; i < data.length; i++) {
                var opt = new Option(data[i].Text, data[i].Value);
                $("#" + DDl_name).append(opt);
              //  console.log(DiscountOptions);
            }
        }
    });
}
function OnDDLDiscountChange(DDLName) {
    var DDLvalue = $("#" + DDLName + "DDLDiscount").val();
    if (DDLvalue == -2) {
        var subtotal = $("#" + DDLName + "txtSubTotal").val();
        $("#" + DDLName + "txtRmainingAmount").val(subtotal);
        $("#" + DDLName + "txtDiscountAmount").val(0);
        BindFeesDiscounts(DDLName);
        $('#static').modal('show');
    } else if (DDLvalue == -1) {
        var subtotal = $("#" + DDLName + "txtSubTotal").val();
        $("#" + DDLName + "txtRmainingAmount").val(subtotal);
        $("#" + DDLName + "txtDiscountAmount").val(0);
    } else {
        $("#" + DDLName + "txtDiscountAmount").val(parseFloat(DDLvalue));
        $("#" + DDLName + "txtRmainingAmount").val(parseFloat($("#" + DDLName + "txtSubTotal").val()) - (parseFloat($("#" + DDLName + "txtSubTotal").val()) * parseFloat(DDLvalue)) / 100);
    }
    $("#tbl_FeesInstallment tbody").empty();
    GetInstallmentDate();


}
function Domath(value , feeid, id) {
    var ckbox = $("#" + feeid + "Chk" + id);
    var val = ckbox.id;
    alert(ckbox.val());
      if (ckbox.is(':checked')) {
        alert('You have Checked it');
    } 
}
// this to submit registration 
// add students function 
function PostFeedata() {

    var grandTotal = 0;
    var reg_fees = [];
    var installment = [];

    //iterate through each input and add to sum
    $('.subtot').each(function() {
        grandTotal += parseInt($(this).val());
        var res = $(this).attr("id").split("txt");
        if ($(this).val() != 0) {
            var newreg_fee = {
                fee_id: res[0],
                amount: $(this).val()
            }
            reg_fees.push(newreg_fee);
        }
    });
    var total = 0;
    $('.installmentbody > tr ').each(function(i) {

        $('td', this).each(function(i) {
            var value = parseFloat($(this).find('.installmentbodysum').val());
            if (!isNaN(value)) {
                total += value;
            }
        });
        var newimstall = {
            reg_id: $('#txtstudent_code').val(),
            amount: total,
            date: $(this).find('.installmendate').val(),
            status: "Pending"
        }
        installment.push(newimstall);
        total = 0;
    });
    var registration = {
        reg_id: $('#txtstudent_code').val(),
        class_id: $('#class_id').val(),
        amount: grandTotal.toFixed(2),
        remark: $('#remark').val()
    };
    var transport_details = {
        car_id: $('#DDLCar').val(),
        transportation: $('.ddltranportation').val(),
        status : "Active"
    };
    $.ajax({
        url: "/Fees/PostFeeData/",
        data: JSON.stringify({ registration, reg_fees, installment, transport_details }),
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function (result) {
            $("#sub").show();

            swal({
                title: "Well Done!",
                text: "Student has been saved successfully",
                type: "success"
            });
        },
        error: function (errormessage) {
            alert(errormessage.responseText);
        }
    });

}
// start Student Profile 

function GetBasicInfo(id) {

    $.ajax({
        url: '/StudentProfile/GetBasicInfo/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            $('#PLblStudentName').text(result.StudentName);
            $('#LblClass').text(result.stdcode);
            //StudentID.value = result.id;
            $('#pLblGender').text(result.Gender);
            $('#pLblAge').text(result.age);
            $("#plblbloodtype").text(result.blood_type);
            $("#plbglName").text(result.guardianname);
            $("#plbpPhone").text(result.primaryphone);
            $("#plbgSPhone").text(result.secondaryphone);
            $("#plbgaddress").text(result.address);
            $("#plbgrelationship").text(result.relationship);
            $("#plbgoccupation").text(result.occupation);
            if (result.insanity == true) {
                $("#plblinsanity").text("Yes");
            } else {
                $("#plblinsanity").text("No");
            }
            $("#plblinsanitydescrition").text(result.insanity_description);
            //$("#classrom_id").val(result.classroom).trigger('change');
            //getInstallmentHead(result.clas);
            GetHealthhistory(result.id);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}

function GetHealthhistory(id) {

    $.ajax({
        url: '/StudentProfile/GetHealthhistory/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + '<span class="label label-sm label-danger"> '+item.date+' </span>' + '</td>';
                html += '<td>' + item.description + '</td>';
                html += '</tr>';

            });
            $("#Tbl_Chronicinfo tbody").empty();
            $("#Tbl_Chronicinfo tbody").append(html);
            GetFamilyMembers(id);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
function GetFamilyMembers(id) {

    $.ajax({
        url: '/StudentProfile/GetFamilyMembers/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + item.name + '</td>'; 
                html += '<td>' + '<span class="label label-sm label-info"> ' + item.date_of_birth + ' </span>' + '</td>';
                html += '<td>' + item.educational_degree + '</td>';
                html += '<td>' + item.remark + '</td>';
                html += '</tr>';

            });
            $("#Tbl_family_members tbody").empty();
            $("#Tbl_family_members tbody").append(html);
            GetFess(id);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
function GetFess(id) {

    $.ajax({
        url: '/StudentProfile/GetFess/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + item.name + '</td>';
                html += '<td>' + item.amount + '</td>';
                html += '</tr>';
                $("#lblbGrandTotal").text(item.GrandTotal);
                $("#lblDueAmount").text(item.DueAmount);
                $("#lblremark").text(item.About);
                $("#lblpclass").text(item.stdClass);
                $("#lblpclassRoom").text(item.StdClassroom);
                $("#lblpNoofMaterials").text(item.NoOfMaterials);
            });
        
          
            $("#Tbl_Fees tbody").empty();
            $("#Tbl_Fees tbody").append(html);
            GetInstallments(id);
            GetInstallmentsForPrint(id)
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
function GetInstallments(id) {
    $.ajax({
        url: '/StudentProfile/GetInstallments/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + item.amount + '</td>';
                html += '<td>' + item.duedate + '</td>';
                html += item.payment_date === "01/01/0001" ? '<td>' + '-' + '</td>' : '<td>' + item.payment_date + '</td>';
                html += item.receipt_no ===null ? '<td>' + '-' + '</td>' : '<td>' + item.receipt_no + '</td>';
               
                html += item.status === "Pending" ? '<td>'+
                    ' <span class="label label-sm label-danger">' + item.status + ' </span>' +
                    '</td>' : '<td>' +
                    ' <span class="label label-sm label-success">' + item.status + ' </span>' +
                    '</td>';
                html += '</tr>';
            });

            $("#Tbl_PInstallments tbody").empty();
            $("#Tbl_PInstallments tbody").append(html);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
// Dashboard Start from here 
function GetNoOfStudents() {

    $.ajax({
        url: '/Home/GetNoOfStudents/',
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var htm = "";
            var htmgrand = "";
            var htmlDue = "";
            htm += '<span data-counter="counterup" data-value="' + parseInt(result.NoofStudents) + '" >' + parseInt(result.NoofStudents) + '</span>';
            htmgrand += '<span data-counter="counterup" data-value="' + result.GrandTotal + '" >' + result.GrandTotal + '</span>';
            htmlDue += '<span data-counter="counterup" data-value="' + result.TotalDueAmounts + '" >' + result.TotalDueAmounts + '</span>';
            $('#LblNoofstudents').append(htm);
            $('#LblGrandTotal').append(htmgrand);
            $('#LblTotalDueAmounts').append(htmlDue);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
function GetInstallmentsForPrint(id) {
    $.ajax({
        url: '/StudentProfile/GetInstallments/' + id,
        typr: "GET",
        contentType: "application/json;charset=UTF-8",
        dataType: "json",
        success: function (result) {
            var html = '';

            $.each(result, function (key, item) {
                html += '<tr>';
                html += '<td>' + (key+1) + 'th</td>';
                html += '<td>' + item.amount + '</td>';
                html += '<td>' + item.duedate + '</td>';
                //   html += item.payment_date === "01/01/0001" ? '<td>' + '-' + '</td>' : '<td>' + item.payment_date + '</td>';
                //   html += item.receipt_no === null ? '<td>' + '-' + '</td>' : '<td>' + item.receipt_no + '</td>';

                //html += item.status === "Pending" ? '<td>' +
                //    ' <span class="label label-sm label-danger">' + item.status + ' </span>' +
                //    '</td>' : '<td>' +
                //    ' <span class="label label-sm label-success">' + item.status + ' </span>' +
                //    '</td>';
                html += '</tr>';
            });

            $("#Tbl_PInstallment tbody").empty();
            $("#Tbl_PInstallment tbody").append(html);
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
