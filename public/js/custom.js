
var RecordID = 0;
var ControllerID = "";
var FormID = "";
var TblID = "";
var invoiceDetails = [];
//==================== Navigation ====================
//<li><a href="#" onclick="goto('/Students/Index')"><i class="fa fa-circle-o"></i>قبول الطلاب </a></li>
//     <section id="Mydiv" class="content">
function goto(url) {
    $("#Mydiv").load(url);
}
//<a href="javascript:void(0)" onclick="goto_edit(Controller, id)">
function goto_edit(Controller, id) {
    var url = '/' + Controller + '/edit/' + id;
    $("#Mydiv").load(url);
}
function goto_delete(Controller, id) {
    var url = '/' + Controller + '/delete/' + id;
    $("#Mydiv").load(url);
}
//----------------------------------------------------------------------
//================= Actions ===================================
function Create(Controller, Form_id, multi_selected, tbl_Name) {
    var url = '/' + Controller + '/Create';
    if (multi_selected != 0) {
        post_ajax_multi_selected(url, Form_id, multi_selected, tbl_Name, Controller);
    }
    else {
        post_ajax(url, Form_id, tbl_Name, Controller);
    }

}
function Edit(Controller, Form_id, multi_selected, tbl_Name, RecordID) {
    var url = '/' + Controller + '/Edit/' + RecordID;
    if (multi_selected != 0) {
        post_ajax_multi_selected(url, Form_id, multi_selected, tbl_Name);
      //  post_ajax(url, Form_id, tbl_Name, Controller, 'Edit', RecordID);
    }
    else {
        post_ajax(url, Form_id, tbl_Name, Controller , 'Edit', RecordID);
    }
}
////function for deleting 's record  
function Delete(Controller, id, tbl_Name) {
    var url = '/' + Controller + '/Delete/' + id;
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!"
    }).then(function (result) {
            if (result) {
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: "application/json;charset=UTF-8",
                    dataType: "json",
                    success: function (result) {
                      //  alert(Controller, TblID);
                        GetAll(Controller, TblID);
                        swal({
                            title: "Well Done!",
                            text: "Record has been Deleted successfully",
                            type: "success"
                        });
                    },
                    error: function (errormessage) {
                        error_msg();
                    }
                });

            }
        },
        function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary Record is safe :)',
                    'error');
            }
        });
}
function GetAll(Controller, TblName , FormName ) {
   

    loadData(Controller, TblName, FormName);
}
function GetbyId(id, Controller, FormName) {

    var url = '/' + Controller + '/GetbyID/';
  
    getRecordById(id, url, FormName);
}
//------------------------------------------------------------
//================= Ajax Post ================================
function post_ajax_multi_selected(url, formid, Multi_selected_id, tbl_Name, controlerName) {
    var result = '';
    $.ajax({
        //data: JSON.stringify({ Email: $("#username").val(), password: $("#password").val(), Check: $('#remembermech').is(':checked') }),
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        //type: "POST",
        url: url,
        data: formtojson_MS(formid, Multi_selected_id),
        success: function (response) {
            if (response.status === 0) {
                error_msg();
            } else {
                alert(controlerName);
               // GetAll(controlerName, tbl_Name);
                save_msg();
                resetForm(formid);
            }
        },
        error: function (response) {
            result = 'error';
        }
    });

    //return result;
}
function post_ajax(url, formid, tbl_Name, Controller , Method , id) {
    var result = '';
    $.ajax({

        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: url,
        data: formtojson(formid , Method , id),
        success: function (response) {

            if (response.status === 0) {
                error_msg();
            } else {
                
                GetAll(Controller, tbl_Name );
                if (Method !== "Edit") {
                    save_msg();
                } else {
                    edit_msg();
                    $('#static').modal('hide');
                    $('#btnAdd').show();
                    $('#btnUpdate').hide();
                }
            
              resetForm(formid);
            }
        },
        error: function (response) {
            result = 'error';
        }
        //async: false
    });
    //return result;
}
function loadData( Controller , tblname) {
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
                        html += '<td>' + item[i] + '</td>';
                }
                html += '<td>' +
                    '<div class="btn-group btn-sm">' + '<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">' + 'Actions' + '<i class="fa fa-angle-down">' + '</i>' + '</button>' + '<ul class="dropdown-menu pull-left" role="menu">' + '<li>' + '<a onclick="GetbyId(' + item.id + ' , ' + ControllerID + ' , ' + FormID + ');">' + '<i class="fa fa-pencil-square-o"></i>' + ' Edit' + '</a>' +
                    '</li>' + '<li>' + '<a onclick="Delete(' + ControllerID + ' ,' + item.id + '  , ' + TblID + ')">' + '<i class="fa fa-times"></i>' + ' Delete' + '</a>' + ' </li>' + ' </ul>' + ' </div>' +
                    '</td>';
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
//Function for getting the Data Based upon Employee ID
function getRecordById(id, url, formid) {


    $.ajax({

        url: url + id,

        typr: "GET",

        contentType: "application/json;charset=UTF-8",

        dataType: "json",
        success: function (result) {
            process_response(formid, result);
            $('#btnUpdate').show();
           // $('#btnUpdate').att
            RecordID = result.id;
            
            $('#btnAdd').hide();
        },
        error: function (errormessage) {
            error_msg();
        }
    });
    return false;
}
//------------------------------------------------------------
//================= Form OPritions ===========================
function formtojson(formid , method, id) {
    var form = document.getElementById(formid);
    var obj = {};
    var elements = form.querySelectorAll("input, select, textarea, radio");
    for (var i = 0; i < elements.length; ++i) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        // todo REview the value of the radio button
        if (name) {
            obj[name] = value;
        }
        if (method === 'Edit') {
            obj['id'] = id;
        }
    }
   
    //alert(JSON.stringify(obj));
    return JSON.stringify(obj);
 

}
function formtojson_MS(formid, multi_selected_id) {

    var form = document.getElementById(formid);
    var obj = {};
    var elements = form.querySelectorAll("input, select, textarea");
    for (var i = 0; i < elements.length; ++i) {
        var element = elements[i];
        var name = element.name;
        var value = element.value;
        if (name) {
            obj[name] = value;
        }
    }
    var selectednumbers = [];
    $('#' + multi_selected_id + ' :selected').each(function (i, selected) {
        selectednumbers[i] = $(selected).val();
    });
    obj[multi_selected_id] = selectednumbers;

    //alert(JSON.stringify(obj));
    return JSON.stringify(obj);

}
function resetForm(formid) {
    $("#" + formid).trigger("reset");
    $('#btnAdd').show();
    $('#btnUpdate').hide();
};
// This to populate ajaxresponse to form dynamicly 
function process_response(frmormid, data) {
    var frm = document.getElementById(frmormid);
    var i;
    for (i in data) {
        if (i in frm.elements) {
            frm.elements[i].value = data[i];
            $(frm.elements[i]).val(data[i]).trigger('change');
        }
    }
    $('#static').modal('show');
}
// This to populate ajaxresponse to form dynamicly 
//------------------------------------------------------------
//================= Alert Msges  ===========================
function error_msg() {
    swal({
        title: "There is something wrong!!",
        text: "Make sure the operation is correct",
        icon: "warning",
        button: "Try agen!"
    });
}
function save_msg(msgbody) {
    swal({
        title: "Well Done!",
        text: msgbody,
        type: "success"
    });
}
function edit_msg(msgbody) {
    swal({
        title: "Well Done!",
        text: msgbody,
        type: "success"
    });
}
function delete_confirmation() {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!"
    }).then(function (result) {
        if (result) {
            return "true";
        }
    },
        function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary Record is safe :)',
                    'error');
            }
        });
}
//------------------------------------------------------------
//================= Binding DropDownlists ===========================
function DDLBind(DDl_name, Controller , FunctionName) {
    var url = '/' + Controller + '/' + FunctionName;
    $.ajax({
        url: url,
        type: "Get",
        success: function (data) {
            var defaultOpt = "<option selected='selected' value='-1'>--Please Select--</option>";
            $("#" + DDl_name).append(defaultOpt);
            for (var i = 0; i < data.length; i++) {
                var opt = new Option(data[i].Text, data[i].Value);
               $("#" + DDl_name).append(opt);
            }
        }
    });

}
function GenerateID(ControlName) {
    var Control = document.getElementById(ControlName);

    Control.value = 'Rpid-' + Math.floor((Math.random() * 10000000));


}
function Checkifexsist(code) {
    $.ajax({

        url: "/Registration/CheckifExsist/" + code,

        typr: "GET",

        contentType: "application/json;charset=UTF-8",

        dataType: "json",

        success: function (result) {
            if (result.NotExist === true) {
                return code;
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

    ///start rapid functions
function GetRecpient() {
    // Get the checkbox
    var checkBox = document.getElementById("isrecipient");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      $.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      var id =$('#customer_id').val();
      $.ajax({
           type:"GET",
           url:"/bills/showCustomer/" + id,
           success : function(result) {
             
              $('#recipient').val(result.name);
              $('#recipient_phone').val(result.phone);
              $('#Recipient_address').val(result.address);
              // disable fildes 
              $('#recipient').prop("disabled", true);
              $('#recipient_phone').prop("disabled", true);
              $('#Recipient_address').prop("disabled", true);
  
           }
      }); 
    } else {
      $('#recipient').val('');
              $('#recipient_phone').val('');
              $('#Recipient_address').val('');
              // disable fildes 
              $('#recipient').prop("disabled", false);
          $('#recipient_phone').prop("disabled", false);
              $('#Recipient_address').prop("disabled", false);
  
    }
  }
     
  /// Add invoice Details 
function AddNewItem(data) {
    var NewItem = {
        unit_id: data.unit_id,
        unit_name: data.units.name,
        item_id: data.id,
        item_name: $('#item_id').text(),
        unit_price:data.unit_price,
        total_price: parseFloat(data.unit_price) * parseFloat($('#qty').val()),
        remark:$('#remark').val(),
        qty:$('#qty').val(),
    };
    invoiceDetails.push(NewItem);
    var html = '';
    html += '<tr>';
    html += '<td>' + NewItem.item_name + '</td>';
    html += '<td>' + NewItem.unit_name + '</td>';
    html += '<td>' + NewItem.qty + '</td>';
    html += '<td>' + NewItem.unit_price + '</td>';
    html += '<td>' + NewItem.total_price + '</td>';
    html += '<td>' + NewItem.remark + '</td>';
    html += '<td>' + '<a class="btn btn-xs btn-danger" onclick="Delete('  + invoiceDetails.indexOf(NewItem) + ',' + "'tbl_invoiceDetails'" + ');">' + '<i class="fa fa-times"></i>' + ' Delete' + '</a>' +'</td>';
    html += '</tr>';
    // $("#tbl_invoiceDetails tbody").empty();
    $("#tbl_invoiceDetails tbody").append(html);
}
// To Delete from Html table
function Delete(item,Tbl_Name) {
  var  row = $(this).parent().index();
  document.getElementById(Tbl_Name).deleteRow(row);
  invoiceDetails.splice(item,1);
  save_msg("Item has been Removed successfully");
}
    //Get Item
    function getitem() {
          $.ajaxSetup({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
          var id =$('#item_id').val();
          $.ajax({
               type:"GET",
               url:"/bills/getitem/" + id,
               success : function(result) {
                AddNewItem(result);
               }
          }); 
      }
///