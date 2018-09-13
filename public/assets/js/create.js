var count=1;
   
   $(".add-row").click(function(){

    if($("#Medicament").val()!='')
    {
        var med = $("#Medicament").val();
        var dos = $("#Dose").val();
        var Dur = $("#Duration").val();
        var markup = " <tr id=\""+count+"\"><th><button class=\"btn sbold red \" type=\"button\"onclick=\"deleterow("+count+");\"> <i class=\"fa fa-minus\"></i> </a></th><th> <input class=\"form-control\" name=\"Medicament"+count+"\" type=\"text\" id=\"Medicament"+count+"\" value=\""+med+"\"></th><th><input class=\"form-control\" name=\"Dose"+count+"\" type=\"text\" id=\"Dose"+count+"\"  value=\""+dos+"\"></th><th> <input class=\"form-control\" name=\"Duration"+count+"\" type=\"text\" id=\"Duration"+count+"\"  value=\""+Dur+"\"></th></tr>";
         $("#table tbody").append(markup);
          $("#Medicament").val('');
         $("#Dose").val('');
         $("#Duration").val('');
         count++;

    }

        
    });
    
function deleterow(id)
{

    $('#'+id).remove();

}
var dcount=1;

   $(".add-row-d").click(function(){
    if($("#Diseasd").val()!='')
    {
        var dis = $("#Diseasd").val();
        var dur = $("#Durationd").val();
        var markup = " <tr id=\"d"+dcount+"\"><th><button class=\"btn sbold red \" type=\"button\"onclick=\"deleterowd("+dcount+");\"> <i class=\"fa fa-minus\"></i> </a></th><th> <input class=\"form-control\" name=\"Diseas"+dcount+"\" type=\"text\" id=\"Diseas"+dcount+"\" value=\""+dis+"\"></th><th> <input class=\"form-control\" name=\"Durationd"+dcount+"\" type=\"text\" id=\"Durationd"+dcount+"\"  value=\""+dur+"\"></th></tr>";
         $("#Diseases tbody").append(markup);
         dcount++;
          $("#Diseasd").val('');
         $("#Durationd").val('');
        }
    });

function deleterows(id)
{

    $('#s'+id).remove();

}

var scount=1;

   $(".add-row-s").click(function(){
    if($("#Surgery").val()!='')
    {
        var sur = $("#Surgery").val();
        var dat = $("#date").val();
        var markup = " <tr id=\"s"+scount+"\"><th><button class=\"btn sbold red \" type=\"button\"onclick=\"deleterows("+scount+");\"> <i class=\"fa fa-minus\"></i> </a></th><th> <input class=\"form-control\" name=\"Surgery"+scount+"\" type=\"text\" id=\"Surgery"+scount+"\" value=\""+sur+"\"></th><th> <input class=\"form-control\" name=\"date"+scount+"\" type=\"text\" id=\"date"+scount+"\"  value=\""+dat+"\"></th></tr>";
         $("#Surgeries tbody").append(markup);
         dcount++;
          $("#Surgery").val('');
         $("#date").val('');
        }
    });

function deleterowd(id)
{

    $('#d'+id).remove();

}
var ecount=1;

   $(".add-row-e").click(function(){
    if($("#name").val()!='')
    {
        var name = $("#name").val();
        var phonee = $("#xxx").val();
        var markup = " <tr id=\"e"+scount+"\"><th><button class=\"btn sbold red \" type=\"button\"onclick=\"deleterowe("+ecount+");\"> <i class=\"fa fa-minus\"></i> </a></th><th> <input class=\"form-control\" name=\"name"+ecount+"\" type=\"text\" id=\"name"+ecount+"\" value=\""+name+"\"></th><th> <input class=\"form-control\" name=\"phonee"+ecount+"\" type=\"text\" id=\"phonee"+ecount+"\"  value=\""+phonee+"\"></th></tr>";
         $("#emergency tbody").append(markup);
         ecount++;
          $("#name").val('');
         $("#xxx").val('');
        }
    });

function deleterowe(id)
{

    $('#e'+id).remove();

}

