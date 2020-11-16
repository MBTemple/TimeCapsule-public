$(function(){

    $('#loading').hide();
    $('#canvasButton').show();
    var canvas1 = new fabric.Canvas('cnvs1', {preserveObjectStacking: true}); //instantiate canvas
    var img; //loaded image
    var imgUrl; //Image URL
    var imgSlength; //The shorter of the vertical and horizontal lengths of the image

    var drawingMode; //0: Determine image position and 1: Draw with pen
    var burshWidth = 20; //pen thickness
    var width = 1;

    $('#inImg').on('change', function (e) {
        $('#uploader').hide();
        $('.canvas').show();
        $('.mode1').show();
        $('.mode2').hide();
        $('#cnvs2').hide();
        img = new Image();
        var reader = new FileReader();
        //put the loaded image in canvas
        reader.onload = function (e) {
            canvas1.clear(); //erase previous image
            img.src = reader.result;
            fabric.Image.fromURL(this.result, function(oImg) {
                imgSlength = Math.min(img.naturalWidth, img.naturalHeight) / 512; 
				// Expand the long side of the loaded photo to the canvas and fix it. The other side can slide.
                if(img.naturalWidth > img.naturalHeight){
                    oImg.set({
                        lockMovementY: true,
                    });
                }else if(img.naturalWidth < img.naturalHeight){
                    oImg.set({
                        lockMovementX: true,
                    });
                }else{
                    oImg.set({
                        lockMovementX: true,
                        lockMovementY: true
                    });
                }
                oImg.scale(1 / imgSlength);
                oImg.set({
                    hasRotatingPoint: false
                });
                oImg.setControlsVisibility({                                                            //hide lines
                     mt: false,    // middle top
                     mb: false,    // middle bottom
                     ml: false,    // middle left
                     mr: false,    // middle right
                     bl: false,    // bottom left
                     br: false,    // bottom right
                     tl: false,    // top left
                     tr: false,    // top right
                     mtr: false,    // middle top rotete
                });
                canvas1.add(oImg);
            });
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    $('#paint').on('click', function(){
        canvas1.isDrawingMode = false;

        $('#cnvs2').show();

        var canvas2 = new fabric.Canvas('cnvs2', {preserveObjectStacking: true});
            canvas2.forEachObject(function(object){
            object.selectable = false;
        });
        $('.mode1').hide();
        $('.mode2').show();
        canvas2.isDrawingMode = true;
        canvas2.freeDrawingBrush.width = burshWidth;
        canvas2.freeDrawingBrush.color = "white";
    });

    $('#move').on('click', function(){
        canvas1.isDrawingMode = false;
        $('#cnvs2').hide();
        $('.mode1').show();
        $('.mode2').hide();
        // canvas2.clear();
        canvas2.isDrawingMode = false;
    });
    $('#changeImg').on('click', function(){
        // $('.uploader').show();
        // $('.canvas').hide();
        location.reload();
        canvas1.clear();
        canvas2.clear();

    });


    $('#sendImg').on('click', function(){

        $('#loading').show();
        $('#canvasButton').hide();
        $('#canvasDescription').hide();
        // get canvas element
        var canvas1 = document.getElementById('cnvs1');
        // canvas1.width = 512;
        // canvas1.height = 512;
        var canvas2 = document.getElementById('cnvs2');
        // canvas2.width = 512;
        // canvas2.height = 512;



        // get base64 data (encode)
        var base64_1 = canvas1.toDataURL('image/png');
        var base64_2 = canvas2.toDataURL('image/png');

        var fData = new FormData();

        fData.append('img1', base64_1);
        fData.append('img2', base64_2);

        var JSONdata = {
            img1: base64_1,
            img2: base64_2
        };

        $.ajax({
			//url: '/send_img',
			//url: 'http://0.0.0.0:57166/send_img',
            //url: 'http://127.0.0.1:57166/send_img',
			//url: 'http://tec2.hpc.temple.edu/~tue57166/4398/Project/php/python3/send_img',
			//url: 'http://tec2.hpc.temple.edu:57166/~tue57166/4398/Project/php/python3/send_img',
			url: 'http://tec2.hpc.temple.edu:57166/send_img',
            type: 'POST',
            data : JSON.stringify(JSONdata),
            contentType: 'application/JSON',
            dataType : 'JSON',
            processData: false,

            success: function(data, dataType) {
                if (data.ResultSet.ip_type == 'inpaint_success') {
                     console.log('Success', data);
                     var result = document.getElementById("result-img");
                     result.src = data.ResultSet.result;
                     var original = document.getElementById("original-img");
                     original.src = data.ResultSet.original;

                    $('#content-before').hide();
                    $('#loading').hide();
                    $('#content-after').show();

                 }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log('Error : ' + errorThrown);
            }
        })
    });
});