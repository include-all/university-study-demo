//textarea高度自适应
$(document).on("input propertychange", "textarea", function (e) {
    var target = e.target;
    //保存初始高度，之后需要重新设置一下初始高度，避免只能增高不能减低。           
        dh = $(target).attr('defaultHeight') || 0;
    if (!dh) {
        dh = target.clientHeight;
        $(target).attr('defaultHeight', dh);
    }
    

    //在高度减小时，先设置高度减少，然后clientHeight减少很多，然后scollhetght减少一点点，然后减少
    target.style.height = dh +'px';
    var clientHeight = target.clientHeight;
    var scrollHeight = target.scrollHeight;
    if (clientHeight !== scrollHeight) {
         target.style.height= scrollHeight + 10 + "px";
     }
});



// -------------------------------------------------------------------------
// 保存换行
function textareaTo(str){
    var reg=new RegExp("\n","g");
    
    str = str.replace(reg,"<br>");
    
    return str;
}



// ----------------------------------------------------------------------------



//ajax处理文章存储和显示
$(function() {  
    var content = $("#content");  
    $.getJSON("../../php/note_php/ajax.php", function(json) {  
        $.each(json, function(index, array) {  
            var txt = "<h3>" + array["article_title"] + "</h3><blockquote>" + array["article_content"] + "</blockquote>" ;  
            content.append(txt);  
        });  
    });  
   
});  


//添加文章
$("#add").click(function() {  
   var title = $("#article_title").val();  
   var txt = $("#article_content").val();  
   var content = $("#content");

   $.ajax({  
       type: "POST",  
       url: "../../php/note_php/content.php",  
       data: "title=" + textareaTo(title) + "&txt=" + textareaTo(txt),  
       success: function(msg) {  
           if (msg == 1) {  
               var str = "<h3>" + textareaTo(title) + "</h3>"+"<blockquote>" + textareaTo(txt) + "</blockquote>";  
               content.append(str);  
               $("#message").show().html("发表成功！").fadeOut(1000);  
               $("#article_title").val(""); 
               $("#article_content").val(""); 

               $("textarea").css("height", dh +'px');
           } else {  
               $("#message").show().html(msg).fadeOut(1000); 
           }  
        }  
    });  
});  


//编辑按钮
$("#edit").click(function(){
    $("#edit_content").toggleClass("delete_content");
});


//删除按钮
$("#delete").click(function(){
    var delete_title = $("#delete_title").val();
    $.ajax({  
       type: "POST",  
       url: "../../php/note_php/delete.php",  
       data: "delete_title=" + delete_title,  
       success: function(msg) {  
           if (msg == 1) {   
               $("#tips").show().html("删除成功！").fadeOut(1000);  
               $("#delete_title").val(""); 
               window.location.reload(); 
           } else {  
               $("#tips").show().html(msg).fadeOut(1000);
           }  
        }  
    });  
});