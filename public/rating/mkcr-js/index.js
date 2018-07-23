/*
********************************************************************************************************************************************
********************************************************************************************************************************************
All Rights Reserved, Muwakaba © 2016
http://www.muwakaba.com
********************************************************************************************************************************************
********************************************************************************************************************************************
*/


window.onload = function(){

    for(var i = 1; i<=6; i++){
        hand_more(i);
    }

    var menu_count = document.getElementById('menu_body').getElementsByTagName('a').length;

    for(var i=0; i<menu_count; i++){
        document.getElementById('menu_body').getElementsByTagName('a')[i].href = 'javascript:void(0)';

        document.getElementById('menu_body').getElementsByTagName('a')[i].onclick = function(){

            if(this.innerHTML =='About'){
                animate.scroll({elIdToMove:'section1', initialPos:'section1' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Demo'){
                animate.scroll({elIdToMove:'section2', initialPos:'section2' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Features'){
                animate.scroll({elIdToMove:'section3', initialPos:'section3' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Contact'){
                animate.scroll({elIdToMove:'section4', initialPos:'section4' , finalPos:0, delay:10, step:1 });
            }
             else if(this.innerHTML =='Blog'){
                //window.location.href = 'http://www.muwakaba.com/blog';
                window.open('http://www.muwakaba.com/blog','_blank');
            }
             else if(this.innerHTML =='Company Website'){
                 //window.location.href = 'http://www.muwakaba.com';
                window.open('http://www.muwakaba.com','_blank');
            }
        };
    }



    document.getElementById('menu_button').onclick = function(e){

        e? e : e=event;
        origEl= e.srcElement || e.target;
        //alert(  document.getElementById(origEl.id).type  );
        //alert(origEl.id);

        if(document.getElementById('menu_body').style.display == 'block'){
            document.getElementById('menu_body').style.display = 'none';
        }
        else{
            document.getElementById('menu_body').style.display = 'block';
        }

    }


    document.getElementById('site_body').onclick = function(e){
        e? e : e=event;
        origEl= e.srcElement || e.target;
        if(origEl.id != 'menu_button'){
            document.getElementById('menu_body').style.display = 'none';
        }
    };



    window.onresize();


    //forceHeight();
};




var hand_more = function(i){

    d('more_button'+i).onclick = function(){

        if(  d('setup'+i).className == 'code'  ){
            d('setup'+i).className = 'code full';
            d('more_button'+i).innerHTML = 'Minimize';
        }
        else{
            d('setup'+i).className = 'code';
            d('more_button'+i).innerHTML = 'See All';
        }
    };


    d('more_specs_button'+i).onclick = function(){

        if(  d('specs'+i).className == 'specs'  ){
            d('specs'+i).className =  'full';  // not working I don't know why!!! 'specs full';
            d('more_specs_button'+i).innerHTML = 'Minimize';
        }
        else{
            d('specs'+i).className = 'specs';
            d('more_specs_button'+i).innerHTML = 'See All';
        }

    };
};



function forceHeight(){

    var first_box_height = document.getElementById('first_box').clientHeight;
    var second_box_height = document.getElementById('second_box').clientHeight;
    var third_box_height = document.getElementById('third_box').clientHeight;
    var fourth_box_height = document.getElementById('fourth_box').clientHeight;
    var fivth_box_height = document.getElementById('fifth_box').clientHeight;
    var sixth_box_height = document.getElementById('sixth_box').clientHeight;


    var max_height = Math.max(first_box_height, second_box_height /*, third_box_height*/);


    document.getElementById('first_box').style.height = max_height+'px';
    document.getElementById('second_box').style.height = max_height+'px';
    document.getElementById('third_box').style.height = max_height+'px';
    document.getElementById('fourth_box').style.height = max_height+'px';
};




window.onresize=function(){

    //forceHeight();
                                      //alert(document.documentElement.clientWidth);
    if( document.documentElement.clientWidth < 1200 /*751*/){
        document.getElementById('first_box').style.maxWidth = '100%';
        document.getElementById('first_box').style.margin = '12px 5px 12px 5px';

        document.getElementById('second_box').style.maxWidth = '100%';
        document.getElementById('second_box').style.margin = '12px 5px 12px 5px';

        document.getElementById('third_box').style.maxWidth = '100%';
        document.getElementById('third_box').style.margin = '12px 5px 12px 5px';

        document.getElementById('fourth_box').style.maxWidth = '100%';
        document.getElementById('fourth_box').style.margin = '12px 5px 12px 5px';

        document.getElementById('fifth_box').style.maxWidth = '100%';
        document.getElementById('fifth_box').style.margin = '12px 5px 12px 5px';

        document.getElementById('sixth_box').style.maxWidth = '100%';
        document.getElementById('sixth_box').style.margin = '12px 5px 12px 5px';


    }
    else{
        document.getElementById('first_box').style.maxWidth = '534px'; //'300px';
        document.getElementById('first_box').style.margin = '12px';

        document.getElementById('second_box').style.maxWidth = '534px'; //'300px';
        document.getElementById('second_box').style.margin = '12px';

        document.getElementById('third_box').style.maxWidth = '100%';//'1060px'; //'300px';
        document.getElementById('third_box').style.margin = '12px';

        document.getElementById('fourth_box').style.maxWidth = '346px'; //'300px';
        document.getElementById('fourth_box').style.margin = '12px';

        document.getElementById('fifth_box').style.maxWidth = '346px'; //'300px';
        document.getElementById('fifth_box').style.margin = '12px';

        document.getElementById('sixth_box').style.maxWidth = '346px'; //'300px';
        document.getElementById('sixth_box').style.margin = '12px';

    }







    var footer_count = document.getElementById('footer_list').getElementsByTagName('a').length;

    for(var i=0; i<footer_count; i++){
        document.getElementById('footer_list').getElementsByTagName('a')[i].href = 'javascript:void(0)';

        document.getElementById('footer_list').getElementsByTagName('a')[i].onclick = function(){

           if(this.innerHTML =='About'){
                animate.scroll({elIdToMove:'section1', initialPos:'section1' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Demo'){
                animate.scroll({elIdToMove:'section2', initialPos:'section2' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Features'){
                animate.scroll({elIdToMove:'section3', initialPos:'section3' , finalPos:0, delay:10, step:1 });
            }
            else if(this.innerHTML =='Blog'){
                //window.location.href = 'http://www.muwakaba.com/blog';
                window.open('http://www.muwakaba.com/blog','_blank');
            }
             else if(this.innerHTML =='Company Website'){
                 //window.location.href = 'http://www.muwakaba.com';
                window.open('http://www.muwakaba.com','_blank');
            }


        };
    }




};





// for the go up icon
//==========================================================================================================================================

window.onscroll = function(){


    var heightOffset = document.documentElement.scrollTop ||   window.pageYOffset;

    if(heightOffset > 100){

        // to see if the screen is narrow (have two boxes in row or less), then show the go up button, else no need
        if( document.documentElement.clientWidth < 10034543543543543534543000){
            document.getElementById('goup').className = 'goUp trans borRad';
        }
        else{
            document.getElementById('goup').className = 'hid';
        }


    }
    else{
        document.getElementById('goup').className = 'hid';
    }

    document.getElementById('goup').onclick = function(){
        animate.scroll({elIdToMove:'headInner', initialPos:'headInner' , finalPos:0, delay:10, step:1 });
    }
}
//==========================================================================================================================================



var g_analytics = function(){

    // to avoid anayltics on some ages
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if(filename.split('.')[0] == 'mind'){
        return;
    }


    // to avoid anayltics on localhost
    if(document.domain =='localhost'){
        return;
    }

    //setTimeout(function(){

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-56909666-1', 'auto');
        ga('send', 'pageview');



    //}, 10);

};

if(window.addEventListener){

    window.addEventListener("load", function(event){
        g_analytics();
    }, false);

}

// for IE <9
else if (window.attachEvent){

    window.attachEvent("onload", function(event){
        g_analytics();
    },false);

}



