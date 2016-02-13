var imgScr = "{{asset('img/personalID')}}";

function escapeTags( str ) {
    return String( str )
        .replace( /&/g, '&amp;' )
        .replace( /"/g, '&quot;' )
        .replace( /'/g, '&#39;' )
        .replace( /</g, '&lt;' )
        .replace( />/g, '&gt;' );
}

// function retriveImg (imgLink, type, obj) {
//     var arr = [];
//     $.ajax({
//         url: Routing.generate('get_image'),
//         method: "POST",
//         data: {
//             imgLink: imgLink,
//             type: type
//         },
//         dataType: "json"
//     })
//     .done(function (rep) {
//         var innerHtml = "";
//         $.each(rep, function(index, value) {
//           innerHtml +="<u class='pull-left' style='padding-right:10px;'><a target='_blank' href='"+ imgScr + "\/" + imgLink + "\/" + type + "\/" + value +"'>"+ value +"</a> <i class='fa fa-remove' class='remove'></i></u>";
//           arr.push(value);
//           console.log(arr[index]);
//         });
//         obj.html(innerHtml);
//         if(type == 'personal-id') {
//           $('#shipment_address_id_scans').val(arr[0]);
//         }
//     })
// }

// function deleteImg (imgLink, type, obj) {
//     var arr = [];
//     $.ajax({
//         url: Routing.generate('delete_image'),
//         method: "POST",
//         data: {
//             imgLink: imgLink,
//             type: type,
//             fileName: obj.prev().text()
//         },
//         dataType: "json"
//     })
//     .done(function (rep) {
//       if(rep.success) {
//         obj.parent().remove();
//       }
//     })
// }

$('#iduploadBtn').click(function() {


    var imgLink1 = $("#personal-front .cropme img").attr("src"); //id of link in form range
    var imgLink2 = $("#personal-back .cropme img").attr("src"); //id of link in form range
    if(imgLink1 && imgLink2 != null) {
 //   retriveImg (imgLink, 'poster', $('#info1'));
 //   retriveImg (imgLink, 'imgDes', $('#info2'));
      console.log(imgLink1 + "                   " + imgLink2);
      $.ajax({
        url: Routing.generate('img_upload'),
        method: "POST",
        data: {
            imgLink1: imgLink1,
            imgLink2: imgLink2,
            type: 'personal-id'
        },
        dataType: "json"
    })
    .done(function (rep) {
      if(rep.success) {
        alert("onComplete");
      }
    });

  } else alert ("need to upload image first");
  
    });
    

  //delete img
  // $('.info').on('click', 'i', function() {
  //   var infoId = $(this).parent().parent().attr('id');
  //   var type = infoId == 'info1'? 'poster' : 'imgDes';
  //   var imgLink = $('#appbundle_product_imageLink').val();
  //   deleteImg (imgLink, type, $(this));
  // });


