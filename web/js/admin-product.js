
var imgScr = "{{asset('img/src')}}";

function escapeTags( str ) {
    return String( str )
        .replace( /&/g, '&amp;' )
        .replace( /"/g, '&quot;' )
        .replace( /'/g, '&#39;' )
        .replace( /</g, '&lt;' )
        .replace( />/g, '&gt;' );
}

function retriveImg (imgLink, type, obj) {
    var arr = [];
    $.ajax({
        url: Routing.generate('get_image'),
        method: "POST",
        data: {
            imgLink: imgLink,
            type: type
        },
        dataType: "json"
    })
    .done(function (rep) {
        var innerHtml = "";
        $.each(rep, function(index, value) {
          innerHtml +="<u class='pull-left' style='padding-right:10px;'><a target='_blank' href='"+ imgScr + "\/" + imgLink + "\/" + type + "\/" + value +"'>"+ value +"</a> <i class='fa fa-remove' class='remove'></i></u>";
          arr.push(value);
        });
        obj.html(innerHtml);
        if(type == 'poster') {
          $('#appbundle_product_poster').val(arr[0]);
        }
    })
}

function deleteImg (imgLink, type, obj) {
    var arr = [];
    $.ajax({
        url: Routing.generate('delete_image'),
        method: "POST",
        data: {
            imgLink: imgLink,
            type: type,
            fileName: obj.prev().text()
        },
        dataType: "json"
    })
    .done(function (rep) {
      if(rep.success) {
        obj.parent().remove();
      }
    })
}

window.onload = function() {


    var btn1 = $('#uploadBtn1');
    var btn2 = $('#uploadBtn2');
    var imgLink = $('#appbundle_product_imageLink').val();
    retriveImg (imgLink, 'poster', $('#info1'));
    retriveImg (imgLink, 'imgDes', $('#info2'));
      //progressBar = $('#progressBar'),
      //msgBox = $('#msgBox');
    var uploader1 = new ss.SimpleUpload({
      button: btn1,
      url: Routing.generate('img_upload'), // server side handler
      responseType: 'json',
      name: 'uploadfile',
      multiple: true,
      allowedExtensions: ['png','jpg'], // for example, if we were uploading pics
      hoverClass: 'ui-state-hover',
      focusClass: 'ui-state-focus',
      disabledClass: 'ui-state-disabled',
      data: {
            imgLink: imgLink,
            type: 'poster'
        },
      onSubmit: function(filename, extension) {
          // Create the elements of our progress bar
          var progress = document.createElement('div'), // container for progress bar
              bar = document.createElement('div'), // actual progress bar
              fileSize = document.createElement('div'), // container for upload file size
              wrapper = document.createElement('div'), // container for this progress bar
              progressBox = document.getElementById('progressBox1'); // on page container for progress bars

          // Assign each element its corresponding class
          progress.className = 'progress';
          bar.className = 'progress-bar';            
          fileSize.className = 'size';
          wrapper.className = 'wrapper';

          // Assemble the progress bar and add it to the page
          progress.appendChild(bar); 
          wrapper.innerHTML = '<div class="name">'+filename+'</div>'; // filename is passed to onSubmit()
          wrapper.appendChild(fileSize);
          wrapper.appendChild(progress);                                       
          progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars    

          // Assign roles to the elements of the progress bar
          this.setProgressBar(bar); // will serve as the actual progress bar
          this.setFileSizeBox(fileSize); // display file size beside progress bar
          this.setProgressContainer(wrapper); // designate the containing div to be removed 
        },

       // Do something after finishing the upload
       // Note that the progress bar will be automatically removed upon completion because everything 
       // is encased in the "wrapper", which was designated to be removed with setProgressContainer() 
      onExtError: function( filename, extension ) {
            alert('只接受jpg,png上传');
        },
      onComplete:   function(filename, response) {
          if ( response.success === true ) {

          }
          else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    alert(response.msg);

                } else {
                    alert('An error occurred and the upload failed.');
                }
            }
          retriveImg ($('#appbundle_product_imageLink').val(), 'poster', $('#info1'));
        },
    });
    
    var uploader2 = new ss.SimpleUpload({
      button: btn2,
      url: Routing.generate('img_upload'), // server side handler
      responseType: 'json',
      name: 'uploadfile',
      multiple: true,
      allowedExtensions: ['png','jpg'], // for example, if we were uploading pics
      hoverClass: 'ui-state-hover',
      focusClass: 'ui-state-focus',
      disabledClass: 'ui-state-disabled',
      data: {
            imgLink: $('#appbundle_product_imageLink').val(),
            type: 'imgDes'
        },
      onSubmit: function(filename, extension) {
          // Create the elements of our progress bar
          var progress = document.createElement('div'), // container for progress bar
              bar = document.createElement('div'), // actual progress bar
              fileSize = document.createElement('div'), // container for upload file size
              wrapper = document.createElement('div'), // container for this progress bar
              progressBox = document.getElementById('progressBox2'); // on page container for progress bars

          // Assign each element its corresponding class
          progress.className = 'progress';
          bar.className = 'progress-bar';            
          fileSize.className = 'size';
          wrapper.className = 'wrapper';

          // Assemble the progress bar and add it to the page
          progress.appendChild(bar); 
          wrapper.innerHTML = '<div class="name">'+filename+'</div>'; // filename is passed to onSubmit()
          wrapper.appendChild(fileSize);
          wrapper.appendChild(progress);                                       
          progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars    

          // Assign roles to the elements of the progress bar
          this.setProgressBar(bar); // will serve as the actual progress bar
          this.setFileSizeBox(fileSize); // display file size beside progress bar
          this.setProgressContainer(wrapper); // designate the containing div to be removed 
        },

       // Do something after finishing the upload
       // Note that the progress bar will be automatically removed upon completion because everything 
       // is encased in the "wrapper", which was designated to be removed with setProgressContainer() 
      onExtError: function( filename, extension ) {
            alert('只接受jpg,png上传');
        },
      onComplete:   function(filename, response) {
          if ( response.success === true ) {
            //$('#info2').append('<p>'+filename+'</p>');
          }
          else {
                if ( response.msg )  {
                    //msgBox.innerHTML = escapeTags( response.msg );
                    alert(response.msg);

                } else {
                    alert('An error occurred and the upload failed.');
                }
            }
          retriveImg (imgLink, 'imgDes', $('#info2'));// Stuff to do after finishing an upload...
        },
    });

  //delete img
  $('.info').on('click', 'i', function() {
    var infoId = $(this).parent().parent().attr('id');
    var type = infoId == 'info1'? 'poster' : 'imgDes';
    var imgLink = $('#appbundle_product_imageLink').val();
    deleteImg (imgLink, type, $(this));
  });

}
