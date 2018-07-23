/*
********************************************************************************************************************************************
********************************************************************************************************************************************
All Rights Reserved, Muwakaba © 2016
http://www.muwakaba.com
********************************************************************************************************************************************
********************************************************************************************************************************************
*/

// To view the final result:
// muwakaba_circular_rating.elementId
/*
setTimeout(function(){
    alert( muwakaba_circular_rating.twix );
    alert(muwakaba_circular_rating[elementId])
},3000);
*/

muwakaba_circular_rating.onload = function(){

    muwakaba_circular_rating.build({

        elementId:'galaxy',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:3,
        stroke_background_colors:{original:'#666', hover:'#adff2f', sticky:'#ffd700'},
        icon_background_color:'#f8f8f8',
        icon_size: {width:'63px', height:'90px'},
        holder_size: {width:'200px', height:'200px'},
        stroke_thickness: '30',
        read_only:0,
        onClick:function(elementId, result){/*alert(muwakaba_circular_rating[elementId])*/}
    });


    muwakaba_circular_rating.build({

        elementId:'snickers',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:0,
        stroke_background_colors:{original:'#ffe6ff', hover:'#ff00ff', sticky:'#660066'},
        icon_background_color:'#fff4ff',
        icon_size: {width:'68px', height:'95px'},
        holder_size: {width:'200px', height:'200px'},
        stroke_thickness: '22',
        read_only:0,
        onClick:function(elementId, result){}
    });
    
    
    
    
    muwakaba_circular_rating.build({

        elementId:'kitkat',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:1,
        stroke_background_colors:{original:'#ccffff', hover:'#00ccff', sticky:'#3366cc'},
        icon_background_color:'#fff',
        icon_size: {width:'63px', height:'90px'},
        holder_size: {width:'240px', height:'240px'},
        stroke_thickness: '40',
        read_only:0,
        onClick:function(elementId, result){}
    });
    
    
    
    
    muwakaba_circular_rating.build({

        elementId:'bounty',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:2,
        stroke_background_colors:{original:'#ffe6e6', hover:'#cc0000', sticky:'#cc0000'},
        icon_background_color:'#fff4ff',
        icon_size: {width:'73px', height:'100px'},
        holder_size: {width:'210px', height:'210px'},
        stroke_thickness: '15',
        read_only:1,
        onClick:function(elementId, result){}
    });
    
    
    
    muwakaba_circular_rating.build({

        elementId:'aero',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:3,
        stroke_background_colors:{original:'#d6d6c2', hover:'#414141', sticky:'#ffcc99'},
        icon_background_color:'#f0f0f0',
        icon_size: {width:'53px', height:'70px'},
        holder_size: {width:'180px', height:'180px'},
        stroke_thickness: '30',
        read_only:0,
        onClick:function(elementId, result){}
    });

    
    
    muwakaba_circular_rating.build({

        elementId:'twix',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:4,
        stroke_background_colors:{original:'#c0c0c0', hover:'#85adad', sticky:'#414141'},
        icon_background_color:'#f0f0ff',
        icon_size: {width:'38px', height:'55px'},
        holder_size: {width:'150px', height:'150px'},
        stroke_thickness: '40',
        read_only:0,
        onClick:function(elementId, result){}
    });
    
    
    muwakaba_circular_rating.build({

        elementId:'mars',
        icons_folder_name:'mkcr-icons',
        icon_name:'test.png',
        // from 1 to 5.
        result:5,
        stroke_background_colors:{original:'#d6d6c2', hover:'#e6e600', sticky:'#00e600'},
        icon_background_color:'#ffffe6',
        icon_size: {width:'33px', height:'50px'},
        holder_size: {width:'120px', height:'120px'},
        stroke_thickness: '28',
        read_only:0,
        onClick:function(elementId, result){}
    });

};


if(window.addEventListener){

    window.addEventListener("load", function(event){
        muwakaba_circular_rating.onload();
    }, false);

}

// for IE <9
else if (window.attachEvent){

    window.attachEvent("onload", function(event){
        muwakaba_circular_rating.onload();
    },false);

}

