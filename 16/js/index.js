var sceneObject = {
    init: function(){
        this._enterCar();
        this._enterInvitation();
        this._enterAlbum();
        this._enterWall();
        this._addBlessing();
        this._searchAddress();
    },
    /*---------------------------------移动的婚车------------------------------*/
    _enterCar: function(){
        initCar();

        /* 婚车随着窗口大小改变 */
        $(window).resize(function(){
            setCarPosition();
        })
    },
    /*---------------------------------进入邀请函------------------------------*/
    _enterInvitation: function(){
         var $home = $(".home"), /* 首页 */
            $toInvitation = $("#to-invitation"), /* 邀请函按钮 */
            $invitation = $(".invitation"), /* 邀请函模块 */
            $invitationCt = $(".invitation-content"), /* 邀请函内容 */
            $inviteReturn = $("#invite-return");

        $toInvitation.click(function(){
            $home.fadeOut(); /* 隐藏首页 */
            $invitation.fadeIn();
            $invitationCt.animate({"top": "0"},function(){
                $inviteReturn.fadeIn();
            });
        })
        
        /* 邀请函中点击返回按钮 */
        $inviteReturn.click(function(){
            $invitationCt.css({"top": "-540px"});
            $invitation.fadeOut(function(){
                $inviteReturn.fadeOut();
                $home.fadeIn(600);
            });
        })
    },
     /*---------------------------------进入相册------------------------------*/
    _enterAlbum: function(){
        var $home = $(".home"), /* 首页 */
             $toPicture = $("#to-picture"),
             $pictureWall = $(".picture-wall"),
             timer;

        $toPicture.click(function(){
            $home.fadeOut(function(){/* 隐藏首页 */
                $pictureWall.fadeIn(); /* 显示相册 */
                autoPicWall();
                timer = setInterval(autoPicWall,4000); /* 照片自动播放 */
            });
        })

        /* 点击照片墙中返回按钮 */
        $("#picture-return").click(function(){
            clearInterval(timer); /* 返回首页时清除循环 */
            picPage = 0; /* 并且显示图片为0，也就是下一次进入时又从0开始 */
            $pictureWall.fadeOut(function(){
                $home.fadeIn();
            })
        })
    },
     /*---------------------------------进入祝福墙-------------------------------*/
    _enterWall: function(){
        var $home = $(".home"),
                $uEnter = $("#to-wall"); /* 进入祝福墙按钮 */
                

        $uEnter.click(function(){
            $home.hide();
            setTimeout(scene6,400); /* 进入祝福墙场景动画 */
        })
    },
    /*---------------------------------添加祝福语-------------------------------*/
    _addBlessing: function(){
           var $home = $(".home"),
                $sevenDiv = $(".seven-content div"),
                $clickMe = $(".clickMe"),
                $mask = $(".mask"),
                $popBox = $(".pop-box"),
                $write = $("#write"),
                $uSure = $("#uSure"),
                $sevenContent = $(".seven-content");

        /* 拖动祝福卡片 */
        draggableNote();

         /* 点我送祝福 */
        $clickMe.click(function(){
            $write.val("送上您的祝福吧~");
            $mask.fadeIn();
            $popBox.animate({top: "50%"});
        })

        /* 获取焦点时 */
        $write.focus(function(){
            var _val = $(this).val();
            if(_val == "送上您的祝福吧~"){
                $(this).val("");
            }
        })
        /* 丢失焦点时 */
        $write.blur(function(){
            var _val = $(this).val();
            if(_val.length == 0){
                $(this).val("送上您的祝福吧~");
            }
        })

        /* 确定添加祝福语 */
        $uSure.click(function(){
            var _writeVal = $write.val(),
                 _randomNum = Math.ceil(Math.random()*6);

            if(_writeVal != "送上您的祝福吧~"){
                var _div = '<div class="note-'+_randomNum+'">'+_writeVal+'</div>';
                $sevenContent.append(_div); /* 如果输入祝福语，将此标签添加的尾部 */
                defineSevenDiv($sevenContent.find("div:last"));
                $popBox.animate({top: "-300px"},function(){
                    $mask.fadeOut();
                    draggableNote(); /* 可拖动卡片，给新添加的标签赋予拖动功能 */
                });
            }else{
                alert("请输入祝福语！");
            }
        })

        /* 祝福墙中返回首页 */
        $("#blessing-return").click(function(){
            $(".seven-box").fadeOut(function(){
                $home.fadeIn();
            })
        })
    },
     /*---------------------------------查看婚礼地址-------------------------------*/
    _searchAddress: function(){
        var $home = $(".home"),
             $toAddress = $("#to-address"); /* 婚礼地址导航 */
             $address = $(".address"), /* 婚礼地址图 */
             $addressReturn = $("#address-return");

        $toAddress.click(function(){
            $home.fadeOut();
            $address.fadeIn();
        })

        /* 婚礼地址返回首页 */
        $addressReturn.click(function(){
            $address.fadeOut();
            $home.fadeIn();
        })
    }
}


/*---------------------------------移动的小车-------------------------------*/
function initCar(){
    var $home = $(".home"); /* 首页 */
    setCarPosition();
    setTimeout(function(){
        $home.fadeIn();
    },6500);
}

/* 婚车位置定位和滑动方法 */
function setCarPosition(){
    var $car = $(".car"),
          wWidth = $(window).width(), /* 文档宽度 */
          wHeight = $(window).height(), /* 窗口高度 */
          carWidth = $car.height(), /* 婚车宽度 */
          carHeight = $car.height(); /* 婚车高度 */
    $car.css({top:wHeight - carHeight - 100});
    $car.animate({left: wWidth - carWidth + 100},8000).fadeOut();
}


/*---------------------------------图片墙-------------------------------*/
var  picPage = 0, /* 当前是第几张图片放大和缩小 */
       picLeft, /* 图片左边距离 */
       picTop; /* 图片上部定位距离 */

/* 自动放大缩小图片方法 */
function autoPicWall(){
    var $pictureWallPic = $(".picture-wall div"),
         $own = $pictureWallPic.eq(picPage),
         isBig = $own.hasClass("bigCenter"), /* 放大时有这个class */
         hasClassPicRow = $own.hasClass("picRow"); /* 判断图片是行的（就是宽大于高） */

    /* 调用图片放大 */
    becomeBig($own,hasClassPicRow);

    /* 隔2秒图片自动缩小 */
    setTimeout(function(){becomeSmall($own,hasClassPicRow);},2000);

    /* 保证当前放大图片为图片总个数内，也就是说存在这个图片 */
    if(picPage < $pictureWallPic.length - 1){
        picPage++;
    }else if(picPage == $pictureWallPic.length - 1){ /* 如果当前图片为最后一张图片，则又从第一张图片开始显示 */
        picPage = 0;
    }

}

/* 图片变大方法 */
function becomeBig($own,hasClassPicRow){
    var $mask = $(".mask"),
          pictureWallWidth = $(".picture-wall").width(),
          pictureWallHeight = $(".picture-wall").height();

    picLeft = $own.css("left"); /* 原始绝对定位left值 */
    picTop = $own.css("top"); /* 原始绝对定位top值 */
    $own.toggleClass("bigCenter"); /* 添加放大的class属性 */
    $mask.fadeIn();

    /* 图片为行图片，也就是宽度大于高度 */
    if(hasClassPicRow){
        for(var i = 120; i < 720; i+=20){
            $own.find("img").animate({"width": i+"px", "height": i/1.5+"px"},2);
            $own.animate({"left": (pictureWallWidth-i)/2+"px", "top": (pictureWallHeight-i/1.5)/2+"px"},2);
        }
    }else{
        for(var i = 80; i < 480; i+=20){
            $own.find("img").animate({"width": i+"px", "height": i*1.5+"px"},2);
            $own.animate({"left": (pictureWallWidth-i)/2+"px", "top": (pictureWallHeight-i*1.5)/2+"px"},2);
        }
    }
}

/* 图片缩小方法 */
function becomeSmall($own,hasClassPicRow){
    var $mask = $(".mask"),
          pictureWallWidth = $(".picture-wall").width(),
          pictureWallHeight = $(".picture-wall").height();

    if(hasClassPicRow){
        for(var i = 720; i >= 120; i-=40){
            $own.find("img").animate({"width": i+"px", "height": i/1.5+"px"},2);
            /* 图片缩小到中心位置 */
            $own.animate({"left": (pictureWallWidth-i)/2+"px", "top": (pictureWallHeight-i/1.5)/2+"px"},2);
        }
    }else{
        for(var i = 480; i >= 80; i-=40){
            $own.find("img").animate({"width": i+"px", "height": i*1.5+"px"},2);
            /* 图片缩小到中心位置 */
            $own.animate({"left": (pictureWallWidth-i)/2+"px", "top": (pictureWallHeight-i*1.5)/2+"px"},2);
        }
    }
    
    /* 图片缩小到中心位置后，回到原始位置 */
    $own.animate({"left": picLeft, "top": picTop},400,function(){
        $mask.fadeOut(); /* 隐藏遮罩层 */
        $own.toggleClass("bigCenter"); /* 去除放大的class属性 */
    });
}


                
/*---------------------------------祝福墙进入动画-------------------------------*/
var colCount = 4, /* 多少列 */
        rowCount = 4, /* 多少行 */
        $sixBox;
function scene6(){
    $sixBox = $(".six-box"); /* 场景六box */
    $sixBox.fadeIn();
    /* 散开 */
    scatter();
    setTimeout(together,100); /* 调用聚合 */
    setTimeout(scene7,2000); /* 进入第七场景 */
}

/* 所有图片聚合 */
function together(){
    var  $sixDiv = $sixBox.find("div"), /* 场景六里面小块div */
            sixDivWidth = $sixDiv.width(), /* 场景六里面小块div的宽度 */
            sixDivHeight = $sixDiv.height(), /* 场景六里面小块div的高度 */
            sixBoxWidth = $sixBox.width(), /* 场景六宽度 */
            sixBoxHeight = $sixBox.height();/* 场景六高度 */
            
    $sixDiv.each(function(){
        var _index = $(this).index(),
                col = _index%colCount, /* 第几列 */
                row = Math.floor(_index/rowCount), /* 第几行 */
                cssLeft = sixBoxWidth/2 - colCount/2*sixDivWidth + col*sixDivWidth, /* left的值 */
                cssTop = sixBoxHeight/2 - rowCount/2*sixDivHeight + row*sixDivHeight, /* top的值 */
                divLeft = -col*sixDivWidth, /* 背景定位的宽度 */
                divTop = -row*sixDivHeight; /* 背景定位的高度 */
          $(this).animate({"left": cssLeft,"top": cssTop-100},800);
    })
}

/* 所有图片散开 */
function scatter(){
    var  $sixDiv = $sixBox.find("div"), /* 场景六里面小块div */
            sixDivWidth = $sixDiv.width(), /* 场景六里面小块div的宽度 */
            sixDivHeight = $sixDiv.height(), /* 场景六里面小块div的高度 */
            sixBoxWidth = $sixBox.width(), /* 场景六宽度 */
            sixBoxHeight = $sixBox.height();/* 场景六高度 */
    $sixDiv.each(function(){
        var _index = $(this).index(),
                col = _index%colCount, /* 第几列 */
                row = Math.floor(_index/rowCount), /* 第几行 */
                cssLeft = (col-1)*(sixBoxWidth+sixDivWidth)- sixDivWidth, /* 我这里的水平间距大小为盒子大小加上它自身的宽度 */
                cssTop = (row-1)*(sixBoxHeight+sixDivHeight)- sixDivWidth, /* 我这里的水平间距大小为盒子大小加上它自身的宽度 */
                divLeft = -col*sixDivWidth, /* 背景定位的宽度 */
                divTop = -row*sixDivHeight; /* 背景定位的高度 */
        $(this).css({"left": cssLeft,"top": cssTop, "background-position": divLeft+"px "+divTop+"px"})
    })
}



/*---------------------------------祝福墙内容页------------------------------*/
function scene7(){
    var $sevenDiv = $(".seven-content div"),
         $sevenBox = $(".seven-box");

    $sixBox.hide();
    $sevenBox.fadeIn(1000);
    $sevenDiv.each(function(){
        defineSevenDiv($(this));
    })
}

/* 定义祝福语贴纸位置和旋转角度 */
function defineSevenDiv($own){
    var _obj = defineRandom();
    $own.css({"transform":"rotate("+_obj.rotate+"deg)"}); /* 设置随机旋转值 */
    $own.animate({left: _obj.left+"px",top: _obj.top+"px"}); /* 随机排布 */
}

/* 定义随机left，top和旋转值 */
function defineRandom(){
    var randomLeft = Math.floor(680*(Math.random())) + 30, /* 图片left值 */
            randomTop =  Math.floor(400*Math.random()) + 30, /* 图片top值 */
            randomRotate = 20 - Math.floor(40*Math.random()); /* 图片旋转角度 */
    return {
        left: randomLeft,
        top: randomTop,
        rotate:randomRotate
    }
}

/* 拖动图片 */
function draggableNote(){
    $(".seven-content div").draggable({
        containment: $(".seven-content"),
        zIndex: 2700,
        start: function(){
            $(this).css({"transform":"rotate(0deg)","cursor": "crosshair"}); /* 开始拖动图片旋转为0，鼠标样式改变 */
        },
        stop: function(){
            var _obj = defineRandom();
            $(this).css({"transform":"rotate("+_obj.rotate+"deg)","cursor": "pointer"}); /* 停止拖动，旋转为随机的 */
        }
    })
}

$(function(){
    sceneObject.init();
})