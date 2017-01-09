;(function($){

    var LightBox = function () {
        var self = this;

        //创建遮罩和弹出框
        this.popupMask = $('<div id="G-lightbox-mask">');
        this.popupWin=$('<div id="G-lightbox-popup">');

        //保存BODY
        this.bodyNode=$(document.body);

        //渲染剩余的DOM，并且插入到body中
        this.renderDOM();

        this.picViewArea = this.popupWin.find("div.lightbox-pic-view");//图片预览区域
        this.popupPic = this.popupWin.find("img.lightbox-image");//图片
        this.picCaptionArea = this.popupWin.find("div.lightbox-pic-caption");//图片描述区域

        this.prevBtn = this.popupWin.find("span.lightbox-prev-btn");//向上切换按钮
        this.nextBtn = this.popupWin.find("span.lightbox-next-btn");//向下切换按钮

        this.captionTitle = this.popupWin.find("h6.lightbox-pic-title");//图片标题
        this.captionText = this.popupWin.find("p.lightbox-pic-desc");//图片描述信息
        this.currentIndex = this.popupWin.find("span.lightbox-of-index");//图片索引

        this.closeBtn = this.popupWin.find("span.lightbox-close-btn");//关闭按钮
       // this.voteBtn = this.popupWin.find("span.lightbox-vote-btn");//投票按钮
       // this.cancelBtn = this.popupWin.find("span.lightbox-cancel-btn");//取消按钮

        //准备开发事件委托，并获取组数据

        this.groupName = null;
        this.groupData=[];

        this.bodyNode.delegate(".js-lightbox,*[data-role=lightbox]","click",function(e){
            //阻止事件冒泡
            e.stopPropagation();

            var currentGroupName=$(this).attr('data-group');
            if (currentGroupName!= self.groupName){
                self.groupName=currentGroupName;
                //根据当前组名获取一组数据
                self.getGroup();
            };

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

        // this.voteBtn.click(function(e) {
        //     e.stopPropagation();
        //     var imgid=$(this).attr('data-id');

        //     var url="src/bstvote.php";

        //     $.post(url,
        //         {
        //             imgid:imgid,
        //         },
        //         function(data,status){
        //             if (data==="success"){
        //                 alert("投票成功");
        //             }else{
        //                 alert("已投票");
        //             }
        //         });

        // });

        // this.cancelBtn.click(function(e) {
        //     e.stopPropagation();
        //     var imgid=$(this).attr('data-id');

        //     var url="src/bstcancelvote.php";

        //     $.post(url,
        //         {
        //             imgid:imgid,
        //         },
        //         function(data,status){
        //             if (data==="success"){
        //                 alert("投票取消成功");
        //             }else{
        //                 alert("还没有投票");
        //             }
        //         });
        // });

        //绑定上下切换按钮事件
        this.flag = true;
        this.nextBtn.hover(function() {
            if (!$(this).hasClass('disabled')&&self.groupData.length>1){
                $(this).addClass('lightbox-next-btn-show');
            };
        }, function() {
             if (!$(this).hasClass('disabled')&&self.groupData.length>1){
                $(this).removeClass('lightbox-next-btn-show');
            };
        }).click(function(e) {
            if(!$(this).hasClass("disabled")&&self.flag){
                self.flag=false;
                e.stopPropagation();
                self.goto("next");

            };
        });

        this.prevBtn.hover(function() {
            if (!$(this).hasClass('disabled')&&self.groupData.length>1){
                $(this).addClass('lightbox-prev-btn-show');
            };
        }, function() {
            if (!$(this).hasClass('disabled')&&self.groupData.length>1){
                $(this).removeClass('lightbox-prev-btn-show');
            };
        }).click(function(e) {
            if(!$(this).hasClass("disabled")&&self.flag){
                self.flag=false;
                e.stopPropagation();
                self.goto("prev");

            };
        });

    };

    LightBox.prototype={

        goto:function(dir){
            if(dir==="next"){
                //this.groupData
                //this.index
                this.index++;
                if (this.index>=this.groupData.length-1){
                    this.nextBtn.addClass('disabled').removeClass('lightbox-next-btn-show');
                };

                if (this.index!=0){
                    this.prevBtn.removeClass('disabled');
                };

                var src=this.groupData[this.index].src;
                var currentId=this.groupData[this.index].id;
                this.loadPicSize(src,currentId);

            }else if(dir==="prev"){
                this.index--;
                if (this.index<=0){
                    this.prevBtn.addClass('disabled').removeClass('lightbox-prev-btn-show');
                };

                if (this.index<this.groupData.length-1){
                    this.nextBtn.removeClass('disabled');
                };

                var src=this.groupData[this.index].src;
                var currentId=this.groupData[this.index].id;
                this.loadPicSize(src,currentId);

            }
        },

        loadPicSize:function(sourceSrc,currentId){
            var self=this;

            self.popupPic.css({width:"auto",height:"auto"}).hide();

            this.preLoadImg(sourceSrc,function(){
                self.popupPic.attr("src",sourceSrc);

                //self.voteBtn.attr("data-id",currentId);
                //self.cancelBtn.attr("data-id",currentId);

                var picWidth=self.popupPic.width(),
                    picHeight = self.popupPic.height();

                self.changePic(picWidth,picHeight);
            });
        },

        changePic:function(width,height){
            var self=this,
                winWidth=$(window).width(),
                winHeight=$(window).height()-100;

            //如果图片的宽高大于浏览器视口的宽高比例，我就看下是否溢出

            var scale = Math.min(winWidth/(width+10),winHeight/(height+10),1);

            width=width*scale;
            height=height*scale;

            this.picViewArea.animate({
                width:width-10,
                height:height-10
            });

            this.popupWin.animate({
                width:width,
                height:height,
                marginLeft:-(width/2),
                top:(winHeight-height)/2
            },function(){
                self.popupPic.css({
                    width:width-10,
                    height:height-10
                }).fadeIn();
                self.picCaptionArea.fadeIn();
                self.flag=true;
            });

            //设置描述文字和当前所引

            this.captionTitle.text(this.groupData[this.index].caption);
            this.captionText.text(this.groupData[this.index].desc);
            this.currentIndex.text("当前索引: "+(this.index+1)+" of "+this.groupData.length);
        },

        preLoadImg:function(src,callback){

            var img = new Image();
            if (!!window.ActiveXObject){
                img.onreadystatechange = function(){
                    if(this.readyState=="complete"){
                        callback();
                    };
                };
            }else{
              img.onload=function(){
                callback();
              };
            };

            img.src=src;
        },

        showMaskAndPopup:function(sourceSrc,currentId){
            var self = this;

            this.popupPic.hide();
            this.picCaptionArea.hide();

            this.popupMask.fadeIn();

            var winWidth = $(window).width(),
                winHeight = $(window).height()-100;

            this.picViewArea.css({
                width:winWidth/2,
                height:winHeight/2
            });

            this.popupWin.fadeIn();

            var viewHeight=winHeight/2+10;

            this.popupWin.css({
                width:winWidth/2+10,
                height:winHeight/2+10,
                marginLeft:-(winWidth/2+10)/2,
                top:-viewHeight
            }).animate({
                top: (winHeight-viewHeight)/2
            },function(){
                //加载图片
                self.loadPicSize(sourceSrc,currentId);
            });

            //根据当前点击的元素ID获取在当前组别的索引

            this.index =this.getIndexOf(currentId);

            var groupDataLength=this.groupData.length;
            if (groupDataLength>1){
                //this.nextBtn this.prevBtn
                if (this.index===0){
                    this.prevBtn.addClass("disabled");
                    this.nextBtn.removeClass("disabled");
                }else if (this.index===(groupDataLength-1)){
                    this.prevBtn.removeClass("disabled");
                    this.nextBtn.addClass("disabled");
                }else{
                    this.prevBtn.removeClass("disabled");
                    this.nextBtn.removeClass("disabled");
                };
            };
        },

        getIndexOf:function(currentId){
            var index = 0;

            $(this.groupData).each(function(i) {
                index=i;
                if (this.id===currentId){
                    return false;
                }
            });

            return index;
        },

        initPopup:function(currentObj){
            var self = this,
                        sourceSrc=currentObj.attr("data-source"),
                        currentId=currentObj.attr("data-id");

            this.showMaskAndPopup(sourceSrc,currentId);

        },

        getGroup:function(){
            var self = this;

            //根据当前的组名获取页面中相同组名的数据

            var groupList =this.bodyNode.find("*[data-group="+this.groupName+"]");

            self.groupData.length = 0;
            groupList.each(function(index, el) {
                self.groupData.push({
                    src:$(this).attr('data-source'),
                    id:$(this).attr('data-id'),
                    caption: $(this).attr('data-caption'),
                    desc: $(this).attr('data-desc'),
                });

            });

        },

        renderDOM:function(){
            var strDom='<div class="lightbox-pic-view">'+
                       '<span class="lightbox-btn lightbox-prev-btn"></span>'+
                       '<img class="lightbox-image" src="">'+
                       '<span class="lightbox-btn lightbox-next-btn"></span>'+
                        '</div>'+
                        '<div class="lightbox-pic-caption">'+
                            '<div class="lightbox-caption-area">'+
                                '<h6 class="lightbox-pic-title"></h6>'+
                                '<p class="lightbox-pic-desc"></p>'+
                                '<span class="lightbox-of-index"></span>'+
                            '</div>'+
                            '<div class="lightbox-btn">'+
                                '<span class="lightbox-close-btn">关闭</span>'+
                            '</div>'+
                        '</div>';

            this.popupWin.html(strDom);
            this.bodyNode.append(this.popupMask,this.popupWin);
        },


    };
    window["LightBox"]=LightBox;
})(jQuery);