		<style>
		.wrapper {
	  width: 600px;
	  margin: 0 auto;
	}

	.rang {
	  text-align: center;
	}

	.rang-title {
	  display: inline-block;
	  width: 200px;
	}

	.rang-number {
	  width: 100%;
	  margin-top: 40px;
	  text-align: center;
	  border-width: 0;
	  font-size: 50px;
	  font-weight: 900;
	  background-color: #faf9f7;
	  color: #0093d7;
	}

	.rang-slider[type=range] {
	  width: 400px;
	  margin-top: 40px;
	  -webkit-appearance: none;
	}

	.rang-slider[type=range]:focus {
	  outline: none;
	}

	.rang-slider[type=range]::-webkit-slider-runnable-track {
	  width: 100%;
	  height: 20px;
	  border-radius: 25px;
	  background: #0093d7;
	  cursor: pointer;
	}

	.rang-slider[type=range]::-webkit-slider-thumb {
	  width: 50px;
	  height: 20px;
	  margin-top: 0;
	  border-radius: 25px;
	  background: #ffc815;
	  -webkit-appearance: none;
	  cursor: pointer;
	}

	.rang-slider[type=range]:focus::-webkit-slider-runnable-track {
	  background: #a3cd3b;
	}

	.meter {
	  display: block;
	  width: 360px;
	  height: 360px;
	  margin: 0 auto;
	}

	.meter-left {
	  transform: skewX(-2deg) skewY(1deg);
	  stroke-width: 58;
	  stroke-dashoffset: 253;
	  stroke-dasharray: 120 400;
	  stroke: #ffc815;
	  fill: none;
	}

	.meter-center {
	transform: skewX(0deg) skewY(0deg);
	  stroke-width: 56;
	  stroke-dashoffset: 128;
	  stroke-dasharray: 120 400;
	  stroke: #a3cd3b;
	  fill: none;
	}

	.meter-right {
	  transform: skewX(2deg) skewY(1deg);
	  stroke-width: 58;
	  stroke-dashoffset: 5;
	  stroke-dasharray: 120 400;
	  stroke: #0093d7;
	  fill: none;
	}

	.meter-down{
			
		transform: skewX(1deg) skewY(1deg);
		stroke-width: 56;
		stroke-dashoffset: -126;
		stroke-dasharray: 138 400;
		 stroke: red;
		 fill: none;
		}
		.meter-clock {
		  transform: rotate(-54deg);
		  transform-origin: 137px 146px;
		  fill: black;
		}

		.meter-circle {
		  fill: black;
		}
		</style>

		<div class="wrapper">
		    <div class="rang">
		        <div class="rang-title"><input class="rang-number" id="show" type="text" value="1" disabled="disabled" /></div><svg class="meter">
		        	<circle class="meter-left" r="96" cx="135" cy="142"></circle>
		        	<circle class="meter-center" r="96" cx="135" cy="142"></circle>
		        	<circle class="meter-right" r="96" cx="135" cy="142"></circle>
		        	<circle class="meter-down" r="96" cx="135" cy="142"></circle>
		        	<polygon class="meter-clock" points="129,145 137,90 145,145"></polygon>
		        	<circle class="meter-circle" r="10" cx="137" cy="145"></circle>
		        </svg>
		        <input            class="rang-slider" id="range" type="range" min="0" max="100" /></div>
		</div>
		<script >
			'use strict';

		  var rangeMeter = document.querySelector('#range');
		  var rangeShow = document.querySelector("#show");
		  var rangeClock =  document.querySelector('.meter-clock');

		  function rangeChange() {
		    var rotateClock = rangeMeter.value;

		    rangeClock.style.transform = 'rotate(' + (-90 + ((rotateClock * 360) / 100)) + 'deg)';
		    rangeShow.value = rotateClock ;
		    if(rotateClock==0)
		    {
		    	rangeShow.value="0";
		    }
		    else if(rotateClock>0 && rotateClock<20)
		    {
		    	rangeShow.value="1";
		    }
		    else if(rotateClock>=20 && rotateClock<40)
		    {
		    	rangeShow.value="2";
		    }
		    else if(rotateClock>=40 && rotateClock<60)
		    {
		    	rangeShow.value="3";
		    }
		    else if(rotateClock>=60 && rotateClock<80)
		    {
		    	rangeShow.value="4";
		    }
		    else if(rotateClock>=80 && rotateClock<=100)
		    {
		    	rangeShow.value="5";
		    }


		  }

			rangeMeter.addEventListener('input', rangeChange);
		</script>