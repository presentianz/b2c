/*jslint unparam: true, regexp: true */
/*global window, $ */
var isAlreadyAdded = false;
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === '/' ?
                '//' : '/upload_excels/index.php',
        uploadButton = $('<button id="submit_changes" />')
            .addClass('btn btn-primary')
            .text('处理中...')
            .on('click', function(){
                //Ajex call to update all changes to database.
                ajax_update_wb(json_obj);
            })
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                //$this
                //    .off('click')
                //    .text('终止更改')
                //    .on('click', function () {
                //        $this.remove();
                //        data.abort();
                //    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(xls|xlsx)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        if(!isAlreadyAdded){
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                if (!index) {
                    node
                        .append('<br>')
                        .append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });
            
        } else {
            location.reload();
        }
        isAlreadyAdded = true;
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('提交批量更改 ?')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

var X = XLSX;
var XW = {
    /* worker message */
    msg: 'xlsx',
    /* worker scripts */
    rABS: '/js/js-xlsx//xlsxworker2.js',
    norABS: '/js/js-xlsx//xlsxworker1.js',
    noxfer: '/js/js-xlsx//xlsxworker.js'
};

var rABS = typeof FileReader !== "undefined" && typeof FileReader.prototype !== "undefined" && typeof FileReader.prototype.readAsBinaryString !== "undefined";
if(!rABS) {
    document.getElementsByName("userabs")[0].disabled = true;
    document.getElementsByName("userabs")[0].checked = false;
}

var use_worker = typeof Worker !== 'undefined';
if(!use_worker) {
    document.getElementsByName("useworker")[0].disabled = true;
    document.getElementsByName("useworker")[0].checked = false;
}

var transferable = use_worker;
if(!transferable) {
    document.getElementsByName("xferable")[0].disabled = true;
    document.getElementsByName("xferable")[0].checked = false;
}

var wtf_mode = false;

function fixdata(data) {
    var o = "", l = 0, w = 10240;
    for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
    o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
    return o;
}

function ab2str(data) {
    var o = "", l = 0, w = 10240;
    for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint16Array(data.slice(l*w,l*w+w)));
    o+=String.fromCharCode.apply(null, new Uint16Array(data.slice(l*w)));
    return o;
}

function s2ab(s) {
    var b = new ArrayBuffer(s.length*2), v = new Uint16Array(b);
    for (var i=0; i != s.length; ++i) v[i] = s.charCodeAt(i);
    return [v, b];
}

function xw_noxfer(data, cb) {
    var worker = new Worker(XW.noxfer);
    worker.onmessage = function(e) {
        switch(e.data.t) {
            case 'ready': break;
            case 'e': console.error(e.data.d); break;
            case XW.msg: cb(JSON.parse(e.data.d)); break;
        }
    };
    var arr = rABS ? data : btoa(fixdata(data));
    worker.postMessage({d:arr,b:rABS});
}

function xw_xfer(data, cb) {
    var worker = new Worker(rABS ? XW.rABS : XW.norABS);
    worker.onmessage = function(e) {
        switch(e.data.t) {
            case 'ready': break;
            case 'e': console.error(e.data.d); break;
            default: xx=ab2str(e.data).replace(/\n/g,"\\n").replace(/\r/g,"\\r"); console.log("done"); cb(JSON.parse(xx)); break;
        }
    };
    if(rABS) {
        var val = s2ab(data);
        worker.postMessage(val[1], [val[1]]);
    } else {
        worker.postMessage(data, [data]);
    }
}

function xw(data, cb) {
    transferable = true;
    if(transferable) xw_xfer(data, cb);
    else xw_noxfer(data, cb);
}

function to_json(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
        var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
        if(roa.length > 0){
            result[sheetName] = roa;
        }
    });
    return result;
}

function to_csv(workbook) {
    var result = [];
    workbook.SheetNames.forEach(function(sheetName) {
        var csv = X.utils.sheet_to_csv(workbook.Sheets[sheetName]);
        if(csv.length > 0){
            result.push("SHEET: " + sheetName);
            result.push("");
            result.push(csv);
        }
    });
    return result.join("\n");
}

function to_formulae(workbook) {
    var result = [];
    workbook.SheetNames.forEach(function(sheetName) {
        var formulae = X.utils.get_formulae(workbook.Sheets[sheetName]);
        if(formulae.length > 0){
            result.push("SHEET: " + sheetName);
            result.push("");
            result.push(formulae.join("\n"));
        }
    });
    return result.join("\n");
}

var tarea = document.getElementById('b64data');
function b64it() {
    if(typeof console !== 'undefined') console.log("onload", new Date());
    var wb = X.read(tarea.value, {type: 'base64',WTF:wtf_mode});
    process_wb(wb);
}

function GetElementInsideContainer(containerID, childID) {
    var elm = document.getElementById(childID);
    var parent = elm ? elm.parentNode : {};
    return (parent.id && parent.id === containerID) ? elm : {};
}

var json_obj;
function ajax_update_wb(json_obj){
    $("#submit_changes").prop("disabled", true);
    var loop_num = json_obj.Sheet1.length;

    for(var i = 0; i < loop_num; i++){

        var currentID = json_obj.Sheet1[i].ID; 
        
        try{
            var currentPrice = GetElementInsideContainer(currentID,  currentID + '_entity_price');
            if(json_obj.Sheet1[i].原价.trim() != currentPrice.textContent.trim()){  
                $.ajax({
                    url: "/ajax_product_price",
                    method: "POST",
                    data: {
                        id: currentID,
                        price: json_obj.Sheet1[i].原价.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_price').style.backgroundColor = "limegreen";
                    GetElementInsideContainer(response.id,  response.id + '_entity_price').innerHTML = response.price;
                })
            }

            var currentPriceDiscounted = GetElementInsideContainer(currentID,  currentID + '_entity_pricediscounted');
            if(json_obj.Sheet1[i].折后价格.trim() != currentPriceDiscounted.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_priceDiscounted",
                    method: "POST",
                    data: {
                        id: currentID,
                        priceDiscounted: json_obj.Sheet1[i].折后价格.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_pricediscounted').style.backgroundColor = "limegreen";
                    GetElementInsideContainer(response.id,  response.id + '_entity_pricediscounted').innerHTML = response.priceDiscounted;
                })
            }

            var currentViewedCount = GetElementInsideContainer(currentID,  currentID + '_entity_viewed_count');
            if(json_obj.Sheet1[i].浏览次数.trim() != currentViewedCount.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_viewed_count",
                    method: "POST",
                    data: {
                        id: currentID,
                        viewed_count: json_obj.Sheet1[i].浏览次数.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_viewed_count').style.backgroundColor = "limegreen";
                    GetElementInsideContainer(response.id,  response.id + '_entity_viewed_count').innerHTML = response.viewed_count;
                })
            }
            

            var currentInventory = GetElementInsideContainer(currentID,  currentID + '_entity_inventory');
            if(json_obj.Sheet1[i].库存.trim() != currentInventory.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_inventory",
                    method: "POST",
                    data: {
                        id: currentID,
                        inventory: json_obj.Sheet1[i].库存.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_inventory').style.backgroundColor = "limegreen";
                    GetElementInsideContainer(response.id,  response.id + '_entity_inventory').innerHTML = response.inventory;
                })
            }                
            
            var currentSoldNo = GetElementInsideContainer(currentID,  currentID + '_entity_soldno');
            if(json_obj.Sheet1[i].销售.trim() != currentSoldNo.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_soldNo",
                    method: "POST",
                    data: {
                        id: currentID,
                        soldNo: json_obj.Sheet1[i].销售.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_soldno').style.backgroundColor = "limegreen";                    
                    GetElementInsideContainer(response.id,  response.id + '_entity_soldno').innerHTML = response.soldNo;
                })
            }
            
            var currentWidget_weight = GetElementInsideContainer(currentID,  currentID + '_entity_widget_weight');
            if(json_obj.Sheet1[i].权重.trim() != currentWidget_weight.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_widget_weight",
                    method: "POST",
                    data: {
                        id: currentID,
                        widget_weight: json_obj.Sheet1[i].权重.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_widget_weight').style.backgroundColor = "limegreen"; 
                    GetElementInsideContainer(response.id,  response.id + '_entity_widget_weight').innerHTML = response.widget_weight;
                })      
            }


            var currentWeight = GetElementInsideContainer(currentID,  currentID + '_entity_weight');
            if(json_obj.Sheet1[i].重量.trim() != currentWeight.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_weight",
                    method: "POST",
                    data: {
                        id: currentID,
                        weight: json_obj.Sheet1[i].重量.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_weight').style.backgroundColor = "limegreen"; 
                    GetElementInsideContainer(response.id,  response.id + '_entity_weight').innerHTML = response.weight;
                })      
            }

            var currentProductKey = GetElementInsideContainer(currentID,  currentID + '_entity_productkey');
            if(json_obj.Sheet1[i].商品编号.trim() != currentProductKey.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_productKey",
                    method: "POST",
                    data: {
                        id: currentID,
                        productKey: json_obj.Sheet1[i].商品编号.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_productkey').style.backgroundColor = "limegreen"; 
                    GetElementInsideContainer(response.id,  response.id + '_entity_productkey').innerHTML = response.productKey;
                })      
            }

            var currentClick = GetElementInsideContainer(currentID,  currentID + '_entity_click');
            if(json_obj.Sheet1[i].点击量.trim() != currentClick.textContent.trim()){
                $.ajax({
                    url: "/ajax_product_click",
                    method: "POST",
                    data: {
                        id: currentID,
                        click: json_obj.Sheet1[i].点击量.trim()
                    },
                    dataType: "json"
                })
                .done(function (response) {
                    GetElementInsideContainer(response.id,  response.id + '_entity_click').style.backgroundColor = "limegreen"; 
                    GetElementInsideContainer(response.id,  response.id + '_entity_click').innerHTML = response.click;
                })      
            }
        } catch(err){
            console.log("Please re-check entry: " + currentID + " in the Excel file... it doesn't exists in database.");
            document.getElementById("drop").innerHTML = "提醒: ID (" + currentID + ") 不存在于现有数据库中, 请检查excel文件中相关条目";
        }     
    }
}

function process_wb(wb) {
    $("#submit_changes").prop("disabled", true);

    var output = JSON.stringify(to_json(wb), 2, 2);
    json_obj = JSON.parse(output);
    var analysis_progress_num = 0;
    var loop_num = json_obj.Sheet1.length;

    (function theLoop (i) {
        setTimeout(function () {
            var all_green = 1;
            var currentID = json_obj.Sheet1[i].ID;
            
            try{
                GetElementInsideContainer(currentID,  currentID + '_entity_id').style.backgroundColor = "#95B56F";
                GetElementInsideContainer(currentID,  currentID + '_entity_name').style.backgroundColor = "lightblue";
                GetElementInsideContainer(currentID,  currentID + '_entity_brand').style.backgroundColor = "lightblue";

                var currentPrice = GetElementInsideContainer(currentID,  currentID + '_entity_price');
                if(json_obj.Sheet1[i].原价 == currentPrice.textContent){
                    currentPrice.style.backgroundColor = "#95B56F";
                } else {
                    currentPrice.style.backgroundColor = "pink";
                    currentPrice.innerHTML = json_obj.Sheet1[i].原价 + " <strike>(" + currentPrice.textContent +")</strike>";
                    all_green = 0;
                }

                var currentPriceDiscounted = GetElementInsideContainer(currentID,  currentID + '_entity_pricediscounted');
                if(json_obj.Sheet1[i].折后价格 == currentPriceDiscounted.textContent){
                    currentPriceDiscounted.style.backgroundColor = "#95B56F";
                } else {
                    currentPriceDiscounted.style.backgroundColor = "pink";
                    currentPriceDiscounted.innerHTML = json_obj.Sheet1[i].折后价格 + " <strike>(" + currentPriceDiscounted.textContent +")</strike>";
                    all_green = 0;
                }

                 
                var currentViewedCount = GetElementInsideContainer(currentID,  currentID + '_entity_viewed_count');
                if(json_obj.Sheet1[i].浏览次数.trim() == currentViewedCount.textContent.trim()){
                    currentViewedCount.style.backgroundColor = "#95B56F";
                } else {
                    currentViewedCount.style.backgroundColor = "pink";
                    currentViewedCount.innerHTML = json_obj.Sheet1[i].浏览次数 + " <strike>(" + currentViewedCount.textContent +")</strike>";
                    all_green = 0;
                }
                

                var currentInventory = GetElementInsideContainer(currentID,  currentID + '_entity_inventory');
                if(json_obj.Sheet1[i].库存.trim() == currentInventory.textContent.trim()){
                    currentInventory.style.backgroundColor = "#95B56F";
                } else {
                    currentInventory.style.backgroundColor = "pink";
                    currentInventory.innerHTML = json_obj.Sheet1[i].库存 + " <strike>(" + currentInventory.textContent +")</strike>";
                    all_green = 0;
                }                
                var currentSoldNo = GetElementInsideContainer(currentID,  currentID + '_entity_soldno');
                if(json_obj.Sheet1[i].销售.trim() == currentSoldNo.textContent.trim()){
                    currentSoldNo.style.backgroundColor = "#95B56F";
                } else {
                    currentSoldNo.style.backgroundColor = "pink";
                    currentSoldNo.innerHTML = json_obj.Sheet1[i].销售 + " <strike>(" + currentSoldNo.textContent +")</strike>";
                    all_green = 0;
                }

                var currentWidget_weight = GetElementInsideContainer(currentID,  currentID + '_entity_widget_weight');
                if(currentWidget_weight == 'undefined' || currentWidget_weight.textContent == null){
                    currentWidget_weight.innerHTML = json_obj.Sheet1[i].权重 + " <strike>(N/A)</strike>";
                    all_green = 0;
                    currentWidget_weight.style.backgroundColor = "pink";
                } else {
                    if(json_obj.Sheet1[i].权重.trim() == currentWidget_weight.textContent.trim()){
                        currentWidget_weight.style.backgroundColor = "#95B56F";
                    } else {
                        currentWidget_weight.innerHTML = json_obj.Sheet1[i].权重 + " <strike>(" + currentWidget_weight.textContent +")</strike>";
                        all_green = 0;
                        currentWidget_weight.style.backgroundColor = "pink";
                    }
                }

                var currentWeight = GetElementInsideContainer(currentID,  currentID + '_entity_weight');
                if(json_obj.Sheet1[i].重量.trim() == currentWeight.textContent.trim()){
                    currentWeight.style.backgroundColor = "#95B56F";
                } else {
                    currentWeight.style.backgroundColor = "pink";
                    currentWeight.innerHTML = json_obj.Sheet1[i].重量 + " <strike>(" + currentWeight.textContent +")</strike>";
                    all_green = 0;
                }


                var currentProductKey = GetElementInsideContainer(currentID,  currentID + '_entity_productkey');
                if(currentProductKey == 'undefined' || currentProductKey.textContent == null){
                    currentProductKey.innerHTML = json_obj.Sheet1[i].商品编号 + " <strike>(N/A)</strike>";
                    all_green = 0;
                    currentProductKey.style.backgroundColor = "pink";
                } else {
                    if(json_obj.Sheet1[i].商品编号.trim() == currentProductKey.textContent.trim()){
                        currentProductKey.style.backgroundColor = "#95B56F";
                    } else {
                        currentProductKey.style.backgroundColor = "pink";
                        currentProductKey.innerHTML = json_obj.Sheet1[i].商品编号 + " <strike>(" + currentProductKey.textContent +")</strike>";
                        all_green = 0;
                    }
                }

                var currentClick = GetElementInsideContainer(currentID,  currentID + '_entity_click');
                if(json_obj.Sheet1[i].点击量.trim() == currentClick.textContent.trim()){
                    currentClick.style.backgroundColor = "#95B56F";
                } else {
                    currentClick.style.backgroundColor = "pink";
                    currentClick.innerHTML = json_obj.Sheet1[i].点击量 + " <strike>(" + currentClick.textContent +")</strike>";
                    all_green = 0;
                }

                var status = GetElementInsideContainer(currentID,  currentID + '_entity_status');
                if(all_green == 1){
                    status.innerHTML = "<span class=\"glyphicon glyphicon-check\"></span>";
                    status.style.backgroundColor = "limegreen";
                } else {
                    status.innerHTML = "<span class=\"glyphicon glyphicon-alert\"></span>";
                    status.style.backgroundColor = "orangered";
                }

                analysis_progress_num = parseInt( i / loop_num * 100, 10);
                $('#analysis_progress .progress-bar').css(
                    'width',
                    analysis_progress_num + '%'
                );
            } catch(err){
                console.log("Please re-check entry: " + currentID + " in the Excel file... it doesn't exists in database.");
                document.getElementById("drop").innerHTML = "提醒: ID (" + currentID + ") 不存在于现有数据库中, 请检查excel文件中相关条目";
            } finally{
                if (++i < loop_num) {          // If i > 0, keep going
                  theLoop(i);       // Call the loop again, and pass it the current value of i
                } else {
                    analysis_progress_num = parseInt(100, 10);
                    $('#analysis_progress .progress-bar').css(
                        'width',
                        analysis_progress_num + '%'
                    );
                    $("#submit_changes").prop("disabled", false);
                }
            }
        }, 20);  //Processing speed.
    })(0);

    /* Following part is the output generation section. */
    //if(out.innerText === undefined) out.textContent = output;
    //else out.innerText = output;
    //if(typeof console !== 'undefined') console.log("output", new Date());
}

var drop = document;
function handleDrop(e) {
    e.stopPropagation();
    e.preventDefault();
    rABS = true;
    use_worker = true;
    var files = e.dataTransfer.files;
    var f = files[0];
    {
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function(e) {
            if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
            var data = e.target.result;
            if(use_worker) {
                xw(data, process_wb);
            } else {
                var wb;
                if(rABS) {
                    wb = X.read(data, {type: 'binary'});
                } else {
                var arr = fixdata(data);
                    wb = X.read(btoa(arr), {type: 'base64'});
                }
                process_wb(wb);
            }
        };
        if(rABS) 
            reader.readAsBinaryString(f);
        else 
            reader.readAsArrayBuffer(f);
    }
}

function handleDragover(e) {
    e.stopPropagation();
    e.preventDefault();
    e.dataTransfer.dropEffect = 'copy';
}

if(drop.addEventListener) {
    drop.addEventListener('dragenter', handleDragover, false);
    drop.addEventListener('dragover', handleDragover, false);
    drop.addEventListener('drop', handleDrop, false);
}


var xlf = document.getElementById('fileupload');
function handleFile(e) {
    rABS = true;
    use_worker = true;
    var files = e.target.files;
    var f = files[0];
    {
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function(e) {
            if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
            var data = e.target.result;
            if(use_worker) {
                xw(data, process_wb);
            } else {
                var wb;
                if(rABS) {
                    wb = X.read(data, {type: 'binary'});
                } else {
                var arr = fixdata(data);
                    wb = X.read(btoa(arr), {type: 'base64'});
                }
                process_wb(wb);
            }
        };
        if(rABS) reader.readAsBinaryString(f);
        else reader.readAsArrayBuffer(f);
    }
}
if(xlf.addEventListener) xlf.addEventListener('change', handleFile, false);