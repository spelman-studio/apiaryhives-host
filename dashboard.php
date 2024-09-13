<?php
require_once("inc/global.php");

if(!isLoggedIn()){
    header("Location: /login.php");
    die('');
}

$user = getUserDetails($_SESSION['loggedIn_userId']);
$departmentName = $user['department_name'];
$dept = $user['department'];
$companyId = $user['company_id'];

$company = getCompanyDetails($companyId);
$companyName = $company['name'];
$companyAddress = $company['address'];
$companyIndustry = $company['industry'];

$companyLogo = $company['logo'];
if($companyLogo != "" && $companyLogo != null){
    if(file_exists("uploads/$companyLogo")){
        $companyLogo = "uploads/$companyLogo";
    }else{
        $companyLogo = $defaultProfilePic;
    }
}else{
    $companyLogo = $defaultProfilePic;
}

$companyLinkedIn = $company['linkedin'];
$companyWebsite = $company['website'];

$ajaxDeptId = (int) mysqli_real_escape_string($connect, strip_tags(@$_GET['dept']));

?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>Dashboard | Apiary Hives</title>
        <script>
        $(document).ready(function(){
            $("#loadMorePostsBtn").click(function() {
                console.log("loading more posts");
                var last_id = $(".post-wrapper:last").attr("id");
                loadMore(last_id);
            });

            function loadMore(last_id){
            console.log("function");
            $.ajax({
            url: 'process/paginateDashboardPosts.php?last_id=' + last_id + "&dept=<?php echo $ajaxDeptId; ?>",
            type: "get",
            beforeSend: function(){
                $('.ajax-load').show();
            }
            }).done(function(data){
            $('.ajax-load').hide();
            $("#main-feed-inner").append(data);
            }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('Error loading more posts');
            });
            }
        });
        </script>
        <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
        <script>
        (function (cjs, an) {
        var p; // shortcut to reference prototypes
        var lib={};var ss={};var img={};
        lib.ssMetadata = [];
        (lib.AnMovieClip = function(){
            this.actionFrames = [];
            this.ignorePause = false;
            this.gotoAndPlay = function(positionOrLabel){
                cjs.MovieClip.prototype.gotoAndPlay.call(this,positionOrLabel);
            }
            this.play = function(){
                cjs.MovieClip.prototype.play.call(this);
            }
            this.gotoAndStop = function(positionOrLabel){
                cjs.MovieClip.prototype.gotoAndStop.call(this,positionOrLabel);
            }
            this.stop = function(){
                cjs.MovieClip.prototype.stop.call(this);
            }
        }).prototype = p = new cjs.MovieClip();
        // symbols:
        (lib.BRbuttonhover = function() {
            this.initialize(img.BRbuttonhover);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,60,67);
        (lib.BRbutton = function() {
            this.initialize(img.BRbutton);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,60,67);
        (lib.Chatfeatures = function() {
            this.initialize(img.Chatfeatures);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,346,301);
        (lib.featuresbackbutton = function() {
            this.initialize(img.featuresbackbutton);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,47,49);
        (lib.Main = function() {
            this.initialize(img.Main);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,1006,865);
        (lib.managebuttonhover = function() {
            this.initialize(img.managebuttonhover);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,260,83);
        (lib.managebutton = function() {
            this.initialize(img.managebutton);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,260,83);
        (lib.manage = function() {
            this.initialize(img.manage);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,419,414);
        (lib.membersbuttonhover = function() {
            this.initialize(img.membersbuttonhover);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,260,83);
        (lib.membersbutton = function() {
            this.initialize(img.membersbutton);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,260,83);
        (lib.members = function() {
            this.initialize(img.members);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,419,258);
        (lib.TRbuttonhover = function() {
            this.initialize(img.TRbuttonhover);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,76,69);
        (lib.TRbutton = function() {
            this.initialize(img.TRbutton);
        }).prototype = p = new cjs.Bitmap();
        p.nominalBounds = new cjs.Rectangle(0,0,76,69);
        (lib.TRbutton_1 = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.TRbutton();
            this.instance.setTransform(-37,-34);
            this.instance_1 = new lib.TRbuttonhover();
            this.instance_1.setTransform(-37,-34);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).wait(1));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-37,-34,76,69);
        (lib.membersback = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.featuresbackbutton();
            this.instance.setTransform(-24,-26);
            this.timeline.addTween(cjs.Tween.get(this.instance).wait(4));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-24,-26,47,49);
        (lib.Membersbutton = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.membersbutton();
            this.instance.setTransform(-127,-47);
            this.instance_1 = new lib.membersbuttonhover();
            this.instance_1.setTransform(-127,-47);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).wait(1));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-127,-47,260,83);
        (lib.manageback = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.featuresbackbutton();
            this.instance.setTransform(-24,-26);
            this.timeline.addTween(cjs.Tween.get(this.instance).wait(4));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-24,-26,47,49);
        (lib.ManageChatbutton = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.managebutton();
            this.instance.setTransform(-138,-36);
            this.shape = new cjs.Shape();
            this.shape.graphics.f().s("#F3C359").ss(1,1,1).p("AAAhHICqAAIAACPIiqAAgAAABIIipAAIAAiPICpAA");
            this.shape.setTransform(-8,12.275);
            this.shape_1 = new cjs.Shape();
            this.shape_1.graphics.f("#00CC66").s().p("AAABIIAAiPICqAAIAACPgAAABIIipAAIAAiPICpAAIAACPg");
            this.shape_1.setTransform(-8,12.275);
            this.instance_1 = new lib.managebuttonhover();
            this.instance_1.setTransform(-138,-36);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_1},{t:this.shape},{t:this.instance}]}).to({state:[{t:this.shape_1},{t:this.shape},{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.shape_1},{t:this.shape},{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.shape_1},{t:this.shape},{t:this.instance},{t:this.instance_1}]},1).wait(1));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-138,-36,260,83);
        (lib.featureback = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.featuresbackbutton();
            this.instance.setTransform(-24,-26);
            this.timeline.addTween(cjs.Tween.get(this.instance).wait(4));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-24,-26,47,49);
        (lib.BRbutton_1 = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            // Layer_1
            this.instance = new lib.BRbutton();
            this.instance.setTransform(-28,-36);
            this.instance_1 = new lib.BRbuttonhover();
            this.instance_1.setTransform(-28,-36);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).to({state:[{t:this.instance},{t:this.instance_1}]},1).wait(1));
            this._renderFirstFrame();
        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-28,-36,60,67);
        // stage content:
        (lib.HRv2 = function(mode,startPosition,loop,reversed) {
        if (loop == null) { loop = true; }
        if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);
            this.actionFrames = [0,22,23,24,25];
            // timeline functions:
            this.frame_0 = function() {
                /* Click to Go to Frame and Play
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and continues playback from that frame.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_1.addEventListener("click", fl_ClickToGoToAndStopFromFrame_3.bind(this));
                function fl_ClickToGoToAndStopFromFrame_3()
                {
                    this.gotoAndStop(23);
                }
            }
            this.frame_22 = function() {
                /* Stop at This Frame
                The  timeline will stop/pause at the frame where you insert this code.
                Can also be used to stop/pause the timeline of movieclips.
                */
                this.stop();
            }
            this.frame_23 = function() {
                /* Click to Go to Frame and Play
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and continues playback from that frame.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_2.addEventListener("click", fl_ClickToGoToAndPlayFromFrame_2.bind(this));
                function fl_ClickToGoToAndPlayFromFrame_2()
                {
                    this.gotoAndPlay(1);
                }
                /* Click to Go to Frame and Stop
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and stops the movie.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_3.addEventListener("click", fl_ClickToGoToAndStopAtFrame_2.bind(this));
                function fl_ClickToGoToAndStopAtFrame_2()
                {
                    this.gotoAndStop(24);
                }
                /* Click to Go to Frame and Stop
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and stops the movie.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_5.addEventListener("click", fl_ClickToGoToAndStopAtFrame_4.bind(this));
                function fl_ClickToGoToAndStopAtFrame_4()
                {
                    this.gotoAndStop(25);
                }
            }
            this.frame_24 = function() {
                /* Click to Go to Frame and Stop
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and stops the movie.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_4.addEventListener("click", fl_ClickToGoToAndStopAtFrame_3.bind(this));
                function fl_ClickToGoToAndStopAtFrame_3()
                {
                    this.gotoAndStop(23);
                }
            }
            this.frame_25 = function() {
                /* Click to Go to Frame and Stop
                Clicking on the specified symbol instance moves the playhead to the specified frame in the timeline and stops the movie.
                Can be used on the main timeline or on movie clip timelines.
                Instructions:
                1. Replace the number 5 in the code below with the frame number you would like the playhead to move to when the symbol instance is clicked.
                2.Frame numbers in EaselJS start at 0 instead of 1
                */
                this.button_6.addEventListener("click", fl_ClickToGoToAndStopAtFrame_5.bind(this));
                function fl_ClickToGoToAndStopAtFrame_5()
                {
                    this.gotoAndStop(23);
                }
            }
            // actions tween:
            this.timeline.addTween(cjs.Tween.get(this).call(this.frame_0).wait(22).call(this.frame_22).wait(1).call(this.frame_23).wait(1).call(this.frame_24).wait(1).call(this.frame_25).wait(22));
            // buttons
            this.button_1 = new lib.TRbutton_1();
            this.button_1.name = "button_1";
            this.button_1.setTransform(949.55,118.35);
            new cjs.ButtonHelper(this.button_1, 0, 1, 2, false, new lib.TRbutton_1(), 3);
            this.button_2 = new lib.featureback();
            this.button_2.name = "button_2";
            this.button_2.setTransform(953.7,118.85);
            new cjs.ButtonHelper(this.button_2, 0, 1, 2, false, new lib.featureback(), 3);
            this.button_4 = new lib.manageback();
            this.button_4.name = "button_4";
            this.button_4.setTransform(951.2,120.6);
            new cjs.ButtonHelper(this.button_4, 0, 1, 2, false, new lib.manageback(), 3);
            this.button_6 = new lib.membersback();
            this.button_6.name = "button_6";
            this.button_6.setTransform(956,119.6);
            new cjs.ButtonHelper(this.button_6, 0, 1, 2, false, new lib.membersback(), 3);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.button_1}]}).to({state:[{t:this.button_2}]},23).to({state:[{t:this.button_4}]},1).to({state:[{t:this.button_6}]},1).to({state:[]},1).wait(21));
            // manage_chat
            this.button_3 = new lib.ManageChatbutton();
            this.button_3.name = "button_3";
            this.button_3.setTransform(824.65,212);
            new cjs.ButtonHelper(this.button_3, 0, 1, 2, false, new lib.ManageChatbutton(), 3);
            this.instance = new lib.manage();
            this.instance.setTransform(569,84);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.button_3}]},23).to({state:[{t:this.instance}]},1).to({state:[]},1).to({state:[]},1).wait(21));
            // members
            this.button_5 = new lib.Membersbutton();
            this.button_5.name = "button_5";
            this.button_5.setTransform(813.65,318.2);
            new cjs.ButtonHelper(this.button_5, 0, 1, 2, false, new lib.Membersbutton(), 3);
            this.instance_1 = new lib.members();
            this.instance_1.setTransform(569,84);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.button_5}]},23).to({state:[]},1).to({state:[{t:this.instance_1}]},1).to({state:[]},1).wait(21));
            // send_message
            this.instance_2 = new lib.BRbutton_1();
            this.instance_2.setTransform(852.65,771.3);
            new cjs.ButtonHelper(this.instance_2, 0, 1, 2, false, new lib.BRbutton_1(), 3);
            this.timeline.addTween(cjs.Tween.get(this.instance_2).to({_off:true},23).wait(24));
            // base
            this.instance_3 = new lib.Main();
            this.instance_3.setTransform(1,0);
            this.instance_4 = new lib.Chatfeatures();
            this.instance_4.setTransform(642,84);
            this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance_3}]}).to({state:[{t:this.instance_3},{t:this.instance_4}]},23).to({state:[{t:this.instance_3}]},1).wait(23));
            this._renderFirstFrame();
        }).prototype = p = new lib.AnMovieClip();
        p.nominalBounds = new cjs.Rectangle(504,432.5,503,432.5);
        // library properties:
        lib.properties = {
            id: '1F2FA1D670364F11AC90603AADE29289',
            width: 1006,
            height: 865,
            fps: 30,
            color: "#FFFFFF",
            opacity: 1.00,
            manifest: [
                {src:"../img/BRbuttonhover.png", id:"BRbuttonhover"},
                {src:"../img/BRbutton.png", id:"BRbutton"},
                {src:"../img/Chatfeatures.png", id:"Chatfeatures"},
                {src:"../img/featuresbackbutton.png", id:"featuresbackbutton"},
                {src:"../img/Main.png", id:"Main"},
                {src:"../img/managebuttonhover.png", id:"managebuttonhover"},
                {src:"../img/managebutton.png", id:"managebutton"},
                {src:"../img/manage.png", id:"manage"},
                {src:"../img/membersbuttonhover.png", id:"membersbuttonhover"},
                {src:"../img/membersbutton.png", id:"membersbutton"},
                {src:"../img/members.png", id:"members"},
                {src:"../img/TRbuttonhover.png", id:"TRbuttonhover"},
                {src:"../img/TRbutton.png", id:"TRbutton"}
            ],
            preloads: []
        };
        // bootstrap callback support:
        (lib.Stage = function(canvas) {
            createjs.Stage.call(this, canvas);
        }).prototype = p = new createjs.Stage();
        p.setAutoPlay = function(autoPlay) {
            this.tickEnabled = autoPlay;
        }
        p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
        p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
        p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
        p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }
        p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }
        an.bootcompsLoaded = an.bootcompsLoaded || [];
        if(!an.bootstrapListeners) {
            an.bootstrapListeners=[];
        }
        an.bootstrapCallback=function(fnCallback) {
            an.bootstrapListeners.push(fnCallback);
            if(an.bootcompsLoaded.length > 0) {
                for(var i=0; i<an.bootcompsLoaded.length; ++i) {
                    fnCallback(an.bootcompsLoaded[i]);
                }
            }
        };
        an.compositions = an.compositions || {};
        an.compositions['1F2FA1D670364F11AC90603AADE29289'] = {
            getStage: function() { return exportRoot.stage; },
            getLibrary: function() { return lib; },
            getSpriteSheet: function() { return ss; },
            getImages: function() { return img; }
        };
        an.compositionLoaded = function(id) {
            an.bootcompsLoaded.push(id);
            for(var j=0; j<an.bootstrapListeners.length; j++) {
                an.bootstrapListeners[j](id);
            }
        }
        an.getComposition = function(id) {
            return an.compositions[id];
        }
        an.makeResponsive = function(isResp, respDim, isScale, scaleType, domContainers) {		
            var lastW, lastH, lastS=1;		
            window.addEventListener('resize', resizeCanvas);		
            resizeCanvas();		
            function resizeCanvas() {			
                var w = lib.properties.width, h = lib.properties.height;			
                var iw = window.innerWidth, ih=window.innerHeight;			
                var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
                if(isResp) {                
                    if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
                        sRatio = lastS;                
                    }				
                    else if(!isScale) {					
                        if(iw<w || ih<h)						
                            sRatio = Math.min(xRatio, yRatio);				
                    }				
                    else if(scaleType==1) {					
                        sRatio = Math.min(xRatio, yRatio);				
                    }				
                    else if(scaleType==2) {					
                        sRatio = Math.max(xRatio, yRatio);				
                    }			
                }
                domContainers[0].width = w * pRatio * sRatio;			
                domContainers[0].height = h * pRatio * sRatio;
                domContainers.forEach(function(container) {				
                    container.style.width = w * sRatio + 'px';				
                    container.style.height = h * sRatio + 'px';			
                });
                stage.scaleX = pRatio*sRatio;			
                stage.scaleY = pRatio*sRatio;
                lastW = iw; lastH = ih; lastS = sRatio;            
                stage.tickOnUpdate = false;            
                stage.update();            
                stage.tickOnUpdate = true;		
            }
        }
        an.handleSoundStreamOnTick = function(event) {
            if(!event.paused){
                var stageChild = stage.getChildAt(0);
                if(!stageChild.paused || stageChild.ignorePause){
                    stageChild.syncStreamSounds();
                }
            }
        }
        an.handleFilterCache = function(event) {
            if(!event.paused){
                var target = event.target;
                if(target){
                    if(target.filterCacheList){
                        for(var index = 0; index < target.filterCacheList.length ; index++){
                            var cacheInst = target.filterCacheList[index];
                            if((cacheInst.startFrame <= target.currentFrame) && (target.currentFrame <= cacheInst.endFrame)){
                                cacheInst.instance.cache(cacheInst.x, cacheInst.y, cacheInst.w, cacheInst.h);
                            }
                        }
                    }
                }
            }
        }
        })(createjs = createjs||{}, AdobeAn = AdobeAn||{});
        var createjs, AdobeAn;
        </script>
        <script>
        var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
        function init() {
            canvas = document.getElementById("canvas");
            anim_container = document.getElementById("animation_container");
            dom_overlay_container = document.getElementById("dom_overlay_container");
            var comp=AdobeAn.getComposition("1F2FA1D670364F11AC90603AADE29289");
            var lib=comp.getLibrary();
            var loader = new createjs.LoadQueue(false);
            loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
            loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
            var lib=comp.getLibrary();
            loader.loadManifest(lib.properties.manifest);
        }
        function handleFileLoad(evt, comp) {
            var images=comp.getImages();	
            if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
        }
        function handleComplete(evt,comp) {
            //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
            var lib=comp.getLibrary();
            var ss=comp.getSpriteSheet();
            var queue = evt.target;
            var ssMetadata = lib.ssMetadata;
            for(i=0; i<ssMetadata.length; i++) {
                ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
            }
            exportRoot = new lib.HRv2();
            stage = new lib.Stage(canvas);
            stage.enableMouseOver();	
            //Registers the "tick" event listener.
            fnStartAnimation = function() {
                stage.addChild(exportRoot);
                createjs.Ticker.framerate = lib.properties.fps;
                createjs.Ticker.addEventListener("tick", stage);
            }	    
            //Code to support hidpi screens and responsive scaling.
            AdobeAn.makeResponsive(true,'both',false,1,[canvas,anim_container,dom_overlay_container]);	
            AdobeAn.compositionLoaded(lib.properties.id);
            fnStartAnimation();
        }
        </script>
    </head>
    <body>

        <!--Post Button Popup Script-->
        <script>
            function togglePopupPost() {
                document.getElementById('post-creator-main').style.display="block";
            }
        </script>

        <!--Msg Popup Script-->
        <script>
            function togglePopup() {
                document.getElementById('popup-msg-box').style.display="block";
            }
            
            function closeTogglePopup() {
                document.getElementById('popup-msg-box').style.display="none";
            }
        </script>

        <!--Popup Post-->
        <div id="post-creator-main">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Post')" id="defaultOpen">Post</button>
                <button class="tablinks" onclick="openTab(event, 'Announcement')">Announcement</button>
            </div>

            <div id="Post" class="tabcontent">
            <p><?php include("inc/new-post.php"); ?></p> 
            </div>

            <div id="Announcement" class="tabcontent">
            <p><?php include("inc/new-anc.php"); ?></p> 
            </div>
        </div>

        <!-- Post Tabs Script -->
        <script>
            function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

        <!--Navbar-->
        <?php require_once("inc/navbar.php"); ?>
        

        <div class="wrapper">

            <!-- Company Info Sidebar -->
            <nav id="sidebar-left" class="sidebar">
                <ul class="list-unstyled components">
                    <div class="sidebar-header">
                        <img src="<?php echo $companyLogo ?>" class="img-responsive post-icons post-pfp" alt="Company Logo"/>
                        <span>Company Info</span>
                    </div>
                    <div class="sidebar-subtext"><?php echo "$companyName: $companyIndustry"?></div>
                    <li>
                        <a href="<?php echo $companyWebsite?>" target="_blank">Website Link</a>
                    </li>
                    <li>
                        <a href="<?php echo $companyLinkedIn?>" target="_blank">LinkedIn Link</a>
                    </li>
                    <li>
                        <a><?php echo $companyAddress?></a>
                    </li>
                    <li>
                        <a href="staff-roster.php">Staff Roster</a>
                    </li>
                    <br>
                    <div class="sidebar-header">Messaging</div>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Active Chats</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li onClick="togglePopup(); init()">
                                <img src="img/pfp-button.png" alt="message button" class="message-img"/>
                                <span>Chat #1</span>
                                
                            </li>
                        </ul>
                    </li>
                    <br>
                    <div class="sidebar-header">Admin Tools</div>
                    <?php
                    if(isHr() || isAdmin()){
                        echo "<li><a href='reports.php'>View Reports</a></li>";
                    }
                    if(isIt() || isAdmin()){
                        echo "<li><a href='tickets.php'>View Tickets</a></li>";
                    }
                    if(isAdmin() || isOnboarding()){
                        echo "<li><a href='users.php'>Employee Accounts</a></li>";
                    }
                    ?>
                </ul>
            </nav>

            
            <div id="popup-msg-box" class="popup-msg-box">
                <div class="chat-box">
                    <?php include("inc/message-box.php")?>
                </div>
            </div>
        <!--Main Feed-->

        <div class="dashboard-box">

        <!--Employee Creation Alert Popups PHP-->
        <?php
            switch(@$_SESSION['createEResult']){
                case "signup-success":
            echo "<div class='alert alert-success'>Your employee has successfully been created!</div>";
            unset($_SESSION['postResult']);
                break;
            }  
        ?>

        <!-- User Edit Alert Popups PHP -->
        <?php
            switch(@$_SESSION['userEdit']){
                case "user-delete-success":
                echo "<div class='alert alert-success'>User account has been deleted.</div>";
            unset($_SESSION['userEdit']);
                break;
                case "user-delete-error":
                echo "<div class='alert alert-danger'>There was an error deleting this user account.</div>";
            unset($_SESSION['userEdit']);
                break;
                case "edit-user-error":
                echo "<div class='alert alert-success'>User details failed to updated. Please try again.</div>";
            unset($_SESSION['userEdit']);
                break;
                case "edit-user-error-missing-fields":
                echo "<div class='alert alert-danger'>Please make sure all fields are filled in for the user.</div>";
            unset($_SESSION['userEdit']);
                break;
            }
        ?>

        <!--Report Alert Popups PHP-->
        <?php
        switch(@$_SESSION['reportResult']){
            case "report-success":
                echo "<div class='alert alert-success'>Your report has successfully been submitted!</div>";
                unset($_SESSION['reportResult']);
                    break;
        }  
        ?>

        <!--Ticket Alert Popups PHP-->
        <?php
        switch(@$_SESSION['ticketResult']){
            case "ticket-success":
                echo "<div class='alert alert-success'>Your ticket has successfully been submitted!</div>";
                unset($_SESSION['ticketResult']);
                    break;
        }  
        ?>

        <!--Post Alert Popups PHP-->
        <?php
        switch(@$_SESSION['postResult']){
            case "post-success":
        echo "<div class='alert alert-success'>Your post has been saved!</div>";
        unset($_SESSION['postResult']);
            break;
            case "post-delete-success":
        echo "<div class='alert alert-success'>Post has been deleted</div>";
        unset($_SESSION['postResult']);
            break;
            case "post-delete-error":
        echo "<div class='alert alert-danger'>There was an error deleting the post. Please try again later.</div>";
        unset($_SESSION['postResult']);
            break;
        }  
        ?>

        <!--Announcement Alert Popups PHP-->
        <?php
        switch(@$_SESSION['ancResult']){
            case "anc-success":
        echo "<div class='alert alert-success'>Your announcement has been saved!</div>";
        unset($_SESSION['ancResult']);
            break;
            case "anc-delete-success":
        echo "<div class='alert alert-success'>Announcement has been deleted</div>";
        unset($_SESSION['ancResult']);
            break;
            case "anc-delete-error":
        echo "<div class='alert alert-danger'>There was an error deleting the announcement. Please try again later.</div>";
        unset($_SESSION['ancResult']);
            break;
        }  
        ?>

        <div class="filter-box">
            <button class="btn-filter"><a href="dashboard.php">Main Feed</a></button>
            <li class="dept-dropdown-btn">
                <button class="btn-filter">Departments</button>
                <ul class="dept-dropdown">
                    <div class="dept-dropdown-arrow-up"></div>
                    <li><a href="dashboard.php?dept=1">HR</a></li>
                    <li><a href="dashboard.php?dept=2">Marketing</a></li>
                    <li><a href="dashboard.php?dept=3">Sales</a></li>
                    <li><a href="dashboard.php?dept=4">IT</a></li>
                    <li><a href="dashboard.php?dept=5">Legal</a></li>
                    <li><a href="dashboard.php?dept=6">Operations</a></li>
                    <li><a href="dashboard.php?dept=7">Board of Directors</a></li>
                    <li><a href="dashboard.php?dept=8">Customer Service</a></li>
                    <li><a href="dashboard.php?dept=9">Onboarding</a></li>
                </ul>
            </li>
            <button class="btn-filter"><a href="announcements.php">Announcements</a></button>
        </div>

        <div id="main-feed">
            <div id="content">
                <div class="container-fluid" id="main-feed-inner">
                    <?php
                    $deptfeed = (int) mysqli_real_escape_string($connect, @$_GET['dept']);
                    if($deptfeed == 0){
                        $sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_company_id = $companyId ORDER BY main_post_id DESC LIMIT 9");
                    } else {
                        $sql = mysqli_query($connect, "SELECT * FROM main_post WHERE main_post_dept_id = '$deptfeed' AND main_post_company_id = $companyId ORDER BY main_post_id DESC LIMIT 9");
                    } 
                    
                    if(mysqli_num_rows($sql) == 0){
                        echo "<div style='text-align:center; font-size: 20pt; color:#4A3D34; margin-top:100px;'>No posts made!</div>";
                    }

                    while($row = mysqli_fetch_array($sql)){
                        $postId = $row['main_post_id'];
                        $postCaption = stripslashes($row['main_post_caption']);
                        $postImg = stripslashes($row['main_post_img']);
                        $postDept = stripslashes($row['main_post_dept_id']);
                        $date = stripslashes($row['main_post_create_date']);
                        $postUser = stripslashes($row['main_post_user_id']);
                        $user = getUserDetails($postUser);
                        $pfp = $user['pfp'];
                        $username = $user['username'];
                        $department = $departmentsArr[$postDept];
                        $position = $user['position']; 

                        if($pfp != "" && $pfp != null){
                            if(file_exists("uploads/$pfp")){
                                $pfp = "uploads/$pfp";
                            }else{
                                $pfp = $defaultProfilePic;
                            }
                        }else{
                            $pfp = $defaultProfilePic;
                        }

                        if(strlen($postCaption) > 300){
                            // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                            $postCaption = substr($postCaption, 0, 300)." ... <a href='read-post.php?id=$postId' class='small font-weight-light'>read more</a>";
                        }

                        $postCaption = nl2br($postCaption);
                        
                        // make new lines into a <br /> tag

                        echo "
                        <br>
                        <div class='post-wrapper' id='$postId'>
                            <div class='post-wrapper-inner'>
                            <div class='post-column post-preview'>
                                <div class='post-img-box'>
                                    <a href='user-profile.php?user_id=$postUser'><img src='$pfp' class='img-responsive post-icons post-pfp' alt='Profile Picture'/>
                                    <span class='post-username'>$username</span>
                                    <a href='read-post.php?id=$postId'><img src='uploads/$postImg' alt='Post Image' class='post-img img-responsive'/></a>
                                </div>
                            </div>
                            <div class='post-column post-caption-box'>
                                <div class='post-caption'><div>$postCaption</div></div>
                                <div class='post-toggle'>
                                    <div class='post-buttons'>
                                        <div class='post-btns'>
                                            <span class='post-username'>$department | $position on $date</span></a>
                                        </div>
                                        <a href='read-post.php?id=$postId'>
                                            <button class='post-btns like-button'><img src='img/like-icon.png' class='post-icons' alt='Like Button'></button>
                                            <button class='post-btns dislike-button'><img src='img/dislike-icon.png' class='post-icons' alt='Dislike Button'></button>
                                            <button class='post-btns comment-button'><img src='img/comment-icon-circle.png' class='post-icons' alt='Comment Button'></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
        <a id="loadMorePostsBtn" class="btn btn-primary">Load More</a>

        <button onclick="topFunction()" id="top-btn" title="Go to top">&#8593;</button>

        <script>
            // Get the button
            let mybutton = document.getElementById("top-btn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                location.reload();
            }
        </script>
        
        <div>
            <!-- Announcement Sidebar -->
            <nav id="sidebar-right" class="sidebar">
                <ul class="list-unstyled components">
                    <div class="sidebar-header">Company Announcements</div>
                    <?php
                    $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_dept_id = '0' AND announce_company_id = $companyId ORDER BY announce_id DESC LIMIT 5");
                    if (mysqli_num_rows($sql) > 0) {
                        while($row = mysqli_fetch_array($sql)){
                            $ancId = $row['announce_id'];
                            $ancCaption = stripslashes($row['announce_caption']);
                            $ancImg = stripslashes($row['announce_img']);
                            $ancDept = stripslashes($row['announce_dept_id']);
                            $ancUser = stripslashes($row['announce_user_id']);

                            if(strlen($ancCaption) > 100){
                                // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                                $ancCaption = substr($ancCaption, 0, 94)." ... <span class='small font-weight-light'>read more</span>";
                            }
    
                            $ancCaption = nl2br($ancCaption);
                            // make new lines into a <br /> tag
    
                            echo "<li><a href='read-anc.php?id=$ancId'>$ancCaption</a></li>";
                        }
                    } else {
                        echo "<li><a>No announcements made!</a></li>";
                    }
                    ?>
                    <br>
                    <div class="sidebar-header"><?php echo $departmentName;?> Announcements</div>
                    <?php
                    $sql = mysqli_query($connect, "SELECT * FROM announce WHERE announce_dept_id = $dept AND announce_company_id = $companyId ORDER BY announce_id DESC LIMIT 5");
                    if(mysqli_num_rows($sql)>0){
                        while($row = mysqli_fetch_array($sql)){
                            $ancId = $row['announce_id'];
                            $ancCaption = stripslashes($row['announce_caption']);
                            $ancImg = stripslashes($row['announce_img']);
                            $ancDept = stripslashes($row['announce_dept_id']);
                            $ancUser = stripslashes($row['announce_user_id']);
    
                            if(strlen($ancCaption) > 100){
                                // if the post is more than 100 characters, only show the first 100, and add a "... read more" link to the end. This helps the page look cleaner if the post is really long
                                $ancCaption = substr($ancCaption, 0, 94)." ... <span class='small font-weight-light'>read more</span>";
                            }
    
                            $ancCaption = nl2br($ancCaption);
                            // make new lines into a <br /> tag
    
                            echo "<li><a href='read-anc.php?id=$ancId'>$ancCaption</a></li>";
                        }
                    } else {
                        echo "<li><a>No announcements made!</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </body>    
</html>
