;(function($){

    var VideoBox = function () {
        var self = this;

        //创建遮罩和弹出框
        this.popupMask = $('<div id="G-videobox-mask">');
        this.popupWin=$('<div id="G-videobox-popup">');

        //保存BODY
        this.bodyNode=$(document.body);

        //渲染剩余的DOM，并且插入到body中
        this.renderDOM();

        this.picViewArea = this.popupWin.find("div.videobox-video-view");//视频预览区域
        this.popupVideo = this.popupWin.find("video.videobox");//视频
        this.popupVideosrc = this.popupWin.find("source.videobox-src");//视频source
        this.closeBtn = this.popupWin.find("button.close-btn");//关闭按钮


        this.bodyNode.delegate(".js-videobox,*[data-role=videobox]","click",function(e){
            //阻止事件冒泡
            e.stopPropagation();


            //初始化弹框
            self.initPopup($(this));

        });

        this.popupMask.click(function() {
            $(this).fadeOut();
            self.popupWin.fadeOut();
        });

        this.closeBtn.click(function() {
            self.popupMask.fadeOut();
            self.popupWin.fadeOut();
        });




    };

    VideoBox.prototype={
        showMaskAndPopup:function(){
            var self = this;

            this.popupMask.fadeIn();
            this.popupWin.fadeIn();


        },

        initPopup:function(currentObj){
            var self = this,
                       sourceSrc=currentObj.attr("data-source");

            this.popupVideosrc.attr("src",sourceSrc);
            this.popupVideo.load();
            this.showMaskAndPopup();

        },

        renderDOM:function(){
            var strDom='<div class="videobox-video-view">'+
                       '<video class="videobox" width="640" height="480" controls>'+
                       '<source class="videobox-src" src="" type="video/mp4">'+
                       '</video>'+
                       '<button type="button" class="close close-btn" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                       '</div>';

            this.popupWin.html(strDom);
            this.bodyNode.append(this.popupMask,this.popupWin);
        },


    };
    window["VideoBox"]=VideoBox;
})(jQuery);